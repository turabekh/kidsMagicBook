<?php
session_start();
require_once("pdo.php");
require_once('../pearsender.php');
// define variables and set to empty values



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// gravatar image url generator
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
  $url = 'https://www.gravatar.com/avatar/';
  $url .= md5( strtolower( trim( $email ) ) );
  $url .= "?s=$s&d=$d&r=$r";
  if ( $img ) {
      $url = '<img src="' . $url . '"';
      foreach ( $atts as $key => $val )
          $url .= ' ' . $key . '="' . $val . '"';
      $url .= ' />';
  }
  return $url;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $_SESSION['nameErr'] = "Username is required";
    header('Location: ../index.php');
    return;
  } else {
    $username = test_input($_POST["username"]);
    $query = "select * from users where username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    if ($user) {
      $_SESSION['userErr'] = "Username already exists.";
      header('Location: ../index.php');
      return;
    }
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z1-9 ]{4,}$/",$username)) {
      $_SESSION['nameErr'] = "Only letters, white space allowed and must be at least 4 charachters long";
      header('Location: ../index.php');
      return;
    }
  }

  if (empty($_POST["email"])) {
    $_SESSION['emailErr'] = "Email is required";
    header('Location: ../index.php');
    return;
  } else {
    $email = test_input($_POST["email"]);
    $query = "select * from users where email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $e = $statement->fetch();
    if ($e) {
      $_SESSION['emailExists'] = "Email already exists.";
      header('Location: index.php');
      return;
    }
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['emailErr'] = "Invalid email format";
      header('Location: ../index.php');
      return;
    }
  }

  if (empty($_POST["pw"]) || empty($_POST["pw2"]) ) {
    $_SESSION['passErr'] = "Password is required";
    header('Location: ../index.php');
    return;
  } else {
    $pw = test_input($_POST["pw"]);
    $pw2 = test_input($_POST["pw2"]);
    // check if e-mail address is well-formed
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $pw)) {
        $_SESSION['passErr'] = "the password must be at least 6 characters long and may contain letters, numbers, and at least 1 special character";
        header('Location: ../index.php');
        return;
    } else if ($pw !== $pw2) {
       $passErr = 'passwords must match!';
       $_SESSION['passErr'] = "passwords must match!";
       header('Location: ../index.php');
       return;
    }
  }

  if (!isset($_SESSION['nameErr']) && !isset($_SESSION['emailErr']) && !isset($_SESSION['passErr']) && !isset($_SESSION['userErr']) && !isset($_SESSION['emailExists'])) {
      //save in the database
      //password hashed
      if (isset($_POST['school_name'])) {
        if (!empty($_POST['school_name'])) {
          $school_name = test_input($_POST['school_name']);
        } else if (empty($_POST['school_name'])) {
            $school_name = 'Not Provided';
      }
    }
      $pw = password_hash($pw, PASSWORD_BCRYPT);
      $usergravatar = get_gravatar($email);
      $query = "Insert into users (username, email, school_name, password_hash, avatar_hash) Values (:username, :email, :school_name, :password_hash, :avatar_hash)";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':email', $email);
      $statement->bindValue(':school_name', $school_name);
      $statement->bindValue(':password_hash', $pw);
      $statement->bindValue(':avatar_hash', $usergravatar);
      $statement->execute();
      $_SESSION['added'] = 'You have successfully signed up. Please Login Thanks a lot!';

      try {
        $to = $username." <". $email.">";
        $from = 'Turaboy Holmirzaev <turabekh@gmail.com>';
        $subject = 'Thanks. KidsNewBook';
        $body = '<p>Thanks for signing up '. $username .'!.</p>';
        $is_body_html = true;
        send_email($to, $from, $subject, $body, $is_body_html);
      } catch(Exception $e) {
        $error = $e->getMessage();
        header('Location: ../index.php');
        return;
      }

      header('Location: ../index.php');
      return;
  }


}
?>
