<head>
    <meta charset="utf-8">
    <meta property="og:type" content="website">
    <meta property="og:description" content="자동 이모티콘 출력기"/>
    <meta property="og:title" content="유사-박성훈봇"/>
</head>


<?php
$q = $_GET['q'];
$res = NULL;
$min = 99999;
$lev = 0;
$path = NULL;
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
echo '<img id="icon" src="'.$path.'/'.rawurlencode($res).'"/>';

?>


<style>
    #icon{width: 100%;}
    *{background-color: black; color: white;}
</style>