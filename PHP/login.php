<?php

require_once 'config.php';
session_start();
session_unset();

$err_password_msg = $username = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT name as nick, username, password, role FROM data_akun WHERE username ='" . $username . "'";

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            echo $sql;
            if(password_verify($password, $row['password'])){
                echo $sql;
                if($row['role'] == 'user'){
                    $_SESSION['nick'] = $row['nick'];
                    header('Location: user-dashboard.php');
                }else{
                    $_SESSION['nick'] = $row['nick'];
                    header('Location: admin-dashboard.php');
                }
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

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel='stylesheet' type='text/css' href="../main.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">



    <link rel="icon" type="image/png" href="login-page/images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-page/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-page/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-page/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="login-page/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-page/vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-page/css/util.css">
    <link rel="stylesheet" type="text/css" href="login-page/css/main.css">
<!--===============================================================================================-->
</head>

</head>
<body>
<!-- <div id="grid">
<div class="container my-container">
    <div class="row justify-content-sm-center align-items-center my-row">

        <div class="col-4 my-col">
            <i class="fas fa-desktop fa-9x form-left-icon"></i>
        </div>

        <div class="col-4 my-col">

            <h2 class="">Login</h2>
            <p class="form-desc">Please fill username and password to sign in into your account</p>
            <form method="post">

                <div class="form-group has-search">
                    <i class="fa fa-user-circle-o form-control-feedback my-icon" aria-hidden="true"></i>
                    <input class="no-outline form-control form-rounded" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                </div>    

                <div class="form-group has-search">
                    <i class="fas fa-lock form-control-feedback my-icon"></i>
                    <input type="password" name="password" class="form-control form-rounded" placeholder="Password"><span class="help-block"><?php echo $err_password_msg; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary form-btn-rounded" value="Login">
                </div>

                <p class="form-desc">Don't have an account? <a href="register.php">Sign up now</a>.</p>
            
            </form>
        </div>
    </div>
</div>
</div>


<script src="https://kit.fontawesome.com/38bd0759ac.js" crossorigin="anonymous"></script>
</div> -->

<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <form method="post" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" value="login">
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="login-page/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="login-page/vendor/bootstrap/js/popper.js"></script>
    <script src="login-page/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="login-page/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="login-page/vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="login-page/js/main.js"></script>

</body>
</html>