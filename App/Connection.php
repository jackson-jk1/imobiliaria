<?php

namespace App;

/**
 * Class Connection
 * @package App
 */
class Connection {
    public static function getDb(){
        try {
            $conn = new \PDO(
                "mysql:host=;charset=utf8",
                "",
                ""
            );
            return $conn;
        } catch (\PDOException $e) {
            echo $e;
        }
    }
}

?>