<?php
session_start();
require_once("pdo.php");

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_GET['message_id']) && isset($_GET['user_id'])) {
  $message_id = $_GET['message_id'];
  $message_id = htmlspecialchars($message_id);
  $user_id = $_GET['user_id'];
  $user_id = htmlspecialchars($user_id);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["delete"] || $_POST['delete'] === false)) {
        header('Location: ../error.php');
        return;
      }

      if ($_POST["delete"] === 'delete') {
        try {
          $query = 'delete from messages where message_id = :message_id';
          $statement = $db->prepare($query);
          $statement->bindValue(':message_id', $message_id);
          $statement->execute();
          $_SESSION['message_deleted'] = 'Message Deleted!';
          header("Location: ../messages.php?user_id=".$user_id);
          return;
        } catch(PDOException $e) {
          header('Location: ../error.php');
        }
      }

      } else {
        header("Location: ../messages.php");
        return;
    }
 ?>
