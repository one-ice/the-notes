<?php
/*
    Name:

    Email:
*/
if(!isset($_SESSION['token'])){
    header("Location:login-view.html");
}
?>

<html>
    <body>
        <h1>highly sensitive data. Must be protected</h1>
    </body>
</html>
