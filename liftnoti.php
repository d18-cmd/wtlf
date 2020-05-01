
session_start();
<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 15px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
The following students have not given the cards back :
<table>
<tr>
<th>Card_id</th>
<th>Card Type</th>
<th>Student_issue_id</th>
<th>Issue_datetime</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM lift WHERE rid_return=' '";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    
echo "<tr><td>" .$row["card_id"]. "</td><td>". $row["ctype"]. "</td><td><a href='liftprofile.php?ans=$row[rid_issue]' target='iframe_abc'>" . $row["rid_issue"] . "</a></td><td>". $row["issue_time"]."</td><td>"."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
<br>
<br>
<br>
<br>
<iframe name="iframe_abc" width="100%" height="300px"  align="bottom">  </iframe>
</body>
</html>