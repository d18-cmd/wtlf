<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$u_id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
	$u_cust = filter_var($_POST["cust"], FILTER_SANITIZE_STRING);

	if (empty($u_id)){
		die("Please enter id");
	}
	if (empty($u_cust)){
		die("Please enter your name");
	}

	
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
    
    
    $sql = "UPDATE co_table SET o_dt=NOW() WHERE id='$u_id'";

    if ($mysqli->query($sql) === TRUE) {
    echo "Record updated successfully";

       
    } else {
    echo "Error updating record: " . $mysqli->error;
    }

}
?>