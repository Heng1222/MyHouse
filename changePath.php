<?php
    @session_start();
    if(isset($_GET['back'])){
        $original = $_SESSION['folderPath'];
        echo $original."<br/>";
        if($original == 'Root'){
        }else{
            $original=substr($original,0,strlen($original)-strlen(strrchr($original, '/')));
            echo $original;
            $_SESSION['folderPath'] = $original;
        }
        header('Location:fileOverView.php');
    }else{
        $original = $_GET['or'];
        $new = $_GET['new'];
        $_SESSION['folderPath']= $original . '/' . $new;
        header('Location:fileOverView.php');
    }
    
?>