<?php
// read.php
header('Content-Type: application/json');
require 'config.php';

try {
    $users = $collection->find()->toArray();

    // Convert MongoDB\BSON\ObjectId to string
    $response = array_map(function($user) {
        $user['_id'] = (string) $user['_id'];
        if (isset($user['created_at'])) {
            $user['created_at'] = $user['created_at']->toDateTime()->format('Y-m-d H:i:s');
        }
        return $user;
    }, $users);

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch students', 'details' => $e->getMessage()]);
}
?>