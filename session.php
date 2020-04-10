<?php

    session_start();
    
    if ($_SESSION['email']) {
        「email」に値があれば表示
        echo "You are logged in!";
        
    } else {
        //元の画面に戻す
        header("Location: index.php");
        
    }
?>