<?php


class database{
    private $dbhost='localhost';
    private $dbuser='root';
    private $dbname='crud_oop';
    private $dbpass='';
    private $conn;
    public function __construct(){
        $this->conn=new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
        if(!$this->conn){
            die('error'.mysqli_connect_error());
        }
    }

    public function insertEmployee($sql){
        if(mysqli_query($this->conn,$sql)){
            return "data added successfully";
        }else{
            return "error in added data";
        }

    }

    public function selectAllData($table){
        $array=array();
        $query="SELECT * FROM $table";
        $result=mysqli_query($this->conn,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                while ($row=mysqli_fetch_assoc($result)){
                    $array[]=$row;
                }
            }
            return $array;
        }else{
            return "error in selected data";
        }
    }

    public function deleteDate($table,$id){
        $query="DELETE FROM `employees` WHERE `id`= '$id' ";
        $result=mysqli_query($this->conn,$query);
        if($result){
            return "data deleted successfully";
        }else{
            return "error in deleted data";
        }
    }

    public function selectOne($table,$id){
        $id=filter_var($id,FILTER_VALIDATE_INT);
        $array=array();
        $query="SELECT * FROM $table WHERE `id`= '$id'";
        $result=mysqli_query($this->conn,$query);
        if($result){
            if(mysqli_num_rows($result)>0){
                while ($row=mysqli_fetch_assoc($result)){
                    $array[]=$row;
                }
            }
            return $array;
        }else{
            return "error in selected data";
        }

    }

    public function encPassword($password){
        return sha1($password);
    }


    public function update($sql){
        if(mysqli_query($this->conn,$sql)){
            return "data updated successfully";
        }else{
            return "error in updated";
        }
    }



}
