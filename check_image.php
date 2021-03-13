<?php
if ($image) {
  $target_directory = 'uploads/';
  $target_file = $target_directory . $image;
  $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
  //error message is empty
  $file_upload_error_messages = '';
  //make sure that file is a real image
  $check = getimagesize($_FILES['image']['tmp_name']);
  if ($check !== false) {
    //submit file is an image
  } else {
    $file_upload_error_messages .= '<div>Submitted file is not an image</div>';
  }
  // make sure certain file types are allowed
  $allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
  if (!in_array($file_type, $allowed_file_types)) {
    $file_upload_error_messages .= "<div>only 'jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF'</div>";
  }
  // make sure submitted file is not too large, can't be larger than 1 MB
  if ($_FILES['image']['size'] > 1024000) {
    $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
  }
  // make sure the 'uploads' folder exists
  // if not, create it
  if (!is_dir($target_directory)) {
    mkdir($target_directory, 0777, true);
  }
  // if $file_upload_error_messages is still empty
  if (empty($file_upload_error_messages)) {
    // it means there are no errors, so try to upload file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      // it means photo was uploaded
    } else {
      echo
      "<div class='alert alert-danger'>
  <div>unable to upload photo</div>
  <div>update the record to upload photo</div>
</div>";
    }
  } else {
    echo
    "<div class='alert alert-danger'>
  <div>$file_upload_error_messages</div>
  <div>update the record to upload photo</div>
</div>";
  }
} else
  echo '<div class="alert alert-danger">Unable to save record.</div>';