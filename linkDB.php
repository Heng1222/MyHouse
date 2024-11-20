<?php
$link = mysqli_connect('localhost','root','','myHouse');
date_default_timezone_set('Asia/Taipei');
if(!mysqli_select_db($link,'myHouse')){
    echo"<script language='javascript'>
    alert('連接資料庫失敗！');
    </script>";
}

function getResult($sql){
    $ans=mysqli_query($GLOBALS["link"], $sql);
    return $ans;
}
?>