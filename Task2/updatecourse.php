<?php
include "dbinstance.php"; // this will include the dbinstance.php file to access the mysql database

if (isset($_POST["title"])) {
    //  Checks if the 'title' field is set in the $_POST array.

    // Prepares an SQL statement to update the coursedetail table with new values.
    $stmt = $pdo->prepare(
        "UPDATE coursedetail SET title=:title,location=:location,overview=:overview,highlight=:highlight,coursedetail=:coursedetail,entryrequirement=:entryrequirement,feesfunding=:feesfunding,faqs=:faqs WHERE id = :id ;"
    );
    // Creates an associative array containing the parameter values for the SQL statement.
    $criteria = [
        "title" => $_POST["title"],
        "location" => $_POST["location"],
        "overview" => $_POST["overview"],
        "highlight" => $_POST["highlight"],
        "coursedetail" => $_POST["coursedetail"],
        "entryrequirement" => $_POST["entryrequirement"],
        "feesfunding" => $_POST["feesfunding"],
        "faqs" => $_POST["faqs"],
        "id" => $_GET["updatecourseid"],
    ];

    //  Executes the prepared statement with the provided criteria and stores the execution result.
    $result = $stmt->execute($criteria);

    if ($result) {
        // Checks if the update operation was successful.
        echo '<script>alert("course is updated.");</script>'; // Displays a JavaScript alert notifying that the course has been updated.

        header("location:courseSelectionForm.php"); // Redirects the user to the courseSelectionForm.php page.
    } else {
        // Executes if the update operation was not successful.
        echo '<script>alert("course is not updated.");</script>'; // Displays a JavaScript alert indicating an incorrect username or password was entered.
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Course Report</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="layout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<script>
    //Ingredients


    $(document).ready(function () {
        var name = $(".modulecredits");
        var add_button = $(".add_modulecredits");

        var count = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            count++;
            $(name).append('<div class="row note"> <div class="col-sm-6"><input type="text" name="module[]" class="form-control" placeholder="Module"></div><div class="col-sm-4"><input type="number" name="credits[]" class="form-control" placeholder="Credits"></div><button href="#" class="delete" id="deletebtnstyle">Delete</button></div>');
        });

        $(name).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            count--;
        });
    });
</script>

<body>
    <header>
        <button class="btn btn-primary" style="float: right"><a href="logout.php" class="text-light">Logout</a></button>

        <h3>CSYM019 - UNIVERSITY COURSES</h3>
    </header>
    <nav>
        <ul>
            <li><a href="./courseSelectionForm.php">Course Report</a></li>
            <li><a href="./newCourse.php">New Course</a></li>
        </ul>
    </nav>
    <main>
        <h2>Please Enter new course details</h2>

        <!-- Form element for submitting data to the same page using the POST method -->
        <form method="POST" action="#">


            <div class="form-group">
                <!-- Creates a label element for the "Title" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Title:</label>
                <!-- Generates an input field of type "text" with the name "title" and pre-populates it with a value fetched from a database using PHP. -->
                <input type="text" name="title" value="<?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["title"];
                echo $destination;
                ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <!-- Creates a label element for the "Location" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Location:</label>
                <!-- Generates an input field of type "text" with the name "location" and pre-populates it with a value fetched from a database using PHP. -->
                <input type="text" name="location" value="<?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["location"];
                echo $destination;
                ?>" class="form-control" required>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "Course Overview" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Overview:</label>
                <!-- Generates an input field of type "text" with the name "overview" and pre-populates it with a value fetched from a database using PHP. -->
                <textarea type="text" name="overview" class="form-control" rows="8" cols="100" required><?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["overview"];
                echo $destination;
                ?></textarea>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "Course Highlight" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Highlight:</label>
                <textarea type="text" name="highlight" class="form-control" rows="8" cols="100" required> <?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["highlight"];
                echo $destination;
                ?></textarea>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "Course Details" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Details:</label>
                <!-- Generates an input field of type "text" with the name "coursedetail" and pre-populates it with a value fetched from a database using PHP. -->
                <textarea type="text" name="coursedetail" class="form-control" rows="8" cols="100" required><?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["coursedetail"];
                echo $destination;
                ?></textarea>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "Entry Requirement" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Entry Requirement:</label>
                <!-- Generates an input field of type "text" with the name "entryrequirement" and pre-populates it with a value fetched from a database using PHP. -->
                <textarea type="text" name="entryrequirement" class="form-control" rows="8" cols="100" required><?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["entryrequirement"];
                echo $destination;
                ?></textarea>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "Fees Funding" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Fees Funding:</label>
                <!-- Generates an input field of type "text" with the name "feesfunding" and pre-populates it with a value fetched from a database using PHP. -->
                <textarea type="text" name="feesfunding" class="form-control" rows="8" cols="100" required><?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["feesfunding"];
                echo $destination;
                ?></textarea>
            </div>

            <div class="form-input">
                <!-- Creates a label element for the "FAQs" input field. -->
                <label class="col-sm-2 col-form-label col-form-label-lg">FAQs:</label>
                <!-- Generates an input field of type "text" with the name "faqs" and pre-populates it with a value fetched from a database using PHP. -->
                <textarea type="text" name="faqs" class="form-control" rows="8" cols="100" required><?php
                $stmt = $pdo->prepare(
                    "SELECT *  FROM  coursedetail  WHERE id = :value "
                );

                $criteria = [
                    "value" => $_GET["updatecourseid"],
                ];
                $stmt->execute($criteria);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = json_encode($result);
                $data = json_decode($response, true); // Decodes the JSON array into an associative array
                $destination = $data[0]["faqs"];
                echo $destination;
                ?></textarea>
            </div>


            <div class="addmore note">
                <input type="submit" value="Update Course" />
            </div>
        </form>
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>