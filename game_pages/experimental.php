<?php
    $link = 'http://animeweb.ddns.net/anime_web';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href=<?php echo "$link/CSS/style.css"?>>
        <link rel="stylesheet" href=<?php echo "$link/CSS/experimental.css"?>>
        <title>experimental_page</title>
    </head>
    <body class="index_body">
        <?php require ($_SERVER['DOCUMENT_ROOT'].'/anime_web/top_bar.php'); ?>
        <div style="margin-top:50px;"></div>
        <div>
            <a target="blank" href="https://www.youtube.com/watch?v=9fCNNuH-Grg&ab_channel=%E3%82%B9%E3%83%94%E3%83%A9%E3%83%BB%E3%82%B9%E3%83%94%E3%82%ABOfficialYouTubeChannel%28SMEJ%29">
                <img class="img" src=<?php echo "$link/other_img/marin_1.jpg"?> >
            </a>
        </div>
        <canvas id='canvas'></canvas>
        <script src="experimental.js"></script>
    </body>
</html>