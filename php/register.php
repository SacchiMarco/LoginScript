<?php

include_once ("..\php\class_user.php");
include_once ("..\php\class_userhandler.php");

if (isset ($_POST['nick']))
{
    $nick = $_POST['nick'];

    $user = new User("", $nick, "");
    $userHandler = new UserHandler();

    if ($userHandler->checkUserNickExist($user))
    {
        echo true;

    }
    else
    {
        echo false;


    }
}

if (isset ($_POST['regNick']))
{
    $nick = $_POST['regNick'];
    $pwd = $_POST['regPwd'];

    $user = new User("", $nick, $pwd);
    $userHandler = new UserHandler();

    echo json_encode( $userHandler->registerNewUser($user), JSON_FORCE_OBJECT);
}
