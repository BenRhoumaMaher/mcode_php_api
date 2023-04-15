<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $storyline = $_POST['storyline'];
    $lang = $_POST['lang'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $box_office = $_POST['box_office'];
    $run_time = $_POST['run_time'];
    $stars = $_POST['stars'];


    $sql = "INSERT INTO movies(title,storyline,lang,genre,release_date,box_office,run_time,stars)
    VALUES(:title,:storyline,:lang,:genre,:release_date,:box_office,:run_time,:stars)";
        $smt = $dba->prepare($sql);
        $smt->bindParam(':title',$title);
        $smt->bindParam(':storyline',$storyline);
        $smt->bindParam(':lang',$lang);
        $smt->bindParam(':genre',$genre);
        $smt->bindParam(':release_date',$release_date);
        $smt->bindParam(':box_office',$box_office);
        $smt->bindParam(':run_time',$run_time);
        $smt->bindParam(':stars',$stars);
        $smt->execute();

    if($smt){
        $response['error'] = false;
        $response['message'] = "movie has been inserted successfully";

    } else {
        $response['error'] = true;
        $response['message'] = "we could not insert the movie";
    }
}
else {
    $response['error'] = true;
    $response['message'] = "please provide all informations";
}
echo json_encode($response);