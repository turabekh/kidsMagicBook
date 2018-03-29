<?php
require_once("pdo.php");
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_GET['search_term'])) {
  $search_term = test_input($_GET['search_term']);
} else {
  $search_term = '';
}

$query = "SELECT books.title, books.description, books.filedestination, users.user_id, users.username, users.school_name
FROM books
INNER JOIN users ON books.user_id=users.user_id where books.title like '%$search_term%'
or books.description like '%$search_term%' or books.author like '%$search_term%'
order by books.title asc";
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll();
$string = '';
if ($results){
  $string .='<table>';
  foreach ($results as $row) {
    $string .='<tr><td>';
    $string .= "<b>".$row['title']."</b> - ";
    $string .= $row['description'];
    $string .= $row['username'];
    $string .= $row['school_name'];
    $string .= "</td></tr>";
  }
  $string .='</table>';
  } else{
  $string = "No matches!";
}

echo $string;
?>
