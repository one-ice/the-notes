<?php
    spl_autoload_register(function ($class){
        require_once $class . ".php";
    });
?>

<html>
    <head>
        <title>Student List</title>
        <link rel="stylesheet" type="text/css" href="student-list.css"/>
        <style>
            table{
                border: 1px solid black;
                border-collapse: collapse;
            }
            td,th {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="centralbox">
            <h2> Student List </h2>

           <!-- Add Code here to display the list of all Student  -->
           <table border = 1>
            <tr><th>ID</th>
            <th>Name</th>
            <th>School</th></tr>
<?php
$dao = new StudentDAO();
$all = $dao->getAll();
foreach($all as $stu){
    $id = $stu->getID();
    $name = $stu->getName();
    $school = $stu->getSchool();
    echo "<tr>
    <td>$id</td>
    <td>$name</td>
    <td>$school</td>
    </tr>";
}
?>
           </table>
            <br/>
            <a href="search.php">Search</a>
            <br/>
            <br/>
        </div>
    </body>
</html>