<?php
/*
 * Lägger till ny kund
*/

require("includes/conn_mysql.php");

// Skapar databaskopplingen
$conn = dbConnect();


// Lägga till ny kund?
if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
    $date = date("Y-m-d H:i:s");
    $name = escapeInsert($conn,$_POST['txtName']);
    $email = escapeInsert($conn,$_POST['txtEmail']);
    $password = escapeInsert($conn,$_POST['txtPassword']);
    // Sparar lösenordet med password_hash
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO customer
			(customerName,customerEmail,customerPassword,customerDate)
			VALUES('$name','$email','$passwordHash','$date')";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($conn);

	header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<title>Beauty Register</title>
</head>

<body>
<h1>Register as a new member</h1>

<form action="register.php" method="post">
 <input type="hidden" name="isnew" id="isnew" value="1">

    <label>Name:</label>
    <p><input type="text" name="txtName" placeholder="Your name:"></p>
	
    <label>E-mail:</label>
    <p><input type="email" name="txtEmail" placeholder="Your e-mail:"></p>

    <label>Password:</label>
    <p><input type="password" name="txtPassword" placeholder="Choose a password:"></p>

    <p><input type="submit" value="Register"></p>
</form>


</body>
</html>

