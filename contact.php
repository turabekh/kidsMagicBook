<?php
session_start();

include 'view/header.php';

if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $user_id = htmlspecialchars($user_id);
}


include 'view/modalforms.php';

?>

<main class="mt-5 d-flex justify-content-center" style='min-height: 100vh;'>

<div class='container mt-5'>
  <div class="row">
    <div class='col-md-2 col-sm-12'>
    </div>
    <div class='col-md-8 col-sm-12'>
        <?php if (isset($_SESSION['sent'])) {echo '<div class="alert alert-success text-uppercase" role="alert">'. $_SESSION['sent'] .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>'; } unset($_SESSION['sent']);?>
    </div>
    <div class='col-md-2 col-sm-12'>
    </div>
  </div>
    <div class='row mt-5'>
      <div class='col-md-2 col-sm-12'>
      </div>
      <div class='col-md-8 col-sm-12 border border-indigo p-5'>
        <form action='model/messageprocess.php' method='POST'>
              <h4 class="text-center font-weight-bold mb-5">Contact Me</h4>
                <div class="md-form form-sm">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" name='name' id="form19" class="form-control">
                    <?php if (isset($_SESSION['nameToUser'])) {echo '<span style="color: red;">'. $_SESSION['nameToUser'] .'</span>'; } unset($_SESSION['nameToUser']);?>
                    <label for="form19">Your name</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="email" name='email' id="form20" class="form-control">
                    <input type="hidden" name="user_id" value='<?php echo $user_id; ?>'>
                    <?php if (isset($_SESSION['emailToUser'])) {echo '<span style="color: red;">'. $_SESSION['emailToUser'] .'</span>'; } unset($_SESSION['emailToUser']);?>
                    <label for="form20">Your email</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fa fa-phone-square prefix"></i>
                    <input type="tel" name="phone" id="form21" class="form-control">
                    <label for="form21">Phone</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fa fa-pencil prefix"></i>
                    <textarea type="text" name="content" id="form8" class="md-textarea mb-0"></textarea>
                    <?php if (isset($_SESSION['content'])) {echo '<span style="color: red;">'. $_SESSION['content'] .'</span>'; } unset($_SESSION['content']);?>
                    <label for="form8">Your message</label>
                </div>

                <div class="text-center mt-1-half">
                    <button class="btn btn-indigo mb-2">Send <i class="fa fa-send ml-1"></i></button>
                </div>
              </form>
          </div>
          <div class='col-md-2 col-sm-12'>
          </div>
    </div>
</div>

</main>

<?php
include 'view/footer.php';

 ?>
