<?php

require_once 'config.php';

$sql = "insert into data_akun (username, password, name, birth_date, regency, province, religion, role) values (?, ?, ?, ?, ?, ?, ?, ?)";

if($stmt = mysqli_prepare($conn, $sql)){

	mysqli_stmt_bind_param($stmt, "ssssssss", $username, $password, $name, $birth_date, $regency, $province, $religion, $role);

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$name = $_REQUEST['name'];
	$birth_date = $_REQUEST['username'];
	$regency = $_REQUEST['birth_date'];
	$province = $_REQUEST['province'];
	$religion = $_REQUEST['religion'];
	$role = "user";

	// Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}
 
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($link);

}
?>