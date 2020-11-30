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
    $src_info['rate']=imagesy($src_img)/imagesx($src_img);
    if($src_info['rate']<=1){
        $src_info['direction']='橫向';
    }else{
        $src_info['direction']='直向';
    }

    $dst_img=imagecreatetruecolor(200,200);
    $dst_info['width']=200;
    $dst_info['height']=200;

    $white=imagecolorallocate($dst_img,255,255,255);
    $red=imagecolorallocate($dst_img,255,0,0);
    imagefill($dst_img,0,0,$white);
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形處理練習</title>
    <style>
        div{
            width:500px;
            margin:10px auto;
            text-align:center;
        }
    </style>
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

    if($src_info['direction']=='橫向'){

        $dst_height=$dst_info['height']*$src_info['rate'];
        $dst_width=$dst_info['width'];
        $dst_y=($dst_info['height']-$dst_height)/2;
        $dst_x=0;
        
    }else{
        $dst_height=$dst_info['height'];
        $dst_width=$dst_info['width']*(1/$src_info['rate']);
        $dst_y=0;
        $dst_x=($dst_info['width']-$dst_width)/2;

    }
    
    imagecopyresampled($dst_img,$src_img,$dst_x,$dst_y,0,0,$dst_width,$dst_height,$src_info['width'],$src_info['height']);
    $dst_path="./dst/".$_FILES['photo']['name'];
    imagejpeg($dst_img,$dst_path);

    echo "<div>";
    echo "<img src='$dst_path'>";
    echo "</div>";

}
imagedestroy($dst_img);

?>
<h3>圖形加邊框</h3>
<hr>

<!----圖形加邊框----->
<?php
    $dst_img=imagecreatetruecolor(200,200);
    $dst_info['width']=200;
    $dst_info['height']=200;

    imagefill($dst_img,0,0,$red);
$border=5;
$padding=10;
if($src_info['direction']=='橫向'){
    $bor_width=($dst_info['width']-$padding*2);
    $bor_height=($dst_info['height']-$padding*2)*$src_info['rate'];
    $dst_y=10+((($dst_info['height']-$padding*2)-$bor_height)/2);
    $dst_x=10;

}else{
    $bor_width=($dst_info['width']-$padding*2)*(1/$src_info['rate']);
    $bor_height=($dst_info['height']-$padding*2);
    $dst_y=10;
    $dst_x=10+((($dst_info['width']-$padding*2)-$bor_width)/2);
}
echo "width:".$bor_width."<br>";
echo "height:".$bor_height."<br>";
echo "x:".$dst_x."<br>";
echo "y:".$dst_y."<br>";

//壓底層框線
$img_bor=imagecreatetruecolor($bor_width,$bor_height);
imagefill($img_bor,0,0,$white);
imagecopyresampled($dst_img,$img_bor,$dst_x,$dst_y,0,0,$bor_width,$bor_height,$bor_width,$bor_height);

if($src_info['direction']=='橫向'){
    $dst_height=($dst_info['height']-$padding*2-$border*2)*$src_info['rate'];
    $dst_width=($dst_info['width']-$padding*2-$border*2);
    $dst_y=($dst_info['height']-$dst_height)/2;
    $dst_x=$padding+$border;
    
}else{
    $dst_height=($dst_info['height']-$padding*2-$border*2);
    $dst_width=($dst_info['width']-$padding*2-$border*2)*(1/$src_info['rate']);
    $dst_y=$padding+$border;
    $dst_x=($dst_info['width']-$dst_width)/2;

}

imagecopyresampled($dst_img,$src_img,$dst_x,$dst_y,0,0,$dst_width,$dst_height,$src_info['width'],$src_info['height']);


$dst_path="./dst/bor_".$_FILES['photo']['name'];
imagejpeg($dst_img,$dst_path);

echo "<div>";
echo "<img src='$dst_path'>";
echo "</div>";

?>

<!----產生圖形驗證碼----->



</body>
</html>