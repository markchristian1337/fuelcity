<?php
// Host, username, password, database below
// password empty because localhost
$con = mysqli_connect("localhost","root","","fuel");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>