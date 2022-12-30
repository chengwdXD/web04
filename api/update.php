<?php

include_once "base.php";

$table=$_POST['table'];//POST傳過來的資料表
$row=$$table->find(1);//ROW會等於table(資料表)裡找的第一個

$row[lcfirst($table)]=$_POST[lcfirst($table)];
$$table->save($row);

to("../back.php?do=".lcfirst($table));


?>