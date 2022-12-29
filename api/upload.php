<?php
include_once "base.php";
$table=$_POST['table'];
$row=$$table->find($_POST['id']);

if(!empty($_FILES['img']['tmp_name'])){//!empty意思是不是空的
    move_uploaded_file($_FILES['img']['tmp_name'],'../upload/'.$_FILES['img']['name']);
    $row['img']=$_FILES['img']['name'];
    $$table->save($row);
}


to("../back.php?do=".lcfirst($table));
?>