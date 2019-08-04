<?php

require('connect.php');
include("auth.php");
echo "".$_SESSION['username']."'s Fuel History";

?>

<!DOCTYPE html>
<html>

<head>
<title>Fuel History</title>
	<link rel="stylesheet" href="css/style.css" />
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>

<body>
	<div class="history" style="align-content: center">
	<h2 align="center">Fuel Quote History</h2>
<table style="width:75%" align="center">
  <tr>
    <th>Gallons Requested</th>
    <th>Delivery Address</th> 
    <th>Delivery Date</th>
    <th>Suggested Price (USD)</th>
    <th>Total Amount Due (USD)</th>
  </tr>
  
<?php

$sql = "SELECT gallons, address, date, price, total FROM history WHERE username = '".$_SESSION['username']."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["gallons"]. "</td><td>" . $row["address"]. "</td><td>" . $row["date"]. "</td><td>" .$row["price"]. "</td><td>" .$row["total"]. "</tr>";
    }
} else {
    echo "0 results";
}
echo "</table>"

?>

</table>

<p><a href="index.php">Home</a></p>
<p><a href="quoteform.php">Quote Form</a></p>
<a href="logout.php">Logout</a>

</body>
</html>