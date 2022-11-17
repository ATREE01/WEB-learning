<?php
    $conn = new mysqli("localhost","root","","anime_web");
    if(isset($_POST["submit"])){
        $title = $_POST["anime_title"];
        $comment = $_POST["anime_comment"];
        $filename = $_FILES["image"]["name"];
        $tmpname = $_FILES["image"]["tmp_name"];
        
        $validImageExtension = ["jpg","jpeg","png"];
        $imageExtension = explode('.',$filename);
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension,$validImageExtension)){
            echo "<script>alert('檔案格式錯誤');</script>";
        }
        $newImageName = uniqid();
        $newImageName .= '.'.$imageExtension;
        move_uploaded_file($tmpname, "img/$newImageName");
        $query = " INSERT INTO anime_comment VALUES('','$newImageName','$title','$comment')";
        mysqli_query($conn , $query);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <mata charset="UTF-8">
        <meta name="description" content="temp">
        <meta name="viewpoint" content="width=device=width, initial-scal=1.0">
        <link rel="stylesheet" href="style.css">
        <title>upload_comment_page</title>
    </head>
    <body>
        <div class="top_bar" >
            <div class="link"><a href="main_page.php" >首頁</a></div>
            <div class="link"><a href="My_comment_page.php">評論區</a></div>
            <div class="link"><a href="upload_comment.php">上傳評論區</a></div>
        </div>
        <div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="upload_area">
                    <div>
                        <input type="textarea" placeholder="請在這裡輸入動畫標題" name="anime_title">
                   </div>
                    <div>
                        <input type="textarea" placeholder="請在這裡輸入評論" name="anime_comment">
                    </div>
                    <div><input type="file" accept=".jpg, .jpeg, .png" name="image"></div>
                    <div><input type="submit" name="submit"></button></div>
                </div>
            </form>
        </div>
    </body>
</html>         