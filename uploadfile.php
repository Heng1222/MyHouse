<?php
@session_start();
# 取得上傳檔案數量、上傳位置
@$path = $_POST['address'] . "/";

// 檢查上傳大小是否超過限制
try {
  $maxPostMB = 400; //400MB 單次限制
  $maxFileMB = 100; //100MB 單一檔案限制
  $maxPostSize = $maxPostMB * 1024 * 1024; //Byte
  if ($_SERVER['CONTENT_LENGTH'] > $maxPostSize) {
    // 上傳的大小超過系統限制
    throw new Exception('單次上傳的檔案大小超過最大限制' . $maxPostMB . 'MB)\n請分批上傳');
  }
} catch (Exception $e) {
  echo "error catch";
  if (isset($_SESSION['uploadError'])) {
    $_SESSION['uploadError'] .= $e->getMessage();
  } else {
    $_SESSION['uploadError'] = $e->getMessage();
  }
  // 內容太多，不上傳
  header("Location:fileOverView.php");
}


// 檔案安全，開始完成上傳流程
@$fileCount = count($_FILES['upload']['name']); //上傳幾個檔案
for ($i = 0; $i < $fileCount; $i++) {
  if ($_FILES['upload']['error'][$i] === UPLOAD_ERR_OK) {  # 檢查檔案是否上傳成功
    # 檢查檔案是否已經存在
    if (file_exists($path . $_FILES['upload']['name'][$i])) {
      if (isset($_SESSION['uploadError'])) {
        $_SESSION['uploadError'] .= $_FILES['upload']['name'][$i] . ' -> 檔案已存在\n';
      } else {
        $_SESSION['uploadError'] = $_FILES['upload']['name'][$i] . ' -> 檔案已存在\n';
      }
    } else {
      $file = $_FILES['upload']['tmp_name'][$i];
      $dest = $path . $_FILES['upload']['name'][$i];
      # 將檔案移至指定位置
      move_uploaded_file($file, $dest);
    }
  } else { #上傳有問題，報錯
    if (isset($_SESSION['uploadError'])) {
      switch ($_FILES['upload']['error'][$i]) {
        case 1:
          $_SESSION['uploadError'] .= $_FILES['upload']['name'][$i] . ' -> 超過單一檔案大小限制 (' . $maxFileMB . 'MB)\n';
          break;
        case 2:
          $_SESSION['uploadError'] .= $_FILES['upload']['name'][$i] . ' -> 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值\n';
          break;
        case 3:
          $_SESSION['uploadError'] .= $_FILES['upload']['name'][$i] . ' -> 檔案上傳不完全，請重試\n';
          break;
        case 4:
          $_SESSION['uploadError'] .= '請先選擇檔案\n';
          break;
        default:
          $_SESSION['uploadError'] .= $_FILES['upload']['name'][$i] . ' -> 無法預期的錯誤\n';
      }
    } else {
      switch ($_FILES['upload']['error'][$i]) {
        case 1:
          $_SESSION['uploadError'] = $_FILES['upload']['name'][$i] . ' -> 超過單一檔案大小限制 (' . $maxFileMB . 'MB)\n';
          break;
        case 2:
          $_SESSION['uploadError'] = $_FILES['upload']['name'][$i] . ' -> 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值\n';
          break;
        case 3:
          $_SESSION['uploadError'] = $_FILES['upload']['name'][$i] . ' -> 檔案上傳不完全，請重試\n';
          break;
        case 4:
          $_SESSION['uploadError'] = '請先選擇檔案\n';
          break;
        default:
          $_SESSION['uploadError'] = $_FILES['upload']['name'][$i] . ' -> 無法預期的錯誤\n';
      }
    }
  }
}
header("Location:fileOverView.php");
