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
    <input type="file" name="photo" id="">
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

<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>