<?php
session_start();
require_once("model/pdo.php");
if (!isset($_SESSION['data'])) {
  header('Location: index.php');
  return;
}
include 'view/header.php';
include 'view/modalforms.php';
if (isset($_GET['book_id']) && isset($_GET['user_id'])) {
  $book_id = $_GET['book_id'];
  $book_id = htmlspecialchars($book_id);
  $user_id = $_GET['user_id'];
  $user_id = htmlspecialchars($user_id);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  try {
    $query = 'select * from books where book_id = :book_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':book_id', $book_id);
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
          $query = 'select * from books where book_id = :book_id';
          $statement = $db->prepare($query);
          $statement->bindValue(':book_id', $book_id);
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
        <form <?php echo 'action="model/bookedit.php?user_id='.$user_id.'&book_id='.$book_id.'"'; ?> method="post" enctype="multipart/form-data">
            <p class="h4 text-center mb-4">Edit Book</p>
                  <!-- Default input name -->
            <label for="title" class="deep-dark-text">Title</label>
            <input type="text" name = 'title' id="title" class="form-control" value='<?php if (isset($result)) {echo $result['title'];}  ?>'>
            <?php if (isset($_SESSION['updateErr'])) {echo '<span style="color: red;">'. $_SESSION['updateErr'] .'</span>'; } unset($_SESSION['updateErr']);?>
            <br>

            <!-- Default input email -->
            <label for="author" class="deep-dark-text">Author</label>
            <input type="text" name="author" value='<?php if (isset($result)) {echo $result['author'];} ?>'id="author" class="form-control">
            <br>

            <!-- Default input email -->
            <label for="description" class="deep-dark-text">Description</label>
            <textarea type="text" id="description" name='description' class="form-control" rows="5"><?php if (isset($result)) {echo $result['description'];} ?></textarea>
            <br>
            <label class="grey-text" for="inputGroupFile01">Upload Book Image</label>
            <input type="file" name = 'file' class="form-control" id="inputGroupFile01">
            <?php if (isset($_SESSION['uploadErr'])) {echo '<span style="color: red;">'. $_SESSION['uploadErr'] .'</span>'; } unset($_SESSION['uploadErr']);?>
            <!-- Default input password -->
            <br>

            <div class="text-center mt-4">
                <button class="btn btn-indigo" type="submit" name='submit'>Update Listing</button>
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
