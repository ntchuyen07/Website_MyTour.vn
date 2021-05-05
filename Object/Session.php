<?php
class Session {

    public function start()
    {
        session_start();
    }

    public function saveUser(String $user)
    {
        $_SESSION["user"] = $user;
    }

    public function getUser()
    {
        if(isset($_SESSION["user"])){
            $user = $_SESSION["user"];
            return $user;
        } else return "";
    }

    public function end()
    {
        session_destroy();
    }
}
?>