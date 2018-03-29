<?php
session_start();
require_once("pdo.php");

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_GET['book_id']) && isset($_GET['user_id'])) {
  $book_id = $_GET['book_id'];
  $book_id = htmlspecialchars($book_id);
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
          $query = 'delete from books where book_id = :book_id';
          $statement = $db->prepare($query);
          $statement->bindValue(':book_id', $book_id);
          $statement->execute();
          $_SESSION['book_deleted'] = 'The Book has been deleted!';
          header("Location: ../mylistings.php?user_id=".$user_id);
          return;
        } catch(PDOException $e) {
          header('Location: ../error.php');
        }
      }

      } else {
        header("Location: ../mylistings.php");
        return;
    }
 ?>
