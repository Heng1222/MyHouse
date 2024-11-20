<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <title>雲端空間</title>
    <!-- 響應式 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">

<body>
    <?php
    include("header.php");
    include("isLogin.php");
    @session_start(); // 啟動 session
    // 取得當前路徑
    if (!isset($_SESSION['folderPath']) || $_SESSION['folderPath'] == '') {
        $folderPath = 'Root';
    } else {
        @$folderPath = $_SESSION['folderPath'];
    }
    // 檢查 session 中是否存在 folderName 變數
    echo "<div class='contain'>";
    // 返回按鈕
    echo '<a class ="button-link" href="changePath.php?back=1"><div class="backBlock"><img src="systemimg/back.png" alt="error photo address"><span class="button-text">回上頁</span></div></a><br/>';
    if (is_dir($folderPath)) {
        $files = scandir($folderPath); // 讀取資料夾中的檔案名稱列表
        // 移除 . 和 .. 檔案名稱
        $files = array_diff($files, array('.', '..'));
        echo '<div class="tool-bar">';
        echo '<h1 class="position">目前位置：' . $folderPath . '</h1>';
        echo '<div class="button-box">
        <div class="addfolder" data-bs-toggle="modal" data-bs-target="#addfolder"><span class="button-text" style="font-weight: bold;">新增資料夾</span></div>
        <div class="uploadfile" data-bs-toggle="modal" data-bs-target="#uploadfile"><span class="button-text" style="font-weight: bold;">上傳檔案</span></div>
    </div>';
        echo '</div>';
        // 顯示檔案列表
        if (count($files) > 0) {
            echo '<ul class ="container">';
            foreach ($files as $file) {
                if (str_ends_with($file, '.png') || str_ends_with($file, '.jpg') || str_ends_with($file, '.jpeg') || str_ends_with($file, '.JPG')) {
                    //圖片
                    echo '<li><div class="item"><a class="link" href ="photoViewer.php?folder=' . $folderPath . '&now=' . $file . '"><div class="imgbox"><img src="' . $folderPath . '/' . $file . ' "alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download" href="download.php?file=' . $folderPath . '/' . $file . '">下載</a></div></div></div></li>';
                } else if (str_ends_with($file, '.docx') || str_ends_with($file, '.doc')) {
                    //word
                    echo '<li><div class="item"><a  class="link disabled" href ="changePath.php?or=' . $folderPath . '&new=' . $file . '"><div class="imgbox"><img src="systemimg/word.png" alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download" href="download.php?file=' . $folderPath . '/' . $file . '">下載</a></div></div></div></li>';
                } else if (str_ends_with($file, '.pptx') || str_ends_with($file, '.ppt')) {
                    //powerpoint
                    echo '<li><div class="item"><a class="link disabled" href ="changePath.php?or=' . $folderPath . '&new=' . $file . '"><div class="imgbox"><img src="systemimg/ppt.png" alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download" href="download.php?file=' . $folderPath . '/' . $file . '">下載</a></div></div></div></li>';
                } else if (str_ends_with($file, '.xlsx') || str_ends_with($file, '.xlx')) {
                    //excel
                    echo '<li><div class="item"><a class="link disabled" href ="changePath.php?or=' . $folderPath . '&new=' . $file . '"><div class="imgbox"><img src="systemimg/excel.png" alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download" href="download.php?file=' . $folderPath . '/' . $file . '">下載</a></div></div></div></li>';
                } else {
                    if (is_dir($folderPath . '/' . $file)) { //資料夾
                        echo '<li><div class="item"><a class="link" href ="changePath.php?or=' . $folderPath . '&new=' . $file . '"><div class="imgbox"><img src="systemimg/folder.png" alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="folder" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download folder" id ="' . $file . '" href="downloadFolder.php?path=' . $folderPath . '&folder=' . $file . '">下載</a></div></div></div></li>';
                    } else { //未知
                        echo '<li><div class="item"><a class="link disabled" href ="changePath.php?or=' . $folderPath . '&new=' . $file . '"><div class="imgbox"><img src="systemimg/other.png" alt="ErrorPhoto"></div></a><div><h2>' . $file . '</h2><div class ="operation"><a class ="delete" id="" href="delete.php?path=' . $folderPath . '&file=' . $file . '">刪除</a><a class ="download" href="download.php?file=' . $folderPath . '/' . $file . '">下載</a></div></div></div></li>';
                    }
                }

            }
            echo '</ul>';
        } else {
            echo '<h1 class="noanswer">此資料夾中沒有檔案</h1>';
        }
    } else {
        echo $folderPath;
        echo '找不到指定的資料夾。';
    }
    echo "</div>";
    include('footer.html');
    //資料夾重複警告
    if (isset($_GET['fileExist'])) {
        echo "<script>alert('資料夾已經存在')</script>";
    }
    // 上傳錯誤警告
    if (isset($_SESSION['uploadError'])) {
        $errorMessage = $_SESSION['uploadError'];
        unset($_SESSION['uploadError']); //移除session
        echo "<script>alert('$errorMessage')</script>";
    }
    ?>
    <!-- 跳出視窗 新增資料夾 -->
    <div class="modal fade" id="addfolder">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal fejléce -->
                <div class="modal-header">
                    <h5 class="modal-title mymodal-title">新增資料夾</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal tartalma -->
                <form action="newfolder.php" method='post'>
                    <?php
                    echo "<input type='hidden' name='address' value='$folderPath'>";
                    ?>
                    <div class="modal-body">
                        <p class="mymodal-text">您將在當前位置建立新的資料夾？</p>
                        <input type="text" class="mymodal-filename" name="folderName" placeholder="請輸入資料夾名稱">
                    </div>

                    <!-- Modal lábléce -->
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal" value="取消">
                        <input type="submit" class="btn btn-success" value="確認">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 跳出視窗 上傳檔案 -->
    <div class="modal fade" id="uploadfile">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal fejléce -->
                <div class="modal-header">
                    <h5 class="modal-title mymodal-title">上傳檔案</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal tartalma -->
                <form action="uploadfile.php" method='post' enctype="multipart/form-data">
                    <?php
                    echo "<input type='hidden' name='address' value='$folderPath'>";
                    ?>
                    <div class="modal-body">
                        <p class="mymodal-text">請選擇您要上傳的檔案(可複選)</p>
                        <p class="mymodal-hint">**上傳檔案需要一段時間，若超過30秒請重新整理並分批上傳**<br/>單次上傳大小限制：400MB<br/>單次上傳數量限制：50<br/>單一檔案大小限制：100MB<br/></p>
                        <input type="file" class="mymodal-upload" name="upload[]" multiple>
                    </div>

                    <!-- Modal lábléce -->
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal" value="取消">
                        <input type="submit" class="btn btn-success" value="確認">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- bootstrap5 jsp -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
    <script src='download.js'></script>
    <script src="delete.js"></script>
</body>