<head>
    <?php
        $q = $_GET['q'];
        $res = NULL;
        $min = 99999;
        $lev = 0;
        $path = NULL;
        echo '<meta property="og:description" content="['.$q.']콘의 이미지입니다.">';
    ?>
    <meta charset="utf-8">
    <meta property="og:type" content="website">
    <meta property="og:title" content="유사-박성훈봇"/>
</head>


<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);

function Findimage($dir){
    global $q, $res, $min, $lev, $path;

    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // 디렉토리가 비어있는지 확인합니다. 
    if (count($ffs) < 1)
        return;
    foreach($ffs as $ff){
        // 재귀함수 : 파일이 아닌 디렉토리가 있으면, 스스로 자신을 호출하여 반복적으로 실행합니다
        if(is_dir($dir.'/'.$ff)) Findimage($dir.'/'.$ff);
        else {
            //echo $ff.'<br/>'; 
            $lev = levenshtein($q , $ff);
            if($lev < $min){
                $res = $ff;
                $min = $lev;
                $path = $dir;
            }
        }
    }
}

Findimage('DCcon');
//echo '<img id="icon" src="'.$path.'/'.rawurlencode($res).'"/>';

?>

<style>
    #icon{width: 400px; height: 200px;}
    *{background-color: black; color: white;}
</style>

<?php
$input = $path.'/'.$res;

$src_img = ImageCreateFromPNG($input);
$dst_img = ImageCreate(200,100);

$bg = ImageColorAllocate($dst_img, 240,240,240);
ImageFill($dst_img, 0, 0, $bg);
ImageCopy($dst_img,$src_img,50,0,0,0,100,100);
imagepng($dst_img, "temp.png");
// Capture the output and clear the output buffer <meta property="og:image" content="test.jpg">

?>
<img id="icon" src="temp3.jpg">
<meta property="og:image" content="temp3.jpg">