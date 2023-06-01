<?php
include "dbinstance.php"; // this will include the dbinstance.php file to access the mysql database

if (isset($_POST["title"])) {
    // Prepare the SQL statement to insert course details into the database
    $stmt = $pdo->prepare(
        "INSERT INTO coursedetail(title, location, overview, highlight, coursedetail, entryrequirement, feesfunding, faqs) VALUES (:title,:location,:overview, :highlight, :coursedetail, :entryrequirement, :feesfunding, :faqs);"
    );

    // Define the criteria for the prepared statement
    $criteria = [
        "title" => $_POST["title"],
        "location" => $_POST["location"],
        "overview" => $_POST["overview"],
        "highlight" => $_POST["highlight"],
        "coursedetail" => $_POST["coursedetail"],
        "entryrequirement" => $_POST["entryrequirement"],
        "feesfunding" => $_POST["feesfunding"],
        "faqs" => $_POST["faqs"],
    ];

    // Execute the prepared statement with the provided criteria
    $result = $stmt->execute($criteria);

    if ($result) {
        // Get the last inserted course ID
        $courseid = $pdo->lastInsertId();

        // Retrieve the module and credit values from the form
        $modules = $_POST["module"];
        $credits = $_POST["credits"];

        // Iterate over the modules and credits arrays
        for ($i = 0; $i < count($modules); $i++) {
            $moduleValue = $modules[$i];
            $creditValue = $credits[$i];

            // Prepare the SQL statement to insert module and credit details into the database
            $stmt2 = $pdo->prepare(
                "INSERT INTO modulecredits( courseid, module, credit) VALUES (:courseid,:module,:credits);"
            );

            // Define the criteria for the prepared statement
            $criteria2 = [
                "courseid" => $courseid,
                "module" => $moduleValue,
                "credits" => $creditValue,
            ];

            // Execute the prepared statement with the provided criteria
            $result2 = $stmt2->execute($criteria2);
        }

        // Display a success message
        echo '<script>alert("New course added.");</script>';

        // Redirect the user to the course selection form
        header("location:courseSelectionForm.php");
    } else {
        // Display an error message
        echo '<script>alert("You have entered an incorrect username or password.");</script>';
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
    // Document ready event handler
    $(document).ready(function () {
        var name = $(".modulecredits"); // Get the element with class "modulecredits"
        var add_button = $(".add_modulecredits"); // Get the element with class "add_modulecredits"

        var count = 1; // Initialize count to 1

        // Click event for adding module and credit inputs
        $(add_button).click(function (e) {
            e.preventDefault();
            count++;
            // Append the HTML code for module and credit inputs along with the delete button
            $(name).append('<div class="row note"> <div class="col-sm-6"><input type="text" name="module[]" class="form-control" placeholder="Module"></div><div class="col-sm-4"><input type="number" name="credits[]" class="form-control" placeholder="Credits"></div><button href="#" class="delete" id="deletebtnstyle">Delete</button></div>');
        });

        // Click event for deleting module and credit inputs
        $(name).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); // Remove the parent div of the delete button
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
            <!-- List item with a link to "Course Report" -->
            <li><a href="./courseSelectionForm.php">Course Report</a></li>
            <!-- List item with a link to "New Course" -->
            <li><a href="./newCourse.php">New Course</a></li>
        </ul>
    </nav>
    <main>
        <!-- Main content section -->
        <h2>Please Enter new course details</h2>
        <!-- Heading for the form -->

        <form method="POST" action="#">
            <!-- Form for entering new course details -->

            <div class="form-group">
                <!-- Form group for the "Title" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Title:</label>
                <!-- Label for the "Title" field -->
                <input type="text" name="title" placeholder="Enter course title" class="form-control" required>
                <!-- Input field for entering the course title -->
            </div>

            <div class="form-group">
                <!-- Form group for the "Location" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Location:</label>
                <!-- Label for the "Location" field -->
                <input type="text" name="location" placeholder="Enter the location" class="form-control" required>
                <!-- Input field for entering the location -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "Course Overview" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Overview:</label>
                <!-- Label for the "Course Overview" field -->
                <textarea type="text" name="overview" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the course overview"></textarea>
                <!-- Textarea for entering the course overview -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "Course Highlight" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Highlight:</label>
                <!-- Label for the "Course Highlight" field -->
                <textarea type="text" name="highlight" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the Highlight"></textarea>
                <!-- Textarea for entering the course highlight -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "Course Details" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Details:</label>
                <!-- Label for the "Course Details" field -->
                <textarea type="text" name="coursedetail" class="form-control" rows="8" cols="100" required
                    placeholder="Enter course detail"></textarea>
                <!-- Textarea for entering the course details -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "Entry Requirement" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Entry Requirement:</label>
                <!-- Label for the "Entry Requirement" field -->
                <textarea type="text" name="entryrequirement" class="form-control" rows="8" cols="100" required
                    placeholder="Enter Entry requirement"></textarea>
                <!-- Textarea for entering the entry requirement -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "Fees Funding" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">Fees Funding:</label>
                <!-- Label for the "Fees Funding" field -->
                <textarea type="text" name="feesfunding" class="form-control" rows="8" cols="100" required
                    placeholder="Enter Fees funding"></textarea>
                <!-- Textarea for entering the fees funding -->
            </div>

            <div class="form-input">
                <!-- Form input section for the "FAQs" field -->
                <label class="col-sm-2 col-form-label col-form-label-lg">FAQs:</label>
                <!-- Label for the "FAQs" field -->
                <textarea type="text" name="faqs" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the FAQs"></textarea>
                <!-- Textarea for entering the FAQs -->
            </div>

            <div class="form-group">
                <!-- Form group for the "Module & Credits" section -->
                <h2 class="col-sm-2 col-form-label col-form-label-lg">Module & Credits</h2>
                <!-- Heading for the "Module & Credits" section -->
                <div class="modulecredits">
                    <!-- Container for module and credits input -->
                    <button class="add_modulecredits">Add Module & Credits +</button>
                    <!-- Button for adding more module and credits input fields -->

                    <div class="row note">
                        <!-- Row for module and credits input fields -->
                        <div class="col-sm-6">
                            <!-- Column for the module input field -->
                            <input type="text" name="module[]" class="form-control" placeholder="Module">
                            <!-- Input field for entering the module -->
                        </div>
                        <div class="col-sm-4">
                            <!-- Column for the credits input field -->
                            <input type="number" name="credits[]" class="form-control" placeholder="Credits">
                            <!-- Input field for entering the credits -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="addmore note">
                <input type="submit" value="Add Course" />
                <!-- Submit button for adding the course details -->
            </div>
        </form>
    </main>

    <!-- Display the copyright information -->
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>