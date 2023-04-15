<?php 

$host = "localhost";
$database = "movies_api";
$user = "root";
$password = "";

$dbc = "mysql:host=$host;dbname=$database;charset=UTF8";

try {
    $dba = new PDO($dbc,$user,$password);
    $dba->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e){
    die($e->getMessage());
}