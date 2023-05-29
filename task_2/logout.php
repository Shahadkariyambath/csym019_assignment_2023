<?php

//php functions to end user sessions and redirect to the login page.

session_start();
session_destroy();
header('location: index.php');

?>