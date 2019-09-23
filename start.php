<?php
session_start();
if(isset($_SESSION["nick"])){echo $_SESSION["nick"];};
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/jquery.js"></script>
</head>

<body>
    <div id="login_user">
        <div id="login_msg"></div>
        <form action="login.php" method="post" id="login_form">
            <input type="text" name="login_nick" id="login_nick" placeholder="Username" autocomplete="username">
            <input type="password" name="login_pwd" id="login_pwd" placeholder="Password" autocomplete="new-password">
            <input type="submit" name="login_submit" value="Login">
        </form>
        <a href="" id="link_register">Register Account</a><a href="" class="" id="link_resetpwd">Password reset</a>
    </div>

</body>
<script src="js/main.js"></script>

</html>