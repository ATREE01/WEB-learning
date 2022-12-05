<?php
$link = "http://localhost/anime_web";
session_start();
session_destroy();

header("Location:$link/index.php");

exit;