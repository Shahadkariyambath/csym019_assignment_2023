<!DOCTYPE html>
<html>

<head>
    <title>Course Report</title>
    <link rel="stylesheet" href="layout.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <h3>CSYM019 - UNIVERSITY COURSES</h3>
    </header>
    <nav>
        <ul>
            <li><a href="./courseSelectionForm.php">Course Report</a></li>
            <li><a href="./newCourse.php">New Course</a></li>
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
        <!-- <div class="sketch">
            <img src="./sampleCourseSelectionScreen.png" alt="Course Selection Screen">
        </div> -->
        <div class="container">

            <form action="./sampleReport.png" class="addmore" method="GET">

                <input type="submit" value="Create Course Report" />
                <!--input type="reset" value="Cancel" /-->

                <table class="table table-bordered">
                    <!-- table defenition -->
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" id="maxSelect" name="checkbox">
                            </th>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Overview</th>
                            <th scope="col">Highlight</th>
                            <th scope="col">Course Detail</th>
                            <th scope="col">Entry Requirement</th>
                            <th scope="col">Fees Funding</th>
                            <th scope="col">Course Delete & Update</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        include 'dbinstance.php';

                        //data is fetched to the table detail using foreach loop and the sql statement will be called
                        $statement = $pdo->prepare("select * from coursedetail order by title");
                        if ($statement->execute()) {
                            foreach ($statement as $row) {

                                $id = $row['id'];
                                $title = $row['title'];
                                $location = $row['location'];
                                $overview = $row['overview'];
                                $highlight = $row['highlight'];
                                $coursedetail = $row['coursedetail'];
                                $entryrequirement = $row['entryrequirement'];
                                $feesfunding = $row['feesfunding'];
                                $faqs = $row['faqs'];
                                // $kcal = "hello";
                                // $fat = $row['rd_nutrition_fat'];
                                // $saturates = $row['rd_nutrition_saturates'];
                                // $carbs = $row['rd_nutrition_carbs'];
                                // $sugar = $row['rd_nutrition_sugar'];
                                // $fibre = $row['rd_nutrition_fibre'];
                                // $protien = $row['rd_nutrition_protien'];
                                // $salt = $row['rd_nutrition_salt'];
                                echo '<tr>
    <td><input type="checkbox" id="selection" class="selection" name="selection[]"   value=' . $id . '></td>
    <th scope="row">' . $title . '</th>
    <td>' . $location . '</td>
    <td>' . $overview . '</td>
    <td>' . $highlight . '</td>
    <td>' . $coursedetail . '</td>
    <td>' . $entryrequirement . '</td>
    <td>' . $feesfunding . '</td>
    <td>
    <button class="btn btn-danger btn-primary m-2"><a href="deletecourse.php? deletecourseid=' . $id . '" class="text-light">Delete</a></button>
    <button class="btn btn-primary m-2"><a href="updatecourse.php? updatecourseid=' . $id . '" class="text-light">Update</a></button>
    </td> 
</tr>';
                            }
                        }

                        ?>

                    </tbody>
            </form>
        </div>



    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>