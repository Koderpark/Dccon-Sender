<!DOCTYPE html>
<header>
    <title>카카오톡 이모티콘</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta property="og:type" content="website">
    <meta property="og:title" content="유사-박성훈봇"/>
</header>

<link rel="stylesheet" type="text/css" href="resource/list.css">

<script type="text/javascript" src="resource/list.js"></script>

<html>
    <body>
        <div id="container">
            <div id="title">
                <h1>아이콘 전체 목록</h1>
                <form method="get">
                    <button id="submitbutton"><img src="resource/list_search.png"></button>
                    <input type="text" id="input"  name="search">
                </form>
                <?php
                    ini_set('display_errors', '0');
                    $get = $_GET['search'];
                    if($get != NULL){
                        $res = NULL;
                        $min = 99999;
                        $lev = 0;
                        $path = NULL;
                        function Findimage($dir){
                            global $get, $res, $min, $lev, $path;
                        
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
                                    $lev = levenshtein($get , $ff);
                                    if($lev < $min){
                                        $res = $ff;
                                        $min = $lev;
                                        $path = $dir;
                                    }
                                }
                            }
                        }
                        Findimage('ICON');
                        $input = $path.'/'.$res;
                        echo '<div id="query"><img src="'.$input.'">';
                        echo '<h3>검색어 ['.$get.']<br/>에 대한 검색 이미지입니다</h3></div>';
                        echo '<meta property="og:description" content="[ '.$get.' ] 콘의 이미지입니다.">';
                        echo '<meta property="og:image" content="'.$input.'">';
                    }
                ?>
            </div>
            <ul>
                <?php
                function Getimage($dir, &$results = array()){
                    $files = scandir($dir);
                    foreach($files as $key => $value){
                        //$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                        $path = $dir.DIRECTORY_SEPARATOR.$value;
                        if(!is_dir($path)) {
                            echo '<li>';
                            echo '<img src="'.$path.'">';
                            echo '<h2>'.explode('.', array_pop(explode('\\', $path)))[0].'</h2>';
                            echo '<h4>'.$path.'</h4>';
                            echo '</li>';
                        } else if($value != "." && $value != "..") {
                            echo '<a class="extend" onclick="control()">'.str_replace('ICON\\', '', $path).'</a>';
                            echo '<div class="folder">';
                            Getimage($path, $results);
                        }
                    }
                    echo '</div>'; // 한 폴더의 탐색이 끝남.
                }
                Getimage('ICON');
                ?>
            </ul>
        </div>
        <a id="back" href="./index.php"><img src="resource/list_exit.png"></a>
    </body>
</html>

<script src="resource/list.js"></script>