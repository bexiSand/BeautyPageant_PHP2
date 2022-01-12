<?php
session_start();
require("includes/conn_mysql.php");
$con = dbConnect();
if ($_SESSION['status'] != "ok") header('Location: index.php');
if (isset($_GET['id'])) {
    $query = "INSERT INTO votes (rating, id) VALUES (" . $_GET['grade'] . ", " . $_GET['id'] . ");";
    if ($con->query($query) === TRUE) {
        echo "Thank you for voting!<br>";
      } else {
        echo "Error: " . $query . "<br>" . $con->error;
      }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Vote</title>
</head>

<body>
<a href="image_upload/index.php">Upload image</a><br> 
<a href="your_rating.php">View your rating</a><br>
<a href="logout.php">Logout</a><br>
<h1>Rate other contestants</h1>


<?php

$sql = "select * from images WHERE customerId != " . $_SESSION['customerId'];
$result = mysqli_query($con,$sql);

// $image = $row['name'];
// $image_src = "upload/".$image;

while($row = mysqli_fetch_array($result)){
    ?>
    <p>
    <img style="width:300px;" src='<?php echo "image_upload/upload/".$row['name'];  ?>' >
    <?php
    echo "Current rating: ";
    $result2 = $con->query("SELECT count(*) as antal FROM votes WHERE id = " . $row['id']);
    $row2 = mysqli_fetch_array($result2);

    $result2 = $con->query("SELECT sum(rating) as total FROM votes WHERE id = " . $row['id']);
    $row3 = mysqli_fetch_array($result2);
    if ($row2['antal'] == 0) {
        echo "No votes";
    } else {
        echo round($row3['total'] / $row2['antal'],1) . " (" . $row2['antal'] . " votes)";
    }
    
    ?>
<br>
<a href="?id=<?php echo $row['id']; ?>&grade=1" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">1</a>
<a href="?id=<?php echo $row['id']; ?>&grade=2" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">2</a>
<a href="?id=<?php echo $row['id']; ?>&grade=3" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">3</a>
<a href="?id=<?php echo $row['id']; ?>&grade=4" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">4</a>
<a href="?id=<?php echo $row['id']; ?>&grade=5" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">5</a>
</p>

    <?php
}
?>

</body>
</html>