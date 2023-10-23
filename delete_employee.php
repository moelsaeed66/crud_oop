<?php
include ('database.php');
$db=new database();
$id=$_GET['id'];
$row=$db->selectOne('employees',$id);
if(isset($id) &&is_numeric($id) && $row){
    echo $db->deleteDate('employees',$id);
}else{
    echo "not found";
}

header('refresh:1 ,employee.php');


