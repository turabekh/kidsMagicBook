<?php
session_start();
require_once("pdo.php");
if (!isset($_SESSION['data'])) {
  header('Location: index.php');
  return;
}
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $user_id = htmlspecialchars($user_id);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST["username"])) {
        $username = test_input($_POST["username"]);
      }

      if (isset($_POST["email"])) {
        $email = test_input($_POST["email"]);
      }
      if (isset($_POST["school_name"])) {
        $school_name = test_input($_POST["school_name"]);
      } else {
        $school_name = '';
      }
      if (isset($_POST["location"])) {
        $location = test_input($_POST["location"]);
      } else {
        $location = '';
      }
      if (isset($_POST["bio"])) {
        $bio = test_input($_POST["bio"]);
      } else {
        $bio = '';
      }


      if (isset($_POST['username']) && isset($_POST['email']) && !empty($username) && !empty($email)) {
        try {
          $query = "update users set username=:username, email=:email, school_name=:school_name, location =:location, bio = :bio where user_id = :user_id";
          $statement = $db->prepare($query);
          $statement->bindValue(':user_id', $user_id);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':email', $email);
          $statement->bindValue(':school_name', $school_name);
          $statement->bindValue(':location', $location);
          $statement->bindValue(':bio', $bio);
          $statement->execute();
          $_SESSION['user_updated'] = 'You have successfully updated your Profile. Thanks a lot!';
          header("Location: ../editprofile.php?user_id=".$user_id);
          return;
        } catch (PDOException $e) {
          $error_message = $e->getMessage();
          echo $error_message;
        }

      } else {

        $_SESSION['fieldErr'] = 'Username and Email are required Fields!';
        header("Location: ../editprofile.php?user_id=".$user_id);
        return;
      }
      }

 ?>
