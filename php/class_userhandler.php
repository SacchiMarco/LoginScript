<?php
include_once ("class_dbcon.php");

class UserHandler extends DBCon
{
    private $pdo;

    public function __construct()
    {
        $con = new DBCon();
        $this->pdo = $con->getPDO();

    }

    /**
     * Add new User
     * return false if Nick alredy exists
     */
    public function registerNewUser($User)
    {
        $registerNewUser = $User;
        $nick = $registerNewUser->getNick();
        //Hash Password
        $pwd = password_hash($registerNewUser->getPwd(), PASSWORD_DEFAULT);
        $check_nick_exist = $this->pdo->prepare("SELECT EXISTS(SELECT 1 FROM users WHERE usr_nick = :nick) as user_exist");
        $check_nick_exist->bindParam(':nick', $nick);
        $check_nick_exist->execute();
        $bool = $check_nick_exist->fetch();
        $check_nick_exist->closeCursor();

        if ($bool->user_exist == 0)
        {
            $stmt = $this->pdo->prepare("INSERT INTO users (id, usr_nick, usr_pwd) VALUES ('', :nick, :pwd) ");
            $stmt->bindParam(':nick', $nick);
            $stmt->bindParam(':pwd', $pwd);

            $stmt->execute();
            return array('bool' => true, 'nick' => $nick);
        }
        else
        {
            return false;
        }



    }

    /**
     * checkUserNickExist 
     * only check if nick alredy exist
     */
    public function checkUserNickExist($User)
    {
        $registerNewUser = $User;
        $nick = $registerNewUser->getNick();
        $check_nick_exist = $this->pdo->prepare("SELECT EXISTS(SELECT 1 FROM users WHERE usr_nick = :nick) as user_exist");
        $check_nick_exist->bindParam(':nick', $nick);
        $check_nick_exist->execute();
        $bool = $check_nick_exist->fetch();
        $check_nick_exist->closeCursor();

        if ($bool->user_exist == 0)
        {
            return true;
        }
        else
        {
            return false;
        }



    }
/**
 * User change data
 */

/**
 * Try Login User
 */
public function userLogin($User, $visitorIp){
    $user = $User;
    $ip = $visitorIp;

    //Ip check + count adden
    $nick = $user->getNick();
    $pwd = $user->getPwd();

    $stm = $this->pdo->prepare("SELECT * from users where usr_nick = :nick");
    $stm->bindParam(":nick", $nick);
    $stm->execute();
    $res = $stm->fetch();
    $stm->closeCursor();



    if(password_verify($pwd, $res->usr_pwd)){
        return $res;
    }
    else{
        return false;
    }
}

/**
 * Recover User Password
 */
}