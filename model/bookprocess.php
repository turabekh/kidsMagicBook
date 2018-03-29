<?php
session_start();
require_once("pdo.php");

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["title"])) {
        $_SESSION['titleErr'] = "Title is required";
        header('Location: ../addbook.php');
        return;
      } else if (empty($_POST["author"])) {
        $_SESSION['authorErr'] = "Author is required";
        header('Location: ../addbook.php');
        return;
      } else if (empty($_POST["description"])) {
        $_SESSION['desErr'] = "Description is required";
        header('Location: ../addbook.php');
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
      if (!isset($_SESSION['titleErr']) && !isset($_SESSION['authorErr']) && !isset($_SESSION['desErr']) && !isset($_SESSION['uploadErr'])) {
        $title = test_input($_POST['title']);
        $author = test_input($_POST['author']);
        $description = test_input($_POST['description']);
        $fileDestination = test_input($fileDestination);
        $fileDestination = substr($fileDestination,3);
        $user_id = test_input($_POST['user_id']);
        $query = "Insert into books (user_id, title, author, description, filedestination) Values (:user_id, :title, :author, :description, :filedestination)";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':author', $author);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':filedestination', $fileDestination);
        $statement->execute();
        $_SESSION['uploaded'] = 'You have successfully published your book. Thanks a lot!';
        header('Location: ../addbook.php?uploaded');
        return;
      }

    } else {
      header('Location: ../addbook.php');
      return;
    }
 ?>
