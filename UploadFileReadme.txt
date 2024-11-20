在php.ini裡面尋找如下行：

upload_max_filesize = 100M 	//單一檔案最大值
max_file_uploads=50 	//單次最大上傳檔案數

post_max_size = 400M	 //POST能接收的最大值
memory_limit = 512M 	//記憶體限制
max_execution_time = 300 	//每個PHP頁面運行的最大時間值(秒)，預設30秒。
max_input_time = 120 	//每個PHP頁面接收資料所需的最大時間，預設60秒 。
memory_limit = 512M 	//每個PHP頁面所吃掉的最大記憶體，預設8M。



uploadfile.php檔案調整：
$maxPostMB為單次Post最大容量
$maxFileMB為單一檔案最大限制


fileOverView.php檔案調整：
id  = uploadfile的modal視窗之hint
