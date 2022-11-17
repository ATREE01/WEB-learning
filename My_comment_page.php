<!DOCTYPE html>
<html>
    <head>
        <mata charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href="style.css">
        <title>My_comment_page</title>
    </head>
    <body class="My_comment_page">
        <div class="top_bar" >
            <div class="link"><a href="main_page.php" >首頁</a></div>
            <div class="link"><a href="My_comment_page.php">評論區</a></div>
            <div class="link"><a href="upload_comment.php">上傳評論區</a></div>
        </div>
        <div class="display_area">
            <?php
                $conn = new mysqli("localhost","root","","anime_web");
                $result = mysqli_query($conn , "SELECT * FROM anime_comment"); 
                $anime_comment = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <?php foreach($anime_comment as $item): ?>
                <div class="anime_block">
                    <div><img class="anime_cover" src= img/<?php echo $item['anime_cover'] ?> ></div>
                    <div class="anime_information">
                        <p class="anime_title"><?php echo $item['anime_title'] ?></p>
                        <div><?php echo $item['anime_comment'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?> 
            <!-- <div class="anime_block">
                <div><img class="anime_cover" src="img/dressup_darling.jpg" ></div>
                <div class="anime_information">
                    <p class="anime_title">戀上換裝娃娃娃</p>
                    <div>動漫啟蒙導師</div>
                </div>
            </div>
            <div class="anime_block">
                <div><img class="anime_cover" src="img/lycoris_recoil.jpg" ></div>
                <div class="anime_information">
                    <p class="anime_title">Lycoris Recoil 莉可麗絲</p>
                    <div>百合好香</div>
                </div>
            </div>
            <div class="anime_block">
                <div><img class="anime_cover" src="img/reincarnated_as_sword.jpg" ></div>
                <div class="anime_information">
                    <p class="anime_title">轉生就是劍</p>
                    <div>芙蘭讚</div>
                </div>
            </div> -->
        </div>
    </body>
</html>
