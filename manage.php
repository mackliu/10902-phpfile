<?php
/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table{
            border:3px solid blue;
            border-collapse:collapse;
            margin:auto;
        }
        td{
            border:1px solid #999;
            padding:5px; 
        }
        a.primary,a.danger{
            border-radius: 10px;
            padding: 3px 8px;
            margin:0 2px;
            color: #ececec;
            box-shadow: 1px 1px 4px grey;
            font-size: 14px;
        }
        a.primary{
            background: #1a8be2;
        }
        a.danger{

            background: red;

        }
    </style>
</head>
<body>
<h1 class="header">檔案管理練習</h1>
<!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->

<a href="upload.php" style="display:block;width:80px;text-align:center;margin:10px auto;box-shadow:0 0 5px #ccc">檔案上傳</a>
<!----建立一個連結來查看上傳後的圖檔---->  
<?php
include_once "base.php";

$rows=all('upload');
echo "<table>";
echo "<td>縮圖</td>";
echo "<td>檔案名稱</td>";
echo "<td>檔案類型</td>";
echo "<td>檔案說明</td>";
echo "<td>下載</td>";
echo "<td>操作</td>";
foreach($rows as $row){

    echo "<tr>";

    if($row['type']=='圖檔'){
        echo "<td><img src='{$row['path']}' style='width:100px'></td>";
        
    }else{
        echo "<td><img src='./img/file_icon.png' style='width:20px'></td>";

    }
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['type']}</td>";
    echo "<td>{$row['note']}</td>";
    echo "<td><a href='{$row['path']}' download>下載</a></td>";
    echo "<td>";
    echo "  <a class='primary' href='edit.php?id={$row['id']}' >編輯</a>";
    echo "  <a class='danger' href='del.php?id={$row['id']}' >刪除</a>";
    echo "</td>";

    echo "</tr>";
}
echo "</table>";


?>



<!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->


</body>
</html>