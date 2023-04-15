<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

if(isset($_POST['id']) && isset($_POST['storyline']) && isset($_POST['stars']) 
&& isset($_POST['box_office'])){

    $id = $_POST['id'];
    $storyline = $_POST['storyline'];
    $stars = $_POST['stars'];
    $box_office = $_POST['box_office'];

    $sql = "UPDATE movies_api.movies SET storyline = :storyline,
    stars = :stars,
    box_office=:box_office
    WHERE id = :id
    ";
    $smt = $dba->prepare($sql);
    $smt->bindParam(':storyline',$storyline);
    $smt->bindParam(':stars',$stars);
    $smt->bindParam(':box_office',$box_office);
    $smt->bindParam(':id',$id);
    $smt->execute();

    if($smt){
        $response['error'] = false;
        $response['message'] = "movie has been updated";
     }
    else {
        $response['error'] = true;
        $response['message'] = "failed to update";
}
} else {
        $response['error'] = true;
        $response['message'] = "Please provide movie informations";
}
echo json_encode($response);