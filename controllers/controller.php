<?php


class Controller extends database {

    public static function createView($viewName) {
        require_once("./view/$viewName.php");
    }

    public static function isLoggedIn() {

        //Checks if Cookie is Set
        if (isset($_COOKIE['MID'])) {
            //Checks if Cookie is in Database
            if(database::query("SELECT fk_users_id FROM login_tokens WHERE login_token=:token", array(':token'=>sha1($_COOKIE['MID'])))){
                $userid = database::query("SELECT fk_users_id FROM login_tokens WHERE login_token=:token", array(':token'=>sha1($_COOKIE['MID'])))[0]['fk_users_id'];
                
                return $userid;
            }
        }
        return false;

    }

    public static function reroute() {

    }



}


?>