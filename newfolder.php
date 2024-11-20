<?php

include("isLogin.php");
@session_start();
if(isset($_POST['address'])){
    $address = $_POST['address'];
    $filename = $_POST['folderName'];
    $path = $address."/".$filename;
    if(file_exists($path)){
        header('Location:fileOverView.php?fileExist=1');
    }else{
        mkdir($path);
        header('Location:fileOverView.php');
    }
   
}
?>