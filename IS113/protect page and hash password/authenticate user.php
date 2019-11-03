<!-- password hasing -->
<!-- register.php  -->
<html><body>
    <h1>Registrater<h1>
    <form method = "post" action = "process_register.php">
        Username <input type="text" name = "username"/><br/>
        Password <input type = "password" name = "password"/><br>
        <input type = "submit" value = "register"/>
    </form>
</body></html>
<!-- process-register.php -->
<?php
require_once "UserDAO.php";
$username = $_POST['username'];
$pwd = $_POST['password'];
$hashed = password_hash($password,PASSWORD_DEFAULT);

$user = new User($username,$password);
$dao = new UserDAO();
$status = $dao->add($user);
if($status){
    echo "Registered successfully";
}else{
    echo "Failed to register";
}
?>

<!-- login -->
<html><body>
    <h1>Login<h1>
    <form method="post" action = "process_login.php">
        Username <input type = "text" name = "username">
        Password <input type = "password" name = "password">
        <input type = "submit" value = "Login">
    </form>
</body></form>
<!-- process-login -->
<?php 
require_once "UserDAO.php";
$username = $_POST['username'];
$password = $_POST['password'];
$dao = new UserDAO();
$hased = $dao->getHashedPassword($username);
$status = password_verify($password,$hashed);
if($status){
    echo "Successful Login";
}else{
    echo "Failed Login";
}
?>


<!-- protect page -->
<!-- process-login -->
<?php
require_once "UserDAO.php";
$username = $_POST['username'];
$password = $_POST['password'];
$dao = new UserDAO();
$hashed = $dao->getHashedPassword($username);
$status = password_verify($password,$hased)
if($status){
    sessstion_start();
    echo "Successful Login";
}else{
    echo "Failed Login";
}
?>
<!-- protect.php -->
<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location:Login.php");
    exit;
}
?>