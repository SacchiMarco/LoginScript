<?php
session_start();
include_once ("..\php\class_user.php");
include_once ("..\php\class_userhandler.php");

$ip =  $_SERVER['REMOTE_ADDR'];

if(isset($_POST["loginNick"]) && isset($_POST["loginPwd"])){
    $nick = $_POST["loginNick"];
    $pwd = $_POST["loginPwd"];
    $callback;

    $user = new User("", $nick, $pwd);
    $userHandler = new UserHandler();

    $res = $userHandler->userLogin($user, $ip);

    if($res != false){
        $callback = array('bool' => true, 'count' => 0, 'msg' => 'Login success');
        $_SESSION["nick"] = $res->usr_nick;
    }
    else{
        //need rescount after fail
        $callback = array('bool' => false, 'count' => 0, 'msg' => 'Username or Password wrong!');
    }

    echo json_encode($callback);
}

/* $nick = "user";
$pwd = "1f";
$callback;

$user = new User("", $nick, $pwd);
$userHandler = new UserHandler();

$res = $userHandler->userLogin($user, $ip);

if($res != false){
    $callback = array('bool' => true, 'count' => 0, 'msg' => 'Login success');
}
else{
    //need rescount after fail
    $callback = array('bool' => false, 'count' => 0, 'msg' => 'Username or Password wrong!');
}

echo json_encode($callback); */