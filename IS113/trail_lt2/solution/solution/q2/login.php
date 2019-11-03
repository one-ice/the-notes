<?php

require_once 'include/common.php';

// Get username and password from FORM submission
$username = $_POST['username'];
$password = $_POST['password'];

// Use AccountDAO to check whether $username is found in Account table
$dao = new AccountDAO();
$message = 'Access Denied';
if( $dao->authenticate($username, $password) ) {
  $_SESSION['token'] = $username;
  header('Location: home.php');
}

?>

<html>
    <body>
<?php
    echo "<h1>$message</h1>";
?>
    </body>
</html>
