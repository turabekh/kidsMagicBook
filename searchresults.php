<?php
session_start();
include 'view/header.php';

include 'model/search.php';
include 'view/modalforms.php';
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
        <form action ='model/search.php' method='get' class="form-inline">
            <input class="form-control mr-sm-2" type="text" name = 'search_term' placeholder="Search Books" aria-label="Search">
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

    <div class="row">
      <!-- Grid Column -->
      <?php
      foreach ($results as $result) {
       include 'view/_card.php';
      }
      ?>
    </div>

  </div>
<!-- Main Container Ends -->

</main>

<?php
include 'view/footer.php';

 ?>
