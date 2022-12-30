<?php
include_once "base.php";
dd($_POST);
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
$table=$_POST['table'];
foreach($_POST['id'] as $idx => $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $$table -> del($id);
    }else{
        $row=$$table->find($id);

        switch($table){
            case "Title":
                $row['text']=$_POST['text'][$idx];
                $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;

                break;
                case "Admin":
                    $row['acc']=$_POST['acc'][$idx];
                    $row['pw']=$_POST['pw'][$idx];

                    break;
                    case "Menu":
                        $row['name']=$_POST['name'][$idx];
                        $row['href']=$_POST['href'][$idx];  
                        $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;

                    break;
                    default:
                    if(isset($_POST['text'])){

                        $row['text']=$_POST['text'][$idx];
                    }
                    // echo $idx;
                    $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                    // dd($row);
                    // dd($idx);
        }
        
        $$table->save($row);
    }

  
}

to("../back.php?do=".lcfirst($table));

?>