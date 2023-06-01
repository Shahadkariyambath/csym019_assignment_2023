<?php
include "dbinstance.php"; // Includes the dbinstance.php file to access the MySQL database

if (isset($_GET["deletecourseid"])) {
    $id = $_GET["deletecourseid"]; // Takes the 'deletecourseid' from the URL and stores it in the $id variable

    $stmt = $pdo->prepare("delete from coursedetail where id=$id"); // Prepare the SQL statement to delete a record from the 'coursedetail' table with the specified ID

    if ($stmt->execute()) {
        $stmt2 = $pdo->prepare("delete from modulecredits where courseid=$id"); // Prepare the SQL statement to delete associated module and credit records from the 'modulecredits' table

        if ($stmt2->execute()) {
            echo '<script>alert("Course deleted successfully.");</script>'; // Display a JavaScript alert to notify the user that the course was deleted successfully
            header("location:courseSelectionForm.php"); // Redirect the user to the course selection form
        }
    } else {
        echo '<script>alert("Course is not deleted.");</script>'; // Display a JavaScript alert to notify the user that the course was not deleted
    }
}
?>