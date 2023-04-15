<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

if(isset($_GET['id'])){

    // get the request parameter which has the title
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM movies WHERE id = :id";
    $smt = $dba->prepare($sql);
    $smt->bindParam(":id",$id);
    $smt->execute();

    if($smt){
        $smt->bindColumn(1,$id);
        $smt->bindColumn(2,$title);
        $smt->bindColumn(3,$storyline);
        $smt->bindColumn(4,$lang);
        $smt->bindColumn(5,$genre);
        $smt->bindColumn(6,$release_date);
        $smt->bindColumn(7,$box_office);
        $smt->bindColumn(8,$run_time);
        $smt->bindColumn(9,$stars);

        $smt->fetch();
        
        $movie = array(
            'id'=>$id,
            'title'=>$title,
            'storyline'=>$storyline,
            'lang'=>$lang,
            'genre'=>$genre,
            'release_date'=>$release_date,
            'box_office'=>$box_office,
            'run_time'=>$run_time,
            'stars'=>$stars
        );
        $response['error'] = false;
        $response['movies'] = $movie;
        $response['message'] = "movie has been returned successfully";

    } else {
        $response['error'] = true;
        $response['message'] = "we could not get the movie";
    }
}else {
    $response['error'] = true;
    $response['message'] = "please provide a movie title"; 
}
echo json_encode($response);