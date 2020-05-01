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
font-size: 25px;
text-align: left;
}
th {
background-color: #E9967A;
color: white;
}
tr:nth-child(even) {background-color: #ffb6c1}
</style>
</head>
<body>
<table>
<tr>
<th>Id</th>
<th>Post Name</th>
<th>Reciever Name</th>
<th>Reach at</th>
<th>Taken at</th>

</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "exa");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id,post,cust, n_dt,o_dt FROM co_table";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" .$row["id"]. "</td><td>". $row["post"]. "</td><td>" . $row["cust"] . "</td><td>". $row["n_dt"]."</td><td>". $row["o_dt"]."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>