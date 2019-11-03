<?php

/*
    Name:

    Email:
*/

require_once 'include/common.php';

// an array of error messages (if any)
$errors = [];

// Get username and password from FORM submission
$username = $_POST['username'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
// Add Code here
if(empty($username)){
  $errors[] = "Username field is empty";
}elseif(empty($current_password)){
  $errors[] = "Current password field is empty";
}elseif(empty($new_password[0])){
  $errors[] = "New password field is empty";
}elseif(empty($new_password[1])){
  $errors[] = "Current password field is empty";
}

$_SESSION['my-errors'] = $errors;
if($errors){
  header("Location:reset-view.php");
}

$dao = new AccountDAO();
$status=$dao->authenticate($username, $current_password);
if(! $status){
  $_SESSION['my-errors'] = ["Wrong username/password"];
  header("Location:reset-view.php");
}

if($new_password[0] != $new_password[1]){
  $_SESSION['my-errors'] = ["Your new password do not match"];
  header("Location:reset-view.php");
}

$dao->reset_password($username,$new_password[0])

?>
<html>
<head>
  <title>Reset</title>
</head>
<body>
Success!
</body>
</html>
