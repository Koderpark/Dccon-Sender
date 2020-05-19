<?php
    //$img = $_POST['image'];
    //$title = $_POST['title'];
    $img = str_replace('data:image/png;base64, ','',$img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = 'ICON/[업로드된 콘]'.$title.'.png';
    $success = file_put_contents($file, $data);

    print $success ? $file : 'Unable to save the file.';
?>