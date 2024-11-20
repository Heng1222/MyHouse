<?php

include("isLogin.php");
@session_start();
if (isset($_GET['file'])) {
    $path = $_GET['path'];
    $filename = $_GET['file'];
    deleteDirectory($path . "/" . $filename);
    header("Location:fileOverView.php");
}

function deleteDirectory($dir)
{
    if (!file_exists($dir))
        return true;
    if (!is_dir($dir) || is_link($dir))
        return unlink($dir); //刪除檔案
    foreach (scandir($dir) as $item) { //把裡面資料刪除再刪除資料夾
        if ($item == '.' || $item == '..')
            continue;
        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!deleteDirectory($dir . "/" . $item))
                return false;
        }
        ;
    }
    return rmdir($dir);
}
?>