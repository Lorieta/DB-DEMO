<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . "<br>";


    $query = 'SELECT * FROM users';
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "User name: " . $row['name'] . "<br>";
        }
    }



} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>