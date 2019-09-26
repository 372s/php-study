#### limit优化
* id>=的形式：
```
SELECT * FROM product 
WHERE ID > =(select id from product limit 866613, 1) limit 20
```
* 利用join
```
SELECT * FROM product a 
JOIN (select id from product limit 866613, 20) b ON a.ID = b.id
```