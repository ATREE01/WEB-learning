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
        <!-- <div>
            <a target="blank" href="https://www.youtube.com/watch?v=9fCNNuH-Grg&ab_channel=%E3%82%B9%E3%83%94%E3%83%A9%E3%83%BB%E3%82%B9%E3%83%94%E3%82%ABOfficialYouTubeChannel%28SMEJ%29">
                <img class="img" src=<?php echo "$link/other_img/marin_1.jpg"?> >
            </a>
        </div> -->
        <!-- <div class="canvas_character">
            <div class="controls">
                <label for="animations">Choose Animation:</label>
                <select id="animations" name="animations"> 
                    <option value='idle'>idle</option>
                    <option value='jump'>jump</option>
                    <option value='fall'>fall</option>
                    <option value='run'>run</option>
                    <option value='dizzy'>dizzy</option>
                    <option value='sit'>sit</option>
                    <option value='roll'>roll</option>
                    <option value='bite'>bite</option>
                    <option value='ko'>ko</option>
                    <option value='getHit'>getHit</option>
                </select>
            </div>
            <canvas id='canvas'></canvas>
            <script src="character.js"></script>
        </div> -->
        <!-- <div id="container">
            <div class="background">
                <canvas id="canvas"></canvas>
            </div>
            <p>Game speed: <span id='showGameSpeed'></span></p>
            <input type="range" min="0" max="20" value="5" class="slider" id="slider"></input>
            <script src="background.js"></script>
        </div> -->
        <canvas id="canvas"></canvas>
        <script src="script.js"></script>
    </body>
</html>