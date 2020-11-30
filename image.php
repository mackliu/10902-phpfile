<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

 if(!empty($_FILES['photo']['tmp_name'])){
    echo "檔名:".$_FILES['photo']['name']."<br>";
    echo "格式:".$_FILES['photo']['type']."<br>";
    echo "大小:".round($_FILES['photo']['size']/1024)."kb<br>";
    move_uploaded_file($_FILES['photo']['tmp_name'],'./img/'.$_FILES['photo']['name']);
    $filename="./img/".$_FILES['photo']['name'];
    $src_info=[
        'width'=>0,
        'height'=>0,
    ];
    $dst_info=[
        'width'=>0,
        'height'=>0,
    ];
    switch($_FILES['photo']['type']){
        case "image/jpeg":
            $src_img=imagecreatefromjpeg($filename);
        break;
        case "image/gif":
            $src_img=imagecreatefromgif($filename);
        break;
        case "image/png":
            $src_img=imagecreatefrompng($filename);
        break;
        default:
        echo "只接受圖形檔案";
        exit();

    }
    $src_info['width']=imagesx($src_img);
    $src_info['height']=imagesy($src_img);

    $dst_img=imagecreatetruecolor(200,200);
    $dst_info['width']=200;
    $dst_info['height']=200;
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形處理練習</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">
    <input type="file" name="photo">
    <input type="submit" value="上傳">
</form>
<h3>原始圖形</h3>
<hr>
<div>
 <img src="<?="./img/".$_FILES['photo']['name'];?>" style="width:250px">
</div>
<!----縮放圖形----->
<h3>縮放圖形</h3>
<hr>
<?php

if(isset($src_img) && isset($dst_img)){

    imagecopyresampled($dst_img,$src_img,0,0,0,0,$dst_info['width'],$dst_info['height'],$src_info['width'],$src_info['height']);
    $dst_path="./dst/".$_FILES['photo']['name'];
    imagejpeg($dst_img,$dst_path);

    echo "<div>";
    echo "<img src='$dst_path'>";
    echo "</div>";

}


?>
<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>