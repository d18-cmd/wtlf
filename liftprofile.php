<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

.button 
{
  background-color: #1c87c9;
  border: none;
  color: white;
  padding: 20px 34px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 4px 2px;
  cursor: pointer;
  width: 18%;
}

.button:hover {
  background-color:lightskyblue;
  color: white;
}
</style>


</head>
<body>

<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$fname=$lname=$designation=$email=$phone=" ";

if(isset($_GET['ans']) /*you can validate the link here*/)
    {
    $abcd=$_GET['ans']; 
    }

$sql = "SELECT fname,lname,designation,phone,email FROM user WHERE rid='$abcd'";
$result = $conn->query($sql);

if ( $result->num_rows > 0) {

  while($row = mysqli_fetch_array($result))
  {
  ?>

  <div class="row">
  <div class="col-md-12" >
  <center> <h2 style="font:">   PROFILE  </h2> </center>
   </div>
  </div>


  <div class="row">

    <div class="col-md-3" >
      
    </div>
    <div class="col-md-9" style="overflow:auto ">
     
        <div class="row">
        <h4>  <label for="latitude">Name:  </label> <?php echo $row['fname']  . "  "  .$row['lname'] ;?>
          <br>
        </div>
        <div class="row">
        <h4>  <label for="longitude">Designation: </label><?php echo $row["designation"];?>
       
          <!-- <p id="longitude"></p> -->
          <br>
        </div>
        <div class="row">
        <h4>  <label for="type">Phone No: </label> <?php echo $row["phone"];?>
          
          <!-- <p id="type"></p> -->
          <br>
        </div>
        <div class="row">
        <h4> <label for="address">Email: </label> <?php echo $row["email"];?>
          <!-- <p id="address"></p> -->

          <?php

               }} else {
                      echo "Data of $abcd Unavailable";
                 }
             $conn->close();
  
           ?>


          <br>
        </div>
      </div>
    </div>
  </div>
    

<script src="lost.js"></script>
</body>
</html> 
