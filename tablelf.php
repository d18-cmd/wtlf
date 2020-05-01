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
font-size: 20px;
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
<th>Place</th>
<th>Thing</th>
<th>Intime</th>
<th>Outid</th>
<th>Outtime</th>
<th>Image</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id,in_id, user_place,user_thing ,dt,out_id,out_dt,image FROM users_data";
$result = $conn->query($sql);
if ($result->num_rows  > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" .$row["id"]. "</td><td>". $row["in_id"]. "</td><td>" . $row["user_place"]."</td><td>". $row["user_thing"]."</td><td>".$row["dt"] ."</td><td>".$row["out_id"] ."</td><td>".$row["out_dt"]."</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200"/>'."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>