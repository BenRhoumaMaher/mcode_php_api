<?php 
header('Content-type: application/json');
require "app/connection.php";

$response = array();

if(isset($_GET['title'])){

    // get the request parameter which has the title
    $title = $_GET['title'];
    
    $sql = "SELECT * FROM movies WHERE title = :title";
    $smt = $dba->prepare($sql);
    $smt->bindParam(":title",$title);
    $smt->execute();

    if($smt){
        $smt->bindColumn('id',$id);
        $smt->bindColumn('title',$title);
        $smt->bindColumn('storyline',$storyline);
        $smt->bindColumn('lang',$lang);
        $smt->bindColumn('genre',$genre);
        $smt->bindColumn('release_date',$release_date);
        $smt->bindColumn('box_office',$box_office);
        $smt->bindColumn('run_time',$run_time);
        $smt->bindColumn('stars',$stars);

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