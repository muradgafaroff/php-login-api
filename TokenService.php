<?php
require_once 'db.php';

class TokenService {
    public static function createToken($userId) {
        $pdo = Database::getConnection();
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', time() + 86400);
        $stmt = $pdo->prepare("INSERT INTO user_tokens (user_id, token, expires_at, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$userId, $token, $expires_at]);
        return $token;
    }
}
