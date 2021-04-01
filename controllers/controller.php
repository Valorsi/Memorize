<?php

include('/home/boriscodefactory/public_html/memorize/classes/database.php');
class Controller extends database {

    
    public static function createView($viewName) {
        require_once("./view/$viewName.php");
    }

    //Function creates a popup window with the error message.
    public static function displayError($errorTitle,$errorMessage) {
        
        $errorSkeleton = controller::curl_file_get_contents('http://boris.codefactory.live/memorize/view/components/error.html');

        $errorReturn = str_replace('{errorTitle}',$errorTitle, $errorSkeleton);
        $errorReturn = str_replace('{errorMessage}',$errorMessage, $errorReturn);

        echo $errorReturn;
        
    }

    //Function redirects, wrote this to not write header("location:")..... multiple times.
    public static function redirectTo($redirect) {

        header("location:http://boris.codefactory.live/memorize/$redirect");

    }

    
    //Function does the same as file_get_contents(), i had to replace it after i uploaded everything to my webserver because of errors
    public static function curl_file_get_contents($URL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }

}


?>