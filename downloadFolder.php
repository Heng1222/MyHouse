<?php
$folderpath = $_GET['path'];    //檔案位置
$foldername = $_GET['folder'];  //下載的資料夾
// 若無zip檔則先建立download.zip
$isExist = new ZipArchive();
if($isExist->open('folderZip/download.zip', ZipArchive::CREATE) === TRUE){
    echo $folderpath,$foldername;
    $isExist->close();
}
//覆蓋後放入資料
$zip = new ZipArchive();
if ($zip->open('folderZip/download.zip', ZipArchive::OVERWRITE) === TRUE) {  //指定打包之後的壓縮檔要放在temporary/下面 檔名為download.zip
    addFileToZip($folderpath,$foldername, $zip);  
    $zip->close();
    header('Location:download.php?file=folderZip/download.zip');
}

//固定的function
function addFileToZip($path,$folder,$zip){
    $handler = opendir($path."/".$folder); //開啟當前資料夾
    while (($filename = readdir($handler)) !== false) {
        if ($filename != "." && $filename != "..") {  //資料夾檔名字為'.'和'..'，不要對他們進行操作
            if (is_dir($path."/".$folder."/".$filename)) {  // 如果讀取的某個物件是資料夾，則遞迴
                addFileToZip($path,$folder."/".$filename, $zip);    //path是原始資料夾位置，遞迴的是下載資料夾內的位置
            }   
            else {  //將檔案加入zip物件
                $zip->addFile($path."/".$folder."/".$filename,$folder."/".$filename); //addfile(檔案位置，儲存位置-少掉原本資料夾本身的位置-從要下載的資料夾開始)
            }   
        }   
    }   
    @closedir($handler);
}
?>