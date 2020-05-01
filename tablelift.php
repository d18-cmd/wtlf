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
<table>
<tr>
<th>Card_id</th>
<th>Card Type</th>
<th>Student_issue_id</th>
<th>Issue_datetime</th>
<th>Student_return_id</th>
<th>Return_datetime</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM lift";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" .$row["card_id"]. "</td><td>". $row["ctype"]. "</td><td>" . $row["rid_issue"] . "</td><td>". $row["issue_time"]."</td><td>". $row["rid_return"]."</td><td>".$row["return_time"] ."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>