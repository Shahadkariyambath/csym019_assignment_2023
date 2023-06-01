<?php
// This PHP is used to update the user profile

include "dbinstance.php"; // this will include the connect.php file to access the mysql database

if (
    isset($_POST["password"]) ||
    isset($_POST["confirm_password"]) ||
    isset($_POST["username"]) ||
    isset($_POST["name"])
) {
    // Check if any of the required fields (password, confirm_password, username, name) are set in the POST data

    if ($_POST["password"] === $_POST["confirm_password"]) {
        // Check if the password and confirm_password values are equal

        if (isset($_POST["name"])) {
            // Check if the name field is set in the POST data

            $stmt = $pdo->prepare(
                "INSERT INTO USER(username, password,name ) VALUES (:username,:password,:name);"
            );
            // Prepare an SQL statement for inserting user data into the database

            $criteria = [
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "name" => $_POST["name"],
            ];
            // Create an associative array with the values for username, password, and name

            $stmt->execute($criteria);
            // Execute the prepared statement with the provided criteria

            if ($stmt->execute($criteria)) {
                // If the execution of the statement is successful, the new user is added

                echo '<script>alert("New user is added.");</script>';
                // Display an alert message indicating that a new user is added

                header("location:index.php");
                // Redirect the user to the index.php page
            } else {
                // If there is an error executing the statement, display an error message

                echo " Something went Wrong";
            }
        }
    } else {
        // If the password and confirm_password values are not equal, display an alert message

        echo '<script>alert("The Password should be equal");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="layout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>University of Northampton Course Details</title>
</head>

<body>
    <header>
        <!-- html page header -->
        <h3 style="text-align: center;">Register</h3>
    </header>

    <main>

        <div class="container" style="display: flex; align-items: center; ">
            <!-- Container div with flex display and center alignment -->

            <form method="POST" action="#">
                <!-- Form element with POST method -->

                <div class="form-group my-4">
                    <!-- Form group div with top margin of 4 -->

                    <label>Name: </label>
                    <!-- Label for the Name input field -->

                    <input type="name" class="form-control" name="name" required placeholder="Enter the name" />
                    <!-- Input field for entering the name, with form-control class and required attribute -->

                </div>

                <div class="form-group my-4">
                    <!-- Form group div with top margin of 4 -->

                    <label>Username: </label>
                    <!-- Label for the Username input field -->

                    <input type="username" class="form-control" name="username" required
                        placeholder="Enter the Username" />
                    <!-- Input field for entering the username, with form-control class and required attribute -->

                </div>

                <div class="form-group my-3">
                    <!-- Form group div with top margin of 3 -->

                    <label>Password: </label>
                    <!-- Label for the Password input field -->

                    <input type="password" class="form-control" name="password" required
                        placeholder="Enter the password" />
                    <!-- Input field for entering the password, with form-control class and required attribute -->

                </div>

                <div class="form-group my-3">
                    <!-- Form group div with top margin of 3 -->

                    <label>Confirm password: </label>
                    <!-- Label for the Confirm password input field -->

                    <input type="password" class="form-control" name="confirm_password" required
                        placeholder="Enter the confirm password" />
                    <!-- Input field for confirming the password, with form-control class and required attribute -->

                </div>

                <div class="form-group">
                    <!-- Form group div -->

                    <input type="submit" type="submit" value="Register" class="btn-login" />
                    <!-- Submit button with value "Register" and btn-login class -->

                </div>
                Already have an account?
                <!-- Text indicating that the user already has an account -->

                <a class=" fw-bold" href="index.php"> Click here to login!</a>
                <!-- Link to the login page with the text "Click here to login!" and fw-bold class -->

            </form>
        </div>
        <!-- End of container div -->

    </main>
    <!-- Display the copyright information -->
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>