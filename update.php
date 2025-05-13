<?php
// update.php
header('Content-Type: application/json');
require 'config.php';

// Read PUTed data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['id']) || empty($data['name']) || empty($data['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID, Name, Email, Age, and Course are required']);
    exit;
}

try {
    $updateResult = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($data['id'])],
        ['$set' => ['name' => $data['name'], 'email' => $data['email'], 'age' => $data['age'], 'course' => $data['course']]]
    );

    echo json_encode(['message' => 'Student updated successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update student', 'details' => $e->getMessage()]);
}
?>