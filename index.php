<?php
session_start();
include 'view/header.php';
include 'view/modalforms.php';
require_once("model/pdo.php");
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_GET['search_term'])) {
  $search_term = test_input($_GET['search_term']);
} else {
  $search_term = '';
}

$query = "SELECT books.title, books.description, books.filedestination, books.date_created, users.user_id, users.username, users.school_name
FROM books
INNER JOIN users ON books.user_id=users.user_id where books.title like '%$search_term%'
or books.description like '%$search_term%' or books.author like '%$search_term%'
order by books.date_created desc limit 6";
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll();
?>


<main class="mt-5" style='min-height: 100vh;'>


<!-- Main container starts -->
  <div class="container">
    <!-- First Row -->
    <div class='row'>
      <!-- Grid Column -->
      <div class="col-md-7 mb-4">
        <div class="view overlay hm-white-light z-depth-1-half">
          <img src="view/static/img/main.jpeg" style="min-width: 100%;min-height: 100%;" class="img-fluid" alt="library">
          <div class="mask"></div>
        </div>
      </div>
      <!-- Grid Column Ends -->

<!-- Grid Column -->
    <div class="col-md-5 mb-4">
      <h2> Kids Awesome Book Sharing</h2>
      <hr>
      <div class="border border-indigo p-2 pl-5 mb-4">
        <form method='get' class="form-inline">
            <input class="form-control mr-sm-2" type="text" name = 'search_term' placeholder="Search Books" aria-label="Search" onkeyup="showResult(this.value)">
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
<div id="livesearch" class="row">
  <!-- Grid Column -->

</div>
    <div id = 'firstresult' class="row">
      <!-- Grid Column -->
      <?php
      if ($results){

        foreach ($results as $result) {
         include 'view/_card.php';
        }
      } else {
        echo '<div class="col">
        <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Sorry No matching results!</h4>
              <p>You can try searching with author\'s name or with title or keywords about the book. Thanks<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button</p>
              <hr>
              </div>
              </div>';
      }


      ?>
    </div>

<div class='row'>
  <div class='col-md-12 d-flex justify-content-center'>
    <!--Pagination purple-->
    <nav>
        <ul class="pagination pg-indigo">
            <!--Arrow left-->
            <li class="page-item">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            <!--Numbers-->
            <li class="page-item active"><a href='#'class="page-link">1</a></li>
            <li class="page-item"><a href='#' class="page-link">2</a></li>
            <li class="page-item"><a href='#'class="page-link">3</a></li>
            <li class="page-item"><a href='#'class="page-link">4</a></li>
            <li class="page-item"><a href='#' class="page-link">5</a></li>

            <!--Arrow right-->
            <li class="page-item">
                <a class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
  </div>
</div>
  </div>
<!-- Main Container Ends -->

</main>

<?php
include 'view/footer.php';

 ?>
