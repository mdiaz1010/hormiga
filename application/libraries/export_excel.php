<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class export_excel{
    function to_excel($array, $filename) {

        $file_name=$filename.".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$file_name);
        header("Pragma: no-cache");
        header("Expires: 0");


        $h = array();
        foreach($array as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                    $h[] = $key;
                }
            }
        }
        echo '<table><tr>';
        foreach($h as $key) {
            $key = ucwords($key);
            echo '<th style="border:1px #888 solid;background-color:#F00;color:white;">'.$key.'</th>';
        }
        echo '</tr>';
        foreach($array as $row){
            echo '<tr>';
            foreach($row as $val)
                $this->writeRow($val);
        }
        echo '</tr>';
        echo '</table>';
    }
    function writeRow($val) {
        echo '<td style="border:1px #888 solid;color:#555;">'.$val.'</td>';
    }
}
?>