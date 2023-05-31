<?php
include 'dbinstance.php';
echo '<script>alert("' . $_GET['deleteid'] . '");</script>';
if (isset($_GET['deletecourseid'])) {
    $id = $_GET['deletecourseid']; //takes the deleteid from the delete button and store it to $id variable
    $stmt = $pdo->prepare("delete from coursedetail where id=$id"); //delete statement
    if ($stmt->execute()) {
        //echo "Record deleted successfully";
        $stmt2 = $pdo->prepare("delete from modulecredits where courseid=$id"); //delete statement

        if ($stmt2->execute()) {

            echo '<script>alert("Course deleted successfully.");</script>';
            header('location:courseSelectionForm.php');
        }
    } else {
        echo '<script>alert("Course is not deleted.");</script>';

    }
}

?>