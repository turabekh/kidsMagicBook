<?php
session_start();
require_once("model/pdo.php");
if (!isset($_SESSION['data'])) {
  header('Location: index.php');
  return;
}
include 'view/header.php';
include 'view/modalforms.php';
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $user_id = htmlspecialchars($user_id);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  try {
    $query = 'select * from users where user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $result = $statement->fetch();
  } catch(PDOException $e) {
    header('Location: ../error.php');
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["submit"] || $_POST['submit'] === false)) {
        header('Location: ../error.php');
        return;
      }

      if ($_POST["submit"] === 'edit') {
        try {
          $query = 'select * from users where user_id = :user_id';
          $statement = $db->prepare($query);
          $statement->bindValue(':user_id', $user_id);
          $statement->execute();
          $result = $statement->fetch();
        } catch(PDOException $e) {
          header('Location: ../error.php');
        }
      }
    }
 ?>

<main class="mt-5" style='min-height: 100vh;'>
  <div class="container">
    <div class='row'>
      <div class='col-md-3 col-sm-12'>

      </div>

      <div class='col-md-6 col-sm-12'>
        <h3 class="h4-responsive text-center">    <?php if (isset($_SESSION['user_updated'])) {echo '<div class="alert alert-success text-uppercase" role="alert">'. $_SESSION['user_updated'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></div>'; } unset($_SESSION['user_updated']);?>
        </h3>
        <form method="post" <?php echo 'action="model/useredit.php?user_id='.$user_id.'"'; ?> class="modal-body mx-3">
          <p class="h4 text-center mb-4">Edit Profile</p>
            <div class="md-form mb-5">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" name="username" id="orangeForm-name" class="form-control validate" value='<?php if (isset($result)) {echo $result['username'];}  ?>'>
                <?php if (isset($_SESSION['fieldErr'])) {echo '<span style="color: red;">'. $_SESSION['fieldErr'] .'</span>'; } unset($_SESSION['fieldErr']);?>
                <label data-error="wrong" data-success="right" for="orangeForm-name">Your username</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-envelope prefix grey-text"></i>
                <input type="email" name="email"  class="form-control validate" value='<?php if (isset($result)) {echo $result['email'];}  ?>'>
                <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-university prefix grey-text"></i>
                <input type="text" name="school_name"  class="form-control validate" value='<?php if (isset($result)) {echo $result['school_name'];}  ?>'>
                <label data-error="wrong" data-success="right" for="orangeForm-email">Your School Name(Optional)</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-home prefix grey-text"></i>
                <input type="text" name="location"  class="form-control validate" value='<?php if (isset($result)) {echo $result['location'];}  ?>'>
                <label data-error="wrong" data-success="right" for="orangeForm-email">Location(Optional)</label>
            </div>
            <label for="description" class="deep-dark-text">About Yourself</label>
            <textarea type="text" id="description" name='bio' class="form-control" rows="5"><?php if (isset($result)) {echo $result['bio'];}  ?></textarea>


        <div class="modal-footer d-flex justify-content-center">
            <button type='submit' class="btn btn-indigo" name='submit'>Update</button>
        </div>
        </form>
        <!-- Default form register -->
      </div>

      <div class='col-md-3 col-sm-12'>

      </div>
    </div>
  </div>

</main>




<?php
include 'view/footer.php';

 ?>
