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

function get_user_messages($user_id) {
  global $db;
  $query = "select message_id, name, email, phone, content, is_read, date_sent from messages where user_id = :user_id order by date_sent Desc";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $user_messages = $statement->fetchAll();
  $statement->closeCursor();
  return $user_messages;
}
$user_id = $_GET['user_id'];
$userdata = get_user_by_id($user_id);
$user_messages = get_user_messages($user_id);
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
    <h3 class="h4-responsive text-center">    <?php if (isset($_SESSION['message_deleted'])) {echo '<div class="alert alert-success text-uppercase" role="alert">'. $_SESSION['message_deleted'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>'; } unset($_SESSION['message_deleted']);?>
    </h3>
        <p class="card-text"><?php if (isset($_SESSION['content'])) {echo '<div class="alert alert-info text-uppercase" role="alert"> <strong><h4>Message:</h4></strong> '. $_SESSION['content'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></div>'; } unset($_SESSION['content']);?></p>
  </div>
</div>

<div class='row'>

  <div class='col-md-12 col-sm-12'>
    <?php
    $string = '';
    $i = 0;
    if ($user_messages){
      $string .='<table class="table table-hover">';
      $string .='<thead class="mdb-color darken-3 text-white text-center">
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>DATE SENT</th>
            <th>READ</th>
            <th>DELETE</th>
        </tr>
        </thead><tbody class="text-center font-weight-bold">';
      foreach ($user_messages as $row) {
        if ($row['is_read'] == 1 || $row['is_read'] == true) {
          $new = '';
        } else {
          $new = '(new)';
        }
        $i++;
        $string .='<tr><th scope="row">';
        $string .= $i;
        $string .=". <span class='green-text font-weight-bold'> ";
        $string .= $new."</span>";
        $string .='</th>';
        $string .= "<td>".$row['name']."</td>";
        $string .= "<td>".$row['email']."</td>";
        $string .= "<td>". substr($row['date_sent'], 0, 10)."</td>";
        $string .= "<td><form method='POST' action='model/readmessage.php?message_id=";
        $string .= $row['message_id']."&user_id=".$user_id."'><button type='submit' name='read' value='read' class='btn btn-indigo my-0' style='border-radius: 70px;'>&nbsp;&nbsp;Read&nbsp;</button></form></td>";
        $string .= "<td><form method='POST' action='model/deletemessage.php?message_id=";
        $string .= $row['message_id']."&user_id=".$user_id."'><button type='submit' name='delete' value='delete' class='btn btn-indigo my-0' style='border-radius: 70px;'>Delete</button></form></td>";
        $string .= "</tr>";
      }
      $string .='</tbody></table>';
      } else{
      $string = "<div class='lead'>No messages!</div>";
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
