<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$s_id = filter_var($_POST["s_id"], FILTER_SANITIZE_STRING);
	$card_id = filter_var($_POST["card_id"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below	
	$ctype = filter_var($_POST["ctype"], FILTER_SANITIZE_STRING);
	

	if (empty($s_id)){
		die("Please enter college id");
	}
	if (empty($card_id)){
		die("Please enter the card id");
	}
	if (empty($ctype)){
		die("Please enter thing you got");
	}	
	
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO lift (card_id, rid_issue, ctype) VALUES(?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sss',$card_id, $s_id, $ctype); //bind values and execute insert query
	
	if($statement->execute()){
		print "Hello " . $s_id . "!, your message has been saved!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>