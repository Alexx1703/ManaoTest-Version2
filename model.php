<?php

class Model // бд JSON
{
    public $link; 

    public function __construct($link)
    {
        $this->link=$link;
    }    
    public function createTable($newTable,$arrayValues) //CREATE
    {
        $data=file_get_contents("$this->link");
        $jsnDecode=json_decode($data,true);
        $jsnDecode["$newTable"]=$arrayValues;
        $jsnEncode=json_encode($jsnDecode);
        file_put_contents("$this->link",$jsnEncode);
        return true;
    }

    public function selectTable($login) // SELECT table
    {
        $data=file_get_contents("$this->link");
        $jsnDecode=json_decode($data,true);
        foreach ($jsnDecode as $key=>$value){
            foreach ($value as $key=>$val){
                if ($key=="login" && $val==$login){  
                    return $jsnDecode[$login];
                }
            }
        }
        return false;
    }

    public function selectField($field,$fieldValue) // SELECT field
    {
        $data=file_get_contents("$this->link");
        $jsnDecode=json_decode($data,true);
        if($jsnDecode==null){
            return false;
        }
        $jsnDecode=[];
        foreach ($jsnDecode as $key=>$value){
           foreach ($value as $key=>$val){
               if ($key==$field && $val==$fieldValue){
                   return "$key=$val";
               }
           }
        }
        return false;
    }
}
    // public function readTable($table) //READ
    // {
    //     $data=file_get_contents("$this->link");
    //     $newData=json_decode($data);
    //     $read=json_encode($newData);
    //     echo $read;
    // }

    // public function updateTable($datd_1,$data_2,$data_3) //UPDATE
    // {
    //     $data=file_get_contents("$this->link");
    //     $jsnDecode=json_decode($data,true);
    //     $jsnDecode["$data_1"]["$data_2"]["$data_3"]=$newVal;
    //     $jsnEncode=json_encode($jsnDecode);
    //     file_put_contents("$this->link",$jsnEncode);
    // }

    // public function delete($table)  // DELETE
    // {
    //     $data = file_get_contents("$this->link");
    //     $jsnDecode = json_decode($data, true);
    //     unset($jsnDecode["$table"]);
    //     $jsnEncode=json_encode($jsnDecode);
    //     file_put_contents("$this->link",$jsnEncode);
    // }
