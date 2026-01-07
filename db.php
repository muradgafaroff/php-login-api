<?php


class Database {
    private static $instance = null;

    public static function getConnection() {
        if (!self::$instance) {
            $dsn = 'mysql:host=localhost;dbname=test_db;charset=utf8mb4';
            $user = 'root';
            $pass = '';
            self::$instance = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
}
