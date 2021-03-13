<?php
//include database connection
include 'config/database.php';
try {
  //error messages
  $err = '';
  //get record id
  //isset() is a PHP function used to verify if a value is there or not
  $id = isset($_GET['id']) ? $_GET['id'] : die('Record ID not found');
  //get image name
  $query = 'select image from products where id=?';
  $stmt = $con->prepare($query);
  $stmt->bindParam(1, $id);
  if (!$stmt->execute()) {
    $err .= '<div>Error at get image</div>';
  }
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $image = $row['image'];
  //delete query
  $query = 'delete from products where id=?';
  $stmt = $con->prepare($query);
  $stmt->bindParam(1, $id);
  //delete image
  if (file_exists('uploads/' . $image)) {
    unlink('uploads/' . $image);
  } else {
    $err .= '<div>Could not delete ' . $image . ', file does not exist</div>';
  }
  if (!$stmt->execute()) {
    $err .= '<div>Error at delete image</div>';
  }
  if ($err === '') {
    //redirect to read records page and 
    //tell the user record was deleted
    header('location:index.php?action=delete');
  } else {
    echo $err;
  }
} catch (PDOException $exception) {
  die("ERROR $exception->getMessage()");
}