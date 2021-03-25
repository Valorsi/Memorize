<?php
class logout extends Controller {
    

    
    // Funktion userLogout
    // Checks if a POST has been submit for logging out, then logs the user out and resets their login_token
    public static function userLogout() {

        //Check if user is Logged in
        if (!login::isLoggedIn()){
            header('location:http://localhost/memorize/home');
        }

        //Check if user clicked logout
        if(isset($_POST['confirm'])) {

            //Check if user still has cookie
            if(isset($_COOKIE['MID'])) {

                //delete login token
                database::query('DELETE FROM login_tokens WHERE login_token=:token', array(':token'=>sha1($_COOKIE['MID'])));
                
                //set Expired cookie (don't eat or you will get sick)
                setcookie("MID", '1', time()-3600);

            }
        }

    }

}

?>