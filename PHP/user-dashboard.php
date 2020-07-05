<?php

include "config.php";



?>


<!DOCTYPE html>
<html>
<head>
    <title>List User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<?php

if(isset($_POST['search'])){
  $key = $_POST['search'];
  $sql = "SELECT name, birth_date, regency, province, religion 
        FROM data_akun
        WHERE name LIKE '%".$key."%' OR
              birth_date LIKE '%".$key."%' OR
              regency LIKE '%".$key."%' OR
              province LIKE '%".$key."%' OR
              religion LIKE '%".$key."%'
              AND role != 'admin'
        ORDER BY name";
}else {

  $sql = "SELECT name, birth_date, regency, province, religion
        FROM data_akun
        WHERE role != 'admin'
        ORDER BY name";
}


if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class = "table table-hover">';
        echo '<thead class = "thead-dark">';
            echo "<tr>";
                echo '<th scope="col">Name</th>';
                echo '<th scope="col">Birth Date</th>';
                echo '<th scope="col">Regency</th>';
                echo '<th scope="col">Province</th>';
                echo '<th scope="col">Religion</th>';
            echo "</tr>";
        echo '</thead>';
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['birth_date'] . "</td>";
                echo "<td>" . $row['regency'] . "</td>";
                echo "<td>" . $row['province'] . "</td>";
                echo "<td>" . $row['religion'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
echo '<h1>Dashboard User</h1>';

?>

</body>
</html>