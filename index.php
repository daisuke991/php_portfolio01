<?php
    //Start
    //サーバ名、データベースユーザー名、パスワード名
    mysqli_connect("localhost", "cl29-users-bzh", "YTTMcfhK.");
    //MYSQLに接続できなかった場合エラーを表示
    if (mysqli_connect_error()) {
        
        echo "There was an error connecting to the database";
        
    } else {
        
        echo "Database connection successful!";
        
    }
    //End

    //Start
    //取得したデータベースを変数「link」へ代入
    $link = mysqli_connect("shareddb1b.hosting.stackcp.net", "cl29-users-bzh", "YTTMcfhK.", "cl29-users-bzh");

    if (mysqli_connect_error()) {
        
        die ("There was an error connecting to the database");
        
    } 

    //フィールド名「user」を取得
    $query = "SELECT * FROM users";
    //上記の代入した変数が無事代入できていれば処理をする
    if ($result = mysqli_query($link, $query)) {
        //1行ずつ結果を配列で取得し「row」に配列で代入
        $row = mysqli_fetch_array($result);
        //データベースの値を取得し、画面へ書き出す
        echo "Your email is ".$row[1]." and your password is ".$row[2];
        
    }

    //「password」フィールドの値を「uedjUFH7^%」へ変更
    $query = "UPDATE `users` SET password = 'uedjUFH7^%' WHERE email = 'robpercival80@gmail.com' LIMIT 1";
    //Emd

    //Start
    mysqli_query($link, $query);

    $query = "SELECT * FROM users";

    if ($result = mysqli_query($link, $query)) {
        
        $row = mysqli_fetch_array($result);
        
        echo "Your email is ".$row[1]." and your password is ".$row[2];
        
    }
    //End

    //Start
    //session処理
    session_start();

    if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
        
        $link = mysqli_connect("localhost", "cl29-users-bzh", "YTTMcfhK.", "cl29-users-bzh");

            if (mysqli_connect_error()) {
        
                die ("There was an error connecting to the database");
        
            } 
        
        //入力欄がからの場合、エラー表示
        if ($_POST['email'] == '') {
            
            echo "<p>Email address is required.</p>";
            
        } else if ($_POST['password'] == '') {
            
            echo "<p>Password is required.</p>";
            
        } else {
            
            $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link, $query);
            //重複チェック
            if (mysqli_num_rows($result) > 0) {
                
                echo "<p>That email address has already been taken.</p>";
                
            } else {
                //「email」と「password」を登録
                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)) {
                    
                    $_SESSION['email'] = $_POST['email'];
                    //session.phpの処理を行う
                    header("Location: session.php");
                    
                } else {
                    //登録がされなかった場合のエラー表示
                    echo "<p>There was a problem signing you up - please try again later.</p>";
                    
                }
                
            }
            
        }
        
        
    }
?>
//登録入力画面
<form method = "post">

<input name="email" type="text" placeholder="Email address">

<input name="password" type="password" placeholder="Password">

<input type="submit" value = "Sign up">

</form>