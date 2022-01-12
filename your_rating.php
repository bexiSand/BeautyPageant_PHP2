<?php
session_start();
require("includes/conn_mysql.php");
$con = dbConnect();
if ($_SESSION['status'] != "ok") header('Location: index.php');
if (isset($_GET['id'])) {
    $query = "INSERT INTO votes (rating, id) VALUES (" . $_GET['grade'] . ", " . $_GET['id'] . ");";
    if ($con->query($query) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $query . "<br>" . $con->error;
      }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Your rating</title>
</head>

<body>
<a href="image_upload/index.php">Upload image</a><br> 
<a href="vote.php">Rate other contestants</a><br>
<a href="logout.php">Logout</a><br>

<h1>Your rating</h1>


<?php

$sql = "select * from images WHERE customerId = " . $_SESSION['customerId'];
$result = mysqli_query($con,$sql);

// $image = $row['name'];
// $image_src = "upload/".$image;

while($row = mysqli_fetch_array($result)){
    ?>
    <p>
    <img style="width:300px;" src='<?php echo "image_upload/upload/".$row['name'];  ?>' >
    <?php
    $result2 = $con->query("SELECT count(*) as antal FROM votes WHERE id = " . $row['id']);
    $row2 = mysqli_fetch_array($result2);

    $result2 = $con->query("SELECT sum(rating) as total FROM votes WHERE id = " . $row['id']);
    $row3 = mysqli_fetch_array($result2);
    if ($row2['antal'] == 0) {
        echo "<br>No votes";
    } else {
        echo round($row3['total'] / $row2['antal'],1) . " (" . $row2['antal'] . " röster)";
    }
    ?>
   

    </p>

    <?php
}
?>

</body>
</html>