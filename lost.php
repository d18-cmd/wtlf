<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	$image = $_FILES['image']['tmp_name'];
    $img = file_get_contents($image);
	$u_id = filter_var($_POST["in_id"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below	
	$u_thing = filter_var($_POST["user_thing"], FILTER_SANITIZE_STRING);
	$u_text = filter_var($_POST["user_message"], FILTER_SANITIZE_STRING);

	if (empty($u_id)){
		die("Please enter college id");
	}
	if (empty($u_thing)){
		die("Please enter thing you got");
	}	
	if (empty($u_text)){
		die("Please enter text");
	}	

	
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO users_data (in_id ,user_thing,user_place,image) VALUES(?, ?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('ssss', $u_id,$u_thing, $u_text,$img); //bind values and execute insert query
	
	if($statement->execute()){
		print "Hey!, your message has been saved!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>