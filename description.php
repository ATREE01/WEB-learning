<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>My_comment_page</title>
    </head>
    <body>
        <?php require ("top_bar.php");?>
        <div class="display_area">
            <?php
                $mysqli = require __DIR__ . "/database.php";
                $sql = "SELECT * FROM anime_description";
                $result = $mysqli -> query($sql);
                $anime = mysqli_fetch_all($result, MYSQLI_ASSOC);  
                foreach($anime as $item):
            ?>
            <div class="anime_block">
                <div><img class="anime_cover" src= img/<?php echo $item['image_name'] ?> ></div>
                <div class="anime_information">
                    <div style="float:right;">
                        <?php       
                            if(isset($_SESSION['user_type']) )
                                if($_SESSION['user_type'] === 'admin'){
                                    echo "<form action='modify.php' method='POST' class='modify_btn'>";
                                    echo "  <input type='hidden' name='anime_id' value= $item[id];> ";
                                    echo "  <input type='submit' name='submit' value='修改'>";
                                    echo "</form>";
                                }                                    
                        ?>
                        
                    </div>
                        <div class="anime_title"><?php echo $item['anime_title'] ?></div>
                        <div class="anime_description"><?php echo $item['anime_description'] ?></div>
                </div>
            </div>
            <?php endforeach; ?> 
        </div>
    </body>
</html>

