<?php
  session_start();
  require_once("pdo.php");

  // function to sanitize user data
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['username']) && isset($_POST['pw'])) {

    // get data about user from database using Username

      $username = test_input($_POST['username']);
      $query = "Select * from users where username = :username";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->execute();
      $result = $statement->fetch();
      $statement->closeCursor();

      // check if user exists in the database and if yes validate
      if ($result === false || $result === null){
        $_SESSION['userDoesNotExist'] = "Username does not exist";
        header('Location: ../index.php');
        return;
      }


      // verification with hashed password
      if (password_verify($_POST['pw'], $result['password_hash']))
          {
            $_SESSION["username"] = $result['username'];
            $_SESSION["pass"] = "Logged in.";
            $_SESSION['data'] = $result;
            header('Location: ../index.php');
            return;
          }
          else
          {
            $_SESSION["errorlogin"] = "Incorrect password or username";
            header('Location: ../index.php');
            return;
          }

  }
} else {
  header('Location: ../index.php');
  return;
}
  ?>
