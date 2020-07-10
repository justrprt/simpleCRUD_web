<?php

require_once 'config.php';
// include 'proses-register.php';


$username = $name = $birth_date = $regency = $province = $religion = $role = "";
$err_password = $err_uname = "";
$sql = "insert into data_akun (username, password, name, birth_date, regency, province, religion, role) values (?, ?, ?, ?, ?, ?, ?, ?)";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "ssssssss", $username, $password, $name, $birth_date, $regency, $province, $religion, $role);

        $password_check = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $birth_date = $_POST['birth_date'];
        // $date = str_replace("/", "-", $or_date);
        // $birth_date = date("Y/m/d", strtotime($date));
        $regency = $_POST['regency'];
        $province = $_POST['province'];
        $religion = isset($_POST['religion']) ? $_POST['religion'] : '';

        $confirm_uname = "SELECT username FROM data_akun WHERE username ='".$username."'";
        if(!empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['birth_date']) && !empty($_POST['regency']) && !empty($_POST['province']) && !empty($_POST['religion'])){
            if($result = mysqli_query($conn, $confirm_uname)){
                if(mysqli_num_rows($result) == 0){
            

                    if($password_check == $confirm_password){

                        // create a hashed password
                        $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                        //binding parameter into prepare
                        $password = $hashed_password;
                        
                        
                        
                        $role = "user";

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            echo "Records inserted successfully.";
                            header("Location: login.php");
                        }else {
                            echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                        }
                    }else {
                        $err_password = "The password did not match.";
                    }
                } else{
                    $err_uname = "The username is already taken.";
                }
            }
        }
    } else{
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    }
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($conn);
}
 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel='stylesheet' type='text/css' href="main.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Sign Up</title>

    <!-- Icons font CSS-->
    <link href="register-page/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="register-page/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="register-page/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="register-page/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="register-page/css/main.css" rel="stylesheet" media="all">
</head>

<body>

<!-- <div id="grid">
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $err_uname; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" >
                
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $err_password; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                
            </div>

            <div class="form-group <?php echo (!empty($birth_date_err)) ? 'has-error' : ''; ?>">
                <label>Birth Date</label>
                <input type="text" name="birth_date" class="form-control" value="<?php echo $birth_date; ?>" placeholder="YYYY-MM-DD">
                
            </div>

            <div class="form-group <?php echo (!empty($regency_err)) ? 'has-error' : ''; ?>">
                <label>Regency</label>
                <input type="text" name="regency" class="form-control" value="<?php echo $regency; ?>">
                
            </div>

            <div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <label>Province</label>
                <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
                
            </div>

            <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                <label for="exampleFormControlSelect1">Religion</label>
                <select name="religion" class="form-control" id="exampleFormControlSelect1">
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                </select>
                
            </div> 

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</div>

<script src="https://kit.fontawesome.com/38bd0759ac.js" crossorigin="anonymous"></script> -->


<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <form method="post" action="">

                        <!-- <div class="row row-space">
                            <div class="col-2"> -->
                                <div class="input-group">
                                    <label class="label">username</label>
                                    <input class="input--style-4" type="text" name="username" value="<?php echo $username; ?>"><span class="help-block"><?php echo $err_uname; ?></span>
                                </div>
                            <!-- </div>
                        </div> -->

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" name="password"><span class="help-block"><?php echo $err_password; ?></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm password</label>
                                    <input class="input--style-4" type="password" name="confirm_password">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">name</label>
                                    <input class="input--style-4" type="text" name="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">birth date</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birth_date" value="<?php echo $birth_date; ?>" placeholder="DD/MM/YYYY">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">regency</label>
                                    <input class="input--style-4" type="tex" name="regency" value="<?php echo $regency; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">province</label>
                                    <input class="input--style-4" type="text" name="province" value="<?php echo $province; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="input-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>" >
                            <label class="label">Religion</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="religion">
                                    <option disabled="disabled" selected="selected" value="">Choose one</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="register-page/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="register-page/vendor/select2/select2.min.js"></script>
    <script src="register-page/vendor/datepicker/moment.min.js"></script>
    <script src="register-page/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="register-page/js/global.js"></script>

</body>
</html>