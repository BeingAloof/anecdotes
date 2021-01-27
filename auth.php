<?php
session_start();
    if(isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $link = mysqli_connect("localhost", "root", "root", "db");
        $obj = mysqli_query($link, "SELECT * FROM admins WHERE login = '$login'");
        $arr = mysqli_fetch_assoc($obj);

        if($arr){
            if(password_verify($password, $arr['password'])){
                $_SESSION['auth'] = true;
                header("Location: http://task/admin.php/");
            }
            else{
                echo '<p>Пользователь не найден</p>';
            }
        }
        else{
            echo '<p>Пользователь не найден</p>';
        }
    }
?>
<form action="" method = "POST">
    <input type="text" name = "login">
    <input type="password" name = "password">
    <input type="submit">
</form>