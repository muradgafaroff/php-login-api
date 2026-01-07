<?php
require_once 'db.php';

class User {
    public $id;
    public $email;
    public $password_hash;
    public $is_active;

    public static function findByEmail($email) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT id, email, password_hash, is_active FROM users WHERE email=?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $user = new self();
        $user->id = (int)$row['id'];
        $user->email = $row['email'];
        $user->password_hash = $row['password_hash'];
        $user->is_active = (int)$row['is_active'];
        return $user;
    }
}
