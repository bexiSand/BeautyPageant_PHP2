<?php
session_start();
if ($_SESSION['status'] != "ok") header('Location: index.php');

require("includes/conn_mysql.php");
$con = dbConnect();

if (isset($_GET['id'])) {
  $query = "DELETE FROM votes WHERE id = " . $_GET['id'];
  $con->query($query);
  $query = "DELETE FROM images WHERE id = " . $_GET['id'];
  if ($con->query($query) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $query . "<br>" . $con->error;
    }
}


if(isset($_POST['upload_img'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
    
    // unikt namn så det inte krockar
    $newName = uniqid().".".$imageFileType;
     // Insert record
     $query = "insert into images(name, customerId) values('".$newName."', " . $_SESSION['customerId'] . ")";
     mysqli_query($con,$query);
  
     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$newName);

  }
 
}


?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Image</title>
</head>

<body>
<br>
<a href="../your_rating.php">View your rating</a><br>
<a href="../vote.php">Rate other contestants</a><br>
<a href="../logout.php">Logout</a><br>
<h1>Upload image</h1>
<p>
<form method="post" action="" enctype='multipart/form-data'>
  <input type='file' name='file' />
  <input type='submit' value='Save' name='upload_img'>
</form>
</p>

<p>
<?php

$sql = "select * from images WHERE customerId = " . $_SESSION['customerId'];
$result = mysqli_query($con,$sql);

// $image = $row['name'];
// $image_src = "upload/".$image;

while($row = mysqli_fetch_array($result)){
    ?>
    <img style="width:300px;" src='<?php echo "upload/".$row['name'];  ?>' >
    <a href="?id=<?php echo $row['id']; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Delete</a>
    </p>

    <?php
}
?>

</body>
</html>