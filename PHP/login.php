<?php

require_once 'config.php';
// $password = 'metalica';
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);
// var_dump($hashed_password);

$err_password_msg = $username = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT username, password FROM data_akun WHERE username ='".$username."'";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);

            if(password_verify($password, $row['password'])){
                echo "logged in successfully";
                header("Location: welcome-page.php");
            }else{
                $err_password_msg = "the password or username is incorrect";
            }
        }else {
            $err_password_msg = "the password or username is incorrect";
        }
    }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
} 

// Else, Redirect them back to the login page.

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group">
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control" placeholder="Password"><span class="help-block"><?php echo $err_password_msg; ?></span>
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>