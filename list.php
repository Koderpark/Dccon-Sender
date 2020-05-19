<!DOCTYPE html>
<header>
    <title>카카오톡 이모티콘</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta property="og:type" content="website">
    <meta property="og:title" content="디시콘-출력기"/>
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
                    // 오류 & 경고메시지 무시.
                    ini_set('display_errors', '0');
                    // 전달된 값 받아오기( 챗봇에서 전송한 )
                    $get = $_GET['search'];
                    if($get != NULL){ // 전달된 값이 있을 경우.
                        $res = NULL;
                        $min = 99999;
                        $lev = 0;
                        $path = NULL;

                        function Findimage($dir){
                            global $get, $res, $min, $lev, $path;
                            $ffs = scandir($dir);
                            //상위 디렉토리 미포함.
                            unset($ffs[array_search('.', $ffs, true)]);
                            unset($ffs[array_search('..', $ffs, true)]);
                            // 디렉토리가 비어있는지 확인
                            if (count($ffs) < 1)
                                return;
                            foreach($ffs as $ff){
                                // 파일이 아닌 디렉토리가 있으면 재귀호출해서 모든 디렉토리를 탐색함.
                                if(is_dir($dir.'/'.$ff)) Findimage($dir.'/'.$ff);
                                else {
                                    // 문자열 비교 함수 levenshtein
                                    $lev = levenshtein($get , $ff);
                                    if($lev < $min){ // 가장 가까운 문자열을 찾아냄.
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
                            echo '<li>'; // 이미지 블록 시작.
                            echo '<img src="'.$path.'">';
                            echo '<h2>'.explode('.', array_pop(explode('/', $path)))[0].'</h2>';
                            echo '<h4>'.$path.'</h4>';
                            echo '</li>'; // 이미지 블록 끝.
                        } else if($value != "." && $value != "..") {
                            echo '<a class="extend" onclick="control()">'.str_replace('ICON/', '', $path).'</a>'; // 폴더 확장&숨기기 버튼
                            echo '<div class="folder">'; // 한 폴더의 탐색을 시작함
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