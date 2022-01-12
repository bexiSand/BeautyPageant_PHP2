<?php
// Startar upp sessionen
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Sessioner Hem</title>
    <meta charset="utf-8" />
</head>
<body>
<?php
require("includes/conn_mysql.php");

// Skapar databaskopplingen
$connection = dbConnect();

// Hämtar användare och lösenord från formuläret
$checkUser = mysqli_real_escape_string($connection,$_POST['txtUser']);
$checkPass = mysqli_real_escape_string($connection,$_POST['txtPassword']);

// kontrollerar om användaren finns
$query = "SELECT * FROM customer
			WHERE customerEmail = '$checkUser'";

$result = mysqli_query($connection,$query) or die("Query failed: $query");

$row = mysqli_fetch_assoc($result);

// Mysqli_num_row räknar antalet rader, dvs om träff på användaren
$count = mysqli_num_rows($result);

if($count == 1) {
    // Kontrollerar lösenordet, använder password_hash för att kontrollera hash mot databasen
    if (password_verify($checkPass, $row["customerPassword"])) {
        $_SESSION['status'] = "ok";
        $_SESSION['customerId'] = $row['customerId'];
        echo "<h1>Welcome!</h1><p>Click on one of the links below!</p>";
        echo '<p><a href="image_upload/index.php">Upload image</a></p>';
        echo '<p><a href="your_rating.php">View your rating</a></p>';
        echo '<p><a href="vote.php">Rate other contestants</a></p>';
        echo '<p><a href="logout.php">Logout</a></p>';
    } else {
        echo "<p>Your password is wrong</p>";
        echo '<p><a href="index.php">Try again</a></p>';
    }
}else {
    echo "<p>Your e-mail or password is wrong.</p>";
    echo '<p><a href="index.php">Try again</a></p>';
}



// Stänger databaskopplingen
mysqli_close($connection);
?>
</body>
</html>