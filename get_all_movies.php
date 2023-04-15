<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

$sql = "SELECT * FROM movies";

$smt = $dba->prepare($sql);
$smt->execute();

if($smt){
    // this array stores all the results
    $movies = array();
    // get all results from db
    $row = $smt->fetchAll(PDO::FETCH_ASSOC);
    // loop and get each single row
    foreach($row as $rows){
        $movies[] = $rows;
    }
    $response['error'] = false;
    $response['movies'] = $movies;
    $response['message'] = "movies returned successfully";
 } else {
    $response['error'] = true;
    $response['message'] = "couldn't execute query";
 }
 echo json_encode($response);