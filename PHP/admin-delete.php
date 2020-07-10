<?php

require_once 'config.php';
echo '<h4>Deleting Data</h4><br>';
echo $_GET['username'];

$key = $_GET['username'];
$query = "DELETE 
    FROM data_akun
    WHERE username ='" . $key . "'";

    $run_it = mysqli_query($conn, $query);

    if($run_it){
		header('Location: admin-dashboard.php');
	}
?>
