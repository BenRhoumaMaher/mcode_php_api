<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

//provide movie id
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM movies WHERE id = :id LIMIT 1";
    $smt = $dba->prepare($sql);
    $smt->bindParam(':id',$id);
    $smt->execute();
    if($smt){
        $response['error'] = false;
        $response['message'] = "movie has been deleted successfully";

    } else {
        $response['error'] = true;
        $response['message'] = "we could not delete the movie";
    }
} 
else{
    $response['error'] = true;
    $response['message'] = "please provide the movie id";
}
echo json_encode($response);