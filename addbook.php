<?php
session_start();
if (!isset($_SESSION['data'])) {
  header('Location: index.php');
  return;
}
include 'view/header.php';
include 'view/modalforms.php';
?>

<main class="mt-5" style='min-height: 100vh;'>
  <div class="container">
    <div class='row'>
      <div class='col-md-3 col-sm-12'>

      </div>

      <div class='col-md-6 col-sm-12'>
        <form action="model/bookprocess.php" method="post" enctype="multipart/form-data">
            <p class="h4 text-center mb-4">Add Book</p>
            <?php if (isset($_SESSION['uploaded'])) {echo '<p class="text-uppercase" style="color: green;">'. $_SESSION['uploaded'] .'</p>'; } unset($_SESSION['uploaded']);?>
            <!-- Default input name -->
            <label for="title" class="deep-dark-text">Title</label>
            <input type="hidden" name="user_id" value="<?=$_SESSION['data']['user_id'];?>">
            <input type="text" name = 'title' id="title" class="form-control">
            <?php if (isset($_SESSION['titleErr'])) {echo '<span style="color: red;">'. $_SESSION['titleErr'] .'</span>'; } unset($_SESSION['titleErr']);?>

            <br>

            <!-- Default input email -->
            <label for="author" class="deep-dark-text">Author</label>
            <input type="text" name="author" id="author" class="form-control">
            <?php if (isset($_SESSION['authorErr'])) {echo '<span style="color: red;">'. $_SESSION['authorErr'] .'</span>'; } unset($_SESSION['authorErr']);?>

            <br>

            <!-- Default input email -->
            <label for="description" class="deep-dark-text">Description</label>
            <textarea type="text" id="description" name='description' class="form-control" rows="5"></textarea>
            <?php if (isset($_SESSION['desErr'])) {echo '<span style="color: red;">'. $_SESSION['desErr'] .'</span>'; } unset($_SESSION['desErr']);?>

            <br>
            <label class="grey-text" for="inputGroupFile01">Upload Book Image</label>
            <input type="file" name = 'file' class="form-control" id="inputGroupFile01">
            <?php if (isset($_SESSION['uploadErr'])) {echo '<span style="color: red;">'. $_SESSION['uploadErr'] .'</span>'; } unset($_SESSION['uploadErr']);?>
            <!-- Default input password -->
            <br>

            <div class="text-center mt-4">
                <button class="btn btn-indigo" type="submit" name='submit'>Publish</button>
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
