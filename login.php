<!DOCTYPE html>
<html>
  <head>
    <title>PICT</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="login.js"></script>


  <style>
.error {color: #FF0000;}
</style>
  </head>

  <?php
// define variables and set to empty values

$rid1 = $pass1 = $riderr = $passerr = " ";


$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "exa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['submit'] =='Login') {

  if (empty($_POST["rid1"])) {
    $riderr = "* Name is required";
  } else {
    $rid1 = test_input($_POST["rid1"]);
     
  }
  
  if (empty($_POST["pass1"])) {
    $passerr = " * Password is required";
  } else {
    $pass1 = test_input($_POST["pass1"]);
  
  }
  // echo "<script type='text/javascript'>alert('ALERTTTTTT1');</script>";
  if($pass1=='1234')
  {

    // echo "<script type='text/javascript'>alert('ALERTTTTTT2  $pass1    $rid1');</script>";

    $sql = "SELECT * FROM login WHERE rid='$rid1'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      session_start();
       $_SESSION['profileid']= $rid1;
      header("Location:index.html");
    } 
    else 
    {
      //  echo "0 results";
    }
  }
  
  $conn->close();
  

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>

<body style="background-color:rgb(233, 248, 192)">
  <div class="row" >
 <br>
 <br>
 <br><br>
 <br>
  </div>
  <div class="row" >
    <div class="col-md-2">
        
    </div>
    <div class="col-md-8">
        
        <div class="card" style="width: 100%;  height:auto ">
           <div class="row" style="padding: 5%; ">
            
            <div class="col-md-7">
                <img src="1.jpg" width=100% height=100%>
            </div>
            <div class="col-md-5" >
              
                 <div class="card1" style="width: 100%; height:auto">
                   
                <center><img class="card-img-top" src="PICT-Logo.jpg" alt="Card image cap" style="width:25%"></center>
              <div class="card-body">
                <h5 class="card-title" ><center><h3>Sign in</h3></center></h5>
                <p class="card-text">

                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="text" id="name" name="rid1" placeholder="College id"><br>
                    <span class="error"><?php echo $riderr;?></span>
                     
                    <input type="password" id="password" name="pass1" placeholder="Password" >
                    <br>      
                    <span class="error"><?php echo $passerr;?></span>
                    <br><br>
                    <center><input type="submit" value="Login" name="submit" class="btn btn-success" style="width:50%" > </center>          
                    <!-- <center><a class="btn btn-success" onclick="func()">Login</a></center> -->

                  </form>

                </div>
            </div>
          

           </div>
      </div>
    </div>
    </div>
    <div class="col-md-2">
        
    </div>
  </div>
</body>
</html>