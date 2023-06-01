<?php
//
$host = 'localhost';
$user_name = 'root';
$pass = ''; // password
$db = 'coursedb'; // Database name

global $pdo;

try {

    $pdo = new PDO("mysql:host=$host; dbname=$db;", $user_name, $pass);
    $created = date("Y:m:d h:i:s");

} catch (PDOException $e) {

    echo "Error!: " . $e->getMessage() . "<br/>";

}

?>