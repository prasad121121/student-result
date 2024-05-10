<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "studentresult";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
function recorddie($line, $file, $error) {
    // Log the error or handle it in any other way
    echo "Error occurred at line $line in file $file: $error";
}

?>