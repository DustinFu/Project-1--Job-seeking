<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "JobSeeking";

$firstName = $_POST["FirstName"];
$lastName = $_POST["LastName"];
$password = $_POST["Password"];
$email = $_POST["Email"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO user (firstName ,lastName,password, email)
VALUES ('$firstName', '$lastName', '$password','$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>