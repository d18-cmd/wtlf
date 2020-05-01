<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$u_from = filter_var($_POST["post"], FILTER_SANITIZE_STRING);
	$u_for = filter_var($_POST["cust"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below	
	

	if (empty($u_from)){
		die("Please enter postname");
	}
	if (empty($u_for)){
		die("Please enter receiver name");
	}


	//Open a new connection to the MySQL server
	
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO co_table (post ,cust) VALUES(?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('ss', $u_from,$u_for); //bind values and execute insert query
	
	$getinfo = "select email from user where  fname='$u_for' ";
	$result = $mysqli->query($getinfo);

	while($row = $result->fetch_assoc()) {
		$u_email = $row['email'];
	}
	if($statement->execute()){
		print "Hello " . $u_from . "!, your message has been saved!";
		
		$to_email = $u_email;
	//	ini_set("SMTP", "smtp.gmail.com");
		$subject = 'Courier';
		$message = 'This mail is sent to inform you that your courier is collected at A building of the pict college so collect it';
		$headers = 'From: divya.agrawal1803@gmail.com';
		mail($to_email,$subject,$message,$headers);
        $message = "email has been send";
        echo "<script type='text/javascript'>alert('$message');</script>";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>