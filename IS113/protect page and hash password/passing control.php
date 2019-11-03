<!-- method1 form submission -->
<!-- page1 -->
<html><body>
    <form method = "post" action = "page2.php">
        Name:<input type = "text" name = "name">
    </form>
</body></html>
<!-- page2 -->
<html><body>
    <form method = "post" action = "summary.php">
        age:<input type = "text" name ="age">
        <?php
            echo "<input type='hidden' name = 'name' value = '".$_POST['name']."'/>";
        ?>
        <input type ="submit" value = "next"/>
    </form>
</body></html>
<!-- page3 -->
<?php
    echo "Name:" . $_post['name'];
    echo "<br>";
    echo "Age:".$_POST["age"];
?>



<!-- method2 hyperlink -->
<!-- page1 -->
<html><body>
    <a href="view_object.php?src=a.jpeg&width=500">
        View object
    </a>
</body></html>
<!-- page2 -->
<?php
echo "<img src = $_GET['src'] width = $_GET['width']/>";
?>




<!-- # method3 Automatic page redirection -->
<?php
header("location:../interacting_with_db/bookDAO.php")
?>
<!-- passing data -->
<?php
sesstion_start();
if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;
echo "you have accessed the page ".$_SESSION['count']."times";

$uset($_SESSION['count']);
?>

