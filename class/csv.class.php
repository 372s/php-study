<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/9/4
 * Time: 12:03
 */
class Csv
{
    private $filename;
    private $out;

    public  $params;

    public function import($file) {
        return $this->readCsv($file);
    }

    public function readCsv($filename) {
        $file = new SplFileObject($filename);
        $aCache = array();
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            $row = eval('return '.iconv('gbk','utf-8',var_export($row,true)).';');
            $aCache[] = $row;
        }
        array_shift($aCache);
        array_pop($aCache);
        return array(count($aCache), $aCache);
    }

    public function export($keys, $data, $filename='export.csv') {
        $this->filename = $filename;

        if(empty($data)) {
            return false;
        }
        $sOut = implode(',', $keys) . "\n";
        foreach ($data as $key => $value) {
            $temp = array();
            foreach ($keys as $k => $v) {
                $temp[] = $value[$k];
            }
            $sOut .= implode(',', $temp)."\n";
        }
        $this->out = $sOut;
        $this->exportCsv();
    }

    public function exportCsv() {
        $this->out = iconv('utf8', 'gb2312', $this->out);
        // $this->filename = iconv('utf8', 'gb2312', $this->filename);
        // $this->out = mb_convert_encoding($this->out, 'gb2312');
        // $this->filename = mb_convert_encoding($this->filename, 'gb2312');
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:filename=".$this->filename);
        echo $this->out;
    }

    public function test () {
        print_r($this->params); 
    }
}