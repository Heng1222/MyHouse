<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>照片瀏覽器</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <?php
    include("header.php");
    include("isLogin.php");
    ?>
    <div class="contain PhotoContain" >
        <?php
        @session_start();
        $folder = $_GET['folder'];
        $now = $_GET['now'];
        echo '<a class ="button-link" href="fileOverView.php"><div class="backBlock"><img src="systemimg/back.png" alt="error photo address"><span class="button-text">離開</span></div></a><br/>';
        echo "<h1 class='topic'>$folder</h1>";
        echo "<div class='photoViewer'>
            <div id='carouselExampleIndicators' class='carousel slide'>";
        $files = scandir($folder); // 讀取資料夾中的檔案名稱列表
        // 移除 . 和 .. 檔案名稱
        $files = array_diff($files, array('.', '..'));
        //indicators
        echo "<div class='carousel-indicators'>";
        $count = 0;
        foreach ($files as $file) {
            if (str_ends_with($file, '.png') || str_ends_with($file, '.jpg') || str_ends_with($file, '.jpeg') || str_ends_with($file, '.JPG')) {
                if ($file == $now) {
                    echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $count . "'
                                class='active' aria-current='true' aria-label='Slide " . $count . "'></button>";
                } else {
                    echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $count . "'
                             aria-current='true' aria-label='Slide " . $count . "'></button>";
                }
                $count++;
            }
        }
        echo "</div>";
        //inner
        echo "<div class='carousel-inner'>";
        foreach ($files as $file) {
            if (str_ends_with($file, '.png') || str_ends_with($file, '.jpg') || str_ends_with($file, '.jpeg') || str_ends_with($file, '.JPG')) {
                if ($file == $now) {
                    echo "<div class='carousel-item active'>";
                } else {
                    echo "<div class='carousel-item'>";
                }
                echo "<p>" . $file . "</p>";
                echo " <img src='" . $folder . "/" . "$file'" . " class='d-block w-100' alt='...'>";

                echo "</div>";
            }
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    </div>
    </div>
    <?php
    include("footer.html");
    ?>

    <!-- bootstrap5 jsp -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
    <script src="slider.js"></script>
</body>

</html>