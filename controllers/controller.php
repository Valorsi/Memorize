<?php


class Controller extends database {

    public static function createView($viewName) {
        require_once("./view/$viewName.php");
    }



}


?>