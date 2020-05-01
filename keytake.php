<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//mysql credentials
	$mysql_host = "localhost:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "exa";
	
	$u_inid =strtoupper(filter_var($_POST["in_id"], FILTER_SANITIZE_STRING));
	$u_key = strtoupper(filter_var($_POST["kno"], FILTER_SANITIZE_STRING)); 
	

	if (empty($u_inid)){
		die("Please enter college id");
	}
	if (empty($u_key)){
		die("Please enter the key id");
	}

	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	$check="select in_time,out_time from k_table where kno='$u_key' ORDER BY out_time LIMIT 1";      //check the latest entry
	$result1 = $mysqli->query($check); 
	if(mysqli_num_rows($result1) == 0) {               //THE KEY HAS NOT BEEN ISSUED EVEN ONCE

	   $check2="select * from k_authority where kno='$u_key'";   //check if it has an authority
		$result2 = $mysqli->query($check2);
		
		if(mysqli_num_rows($result2) == 0) {   //KEY DOES NOT HAVE ANY AUTHORITY
		   
			$query = "INSERT IGNORE INTO k_table(in_id,kno) VALUES('$u_inid', '$u_key')";
			$result = mysqli_query($mysqli, $query) or die('Error querying database.');
			echo "Key Added";

		
		}    
		else     //KEY HAS AUTHORITY 
		 {
			$check3="select * from k_authority where kno='$u_key' AND rid='$u_inid' ";   //check if it is the same person
			$result3 = $mysqli->query($check3);
			if(mysqli_num_rows($result3) == 0)   //NOT THE PERSON ASSIGNED TO COLLECT
			 {
			  echo '<script>alert("YOU ARE NOT ALLOWED TO ISSUE THE KEY")</script>';

			}
			else    //IS THE SAME PERSON ASSIGNED TO COLLECT
			{
			  $query = "INSERT IGNORE INTO k_table(in_id,kno) VALUES('$u_inid', '$u_key')";
			  $result = mysqli_query($mysqli, $query) or die('Error querying database.');
			  echo "Key Added";
			}

			
		 }
		 mysqli_close($mysqli);
	}
else{    //KEY HAS BEEN ISSUED BEFORE

	while($row = $result1->fetch_assoc()) {
		$u_intime = $row['in_time'];
		$u_outtime = $row['out_time'];
	
   if($u_intime>0 && $u_outtime==0) {         //THE KEY HAS ZERO OUTTIME I.E. IT IS NOT AVAILABLE
    echo '<script>alert("Key already taken")</script>';
   } 
    else {   ////KEY IS AVAILABLE

		$check2="select * from k_authority where kno='$u_key'";   //check if it has an authority
		$result2 = $mysqli->query($check2);
		
		if(mysqli_num_rows($result2) == 0) {   //KEY DOES NOT HAVE ANY AUTHORITY
		   
			$query = "INSERT IGNORE INTO k_table(in_id,kno) VALUES('$u_inid', '$u_key')";
			$result = mysqli_query($mysqli, $query) or die('Error querying database.');
			echo "Key Added";

		
		}    
		else     //KEY HAS AUTHORITY 
		 {
			$check3="select * from k_authority where kno='$u_key' AND rid='$u_inid' ";   //check if it is the same person
			$result3 = $mysqli->query($check3);
			if(mysqli_num_rows($result3) == 0)   //NOT THE PERSON ASSIGNED TO COLLECT
			 {
			  echo '<script>alert("YOU ARE NOT ALLOWED TO ISSUE THE KEY")</script>';

			}
			else    //IS THE SAME PERSON ASSIGNED TO COLLECT
			{
			  $query = "INSERT IGNORE INTO k_table(in_id,kno) VALUES('$u_inid', '$u_key')";
			  $result = mysqli_query($mysqli, $query) or die('Error querying database.');
			  echo "Key Added";
			}

			
		 }
    }
	
	}
}
}
?>