<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "exa";

$u_fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
	$u_lname = filter_var($_POST["lname"], FILTER_SANITIZE_STRING); 
	$u_feedback = filter_var($_POST["feedback"], FILTER_SANITIZE_STRING);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO feedback_t (fname, lname, feedback)
VALUES ('$u_fname', '$u_lname', '$u_feedback')";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Your Message successfully sent");';
    echo 'window.location.href="contact.html";';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>