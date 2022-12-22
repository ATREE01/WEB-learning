<?php
    $link = 'https://animeweb.ddns.net/anime_web';

    if(isset($_POST['submit'])){
        $mysqli = require $_SERVER['DOCUMENT_ROOT'].'/anime_web/database.php';
        $sql = sprintf("SELECT * FROM login_db WHERE email ='%s'",$mysqli -> real_escape_string($_POST['email']));
        $result = $mysqli->query($sql);
        $user = $result -> fetch_assoc();
        
        if($user){
            if(password_verify($_POST['password'],$user["password_hash"])){
                
                session_start();
                session_regenerate_id();
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['username'] = $user['username'];
                echo "<script>window.alert('登入成功');window.location='$link/index.php'</script>";
                exit;
            }
            else echo "<script>window.alert('帳號或密碼錯誤')</script>";
        }
        else echo "<script>window.alert('帳號或密碼錯誤')</script>";
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="description" content="temp"/>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href=<?php echo "$link/CSS/style.css" ?>>
        <title>登入頁面</title>
    </head>
    <body class="login_body"> 
        <?php
            session_start();    
            if(isset($_SESSION['username']))
                header("Location:$link/index.php");
        ?>  
        <form action="login.php" class="login" method="POST">
            <h1>歡迎登入</h1>
            <input class="login_input" type="email" name="email" placeholder="請輸入電子信箱"></input>
            <input class="login_input" type="password" name="password" placeholder="請輸入密碼"></input>
            <input class="btn" type="submit" name="submit" value="登入">
            <a class="sign_up" href="signup.php">註冊新帳號</a>
        </form>
    </body>  
</html>
