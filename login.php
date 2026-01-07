<?php
header('Content-Type: application/json');

require_once 'User.php';
require_once 'TokenService.php';

function sendResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}
$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? null;
$password = $input['password'] ?? null;

if (!$email || !$password) sendResponse(400, ['status'=>'error','message'=>'Email and password required']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) sendResponse(400, ['status'=>'error','message'=>'Invalid email format']);

$user = User::findByEmail($email);
if (!$user) sendResponse(401, ['status'=>'error','message'=>'Invalid credentials']);
if ($user->is_active === 0) sendResponse(403, ['status'=>'error','message'=>'User not active']);

if (!password_verify($password, $user->password_hash)) {
    sendResponse(401, ['status'=>'error', 'message'=>'Invalid credentials']);
}

$token = TokenService::createToken($user->id);


sendResponse(200, [
    'status'=>'ok',
    'data'=>[
        'token'=>$token,
        'user'=>[
            'id'=>$user->id,
            'email'=>$user->email
        ]
    ]
]);
