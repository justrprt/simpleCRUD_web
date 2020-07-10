<?php

require_once 'config.php';


$err_password = $err_uname = $err_edit_pass = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

		$password_check = $_POST['password'];
	    $confirm_password = $_POST['confirm_password'];
	    $username = $row['username'];
	    $name = $_POST['name'];
	    $birth_date = $_POST['birth_date'];
	    $regency = $_POST['regency'];
	    $province = $_POST['province'];
	    $religion = $_POST['religion'];
	    $role = $_POST['role'];

	    if(!empty($password_check)){
	    	$err_edit_pass = '';
		    if($password_check == $confirm_password){

		        // create a hashed password
		        $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		        //binding parameter into prepare
		        $password = $hashed_password;

		        $query = "UPDATE data_akun SET 
		        password='". $password . "',
		        name='". $name . "',
		        birth_date='". $birth_date . "',
		        regency='". $regency . "',
		        province='". $province . "',
		        role='". $role . "'
				WHERE username='" . $username . "'";

				$run_it = mysqli_query($conn, $query);

				if($run_it){
					header('Location: admin-dashboard.php');
				}

		    }else{
		    	$err_password = "The password did not match.";
		    }
		}else{
			$err_edit_pass = 'please enter new password';
		}
	$conn->close();
}
?>