<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的目錄</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
    <?php
    include("header.php");
    echo '<div class="contain"><h1 class="welcome">再等等<br/>我還在努力...</h1></div>';
    include('footer.html');
    header('Refresh:2 url="backRoot.php"');
    ?>
</body>
</html>