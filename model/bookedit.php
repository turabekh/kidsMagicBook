<?php
session_start();
require_once("pdo.php");
if (!isset($_SESSION['data'])) {
  header('Location: index.php');
  return;
}
if (isset($_GET['book_id']) && isset($_GET['user_id'])) {
  $book_id = $_GET['book_id'];
  $book_id = htmlspecialchars($book_id);
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
      if (isset($_POST["title"])) {
        $title = test_input($_POST["title"]);
      }
      if (isset($_POST["author"])) {
        $author = test_input($_POST["author"]);
      }
      if (isset($_POST["description"])) {
        $description = test_input($_POST["description"]);
      }

      if (isset($_POST['submit'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
          if ($fileError === 0){
            if ($fileSize < 3000000) {
              $fileNameNew = uniqid('', true).".".$fileActualExt;
              $fileDestination = '../uploads/'. $fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);

            } else {
              $_SESSION['uploadErr'] = "Image must be less than 2Mb and be of type jpg/jpeg/png";
            }
          } else {
            $_SESSION['uploadErr'] = "Image must be less than 2Mb and be of type jpg/jpeg/png";
          }
        } else {
          $_SESSION['uploadErr'] = "Image must be less than 2Mb and be of type jpg/jpeg/png";
        }
      }
      if (!$_SESSION['uploadErr'] && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description'])) {
        try {
          $fileDestination = test_input($fileDestination);
          $fileDestination = substr($fileDestination,3);
          $query = "update books set title=:title, author=:author, description=:description, filedestination=:filedestination where book_id = :book_id";
          $statement = $db->prepare($query);
          $statement->bindValue(':title', $title);
          $statement->bindValue(':author', $author);
          $statement->bindValue(':description', $description);
          $statement->bindValue(':filedestination', $fileDestination);
          $statement->bindValue(':book_id', $book_id);
          $statement->execute();
          $_SESSION['book_updated'] = 'You have successfully updated your book. Thanks a lot!';
          header("Location: ../mylistings.php?user_id=".$user_id);
          return;
        } catch (PDOException $e) {
          $error_message = $e->getMessage();
          echo $error_message;
        }

      } else {
        $_SESSION['updateErr'] = 'Title, Author, Description and Photo are required fields!';
        header("Location: ../editlisting.php?user_id=".$user_id."&book_id=".$book_id);
        return;
      }
      }

 ?>
