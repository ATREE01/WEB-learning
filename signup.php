


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
    <form action="signup_process.php" method=POST class="signup">
            <h1>歡迎註冊</h1>
            <input class="text_input" type="text" name="account" placeholder="請輸入使用者名稱" ></input>
            <input class="text_input" type="text" name="account" placeholder="請輸入電子信箱" ></input>
            <input class="text_input" type="password" name="password" placeholder="請輸入密碼"></input>
            <input class="text_input" type="password" name="password" placeholder="再次輸入密碼"></input>
            <input class="btn" type="submit" name="submit" value="註冊">
        </form>
    </body>
</html>