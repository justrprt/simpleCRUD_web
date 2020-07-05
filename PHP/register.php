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
        $regency = $_POST['regency'];
        $province = $_POST['province'];
        $religion = $_POST['religion'];

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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
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
                <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $err_password; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <!-- <span class="help-block"><?php echo $name_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($birth_date_err)) ? 'has-error' : ''; ?>">
                <label>Birth Date</label>
                <input type="text" name="birth_date" class="form-control" value="<?php echo $birth_date; ?>" placeholder="YYYY-MM-DD">
                <!-- <span class="help-block"><?php echo $birth_date_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($regency_err)) ? 'has-error' : ''; ?>">
                <label>Regency</label>
                <input type="text" name="regency" class="form-control" value="<?php echo $regency; ?>">
                <!-- <span class="help-block"><?php echo $regency_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <label>Province</label>
                <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
                <!-- <span class="help-block"><?php echo $province_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                <label>Religion</label>
                <select name="religion">
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                </select>
                <!-- <span class="help-block"><?php echo $religion_err; ?></span> -->
            </div> 

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>