<?php
include 'dbinstance.php'; // this will include the dbinstance.php file to access the mysql database 
// echo '<script>alert("You Hellow welcome .");</script>';

if (isset($_POST['title'])) {

    // $title = $_POST['title']; //the username is assigned to a variable uname
    // $location = $_POST['location']; //the username is assigned to a variable uname
    // $overview = $_POST['overview']; //the username is assigned to a variable uname
    // $highlight = $_POST['highlight']; //the username is assigned to a variable uname
    // $coursedetail = $_POST['coursedetail']; //the username is assigned to a variable uname
    // $entryrequirement = $_POST['entryrequirement']; //the username is assigned to a variable uname
    // $feesfunding = $_POST['feesfunding']; //the username is assigned to a variable uname
    // $faqs = $_POST['faqs']; //the username is assigned to a variable uname
    // $module = $_POST['module']; //the username is assigned to a variable uname
    // $credits = $_POST['credits']; //password is assigned to a variable password

    // $result = fetchARecordWithTwoWhereClause('user', 'email', $uname, 'password', $password);

    $stmt = $GLOBALS['pdo']->prepare('INSERT INTO coursedetail(title, location, overview, highlight, coursedetail, entryrequirement, feesfunding, faqs) VALUES (:title,:location,:overview, :highlight, :coursedetail, :entryrequirement, :feesfunding, :faqs);');
    $criteria = [
        'title' => $_POST['title'],
        'location' => $_POST['location'],
        'overview' => $_POST['overview'],
        'highlight' => $_POST['highlight'],
        'coursedetail' => $_POST['coursedetail'],
        'entryrequirement' => $_POST['entryrequirement'],
        'feesfunding' => $_POST['feesfunding'],
        'faqs' => $_POST['faqs']

    ];

    $result = $stmt->execute($criteria);

    if ($result) {
        //if there is an matching row, then the page will redirected to home.php
        // echo '<script>alert("You have entered new course.");</script>';

        $courseid = $GLOBALS['pdo']->lastInsertId();

        $modules = $_POST['module'];
        $credits = $_POST['credits'];

        // Iterate over the arrays to access the values
        for ($i = 0; $i < count($modules); $i++) {
            $moduleValue = $modules[$i];
            $creditValue = $credits[$i];


            $stmt2 = $GLOBALS['pdo']->prepare('INSERT INTO modulecredits( courseid, module, credit) VALUES (:courseid,:module,:credits);');

            $criteria2 = [
                'courseid' => $courseid,
                'module' => $moduleValue,
                'credits' => $creditValue,

            ];

            $result2 = $stmt2->execute($criteria2);

            // Process the values as needed
            // echo "Module: " . $moduleValue . ", Credits: " . $creditValue . "<br>";
        }







        //if there is an matching row, then the page will redirected to home.php
        echo '<script>alert("New course added.");</script>';

        header('location:courseSelectionForm.php');

        // header('location:courseSelectionForm.php');
    } else {
        // if there is no matching row then it will print " Something went Wrong"
        echo '<script>alert("You have entered an incorrect username or password.");</script>';
    }



}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course Report</title>
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

        <!-- <div class="form-content">
            <div class="form-items"> -->

        <form method="POST" action="#">
            <!-- <div class="sketch"> -->
            <!-- <img src="./sampleEntryForm.png" alt="New course entry form"> -->


            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-lg">Title:</label>
                <input type="text" name="title" placeholder="Enter course title" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-lg">Location:</label>
                <input type="text" name="location" placeholder="Enter the location" class="form-control" required>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Overview:</label>
                <textarea type="text" name="overview" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the course overview"></textarea>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Highlight:</label>
                <textarea type="text" name="highlight" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the Highlight"></textarea>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">Course Details:</label>
                <textarea type="text" name="coursedetail" class="form-control" rows="8" cols="100" required
                    placeholder="Enter course detail"></textarea>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">Entry Requirement:</label>
                <textarea type="text" name="entryrequirement" class="form-control" rows="8" cols="100" required
                    placeholder="Enter Entry requirement"></textarea>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">Fees Funding:</label>
                <textarea type="text" name="feesfunding" class="form-control" rows="8" cols="100" required
                    placeholder="Enter Fees funding"></textarea>
            </div>

            <div class="form-input">
                <label class="col-sm-2 col-form-label col-form-label-lg">FAQs:</label>
                <textarea type="text" name="faqs" class="form-control" rows="8" cols="100" required
                    placeholder="Enter the FAQs"></textarea>
            </div>

            <div class="form-group">
                <h2 class="col-sm-2 col-form-label col-form-label-lg">Module & Credits</h2>
                <div class="modulecredits">
                    <button class="add_modulecredits">Add Module & Credits +
                    </button>

                    <div class="row note">
                        <div class="col-sm-6">
                            <input type="text" name="module[]" class="form-control" placeholder="Module">
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="credits[]" class="form-control" placeholder="Credits">
                        </div>

                    </div>
                </div>
            </div>


            <!-- </div> -->
            <div class="addmore note">
                <!-- add more feilds for the remaining recipe info ...-->
                <!-- <p class="note">

                </p> -->
                <input type="submit" value="Add Course" />
                <!--input type="reset" value="Cancel" /-->
            </div>
        </form>
        <!-- </div>
        </div> -->
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>