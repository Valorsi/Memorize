<?php
class register extends Controller {

    
     public static function registerUser() {
         
        if(isset($_POST['register'])) {
            //Save post into variables and strip them of Tags and empty spaces
            $firstName = strip_tags(trim($_POST['firstName']));
            $lastName = strip_tags(trim($_POST['lastName']));
            $email = strip_tags(trim($_POST['email']));
            $emailConfirm = strip_tags(trim($_POST['emailConfirm']));
            $password = strip_tags(trim($_POST['password']));
            $passwordConfirm = strip_tags(trim($_POST['passwordConfirm']));

            //Check if Emails match
            if($email !== $emailConfirm) {
                echo "Emails don't Match";

            //Check if Passwords match
            } else if ($password !== $passwordConfirm) {
                echo "Passwords don't match";

            //Check if email is already registered
            } else if ( database::query("SELECT email FROM users WHERE email=:email", array(':email'=>$email))) {

                echo "Email already registered, continue to <a href='localhost/memorize/login'>login</a>";

            //Proceed to register if all checks go through
            } else {

                database::query("INSERT INTO users VALUES ('', :firstName, :lastName, :password, :email, 'user')", array(":firstName"=>$firstName, ":lastName"=>$lastName, ":password"=>password_hash($password, PASSWORD_DEFAULT ), ":email"=>$email));
                echo "Registration Successfull, continue to <a href='localhost/memorize/login'>login</a>!";
                

                



            }

          
        }
     }
}

?>