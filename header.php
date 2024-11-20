<div class="header">
    <a href=""><img src="" alt=""></a>
    <ul>
        <?php
        @session_start();
        if(isset($_SESSION['login'])){
            echo "<li><div class='userdiv'><p class='userName'>Hi，".$_SESSION['user_name']."</p><p class='userLogin'>上次登入：".$_SESSION['user_lastLogin']."</p></div></li>
            <li><a href='myHouse.php'>我的目錄</a></li>
            <li><a href='backRoot.php'>回根目錄</a></li>
            <li><a href='logout.php'>登出</a></li>";
        }else{
            echo "<li><a href='login.php'>登入</a></li>";
        }
        ?>
    </ul>
</div>