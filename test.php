<?php
require_once __DIR__ . '/db_conn.php';
require_once __DIR__ . '/func-auth.php';

// Example user ID for token generation
$user_id = 1;

// Generate JWT token
$token = generate_token($user_id);

// Output the token
echo json_encode(["token" => $token]);
?>
