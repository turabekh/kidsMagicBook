<?php
session_start();
require_once("pdo.php");
require_once('../pearsender.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["name"])) {
        $_SESSION['nameToUser'] = "Name is required";
        header('Location: ../contact.php');
        return;
      } else if (empty($_POST["email"])) {
        $_SESSION['emailToUser'] = "Email is required";
        header('Location: ../contact.php');
        return;
      } else if (empty($_POST["content"])) {
        $_SESSION['content'] = "Message is required";
        header('Location: ../contact.php');
      }




      if (!isset($_SESSION['nameToUser']) && !isset($_SESSION['emailToUser']) && !isset($_SESSION['content'])) {
        try {
          $name = test_input($_POST['name']);
          $email = test_input($_POST['email']);
          $phone = test_input($_POST['phone']);
          $content = test_input($_POST['content']);
          $user_id = test_input($_POST['user_id']);
          $query = "Insert into messages (user_id, name, email, phone, content) Values (:user_id, :name, :email, :phone, :content)";
          $statement = $db->prepare($query);
          $statement->bindValue(':user_id', $user_id);
          $statement->bindValue(':name', $name);
          $statement->bindValue(':email', $email);
          $statement->bindValue(':phone', $phone);
          $statement->bindValue(':content', $content);
          $statement->execute();
          $_SESSION['sent'] = 'Thank You! Your message has been sent successfully. The reciever will be notified shortly.';

          try {
            $query = "select email, username from users where user_id=:user_id";
            $statement = $db->prepare($query);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
            $result = $statement->fetch();
            $email = $result['email'];
            $username = $result['username'];
            $to = $username." <". $email.">";
            $from = 'Turaboy Holmirzaev <turabekh@gmail.com>';
            $subject = 'New Book Request From: KidsBestBooks';
            $body = '<p>You have a new message from '. $name .'</p>';
            $is_body_html = true;
            send_email($to, $from, $subject, $body, $is_body_html);
          } catch(Exception $e) {
            $error = $e->getMessage();
            header('Location: ../contact.php');
            return;
          }
          header('Location: ../contact.php');
          return;
        } catch(PDOException $e) {
          header('Location: ../error.php');
        }

      }

    } else {
      header('Location: ../contact.php');
      return;
    }
 ?>
