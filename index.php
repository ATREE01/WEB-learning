<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="temp">
    <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>首頁</title>
</head>

<body class="index_body">
    <?php require("top_bar.php"); ?>
    <img class='background' src="background.jpg">
    <div class="personal_information">
        <h2>網站簡介</h2>
        <p>
            這是一個我在學了HTML之後因為希望練習使用的技巧而決定寫的網站，
            在想要寫什麼樣的內容的時候想到可以來寫一個網站記錄我看過的動畫，
            還可以順便練習資料庫的使用，不過目前只放了四個當作樣本而已，
            之後有空的話應該會在新增更多的動畫。
            除此之外也順便學習了基本的登入登出註冊帳號系統。
        </p>
        <p>
            小遊戲的部分，是為了練習JS寫的東西，
            不過裡面目前只有一個充滿bug的俄羅斯方塊而已。
            實驗區的話則是我嘗試各種JS的地方，等做出完整的小遊戲時會在放上去。
        </p>
        <p style="text-align:right">2022/12/22</p>
        <h2>個人簡介</h2>
        <p>姓名: 施奕安</p>
        <P>生日: 2003/11/02</p>
        <p>興趣: 看動畫，寫程式，重訓</P>
        <p>學歷: 中央大學資訊工程學系</p>


    </div>
    <!-- <image src=other_img/marin.jpg style="width:100%;opacity:1.0;"> -->
</body>

</html>