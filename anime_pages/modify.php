<?php

$link = 'http://animeweb.ddns.net/anime_web';

    if(isset($_POST['submit'])){
        $mysqli = require $_SERVER['DOCUMENT_ROOT'].'/anime_web/database.php';
        $sql = sprintf("SELECT * FROM anime_description WHERE id = '%d'",$mysqli -> real_escape_string($_POST['anime_id']));
        $result = $mysqli->query($sql);
        $anime = $result->fetch_assoc();
    }

    session_start();
    if(isset($_POST['modify'])){
        if(!empty($_POST['anime_title']) && !empty($_POST['anime_description'])){
            $title = $_POST["anime_title"];
            $description = $_POST["anime_description"];
            $id = $_POST["id"];

            $mysqli = require $_SERVER['DOCUMENT_ROOT'].'/anime_web/database.php';
            $sql = "UPDATE anime_description SET anime_title = '$title' , anime_description = '$description' WHERE anime_description . id = $id";
            $stmt = $mysqli->stmt_init();
            $stmt ->prepare($sql);
            $stmt->execute();
            header("Location:description.php");
        }
        else echo "<script>window.alert('未填入完全')</script>";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href=<?php echo "$link/CSS/style.css" ?>>
        <title>modify_page</title>
    </head>
    <body>
         <form class="modify_area" action="modify.php" method="POST" enctype="multipart/form-data">
            <div class="modify_input_area">
                <div class="upload_text">
                    <input type="hidden" name="id" value=<?php echo $anime['id'] ; ?>>
                    <textarea name="anime_title"><?php echo $anime['anime_title'] ; ?></textarea>
                    <textarea style="height:250px" name="anime_description"><?php echo $anime['anime_description'] ?></textarea>
                </div>
                <div class="upload_btn">
                    <input type="submit" name="modify">
                </div>
            </div>
        </form>
    </body>
</html>