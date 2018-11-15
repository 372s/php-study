<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/11/15
 * Time: 18:40
 */

$res= file_get_contents('https://h5ssl.1sapp.com/activity_dest/dancer/index.html?content_id=137487690&key=2b3dhfUuH9TS-kckDpy9f66_SDBFTF5mvg47MR5bRLzQrAHis0fXhvg2RGp8wr_HZLmzpxJuvoHX20tYf7k7R5zSqbbEHV-n_jLjLe-H6j_DQZP_kiDUn0I2gTLukp5zV5UBmQ&pv_id=%7B724A1E45-BDA0-ADE9-0A09-439FCDB122D8%7D&cid=1&cat=1&rss_source=&fr=15&hj=0&mod_id=&o=1&p=1&fqc_flag=0&skip_ad=0&is_h5_content_type=0&is_origin_new=0');

echo preg_match("/class=\"content\">[\s\S]*?<\/section>/", $res,$c);

print_r($c);