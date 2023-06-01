<!DOCTYPE html> <!-- html tag started -->
<html>

<head>
    <title>Course Report</title>
    <link rel="stylesheet" href="layout.css">
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>

        <!-- Logout button with primary styling aligned to the right -->
        <button class="btn btn-primary" style="float: right"><a href="logout.php" class="text-light">Logout</a></button>

        <h3>CSYM019 - UNIVERSITY COURSES</h3>
    </header>
    <nav>
        <ul>
            <li><a href="./courseSelectionForm.php">Course Report</a></li>
            <!-- List item with a link to "Course Report" -->
            <li><a href="./newCourse.php">New Course</a></li> <!-- List item with a link to "New Course" -->
        </ul>
    </nav>
    <script type="text/javascript">
        //this script is to acheive the select all checkbox option. It check for the id for the check box on the table header and if the property of that check box is checked it changes rest of the checbox status by referring the id selection which is defined as an array to checked as well.
        $(document).ready(function () {
            $("#maxSelect").click(function () { //identifying the checkbox in table header
                $(".selection").prop('checked', $(this).prop('checked')); //identifying checkbox in table details with the id 'selection'
            });
        });
    </script>

    <main>

        <h3>Selection Form</h3>

        <div class="container">

            <!-- Form element for submitting data to "./sampleCourseReport.php" using the GET method -->
            <form action="./sampleCourseReport.php" class="addmore" method="GET">

                <input type="submit" value="Create Course Report" />

                <!-- start of the table tag., table tag is to create a table in the html page given class name as table and also gives a table bordered-->
                <table class="table table-bordered">
                    <!-- table defenition -->
                    <!-- thead tag is used to group header content in an HTML table.-->
                    <thead>
                        <!--tr tag defines a row in an HTML table and here defines the heading of the table-->
                        <tr>
                            <!-- Table header cell -->
                            <th scope="col"><input type="checkbox" id="maxSelect" name="checkbox"></th>
                            <!-- Table header with a checkbox column -->
                            <th scope="col">Title</th> <!-- Table header for "Title" -->
                            <th scope="col">Location</th> <!-- Table header for "Location" -->
                            <th scope="col">Overview</th> <!-- Table header for "Overview" -->
                            <th scope="col">Highlight</th> <!-- Table header for "Highlight" -->
                            <th scope="col">Course Detail</th> <!-- Table header for "Course Detail" -->
                            <th scope="col">Entry Requirement</th> <!-- Table header for "Entry Requirement" -->
                            <th scope="col">Fees Funding</th> <!-- Table header for "Fees Funding" -->
                            <th scope="col">Course Delete & Update</th>
                            <!-- Table header for "Course Delete & Update" -->

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include "dbinstance.php"; // this will include the dbinstance.php file to access the mysql database
                        
                        //data is fetched to the table detail using foreach loop and the sql statement will be called
                        $stmt = $pdo->prepare(
                            "select * from coursedetail order by title"
                        ); // sql statement
                        if ($stmt->execute()) {
                            foreach ($stmt as $row) {
                                //for each row returned from database, each value will be assigned to a variable and the value will be echoed into database table.
                                $id = $row["id"];
                                $title = $row["title"];
                                $location = $row["location"];
                                $overview = $row["overview"];
                                $highlight = $row["highlight"];
                                $coursedetail = $row["coursedetail"];
                                $entryrequirement = $row["entryrequirement"];
                                $feesfunding = $row["feesfunding"];
                                $faqs = $row["faqs"];
                                // Generate table row for each course, and their update and delete button.
                                echo '<tr>
    <td><input type="checkbox" id="selection" class="selection" name="selection[]"   value=' .
                                    $id .
                                    '></td>
    <th scope="row">' .
                                    $title .
                                    '</th>
    <td>' .
                                    $location .
                                    '</td>
    <td>' .
                                    $overview .
                                    '</td>
    <td>' .
                                    $highlight .
                                    '</td>
    <td>' .
                                    $coursedetail .
                                    '</td>
    <td>' .
                                    $entryrequirement .
                                    '</td>
    <td>' .
                                    $feesfunding .
                                    '</td>
    <td>
    <button class="btn btn-danger btn-primary m-2"><a href="deletecourse.php? deletecourseid=' .
                                    $id .
                                    '" class="text-light">Delete</a></button>
    <button class="btn btn-primary m-2"><a href="updatecourse.php? updatecourseid=' .
                                    $id .
                                    '" class="text-light">Update</a></button>
    </td> 
</tr>';
                            }
                        }
                        ?>

                    </tbody>
            </form>
        </div>



    </main>
    <!-- Display the copyright information -->
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>