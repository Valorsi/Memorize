<?php


class Controller extends database {

    public static function createView($viewName) {
        require_once("./view/$viewName.php");
    }

    public static function displayError($errorTitle,$errorMessage) {
        
        $errorSkeleton = file_get_contents('./view/components/error.html');

        $errorReturn = str_replace('{errorTitle}',$errorTitle, $errorSkeleton);
        $errorReturn = str_replace('{errorMessage}',$errorMessage, $errorReturn);

        echo $errorReturn;
        die();
    }

}


?>