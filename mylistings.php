<?php
session_start();
require_once("model/pdo.php");
include 'view/header.php';
include 'view/modalforms.php';

function get_user_by_id($user_id) {
  global $db;
  $query = "Select * from users where user_id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $userdata = $statement->fetch();
  $statement->closeCursor();
  return $userdata;
}

function get_user_listings($user_id) {
  global $db;
  $query = "select title, author, description, date_created, book_id from books where user_id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $user_listings = $statement->fetchAll();
  $statement->closeCursor();
  return $user_listings;
}
$user_id = $_GET['user_id'];
$userdata = get_user_by_id($user_id);
$user_listings = get_user_listings($user_id);
if (!$userdata) {
  echo 'what';
}


?>
<main class="mt-5" style='min-height: 100vh;'>
<!-- Main container starts -->
  <div class="container">
    <!-- First Row -->
    <div class='row'>
<!-- Grid Column -->
    <div class="col-md-12 mb-4">
      <h2> </h2>
      <hr>
      <div class="border border-indigo p-2 pl-5 mb-4">
        <form class="md-form form-row">
            <input class="form-control mr-sm-2" type="text" placeholder="Search Books" aria-label="Search">
            <input class="btn btn-indigo" type="submit" value="Search">
        </form>
      </div>
    <hr>
      <?php include('controller/signupvalidate.php') ?>
      <?php include('controller/loginvalidate.php') ?>
    </div>
<!-- Grid Column Ends -->
</div>
<!-- First Row ends -->

<div class='row'>
  <div class='col'>
    <h3 class="h3-responsive font-weight-bold text-center mb-3">The books I have listed so far</h3>
    <h3 class="h4-responsive text-center">    <?php if (isset($_SESSION['book_deleted'])) {echo '<div class="alert alert-info text-uppercase" role="alert">'. $_SESSION['book_deleted'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>'; } unset($_SESSION['book_deleted']);?>
    </h3>

    <h3 class="h4-responsive text-center">    <?php if (isset($_SESSION['book_updated'])) {echo '<div class="alert alert-info text-uppercase" role="alert">'. $_SESSION['book_updated'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>'; } unset($_SESSION['book_updated']);?>
    </h3>
  </div>
</div>
<div class='row'>
  <div class='col-md-12 col-sm-12'>
    <?php
    $string = '';
    $i = 0;
    if ($user_listings){
      $string .='<table class="table table-hover">';
      $string .='<thead class="mdb-color darken-3 text-white text-center">
        <tr>
            <th>#</th>
            <th>TITLE</th>
            <th>AUTHOR</th>
            <th>DATE CREATED</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>
        </thead><tbody class="text-center font-weight-bold">';
      foreach ($user_listings as $row) {
        $i++;
        $string .='<tr><th scope="row">';
        $string .= $i;
        $string .='</th>';
        $string .= "<td class='lead'>".$row['title']."</td>";
        $string .= "<td class='lead'>".$row['author']."</td>";
        $string .= "<td class='lead'>". substr($row['date_created'], 0, 10)."</td>";
        $string .= "<td class='lead'><form method='POST' action='editlisting.php?book_id=";
        $string .= $row['book_id']."&user_id=".$user_id."'><button type='submit' name='submit' value='edit' class='btn btn-indigo my-0' style='border-radius: 70px;'>&nbsp;&nbsp;EDIT&nbsp;</button></form></td>";
        $string .= "<td class='lead'><form method='POST' action='model/deletebook.php?book_id=";
        $string .= $row['book_id']."&user_id=".$user_id."'><button type='submit' name='delete' value='delete' class='btn btn-indigo my-0' style='border-radius: 70px;'>Delete</button></form></td>";
        $string .= "</tr>";
      }
      $string .='</tbody></table>';
      } else{
      $string = "<div class='lead'>No Listings so far!</div>";
    }
    echo $string;
    ?>
  </div>


</div>






</div>
<!-- Main Container Ends -->

</main>
<?php
include 'view/footer.php';

 ?>
