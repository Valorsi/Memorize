<?php 

class database {

    public static $host = "localhost";
    public static $db_name = "";
    public static $username = '';
    public static $password = '';


    private static function connect() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$db_name.";charset=utf8", self::$username, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(" ", $query)[0] == "SELECT") {
            $data = $statement->fetchAll();
            return $data;
        }
    }
}

?>
