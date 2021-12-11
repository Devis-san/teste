<?php

    session_start();
    $_SESSION['USER_GLOBAL_DATA'] = null;
    header("Location: /src/_html/_login/login.php");
    
?>