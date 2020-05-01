<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$u_outid = filter_var($_POST["out_id"], FILTER_SANITIZE_STRING);
	$u_id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);

	if (empty($u_id)){
		die("Please enter id of the item");
	}
	if (empty($u_outid)){
		die("Please enter your college id");
	}
	
	//Open a new connection to the MySQL server
	
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
    
    
    $sql = "UPDATE users_data SET out_id='$u_outid',out_dt=NOW() WHERE id='$u_id'";

    if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";
    } else {
    echo "Error updating record: " . $conn->error;
    }

}
?>