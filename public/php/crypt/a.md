Web狗要懂的Padding Oracle攻击
2017.11.08 21:47:44
字数 1129阅读 2293

之前写CBC翻转攻击的时候就在想什么时候能遇到Padding Oracle的题目hhhhh 想不到这么快就遇到了hhhhh
题目

题目ruby代码如下：

#!/usr/bin/ruby -w
require 'openssl'
require 'base64'

def banner()
    puts ' ____________________________________________'
    puts '|                                            |'
    puts '| Welcome to our secure communication system |'
    puts '| Our system is secured by AES               |'    
    puts '| So...No key! No Message!                   |'
    puts '|____________________________________________|'
    puts ''
end

def option()
    puts '1. Get the secret message.'
    puts '2. Encrypt the message'
    puts '3. Decrypt the message.'
    puts 'Give your option:'
    STDOUT.flush
    op=gets
    return op.to_i
end

def init()
    file_key=File.new("./aeskey","r")
    $key=file_key.gets
    file_key.close()
end
def aes_encrypt(iv,data)
    cipher = OpenSSL::Cipher::AES.new(256, :CBC)
    cipher.encrypt
    cipher.key = $key
    cipher.iv  = iv
    cipher.update(data) << cipher.final
end

def aes_decrypt(iv,data)
    cipher = OpenSSL::Cipher::AES.new(256, :CBC)
    cipher.decrypt
    cipher.key = $key
    cipher.iv  = iv
    data = cipher.update(data) << cipher.final
end

def output_secret()
    file_secret=File.new("./flag","r")
    secret=file_secret.gets
    file_secret.close
    secret_enc=aes_encrypt("A"*16,secret)
    secret_enc_b64=Base64.encode64(secret_enc)
    puts secret_enc_b64 
end

init
banner
while true do
    begin
        op=option
        if op==1
            output_secret
        elsif op==2
            puts "IV:"
            STDOUT.flush
            iv=Base64.decode64(gets)
            puts "Data:"
            STDOUT.flush
            data=Base64.decode64(gets)
            data_enc=aes_encrypt iv,data
            puts Base64.encode64(data_enc)
            puts "Encrytion Done"    
            STDOUT.flush
        elsif op==3
            puts "IV:"
            STDOUT.flush
            iv=Base64.decode64(gets)
            puts "Data:"
            STDOUT.flush
            data=Base64.decode64(gets)
            data_dec=aes_decrypt iv,data
            puts data_dec
            puts "Decrpytion Done"
            STDOUT.flush
        else
            puts 'Wrong Option'
            STDOUT.flush
        end
    rescue Exception => e  
        puts e.message
        STDOUT.flush
        retry
    end
end

可以得出题目的基本信息：

    1选项：
    输出经过aes-256-cbc加密的flag
    2选项：
    提供你的IV和要加密的数据，返回加密后的密文
    3选项：
    提供你的IV和要解密的数据，不返回解密明文，只返回解密成功是否

我们可以从源码获取到的信息有：

    加密flag所采用的IV为16个字符A
    不能获取到加密flag所用的密钥
    解密时IV与密文可控

背景知识：

    加密过程

    cbcEncrypt.png

    首先将明文分成每X位一组，位数不足的是用特殊字符填充！！！！！！！
    X常见的为16位，也有32位
    这里要注意，CBC的填充规则（有PKCS5和PKCS7，区别这里使用的是PKCS7 图解如下）是缺少N位，就用 N 个 '\xN'填充，如缺少10位则用 10 个 '\x10'填充
    然后生成初始向量IV(这里的初始向量如果未特定给出则随机生成)和密钥
    将初始向量与第一组明文异或生成密文A
    用密钥加密密文A 得到密文A_1
    重复3 将密文A_1与第二组明文异或生成密文B
    重复4 用密钥加密密文B_1
    重复3-6 直到最后一组明文
    将IV和加密后的密文拼接在一起，得到最终的密文(也可以不拼接)

    解密过程

    cbcDecrypt.png

    解密过程则是相反的

    首先从最终的密文中提取出IV (IV为加密时指定的X位) //如果加密时没有加入IV则不用提取
    将密文分组
    使用密钥对第一组密文解密得到密文A，然后用IV进行异或得到第一组明文
    使用密钥对第二组密文解密得到密文B，然后用A与B进行异或得到第二组明文
    重复3-4 直到最后一组密文

攻击

与CBC翻转攻击不同的地方是 我们这里不知道解密之后的明文，只知道并可控IV和密文，对了 还有解密是否成功
解密是否成功这个点成为了padding oracle攻击至关重要的一点，
因为我们知道padding只能为：

data 0x01 或
data 0x02 0x02 或
data 0x03 0x03 0x03 或
data 0x04 0x04 0x04 0x04 或
data 0x05 0x05 0x05 0x05 0x05 或
......

那如果出现以下这种padding的时候会怎么样呢？
data 0x05 0x05
（正常来说这个padding应为data 0x05 0x05 0x05 0x05 0x05）
那解密之后的检验就会出现错误，因为padding的位数和padding内容不一致
如果这个服务没有catch这个错误的话那么程序就会中途报错退出，表现为，如http服务的status code为500
那么这里就给了我们一个爆破的机会，假如在第一组解密中，我们输入解密的IV为16个0x00的话，解密过程就为：
00wrong.png

