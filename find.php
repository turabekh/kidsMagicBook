<?php
include 'model/pdo.php';


$search_term = $_GET['search_term'];
$query = "SELECT books.title, books.description, books.filedestination, users.user_id, users.username, users.school_name
FROM books
INNER JOIN users ON books.user_id=users.user_id where books.title like '%$search_term%'
or books.description like '%$search_term%' or books.author like '%$search_term%'
order by books.title asc";
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll();

$response = '';

if ($results) {
  foreach ($results as $result) {
    $response .='<div class="col-md-4 mb-4">
      <!--Card-->
      <div class="card">

            <!--Card image-->
            <div class="view overlay hm-white-slight">
                <img src="'.$result['filedestination'].'" class="img-fluid" style="min-width: 100%;height: 220px;" alt="">
                <a href="#">
                    <div class="mask"></div>
                </a>
            </div>

            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h4 class="card-title">'. $result['title']. '</h4>
                <h6>Posted By: <a href="profile.php?user_id='.$result['user_id'].'">'. $result['username'].'</a></h6>
                <h6>School Name: <span class="text-info">'. $result['school_name'].'</span></h6>
                <!--Text-->
                <p class="card-text">Description: <a href="#">'. substr($result['description'], 0, 25).'...</a></p>
                <a href="contact.php?user_id='.$result['user_id'].'" class="btn btn-indigo mx-0">Contact Me</a><a class="btn btn-indigo" data-toggle="modal" data-target="#description">More Info</a>
            </div>

        </div>


    </div>';
  }

}   else{
    $response = '<div class="col">
          <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Sorry No matching results!</h4>
        <p>You can try searching with author\'s name or with title or keywords about the book. Thanks<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button</p>
        <hr>
        </div>
        </div>';
}




echo $response;
?>
