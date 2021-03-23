<?php
class login extends Controller {
    

    
    // Funktion userLogin
    // Checks if a POST has been submit for logging in and generates a token.
    public static function userLogin() {
        
        if(isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(database::query('SELECT email FROM users WHERE email=:email', array(":email"=>$email))) {
                
               if( password_verify($password, database::query('SELECT password FROM users WHERE email=:email', array(":email"=>$email))[0]['password'])) {
                   echo "Welcome to Memorize!";

                   //Generate a Token
                   $cstrong = true;
                   $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

                   //Grab Users ID
                   $user_id = database::query('SELECT users_id FROM users WHERE email=:email', array(":email"=>$email))[0]['users_id'];

                   //Sets hashed Token into Database
                   database::query('INSERT INTO login_tokens VALUES ("", :token, :fk_users_id)', array(':token'=>sha1($token), ':fk_users_id'=>$user_id));
                   
                   //Sets the Cookie into browser
                   setcookie("MID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);

               } else {
                   echo "Wrong Password!";
                   
               }


            } else {
                echo "User is not Registered! Please register <a href='localhost/memorize/register'>here</a>.";
            }


        }


    }
}

?>