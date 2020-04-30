<header>
    <title>카카오톡 이모티콘</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</header>

<link rel="stylesheet" type="text/css" href="resource/index.css">

<?php
    ini_set('display_errors', '0');
    $upload_dir = './iCON';
    $whitelist = array('jpg','jpeg','png','gif');

    $error = $_FILES['uploadfile']['error'];
    $name = $_FILES['uploadfile']['name'];
    $dst_name = $_POST['filename'];
    $ext = array_pop(explode('.', $name));
    $size = GetImageSize($_FILES['uploadfile']['tmp_name']);//0 = x, 1 = y, 2 = 확장자
    //echo "<script>alert('hello world');</script>";

    if($name != NULL){ // 이미지 업로드가 맞음
        if($error != UPLOAD_ERR_OK){ // 에러 핸들링
            switch($error){
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo "<script>alert('파일이 너무 큽니다. [$error]');</script>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "<script>alert('파일이 첨부되지 않았습니다. [$error]');</script>";
                    break;
                default:
                    echo "<script>alert('파일이 제대로 업로드되지 않았습니다. [$error]');</script>";
            }
            exit;
        }
        if(!in_array($ext, $whitelist)){ echo "<script>alert('잘못된 확장자입니다\\n[ jpg, jpeg, png, gif ] 파일으로 올려주세요');</script>"; exit; }// 확장자 검사
        if($size[0] != $size[1]){ echo "<script>alert('가로 세로의 비율이 다릅니다\\n꼭 1대 1 비율으로 올려주세요 (100x100 권장) ');</script>"; exit; }
        switch($ext){
            case 'jpg':
            case 'jpeg':    $src_img = ImageCreateFromJPEG($_FILES['uploadfile']['tmp_name']); break;
            case 'png':     $src_img = ImageCreateFromPNG ($_FILES['uploadfile']['tmp_name']); break;
            case 'gif':
            default   :     $src_img = IMageCreateFromGIF ($_FILES['uploadfile']['tmp_name']);
        }
        $dst_img = ImageCreate($size[0]*2, $size[1]);
        $bg = ImageColorAllocate($dst_img, 240,240,240);
        ImageFill($dst_img, 0, 0, $bg);
        ImageCopy($dst_img,$src_img,$size[0]/2,0,0,0,$size[0],$size[1]);
        imagepng($dst_img, "ICON/$dst_name.png");
    }
?>

<html>
    <body>
        <div id = "wrapper">
            <div class="flex left">
                <h1>이모티콘 업로드</h1>
                <h3>1대 1 비율의 파일만 가능!</h3>
                <img src="resource/index_upload.png">
                <div id="subtitle">원하는대로</div>
                <button class="btn-left" onclick="popup()">업로드 해보기</button>
            </div>
            <div class="flex right">
                <h1>이모티콘 목록</h1>
                <h3>200+ 개의 사용가능한 이모티콘!</h3>
                <img src="resource/index_icon.gif">
                <div id="subtitle">사실 움짤은 안된다 하더라</div>
                <a class="btn-right" href="list.php">목록 보러가기</a>
            </div>
        </div>
    </body>
    <div id="grey" onclick="exit()" ></div>
    <div id="popup">
        <h1>이모티콘 업로드하기</h1>
        <h3>버튼을 눌러 선택해주세요<br/>(1대 1 비율의 png gif jpg jpeg 사진만 가능합니다)</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="uploadfile" id="article">
            <input type="text" placeholder="아이콘 이름" name="filename" id="filename">
            <button class="btn-right popup">업로드</button>
        </form>
    </div>
</html>

<script src="resource/index.js"></script>