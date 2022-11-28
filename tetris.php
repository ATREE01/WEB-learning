<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href="style.css"/>
        <style>
            h1{
                color:red;
            }
            #my_canvas{
                color:white;
                margin:10px 0px 0px 10px;
            }
        </style>
        <script src="tetris.js"></script>
        <title>main_page</title>
    </head>
    <body class="index_body">
        <?php require ("top_bar.php");?>
        <div style="margin-top:50px;"></div>
        <div>
            <h1>
                這是一個充滿bug的俄羅斯方塊 真虧那個人還能出youtube教學。
                不過至少算是學到怎麼寫JS遊戲了。
            </h1>
            <canvas id='my_canvas'></canvas>
        </div>
    </body>
</html>