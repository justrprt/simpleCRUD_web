<?php
require_once 'config.php';
session_start();

$key = $_GET['username'];
$sql = "SELECT username, name, birth_date, regency, province, religion, role 
    FROM data_akun
    WHERE username ='" . $key . "'";

// echo $sql;

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

include 'admin-proses-edit.php';

// echo $_GET['username'];


// echo $row['birth_date'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel='stylesheet' type='text/css' href="main.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="register-page/file-btn.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Title Page-->
    <title>Edit</title>

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
    <!-- <div class="wrapper">
        <h2>Edit Data</h2>
        <form action="" method="post">

            
                <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                

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
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
            </div>

            <div class="form-group <?php echo (!empty($birth_date_err)) ? 'has-error' : ''; ?>">
                <label>Birth Date</label>
                <input type="text" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>" placeholder="YYYY-MM-DD">
            </div>

            <div class="form-group <?php echo (!empty($regency_err)) ? 'has-error' : ''; ?>">
                <label>Regency</label>
                <input type="text" name="regency" class="form-control" value="<?php echo $row['regency']; ?>">
            </div>

            <div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <label>Province</label>
                <input type="text" name="province" class="form-control" value="<?php echo $row['province']; ?>">
            </div>

            <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                <label>Religion</label>
                <select name="religion">
                    <option value="Islam" <?php echo ($row['religion'] == 'Islam') ? 'selected' : '' ?>>Islam</option>

                    <option value="Kristen Protestan" <?php echo ($row['religion'] == 'Kristen Protestan') ? 'selected' : '' ?>>Kristen Protestan</option>

                    <option value="Katolik" <?php echo ($row['religion'] == 'Katolik') ? 'selected' : '' ?>>Katolik</option>

                    <option value="Hindu" <?php echo ($row['religion'] == 'Hindu') ? 'selected' : '' ?>>Hindu</option>

                    <option value="Buddha" <?php echo ($row['religion'] == 'Buddha') ? 'selected' : '' ?>>Buddha</option>

                    <option value="Kong Hu Cu" <?php echo ($row['religion'] == 'Kong Hu Cu') ? 'selected' : '' ?>>Kong Hu Cu</option>
                </select>
            </div> 

            <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                <label>Religion</label>
                <select name="role">
                    <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : '' ?>>admin</option>

                    <option value="user" <?php echo ($row['role'] == 'user') ? 'selected' : '' ?>>user</option>
				</select>
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>     -->

<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Edit Form</h2>
                    <form method="post" action="">

                        <input type="hidden" name="username" value="<?php echo $row['username']; ?>">

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">new password</label>
                                    <input class="input--style-4" type="password" name="password"><span class="help-block"><?php echo $err_password; ?></span><span class="help-block"><?php echo $err_edit_pass; ?></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">confirm new password</label>
                                    <input class="input--style-4" type="password" name="confirm_password">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">name</label>
                                    <input class="input--style-4" type="text" name="name" value="<?php echo $row['name']; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">birth date</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birth_date" value="<?php echo $row['birth_date']; ?>" placeholder="DD/MM/YYYY">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">regency</label>
                                    <input class="input--style-4" type="tex" name="regency" value="<?php echo $row['regency']; ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">province</label>
                                    <input class="input--style-4" type="text" name="province" value="<?php echo $row['province']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group" >
                                    <label class="label">Religion</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="religion">
                                    <option value="Islam" <?php echo ($row['religion'] == 'Islam') ? 'selected' : '' ?>>Islam</option>

                                    <option value="Kristen Protestan" <?php echo ($row['religion'] == 'Kristen Protestan') ? 'selected' : '' ?>>Kristen Protestan</option>

                                    <option value="Katolik" <?php echo ($row['religion'] == 'Katolik') ? 'selected' : '' ?>>Katolik</option>

                                    <option value="Hindu" <?php echo ($row['religion'] == 'Hindu') ? 'selected' : '' ?>>Hindu</option>

                                    <option value="Buddha" <?php echo ($row['religion'] == 'Buddha') ? 'selected' : '' ?>>Buddha</option>

                                    <option value="Kong Hu Cu" <?php echo ($row['religion'] == 'Kong Hu Cu') ? 'selected' : '' ?>>Kong Hu Cu</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>

                        
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Permission</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">admin
                                            <input type="radio" name="role" value="admin" <?php echo ($row['role']=='admin')?'checked':'' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">user
                                            <input type="radio" name="role" value="user" <?php echo ($row['role']=='user')?'checked':'' ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                            <button disabled><a class="btn btn--radius-2 btn--blue" href="admin-dashboard.php" style="text-decoration:none; margin-left:120px;">Cancel</a></button>
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