<?php
//
$host = "localhost";
$user_name = "root"; //username is root
$pass = ""; //password is null
$db = "coursedb"; //coursedb is my schema name in mysql database

global $pdo;

try {
    $pdo = new PDO("mysql:host=$host; dbname=$db;", $user_name, $pass);
    //creating pdo instance representing a connection to a database with following inputs to mysql database
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    // it throw an error
}

?>