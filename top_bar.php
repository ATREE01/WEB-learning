<?php
    $link = 'https://animeweb.ddns.net/anime_web'
?>

<div class="top_bar" >
    <a class="link_left" href=<?php echo $link . "/index.php" ?>>首頁</a>
    <a class="link_left" href=<?php echo $link . "/anime_pages/description.php"?>>評論區</a>
    <?php
        if(isset($_SESSION['user_type']) )
            if($_SESSION['user_type'] === 'admin')
                echo "<a class='link_left' href='$link/anime_pages/upload_description.php'>上傳評論區</a>";                
    ?>
    <a class="link_left" href=<?php echo $link . "/web_crawler_nodejs/index.html" ?> >爬蟲實驗室</a>
    <div class="link_left dropdown">
        <span class="drop_btn">小遊戲</span>
        <div class="dropdown_content">
            <a href=<?php echo $link . "/game_pages/tetris/tetris.php" ?> >俄羅斯方塊</a>
            <a href=<?php echo $link . "/game_pages/experimental/experimental.php" ?> >實驗室</a>
            <!-- <a href="#">測試</a> -->
        </div>
    </div>
    <?php   
        if(isset($_SESSION['user_id'])){
            echo "<a class='link_right' href='$link/login_out/logout.php'>登出</a>";
            echo "<div class='link_right'> ";
            echo htmlspecialchars($_SESSION['username']);
            echo "</div>";
        }
        else{
            echo "<a class='link_right' href='$link/login_out/login.php'>登入</a>";
        }
    ?>
</div>
<div style="height:40px"></div>