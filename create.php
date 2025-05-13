<?php
// create.php
header('Content-Type: application/json');
require 'config.php';

// Read POSTed data (JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['name']) || empty($data['email']) || empty($data['age']) || empty($data['course'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Name, Email, Age, and Course are required']);
    exit;
}

try {
    $insertResult = $collection->insertOne([
        'name' => $data['name'],
        'email' => $data['email'],
        'age' => $data['age'],
        'course' => $data['course'],
        'enrolled_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    echo json_encode([
        'message' => 'Student created successfully',
        'id' => (string) $insertResult->getInsertedId()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create student', 'details' => $e->getMessage()]);
}
?>