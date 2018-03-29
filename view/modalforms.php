
<!-- // Registration Forms Starts -->

<div class="modal fade" id="signupform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="model/signup.php" class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" name="username" id="orangeForm-name" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="orangeForm-name">Your username</label>
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" name="email"  class="form-control validate">
                    <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="text" name="school_name"  class="form-control validate">
                    <label data-error="wrong" data-success="right" for="orangeForm-email">Your School Name(Optional)</label>
                </div>
                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name='pw' id="orangeForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
                </div>
                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name='pw2' value="passwrdod2" id="orangeForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="orangeForm-pass">Confirm Password</label>
                </div>


            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-indigo">Sign up</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Registration Forms Ends -->




<!-- Login form modal -->

<div class="modal fade" id="loginform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Log in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="model/login.php" class="modal-body mx-3">
              <div class="md-form mb-5">
                  <i class="fa fa-user prefix grey-text"></i>
                  <input type="text" name="username" id="orangeForm-name" class="form-control validate">
                  <label data-error="wrong" data-success="right" for="orangeForm-name">Your username</label>
              </div>

                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name = 'pw' id="defaultForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                </div>


              <div class="modal-footer d-flex justify-content-center">
                  <button class="btn btn-indigo">Login</button>
              </div>
            </form>
        </div>
    </div>
</div>

<!-- Login Modal form ends -->



<!-- Description of the Book Modal form starts  -->
<!-- Central Modal Medium Info -->
<div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header indigo darken-3 white-text">
                <p class="heading lead">How To Request a Book?</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="">
                    <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                    <p class="">
                      <ol>
                        <li>Search and find the book you like</li>
                        <li>Click on Contact me button and send a message to publisher requesting the book you have found</li>
                        <li>You can also see some information about the publisher by clicking on the username as in Posted by: username</li>

                      </ol>
                    </p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-indigo waves-effect" data-dismiss="modal">Close</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Info-->
<!-- Description ends here -->



<!-- Profile Modal Starts Here -->
<!-- Central Modal Medium Success -->
<div class="modal fade right" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-full-height modal-right" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <p class="heading lead">Profile Information</p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="card card-cascade">

      <!--Card image-->
      <div class="view overlay">
          <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="img-fluid" alt="">
          <a>
              <div class="mask rgba-white-slight"></div>
          </a>
      </div>
      <!--/.Card image-->

      <!--Card content-->
      <div class="card-body text-center">
          <!--Title-->
          <h4 class="card-title"><strong>Billy Cullen</strong></h4>
          <h5>Web developer</h5>

          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, ex, recusandae. Facere modi sunt, quod quibusdam.
          </p>

          <!--Facebook-->
          <a type="button" class="btn-floating btn-small btn-fb"><i class="fa fa-facebook"></i></a>
          <!--Twitter-->
          <a type="button" class="btn-floating btn-small btn-tw"><i class="fa fa-twitter"></i></a>
          <!--Google +-->
          <a type="button" class="btn-floating btn-small btn-dribbble"><i class="fa fa-dribbble"></i></a>

      </div>
      <!--/.Card content-->

  </div>
  <!--/.Card Regular-->
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
            <a type="button" class="btn btn-success">Get it now <i class="fa fa-diamond ml-1"></i></a>
            <a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">No, thanks</a>
        </div>
    </div>
    <!--/.Content-->
</div>
</div>
<!-- Central Modal Medium Success-->
<!-- Profile Modal ends Here -->
