<?php
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $db_name = "shouse";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db_name);

    // Check connection
    if (!$db_name) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";
?>