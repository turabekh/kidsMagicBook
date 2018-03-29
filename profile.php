<?php
session_start();
require_once("model/pdo.php");
include 'view/header.php';


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
  $query = "select title, author, description, date_created from books where user_id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $user_listings = $statement->fetchAll();
  $statement->closeCursor();
  return $user_listings;
}
if (!isset($_GET['user_id'])) {
  header('Location: index.php');
  return;
} else if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $userdata = get_user_by_id($user_id);
  $user_listings = get_user_listings($user_id);
}

if (!$userdata) {
  header('Location: error.php');

}


?>
<main class="mt-5" style='min-height: 100vh;'>
<!-- Main container starts -->
  <div class="container">
    <!-- First Row -->
    <div class='row'>
      <!-- Grid Column -->
      <div class="col-md-12 mb-4">
        <div class="jumbotron p-2">
          <!-- Card -->
            <div class="card card-image" style="background-image: url(http://foundationforlcl.org//wp-content/uploads/2016/02/children-in-the-library-clipart-29.jpg);">

            <!-- Content -->
            <div class="text-white rgba-black-strong py-5 px-4">
              <div>
                <span class="d-flex justify-content-center"><img src='<?php echo $userdata['avatar_hash']; ?>'class="rounded-circle"></span>

                  <h3 class="card-title pt-2 text-center"><strong><?php echo strtoupper($userdata['username']); ?></strong></h3>
                    <h5 class="text-white"><?php echo strtoupper($userdata['username']); ?> is a member since <?php echo substr($userdata['date_joined'], 0, 10) ?></h5>
                    <h5 class="text-white">Location: <a href="https://www.google.com/maps/place/<?php echo $userdata['location'];?>"><?php echo $userdata['location']; ?>.  </a></h5>
                    <h5 class="text-white">About myself: <?php echo $userdata['bio']; ?></h5>
                    <h5 class="text-white">My School: <?php echo $userdata['school_name']; ?></h5>
              </div>
            </div>
            <!-- Content -->
            </div>
            <!-- Card -->
          </div>
      </div>
      <!-- Grid Column Ends -->



<!-- Grid Column Ends -->
</div>
<!-- First Row ends -->
<?php include('controller/signupvalidate.php') ?>
<?php include('controller/loginvalidate.php') ?>
<div class='row'>
  <div class='col'>
    <h3 class="h4-responsive font-weight-bold text-center mb-3"><?php echo strtoupper($userdata['username']); ?> has listed the following book(s)</h3>
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
            <th>DATE LISTED</th>
        </tr>
        </thead><tbody class="text-center font-weight-bold">';
      foreach ($user_listings as $row) {
        $i++;
        $string .='<tr> <th scope="row">';
        $string .= $i;
        $string .='</th>';
        $string .= "<td class='lead'>".$row['title']."</td>";
        $string .= "<td class='lead'>".$row['author']."</td>";
        $string .= "<td class='lead'>". substr($row['date_created'], 0, 10)."</td>";
        $string .= "</tr>";
      }
      $string .='</tbody></table>';
      } else{
      $string = "No matches!";
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
include 'view/modalforms.php';
 ?>
