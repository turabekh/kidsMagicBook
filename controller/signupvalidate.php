<?php


if (isset($_SESSION['nameErr'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['nameErr']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['nameErr']);
} else if (isset($_SESSION['userErr'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['userErr']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['userErr']);
} else if (isset($_SESSION['emailErr'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['emailErr']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['emailErr']);
} else if (isset($_SESSION['emailExists'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['emailExists']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['emailExists']);
} else if (isset($_SESSION['passErr'])) {
  echo '<div class="alert alert-danger" role="alert">'. $_SESSION['passErr']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['passErr']);
} else if (isset($_SESSION['added'])) {
  echo '<div class="alert alert-success" role="alert">'. $_SESSION['added']. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
  unset($_SESSION['added']);
}
?>
