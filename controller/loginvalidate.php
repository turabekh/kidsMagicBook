<?php

if (isset($_SESSION['userDoesNotExist'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['userDoesNotExist']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['userDoesNotExist']);
} else if (isset($_SESSION['errorlogin'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['errorlogin']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['errorlogin']);
} else if (isset($_SESSION['pass'])) {
  echo '<div class="alert alert-success" role="alert">'. $_SESSION['pass']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['pass']);
}
?>
