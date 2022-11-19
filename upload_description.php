<?php

    session_start();
    if(isset($_POST['submit'])){
        $title = $_POST["anime_title"];
        $description = $_POST["anime_description"];
        $filename = $_FILES["image"]["name"];
        $tmpname = $_FILES["image"]["tmp_name"];

        $imageExtension = explode('.',$filename);
        $imageExtension = strtolower(end($imageExtension));

        $newImageName = uniqid();
        $newImageName .= '.'.$imageExtension;
        move_uploaded_file($tmpname, "img/$newImageName");

        $mysqli = require __DIR__ . "/database.php";
        $sql = "INSERT INTO anime_description (anime_title, anime_description, image_name)
                VALUES (?, ?, ?)";
        $stmt = $mysqli->stmt_init();
        $stmt ->prepare($sql);
        $stmt -> bind_param("sss",$title,$description,$newImageName);
        $stmt->execute();
        header("Location:My_comment_page.php");
    }
    
    // if(isset($_POST["submit"])){
    //     $title = $_POST["anime_title"];
    //     $comment = $_POST["anime_comment"];
    //     $filename = $_FILES["image"]["name"];
    //     $tmpname = $_FILES["image"]["tmp_name"];
        
    //     $validImageExtension = ["jpg","jpeg","png"];
    //     $imageExtension = explode('.',$filename);
    //     $imageExtension = strtolower(end($imageExtension));
    //     if(!in_array($imageExtension,$validImageExtension)){
    //         echo "<script>alert('檔案格式錯誤');</script>";
    //     }
    //     $newImageName = uniqid();
    //     $newImageName .= '.'.$imageExtension;
    //     move_uploaded_file($tmpname, "img/$newImageName");
    //     $query = " INSERT INTO anime_comment VALUES('','$newImageName','$title','$comment')";
    //     mysqli_query($conn , $query);
    // }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href="style.css">
        <title>upload_comment_page</title>
    </head>
    <body class="upload_body">
        <?php require ("top_bar.php");?>
        <form class="upload_area" action="upload_comment.php" method="POST" enctype="multipart/form-data">
            <div class="upload_input_area">
                <div class="upload_text">
                    <input type="textarea" placeholder="請在這裡輸入動畫標題" name="anime_title">
                    <input style="height:250px;" type="textarea" placeholder="請在這裡輸入評論" name="anime_description">
                </div>
                <div class="upload_btn">
                    <input type="file" accept=".jpg, .jpeg, .png" name="image">
                    <input type="submit" name="submit"></button>
                </div>
            </div>
        </form>
    </body>
</html>         