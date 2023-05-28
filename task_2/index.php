<!-- login.php is used for login into the page using username and password data -->

<?php
include 'dbinstance.php'; // this will include the dbinstance.php file to access the mysql database 
?>


<?php

if (isset($_POST['username'])) {

    $uname = $_POST['username']; //the username is assigned to a variable uname
    $password = $_POST['password']; //password is assigned to a variable password

    // $result = fetchARecordWithTwoWhereClause('user', 'email', $uname, 'password', $password);

    $stmt = $GLOBALS['pdo']->prepare('SELECT * FROM user WHERE username = :value AND password = :valuetwo');
    $criteria = [
        'value' => $uname,
        'valuetwo' => $password
    ];
    $stmt->execute($criteria);
    $resultAll = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($resultAll) {


        //if there is an matching row, then the page will redirected to courseSelectionForm.php
        header('location:courseSelectionForm.php');
    } else {
        // if there is no matching row then it will print " Something went Wrong"
        echo '<script>alert("You have entered an incorrect username or password.");</script>';
    }

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="layout.css">
    <title>University of Northampton Course Details</title>
</head>

<body>
    <header>
        <!-- html page header -->
        <h3 style="text-align: center;">Login Page</h3>
    </header>

    <main>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <div class="container" style="display: flex; align-items: center; ">

            <form method="POST" action="#">
                <div class="form-input my-4">
                    <label>Username: </label>
                    <input type="username" name="username" required placeholder="Enter the Username" />
                    <!-- input textbox to inserting the username -->
                </div>
                <div class="form-input my-3">
                    <label>Password: </label>
                    <input type="password" name="password" required placeholder="Enter the password" />
                    <!-- input textbox to inserting the password -->
                </div>
                <div style="text-align: center;">
                    <input type="submit" type="submit" value="LOG IN" class="btn-login" />
                    <!-- Input element for submitting a login details -->
                </div>
            </form>
        </div>
    </main>
    <footer>&copy; CSYM019 2023</footer>
</body>

</html>