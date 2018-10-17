<?php
/**
 * Created by PhpStorm.
 * User: wq455
 * Date: 2018/10/18
 * Time: 00:34
 */

// pq(); is using selected document as default phpQuery::selectDocument($doc);
// documents are selected when created or by above method
// query all unordered lists in last selected document pq('ul')->insertAfter('div');
require('phpQuery/phpQuery.php');
$doc = phpQuery::newDocumentHTML($markup);