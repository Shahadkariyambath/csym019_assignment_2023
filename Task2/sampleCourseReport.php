<?php
include "dbinstance.php";
// this will include the dbinstance.php file to access the mysql database
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course Report</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="layout.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<script>
    function randomcolor() {
        // Function to generate a random color
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += Math.floor(Math.random() * 16).toString(16);
        }
        return color;
    }

    function createBarChart(barData) {
        // Function to create a bar chart
        var ctx = document.getElementById("myChart").getContext("2d");

        var data = {
            // Chart data containing labels and datasets
            labels: ["Module-1", "Module-2", "Module-3", "Module-4", "Module-5", "Module-6", "Module-7", "Module-8"],
            datasets: barData
        };

        var myBarChart = new Chart(ctx, {
            // Creating a new bar chart instance
            type: 'bar', // Specify chart type as bar
            data: data, // Set the chart data
            options: {
                // Chart options
                barValueSpacing: 20, // Spacing between bars
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0, // Set minimum value on the y-axis
                        }
                    }]
                }
            }
        });
    }

    function createPieChart(id, modules, credit) {
        // Function to create a pie chart
        let idname = document.getElementById(id);

        let modulesCount = modules.length;
        var backgroundColors = [];
        var borderColors = [];

        for (var i = 0; i < modulesCount; i++) {
            backgroundColors[i] = randomcolor(); // Generate random background colors for each pie slice
        }

        for (var i = 0; i < modulesCount; i++) {
            borderColors[i] = randomcolor(); // Generate random border colors for each pie slice
        }

        let chart = new Chart(idname, {
            // Creating a new pie chart instance
            type: "pie", // Specify chart type as pie
            data: {
                // Chart data containing labels and datasets
                labels: modules, // Set the labels for each pie slice
                datasets: [{
                    backgroundColor: backgroundColors, // Set the background colors
                    data: credit, // Set the data values for each pie slice
                    borderWidth: 1,
                    borderColor: borderColors // Set the border colors
                }]
            },
            options: {
                // Chart options
                title: {
                    display: true,
                    text: "Pie-Chart" // Set the chart title
                }
            }
        });
    }
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
        <h3 class="text-center"><b>Course Report</b></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- Table header cell -->
                    <th scope="col">Title</th> <!-- Table header for "Title" -->
                    <th scope="col">Location</th> <!-- Table header for "Location" -->
                    <th scope="col">Course Overview</th> <!-- Table header for "Course Overview" -->
                    <th scope="col">Course Details</th> <!-- Table header for "Course Details" -->
                    <th scope="col">Chart</th> <!-- Table header for "Chart" -->
                </tr>
            </thead>
            <tbody>

                <?php
                function getRandomColor()
                {
                    // Function to generate a random color
                    $color = "#";
                    for ($i = 0; $i < 6; $i++) {
                        $color .= dechex(mt_rand(0, 15));
                    }
                    return $color;
                }

                $count = count($_GET["selection"]); //identifying the count of the selected checkbox
                
                $Ids = $_GET["selection"]; // it will store the course id's
                
                //data is fetched to the table detail using foreach loop and the sql statement will be called
                $stmt = $pdo->prepare(
                    "select * from coursedetail where id in(" .
                    implode(",", $Ids) .
                    ") order by title"
                );

                $barData = []; // it will store the bar chart data
                
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

                        //data is fetched to the table detail using foreach loop and the sql statement will be called
                        $stmt2 = $pdo->prepare(
                            "select * from modulecredits where courseid = $id "
                        );

                        $moduledata = []; // it will store the module details
                        $creditdata = []; // it will store the credit score details
                        $i = 0;
                        if ($stmt2->execute()) {
                            foreach ($stmt2 as $row2) {
                                //for each row returned from database, each value will be assigned to a variable and the value will be echoed into database table.
                                $moduledata[$i] = $row2["module"];
                                $creditdata[$i] = $row2["credit"];
                                $i++;
                            }
                        }

                        $moduledataString = implode(",", $moduledata); // Combines the elements of $moduledata array into a string, separated by commas
                
                        $moduledataArray = explode(",", $moduledataString); // Converts the $moduledataString into an array by splitting it at each comma
                        $new = array_map(function ($element) {
                            // Applies the anonymous function to each element of $moduledataArray
                            return "'" . trim($element) . "'"; // Trims each element and adds single quotes around it
                        }, $moduledataArray);

                        $moduledataString = implode(",", $new); // Combines the elements of $new array into a string, separated by commas
                
                        $creditdataString = implode(",", $creditdata); // Combines the elements of $creditdata array into a string, separated by commas
                
                        $creditdataArray = explode(",", $creditdataString); // Converts the $creditdataString into an array by splitting it at each comma
                
                        $chart =
                            '<canvas id="chart' .
                            $row["id"] .
                            '" width="400" height="400"></canvas>
                        <script>createPieChart("chart' .
                            $row["id"] .
                            '",[' .
                            $moduledataString .
                            "],[" .
                            $creditdataString .
                            "])</script>";

                        // Generate table row for each course, and their update and delete button.
                        echo '<tr>
                
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
                            $coursedetail .
                            '</td>
                        <td>' .
                            $chart .
                            '</td>
                        </tr>';

                        if ($count > 1) {
                            // If the count is greater than 1, perform the following operations
                
                            $labelValues = $creditdataArray; // Assign the values of $creditdataArray to $labelValues
                            $labelnames = explode(",", $moduledataString); // Split $moduledataString into an array using commas as delimiters and assign it to $labelnames
                
                            $barValue = $creditdataArray; // Assign the values of $creditdataArray to $barValue
                
                            // Create an associative array with 'label', 'backgroundColor', and 'data' keys and assign values to them
                            $array = [
                                "label" => $row["title"],
                                // Assign the value of $row['title'] to 'label' key
                                "backgroundColor" => getRandomColor(),
                                // Assign a random color generated by getRandomColor() function to 'backgroundColor' key
                                "data" => $barValue, // Assign the value of $barValue to 'data' key
                            ];

                            $barData[] = $array; // Add $array to the $barData array
                        }
                    }
                }

                $data = json_encode($barData);

                // converts the $barData array into a JSON string.
                ?>
            </tbody>
        </table>

        <?php if (count($_GET["selection"]) > 1) {
            //identifying the count of the selected checkbox and if it is greater than 1 then it will generate bar chart
        
            echo '<div class="bar-graph">
            <div class="report-head">
                    <h2>Bar Graph</h2>
            </div><div>
                <canvas id="myChart"></canvas>
            </div></div>';

            echo "<script>createBarChart(" . $data . ");</script>";
        } else {
            echo '<div class="bar-graph"></div>';
        } ?>
    </main>
    <!-- Display the copyright information -->
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>