最后一位为0x3D，不符合padding规则
我们将IV的最后一位递增，然后提交，在0x00到0xFF中，只会有一个异或middle最后一位之后会得到0x01，也就是正确的padding，这时候服务正常解密(只是解密出来的结果不是原来的明文而已)，则假设Plainttext为明文，middle为经过aes解密之后尚未和IV异或的值，IV[0]则为需要遍历爆破的十六进制，有
00true.png

//根据
middle[最后一位] ^ IV[最后一位] = 0x01
middle[最后一位] = IV[最后一位] ^ 0x01
//因为正常的解密步骤是middle异或加密时使用的old_IV，所以
Plainttext[最后一位] = middle[最后一位] ^ old_IV[最后一位]

到这里我们就能在不知道密钥的情况下爆破出最后一位的明文了
接下来我们要爆破倒数第二位，后两位正确的padding应该是
data 0x02 0x02
首先我们得先把最后一位调整成0x02，所以

IV[0] = middle[0] ^ 0x02
//那么解密的时候middle[0] ^ IV[0]就会始终等于0x02了

然后继续从0x00爆破到0xFF，得到正确的解密提示之后将爆破得到的值异或old_IV[倒数第二位]就是Plainttext[倒数第二位了]
以此类推.....

但是在解密第二组及其以后的组的时候有一个注意的地方，经过aes解密之后的middle要异或的不再是IV了，而是前一组密文！！
坑点：

    首先记得查看加密的初始IV是多少位，再根据这个位数将密文分组！按组爆破！
    其次是IV是每爆破出一位最好都要重新根据middle生成爆破位后面的位数 （之前就是这个点坑了我一个通宵。。。。）

解题脚本 1:

from pwn import *
import base64 as b64

IV = ['\x00'] * 16
secret = 'nPQctp6AezY8BcGPjlYW8Pv+Fpo15LeatsVbj47jqgE='
secret1 = b64.b64decode(secret)[0:16]
secret2 = b64.b64decode(secret)[16:]
p = remote('10.188.2.20',10010)
middle = []
pt = ''

for x in xrange(0,16):
    for y in xrange(0,256):
        p.recvuntil("Give your option:\n")
        p.sendline('3')
        p.recvuntil("IV:\n")
        p.sendline(b64.b64encode(''.join(IV))) #send your IV
        p.recvuntil("Data:\n")
        p.sendline(b64.b64encode(secret1)) #send your Data
        # p.sendline(b64.b64encode(secret2)) #send your Data
        res = p.recvuntil("\n")
        # print res
        if 'bad decrypt' in res:
            IV[15-x] = chr(y)
        elif 'Decrpytion Done' in res:
            print IV
            IV[15-x] = chr(ord(IV[15-x]) ^ (x + 1)) #to get the correct middle, just like ---> IV[0] ^ 0x01 = middle[0]
            middle.append(ord(IV[15-x])) #store the correct middle
            print middle
            pt += chr(ord(IV[15-x]) ^ ord('A')) #first plaint text
            # pt += chr(ord(IV[15-x]) ^ ord(secret1[15-x])) #second plaint text
            for z in xrange(0,x + 1):
                IV[15-z] = chr(middle[z] ^ (x + 2)) #generate the next new IV
            break
        else:
            print res
            exit()
        if y == 255:
            print '[!] Something wrong'
            print x + 1
            exit()

print '[!] Final IV : '
print IV
print '[!] Get middle : ', middle
print '[!] PlaintText is : ' + pt[::-1]

解题脚本 2:

from pwn import *
import base64 as b64

secret = 'nPQctp6AezY8BcGPjlYW8Pv+Fpo15LeatsVbj47jqgE='
secret1 = b64.b64decode(secret)[0:16]
secret2 = b64.b64decode(secret)[16:]
p = remote('10.188.2.20',10010)

middle = []
padding = ''

for x in xrange(1,17):
    for y in xrange(0,256):
        IV = "\x00" * (16-x) + chr(y) + padding

        p.recvuntil("Give your option:\n")
        p.sendline("3")

        p.recvuntil("IV:\n")
        p.sendline(b64.b64encode(IV))

        p.recvuntil("Data:\n")
        p.sendline(b64.b64encode(secret2))

        res = p.recvuntil("\n")
        if 'Decrpytion Done' in res:
            middle.append(y ^ x) #calculate and store the correct middle
            print middle
            padding = ''
            for z in middle:
                padding = chr((x+1) ^ z) + padding #generate the next new IV tail
            break

flag = ""
for x,y in zip(middle,secret1[::-1]):
    # flag += chr(x ^ ord('A')) #for secret1
    flag += chr(x ^ ord(y)) #for secret2
print flag[::-1]

作者水平有限 如有错误请指出 Orz

参考文章 :
http://blog.zhaojie.me/2010/10/padding-oracle-attack-in-detail.html
http://www.jianshu.com/p/1851f778e579
http://www.jianshu.com/p/9b4d3565de87
