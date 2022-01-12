<?php
/*
 * Skapar databaskopplingen
*/
function dbConnect(){
    // Skapar databaskopplingen
    $connection = mysqli_connect("db", "root", "password", "beauty" ) or die("Could not connect");
    // Väljer databas
    mysqli_select_db($connection,"beauty") or die("Could not select database");
    return $connection;

}
	
/*
* stänger databaskopplingen
*/
function dbDisconnect($connection){
	mysqli_close($connection);
}

/*
 * Tar bort oönskade html-tecken
 *
 * mysqli_real_escape_string motverkar SQLInjection
 */
function escapeInsert($conn,$insert) {
    $insert = htmlspecialchars($insert);

    $insert = mysqli_real_escape_string($conn,$insert);

    return $insert;
}


?>