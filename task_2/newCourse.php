<!DOCTYPE html>
<html>

<head>
    <title>Course Report</title>
    <link rel="stylesheet" href="layout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
    <main>
        <h2>Please Enter new course details</h2>
        <form action="post" action="#">
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


            <!-- </div> -->
            <div class="addmore">
                <!-- add more feilds for the remaining recipe info ...-->
                <p class="note">

                </p>
                <input type="submit" value="Add Course" />
                <!--input type="reset" value="Cancel" /-->
            </div>
        </form>
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>