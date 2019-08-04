<?php
//include auth.php file on all secure pages
include("auth.php");
require('connect.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>
<?php

// printing profile information on home page
$sql = "SELECT fullname, address, address2, city, state, zipcode FROM users WHERE username = '".$_SESSION['username']."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // print data of each row
    while($row = $result->fetch_assoc()) {
        echo "Full Name: " . $row["fullname"]. "<br> Address: " . $row["address"]. "<br> Address 2: " . $row["address2"]. "<br> 
        City: " .$row["city"]. "<br> State: " .$row["state"]. "<br> Zipcode: " .$row["zipcode"]. "<br>";
        //assigning session variables
        foreach ($row as $key => $value) {
        	if(is_string($key)){
        		$_SESSION[$key] = $value;
        		//echo "$_SESSION[$key]";
        	}
        }
    }
} else {
    echo "0 results";
}
?>
<p><a href="profile.php">Profile</a></p>
<p><a href="history.php">Quote History</a></p>
<p><a href="quoteform.php">Quote Form</a></p>
<a href="logout.php">Logout</a>
</div>
</body>
</html>