<?php

require_once ('config.php');
function connectToDatabase(){
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT;
    try {
        return $pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


?>