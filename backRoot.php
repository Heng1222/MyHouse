<?php
@session_start();
$_SESSION['folderPath']='';
header("Location:fileOverView.php");
?>