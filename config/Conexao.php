<?php
class Conexao{

    static $con = null;
    public static function getConnection(){
    $ip = "sql106.epizy.com";
    $port = "3306";
    $user = "epiz_32123353";
    $pass = "sDJrc72l1B";
    $db = "epiz_32123353_projeto_final";

    if(!self::$con){
        self::$con = new mysqli($ip, $user, $pass, $db, $port);
        self::$con->set_charset("utf8mb4");

        if(self::$con->connect_error){
            echo self::$con->connect_error;
            die();
        }
    }
    return self::$con;
}
}
?>
