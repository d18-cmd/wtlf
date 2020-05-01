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
<th>Id</th>
<th>Inid</th>
<th>Intime</th>
<th>Key</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id,in_id,in_time, kno FROM k_table WHERE out_id=' '";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" .$row["id"]. "</td><td><a href='keyprofile.php?ans1=$row[in_id]' target='iframe_abcd'>". $row["in_id"]. "</a></td><td>" . $row["in_time"] . "</td><td>". $row["kno"]."</td></tr>";
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
<iframe name="iframe_abcd" width="100%" height="300px"  align="bottom">  </iframe>
</body>
</html>