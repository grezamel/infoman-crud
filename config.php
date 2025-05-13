<?php
// config.php
require 'vendor/autoload.php'; // Load Composer libraries

try {
    // Create a MongoDB client instance
    $client = new MongoDB\Client("mongodb://localhost:27017");

    // Select database and collection
    $db = $client->selectDatabase('testdb');
    $collection = $db->selectCollection('students');
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not connect to MongoDB', 'details' => $e->getMessage()]);
    exit;
}
?>