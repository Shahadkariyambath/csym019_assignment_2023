<!-- login.php is used for login into the page using username and password data -->

<?php include "dbinstance.php";
// this will include the dbinstance.php file to access the mysql database
?>


<?php if (isset($_POST["username"])) {
    // Code to be executed if the 'username' field is set in the $_POST array

    $uname = $_POST["username"]; //the username is assigned to a variable uname
    $password = $_POST["password"]; //password is assigned to a variable password

    $stmt = $GLOBALS["pdo"]->prepare(
        "SELECT * FROM user WHERE username = :value AND password = :valuetwo"
    ); // Preparing the statement
    // Define the criteria for the prepared statement
    $criteria = [
        "value" => $uname,
        // Set the value of the 'username' column to the value of $uname
        "valuetwo" => $password, // Set the value of the 'password' column to the value of $password
    ];
    $stmt->execute($criteria); // Execute the prepared statement with the given criteria
    $resultAll = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows from the result set into $resultAll as an associative array

    if ($resultAll) {
        header("location:courseSelectionForm.php"); // Redirect the user to the specified page if the query result is not empty
    } else {
        echo '<script>alert("You have entered an incorrect username or password.");</script>'; // Display an alert message if the query result is empty, indicating incorrect credentials
    }
} ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout.css">
    <!-- Bootstrap CSS -->
    <!-- This code adds a link to the Bootstrap CSS file from the specified URL, allowing you to apply Bootstrap styles to your web page. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>University of Northampton Course Details</title>
</head>

<body>
    <header>
        <!-- html page header -->
        <h3 style="text-align: center;">Login Page</h3>
    </header>

    <main>

        <div class="container" style="display: flex; align-items: center; ">
            <!-- Container with flex display and center alignment -->

            <form method="POST" action="index.php">
                <!-- Form element with method set to POST and action set to "index.php" -->

                <div class="form-group my-4">
                    <!-- Form group for the username input -->
                    <label>Username: </label>
                    <!-- Label for the username input -->
                    <input type="username" class="form-control" name="username" required
                        placeholder="Enter the Username" />
                    <!-- Input textbox for entering the username -->
                </div>

                <div class="form-group my-3">
                    <!-- Form group for the password input -->
                    <label>Password: </label>
                    <!-- Label for the password input -->
                    <input type="password" class="form-control" name="password" required
                        placeholder="Enter the password" />
                    <!-- Input textbox for entering the password -->
                </div>

                <div style="text-align: center;">
                    <!-- Container with center alignment for the login button -->
                    <input type="submit" type="submit" value="LOG IN" class="btn-login" />
                    <!-- Input element for submitting the login details -->
                </div>

                <div>
                    <!-- Container for the sign up link -->
                    <p class="mb-0">Don't have an account? <a href="registrationForm.php" class="fw-bold">Sign Up</a>
                    </p>
                    <!-- Paragraph with a sign up link -->
                </div>
            </form>
        </div>

    </main>
    <!-- Display the copyright information -->
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>