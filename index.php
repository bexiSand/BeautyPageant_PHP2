<?php

session_start();
if ($_SESSION['status'] == "ok") header('Location: checklogin.php');
?>
<!DOCTYPE html>
<html lang="sv">
<head>
 <title>Beauty Index</title>
<meta charset="utf-8" />
</head>
<body>

<form action="checklogin.php" method="post">
    <h1>Beauty Pageant</h1>
    <p>This is a competition that is judging and ranking your physical attributes.</p>
    <img src="img/index.jpg" style="width:300px;">
    <p><b>Already a contestant?</b></p>
    <label>e-mail:</label>
    <p><input type="email" name="txtUser"></p>

    <label>Password:</label>
    <p><input type="password" name="txtPassword"></p>

    <p><input type="submit" name="submit" value="login"></p>
</form>
<p><b>Otherwise</b></p>
<p><a href="register.php">register</a> to vote and join the competition!</p>

</body>
</html>