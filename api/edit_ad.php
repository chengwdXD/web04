<?php
include_once "base.php";
// dd($_POST);
// if(isset($_POST['id']))
//比較舊的寫法
// foreach($_POST['id'] as $idx => $id){
//     $row=$Title->find($id);
//     $row['text']=$_POST['text'][$idx];
//     $Title->save($row);
// }

// $row1=$Title->find($_POST['sh']);
// foreach($_POST['id'] as $id){
//     $row2=$Title->find($id);
//     $row2['sh']=0;
//     $Title->save($row2);
// }

// $row1['sh']=1;
// $Title->save($row1);

// foreach($_POST['del'] as $id){
//     $Title->del($id);
// }
//比較舊的寫法
foreach($_POST['id'] as $idx => $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $Ad -> del($id);
    }else{
        $row=$Ad->find($id);
        $row['text']=$_POST['text'][$idx];
        $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        
        $Ad->save($row);
    }
    
  
}
to("../back.php?do=ad");

?>