<div class="top_bar" >
    <a class="link_left" href="index.php" >首頁</a>
    <a class="link_left" href="description.php">評論區</a>
        
    <?php
        if(isset($_SESSION['user_type']) )
            if($_SESSION['user_type'] === 'admin')
                echo '<a class="link_left" href="upload_description.php">上傳評論區</a>';
        if(isset($_SESSION['user_id'])){
            echo "<a class='link_right' href='logout.php'>登出</a>";
            echo "<div class='link_right'> ";
            echo htmlspecialchars($_SESSION['username']);
            echo "</div>";
        }
        else{
            echo "<a class='link_right' href='login.php' >登入</a></div>";
        }
    ?>
</div>