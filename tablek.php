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
<th>Outid</th>
<th>Outtime</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id,in_id,in_time, kno,out_id,out_time FROM k_table";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" .$row["id"]. "</td><td>". $row["in_id"]. "</td><td>" . $row["in_time"] . "</td><td>". $row["kno"]."</td><td>". $row["out_id"]."</td><td>".$row["out_time"] ."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>