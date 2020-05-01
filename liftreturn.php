<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$return_id = filter_var($_POST["return_id"], FILTER_SANITIZE_STRING);
	$cid = filter_var($_POST["cid"], FILTER_SANITIZE_STRING);

	if (empty($return_id)){
		die("Please enter college id");
	}
	if (empty($cid)){
		die("Please enter the card to be returned");
	}
	
	//Open a new connection to the MySQL server
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
    
    
    $sql = "UPDATE lift SET rid_return='$return_id', return_time=NOW() WHERE card_id='$cid' ORDER BY return_time LIMIT 1";

    if ($mysqli->query($sql) === TRUE) 
    {
    echo "Record updated successfully";
    } 
    else 
    {
    echo "Error updating record: " . $mysqli->error;
    }

}

?>