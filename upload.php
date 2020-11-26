<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
include_once "base.php";


 if(!empty($_FILES['img']['tmp_name'])){

    $subname="";
    $subname=explode('.',$_FILES['img']['name']);
    $subname=array_pop($subname);

    $filename=date("Ymdhis").".".$subname;

     move_uploaded_file($_FILES['img']['tmp_name'],"./img/".$filename);

     $row=[
         "name"=>$_FILES['img']['name'],
         "path"=>"./img/".$filename,
         "type"=>$_POST['type'],
         "note"=>$_POST['note']
     ];

     print_r($row);
     save("upload",$row);
     to('manage.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form{
            border:3px solid blue;
            margin:auto;
            padding:20px;
            width:300px;
        }
        form div{
            margin:5px 0;
        }
    </style>
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->
<form action="?" method="post" enctype="multipart/form-data">
    <div>上傳的檔案:<input type="file" name="img"></div>
    <div>檔案說明<input type="text" name="note"></div>
    <div>檔案類型<select name="type">
        <option value="圖檔">圖檔</option>
        <option value="文件">文件</option>
        <option value="其它">其它</option>
    </select></div>
    <input type="submit" value="上傳">
</form>




<!----建立一個連結來查看上傳後的圖檔---->  


</body>
</html>