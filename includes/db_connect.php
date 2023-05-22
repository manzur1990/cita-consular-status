<?php
// Database configuration
$host = '127.0.0.1';
$dbname = 'citas_consulares';
$username = 'root';
$password = 'your_password';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
    exit();
}
