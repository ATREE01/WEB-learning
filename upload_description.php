<?php
    session_start();
    if(isset($_POST['submit'])){
        print_r($_POST);
        if(!empty($_POST['anime_title']) && !empty($_POST['anime_description'] && !empty($_FILES['image']))  ){
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
        <link rel="stylesheet" href="style.css">
        <title>upload_comment_page</title>
    </head>
    <body>
        <?php require ("top_bar.php");?>
        <form class="upload_area" action="upload_description.php" method="POST" enctype="multipart/form-data">
            <div class="upload_input_area">
                <div class="upload_text">
                    <textarea name="anime_title" placeholder="請在這裡輸入動畫標題"></textarea>
                    <textarea style="height:250px" name="anime_description" placeholder="請在這裡輸入評論"></textarea>
                </div>
                <div class="upload_btn">
                    <input id="cover_image" type="file" accept=".jpg, .jpeg, .png" name="image">
                    <input type="submit" name="submit"></button>
                </div>
            </div>
            <img id="preview" class="preview" src="#">
            <script>
                cover_image.onchange = evt =>{
                    const [file] = cover_image.files
                    if(file){
                        preview.src = URL.createObjectURL(file)
                    }
                }
            </script>
        </form>
    </body>
</html>         