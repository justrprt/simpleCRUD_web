<?php

include "config.php";
session_start();

?>


<!DOCTYPE html>
<html>
<head>
    <title>List User-Admin</title>
    <link rel="stylesheet" type="text/css" href="main.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="table-responsive/main.css">

<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="table-responsive/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="table-responsive/css/util.css">
  <link rel="stylesheet" type="text/css" href="table-responsive/css/main.css">
<!--===============================================================================================-->
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="login.php">Welcome <?php echo $_SESSION['nick']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
        </ul>
        <form class="form-inline" method="post">
          <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


<?php 

if(isset($_POST['search'])){
  $key = $_POST['search'];
  $sql = "SELECT username, name, birth_date, regency, province, religion, role 
        FROM data_akun
        WHERE name LIKE '%".$key."%' OR
              birth_date LIKE '%".$key."%' OR
              regency LIKE '%".$key."%' OR
              province LIKE '%".$key."%' OR
              religion LIKE '%".$key."%' OR
              role LIKE '%".$key."%'
        ORDER BY name";
}else {

  $sql = "SELECT username, name, birth_date, regency, province, religion, role 
        FROM data_akun
        WHERE role != 'admin'
        ORDER BY name";
}

if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) > 0){
    echo '<div class="limiter">';
      echo '<div class="container-table100">';
        echo '<div class="wrap-table100">';
          echo '<div class="table100">';
                echo '<table>';
                echo '<thead>';
                    echo '<tr class="table100-head">';
                        echo '<th class="column1">Name</th>';
                        echo '<th class="column1">Birth Date</th>';
                        echo '<th class="column1">Regency</th>';
                        echo '<th class="column1">Province</th>';
                        echo '<th class="column1">Religion</th>';
                        echo '<th class="column1">Role</th>';
                    echo "</tr>";
                echo '</thead>';
                echo '<tbody>';
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td class='column1'>" . $row['name'] . "</td>";
                        echo "<td class='column1'>" . $row['birth_date'] . "</td>";
                        echo "<td class='column1'>" . $row['regency'] . "</td>";
                        echo "<td class='column1'>" . $row['province'] . "</td>";
                        echo "<td class='column1'>" . $row['religion'] . "</td>";
                        echo "<td class='column1'>" . $row['role'] . "</td>";
                    echo "</tr>";
                }
                echo '</tbody';
                echo "</table>";
                mysqli_free_result($result);
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  } else{
    echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


?>

<!--===============================================================================================-->  
  <script src="table-responsive/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="table-responsive/vendor/bootstrap/js/popper.js"></script>
  <script src="table-responsive/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="table-responsive/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="table-responsive/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>