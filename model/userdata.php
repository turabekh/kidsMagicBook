<?php
  require_once("pdo.php");
  function get_user_by_id($user_id) {

    $query = "Select * from users where user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $userdata = $statement->fetch();
    $statement->closeCursor();
}

  ?>
