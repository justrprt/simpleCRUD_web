<?php
require_once 'config.php';

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
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Edit Data</h2>
        <form action="" method="post">

            
                <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                

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
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                <!-- <span class="help-block"><?php echo $name_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($birth_date_err)) ? 'has-error' : ''; ?>">
                <label>Birth Date</label>
                <input type="text" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>" placeholder="YYYY-MM-DD">
                <!-- <span class="help-block"><?php echo $birth_date_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($regency_err)) ? 'has-error' : ''; ?>">
                <label>Regency</label>
                <input type="text" name="regency" class="form-control" value="<?php echo $row['regency']; ?>">
                <!-- <span class="help-block"><?php echo $regency_err; ?></span> -->
            </div>

            <div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <label>Province</label>
                <input type="text" name="province" class="form-control" value="<?php echo $row['province']; ?>">
                <!-- <span class="help-block"><?php echo $province_err; ?></span> -->
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
                <!-- <span class="help-block"><?php echo $religion_err; ?></span> -->
            </div> 

            <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                <label>Religion</label>
                <select name="role">
                    <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : '' ?>>admin</option>

                    <option value="user" <?php echo ($row['role'] == 'user') ? 'selected' : '' ?>>user</option>
				</select>
                <!-- <span class="help-block"><?php echo $religion_err; ?></span> -->
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>