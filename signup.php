<?php
    if(isset($_POST['submit'])){
        //  print_r($_POST);
        if(empty($_POST['username']))
           echo "<script>window.alert('請輸入使用者名稱')</script>"; 
        else if(empty($_POST['email']))
            echo "<script>window.alert('請輸入電子信箱')</script>"; 
        else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            echo ("<script>window.alert('請輸入正確電子信箱')</script>"); 
        else if(empty($_POST['password']))
            echo "<script>window.alert('請輸入密碼')</script>"; 
        else if(empty($_POST['password2']))
            echo "<script>window.alert('請再次輸入密碼')</script>"; 
        else if (strlen($_POST['password']) < 8)
            echo "<script>window.alert('密碼長度需要超過8位')</script>"; 
        else if(!preg_match("/[a-zA-Z]/",$_POST["password"]))
            echo "<script>window.alert('密碼需要至少包含一個字母')</script>"; 
        else if(!preg_match("/[0-9]/",$_POST["password"]))
            echo "<script>window.alert('密碼需要至少包含一個數字')</script>"; 
        else if($_POST['password'] !== $_POST['password2'])
            echo "<script>window.alert('請確認兩次輸入密碼相同')</script>"; 
        else {
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $username = $_POST['username']; $username = htmlspecialchars($username);
            $email = $_POST['email'];$email=htmlspecialchars($email);
            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            
            $mysqli = require __DIR__ . "/database.php";
            $sql = "INSERT INTO login_db (username, email, password_hash)
                    VALUES (?, ?, ?)";
            $stmt = $mysqli->stmt_init();
            $stmt ->prepare($sql);
            $stmt -> bind_param("sss",$username,$email,$password_hash);
            try {
                $stmt->execute();
                echo "<script>window.alert('註冊成功'); window.location='login.php'</script>";
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    echo "<script>window.alert('電子信箱已使用過')</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8"/>
        <meta name="description" content="temp"/>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="style.css"/>
        <title>註冊頁面</title>
    </head>
    <body class="signup_body">
        <form action="signup.php" method=POST class="signup">
            <h1>歡迎註冊</h1>
            <input class="text_input" type="text" name="username" placeholder="請輸入使用者名稱" ></input>
            <input class="text_input" type="text" name="email" placeholder="請輸入電子信箱" ></input>
            <input class="text_input" type="password" name="password" placeholder="請輸入密碼"></input>
            <input class="text_input" type="password" name="password2" placeholder="再次輸入密碼"></input>
            <input class="btn" type="submit" name="submit" value="註冊">
        </form>
    </body>
</html>