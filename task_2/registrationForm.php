<?php
// This PHP is used to update the user profile

include 'dbinstance.php'; // this will include the connect.php file to access the mysql database 

if (
    isset($_POST['password']) || isset($_POST['confirm_password']) || isset($_POST['username'])
    || isset($_POST['name'])
) {
    // check if password and confirm password is equal or not and then it will updat in the database
    if ($_POST['password'] === $_POST['confirm_password']) {

        if (isset($_POST['name'])) {

            $stmt = $pdo->prepare('INSERT INTO USER(username, password,name ) VALUES (:username,:password,:name);');
            $criteria = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'name' => $_POST['name']
            ];
            $stmt->execute($criteria);


            if ($stmt->execute($criteria)) {
                //if there is an matching row, then the page will redirected to home.php
                echo '<script>alert("New user is added.");</script>';

                header('location:index.php');
            } else {
                // if there is no matching row then it will print " Something went Wrong"
                echo " Something went Wrong";
            }
        }

    } else {
        // The below code will display an alert which will show that "The Password should be equal"
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
    <!-- Bootstrap CSS -->
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

            <form method="POST" action="#">
                <div class="form-group my-4">
                    <label>Name: </label>
                    <input type="name" class="form-control" name="name" required placeholder="Enter the name" />
                    <!-- input textbox to inserting the username -->
                </div>
                <div class="form-group my-4">
                    <label>Username: </label>
                    <input type="username" class="form-control" name="username" required
                        placeholder="Enter the Username" />
                    <!-- input textbox to inserting the username -->
                </div>
                <div class="form-group my-3">
                    <label>Password: </label>
                    <input type="password" class="form-control" name="password" required
                        placeholder="Enter the password" />
                    <!-- input textbox to inserting the password -->
                </div>
                <div class="form-group my-3">
                    <label>Confirm password: </label>
                    <input type="password" class="form-control" name="confirm_password" required
                        placeholder="Enter the confirm password" />
                    <!-- input textbox to inserting the password -->
                </div>
                <div class="form-group">
                    <input type="submit" type="submit" value="Register" class="btn-login" />
                </div>Already have an account?
                <a class=" fw-bold" href="index.php"> Click here to login!</a>
                <!-- <br> -->
                <!-- <a href="registration.php">Haven't got an account? Click here to create a new one!</a> -->

            </form>
        </div>

    </main>
</body>

</html>