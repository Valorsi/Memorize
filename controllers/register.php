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

            //Password requires Uppercase, Lowercase, a number and a special character. Saving results into variables so they can be used later.
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);


            //Check if Emails match
            if($email !== $emailConfirm) {
                $errMessage = "Emails don't Match!";
                $registerError = True;

            //Check if Email is actually an Email
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errMessage = "Email address is not valid!";
                $registerError = True;

            //Check if name fields are empty
            } else if (empty($firstName) || empty($lastName)) {
                $errMessage = "Name field cannot be Empty!";
                $registerError = True;

            //Check if Passwords match
            }else if ($password !== $passwordConfirm) {
                $errMessage = "Passwords don't match!";
                $registerError = True;

            //Check if password meets security standards
            } else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $errMessage = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                $registerError = True;

            //Check if email is already registered
            } else if ( database::query("SELECT email FROM users WHERE email=:email", array(':email'=>$email))) {
                $errMessage = "Email already registered, continue to <a href='localhost/memorize/login'>login</a>";
                $registerError = True;

            //if all checks pass Set registerError to False
            } else {
                $registerError = False;
            
            }

            //If there is an error, echo the error Message
            if ($registerError) {
                controller::displayError('There was a problem...', $errMessage);

            //Else proceed with the SQL Query
            } else if (!$registerError) {
                database::query("INSERT INTO users VALUES ('', :firstName, :lastName, :password, :email, 'user')", array(":firstName"=>$firstName, ":lastName"=>$lastName, ":password"=>password_hash($password, PASSWORD_DEFAULT ), ":email"=>$email));
                header('location:http://localhost/memorize/login');

            }

          
        }
     }
}

?>