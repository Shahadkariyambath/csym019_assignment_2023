<?php
include 'dbinstance.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course Report</title>
    <link rel="stylesheet" href="layout.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<script>
    function randomcolor() {
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += Math.floor(Math.random() * 16).toString(16);
        }
        return color;
    }

    function createBarChart(barData) {
        var ctx = document.getElementById("myChart").getContext("2d");

        var data = {
            labels: ["Module-1", "Module-2", "Module-3", "Module-4", "Module-5", "Module-6", "Module-7", "Module-8"],
            datasets: barData
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });

    }

    function createPieChart(id, modules, credit) {
        let idname = document.getElementById(id);

        let modulesCount = modules.length;
        var backgroundColors = [];
        var borderColors = [];

        for (var i = 0; i < modulesCount; i++) {
            backgroundColors[i] = randomcolor();
        }

        for (var i = 0; i < modulesCount; i++) {
            borderColors[i] = randomcolor();
        }

        let chart = new Chart(idname, {
            type: "pie", // specify chart type
            data: {
                labels: modules,
                datasets: [{
                    backgroundColor: backgroundColors,
                    data: credit,
                    borderWidth: 1,
                    borderColor: borderColors
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Pie-Chart" //chart title
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
            <li><a href="./courseSelectionForm.php">Course Report</a></li>
            <li><a href="./newCourse.php">New Course</a></li>
        </ul>
    </nav>
    <main>
        <!-- <h3>Sample Course Reoprt</h3>
        <div class="sketch">
            <img src="./sampleReport.png" alt="Sample Course Report">
        </div>
        <div class="addmore">
            <p class="note">The sketch above provides a sample report based on the selection of TWO courses.</p>
            <p class="blueNote">IMPORTANT NOTE: ALL CHARTS MUST BE CREATED USING THE <a
                    href="https://www.chartjs.org">Chartjs</a> LIBRARY.</p>
        </div> -->


        <h3 class="text-center"><b>Course Report</b></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Location</th>
                    <th scope="col">Course Overview</th>
                    <th scope="col">Course Details</th>
                    <th scope="col">Chart</th>



                </tr>
            </thead>
            <tbody>

                <?php
                // include 'dbinstance.php';
                function getRandomColor()
                {
                    $color = '#';
                    for ($i = 0; $i < 6; $i++) {
                        $color .= dechex(mt_rand(0, 15));
                    }
                    return $color;
                }

                $count = count($_GET['selection']); //identifying the count of the selected checkbox
                

                $Ids = $_GET['selection'];
                $stmt = $pdo->prepare("select * from coursedetail where id in(" . implode(',', $Ids) . ")");

                $barData = [];

                if ($stmt->execute()) {
                    foreach ($stmt as $row) {



                        $id = $row['id'];
                        $title = $row['title'];
                        $location = $row['location'];
                        $overview = $row['overview'];
                        $highlight = $row['highlight'];
                        $coursedetail = $row['coursedetail'];
                        $entryrequirement = $row['entryrequirement'];
                        $feesfunding = $row['feesfunding'];
                        $faqs = $row['faqs'];

                        $stmt2 = $pdo->prepare("select * from modulecredits where courseid = $id ");

                        $moduledata = [];
                        $creditdata = [];
                        $i = 0;
                        if ($stmt2->execute()) {
                            foreach ($stmt2 as $row2) {
                                $moduledata[$i] = $row2['module'];
                                $creditdata[$i] = $row2['credit'];
                                $i++;
                            }
                        }

                        $moduledataString = implode(',', $moduledata);

                        $moduledataArray = explode(",", $moduledataString);
                        $new = array_map(function ($element) {
                            return "'" . trim($element) . "'";
                        }, $moduledataArray);

                        $moduledataString = implode(",", $new);

                        // Output the result
                        // echo $moduledataString;
                

                        $creditdataString = implode(',', $creditdata);

                        // $creditdataString = explode(",", $creditdataString);
                        // $new = array_map(function ($element) {
                        //     return "'" . trim($element) . "'";
                        // }, $creditdataString);
                
                        // $creditdataString = implode(",", $new);
                
                        // echo $creditdataString;
                        $creditdataArray = explode(",", $creditdataString); // Split the string by commas
                


                        $chart = '<canvas id="chart' . $row['id'] . '" width="400" height="400"></canvas>
                        <script>createPieChart("chart' . $row['id'] . '",[' . $moduledataString . '],[' . $creditdataString . '])</script>';


                        echo '<tr>
                
                <th scope="row">' . $title . '</th>
                <td>' . $location . '</td>
                <td>' . $overview . '</td>
                <td>' . $coursedetail . '</td>
                <td>' . $chart . '</td>
                
            </tr>';




                        if ($count > 1) {

                            $labelValues = $creditdataArray;
                            $labelnames = explode(",", $moduledataString);



                            $barValue = $creditdataArray;



                            $barValue = $creditdataArray;
                            $array = [
                                "label" => $row['title'],
                                "backgroundColor" => getRandomColor(),
                                "data" => $barValue
                            ];
                            $barData[] = $array;
                        }
                    }
                }

                $data = json_encode($barData);



                ?>
            </tbody>
        </table>

        <?php

        if (count($_GET['selection']) > 1) {

            echo '<div class="bar-graph">
            <div class="report-head">
                    <h2>Bar Graph</h2>
            </div><div>
                <canvas id="myChart"></canvas>
            </div></div>';

            echo '<script>createBarChart(' . $data . ');</script>';

        } else {
            echo '<div class="bar-graph"></div>';
        }


        ?>
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>