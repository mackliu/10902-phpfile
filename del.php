<?php

include_once "base.php";

$id=$_GET['id'];

//找出檔案的路徑並刪除
$row=find('upload',$id);
$path=$row['path'];
unlink($path);

//刪除資料表中的紀錄
del('upload',$id);

to('manage.php');
?>

