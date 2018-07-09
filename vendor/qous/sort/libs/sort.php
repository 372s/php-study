<?php
class Psort {
    /*
    * 数组排序 默认降序
    * $arr 排序数组
    * $field  需排序字段
    * $sort_by 降序还是升序
    * $sort_type 按照什么类型排序 字符串 数字
    */
    public static function sortArr($arr, $field=false, $sort_by=SORT_ASC, $sort_type=SORT_NUMERIC){
        if( !isset($arr)){
            return false;
        }
        $ks = array();
        if($field == false){
            $ks = $arr;
            // foreach($arr as $k){
            //     $ks[] = $k;
            // }

        }else{
            $ks = array_map(function($v) use($field) {
                return $v[$field];
            }, $arr);
            // foreach($arr as $k){
            //     $ks[] = $k[$field];
            // }
        }
        
        array_multisort($ks,$sort_by,$sort_type,$arr);
        return $arr;
    }
}
?>