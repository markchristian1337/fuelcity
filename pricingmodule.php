<?php
require('connect.php');
include("auth.php");
echo "".$_SESSION['username']."'s Pricing Module <br>";

//Define Variables
$Price = 1.50;
$Profit = .1;
$Address = $_SESSION['address'];
$Username = $_SESSION['username'];

//Get values from AJAX call in quote form

$Gallons = 1500; //$_REQUEST['Gallons'];
$Month = 2; //$_REQUEST['Month'];

//Variables to be set and calculated
$State = getState($con,$Username);
$Transportation = calculateTransportation($State);
$Season = calculateSeason($Month);
$RequestFactor = calculateRequestFactor($Gallons);
$History = calculateHistory($Username, $con);
$suggestedPrice = calculatePrice($Price,$Transportation,$History,$RequestFactor,$Profit,$Season);
$Total = calculateTotal($suggestedPrice, $Gallons);
$Values = array($suggestedPrice,$Total);

//return values to quote form
echo json_encode(array("a" => $suggestedPrice, "b" => $Total));

//Calculate location factor
function calculateTransportation($State)
{
	if($State == 'TX')
		return 0.02; //echo "yee haw<br>";
	else
		return 0.04; //echo "You ain't from around here<br>";
}

function calculateHistory($Username, $con)
{
	$sql = "SELECT id FROM history WHERE username = '$Username'";
	$result = mysqli_query($con,$sql);

	//if history exists
	if (mysqli_num_rows($result))
		return .01; //echo "quote history exists";
	else
		return 0.0; //echo "no quote history";
}

//calculate season factor
function calculateSeason($Month)
{
	$szn = array(0,0.03,0.03,0.04,0.04,0.04,0.04,0.04,0.04,0.03,0.03,0.03,0.03);
	return $szn[$Month];
}

//calculate amount factor
function calculateRequestFactor($Gallons)
{
	if($Gallons > 1000)
		return .02;
	else
		return .03;
}

//Retreive client state from database
function getState($con, $Username)
{
	$sql = "SELECT * FROM users WHERE username = '$Username'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$value = $row["state"];
	return $value;
}

function calculatePrice($Price,$Transportation,$History,$RequestFactor, $Profit, $Season)
{
	return ($Price + ($Transportation - $History + $RequestFactor + $Profit + $Season) * $Price);
}

function calculateTotal($suggestedPrice,$Gallons)
{
	return $suggestedPrice * $Gallons;
}

?>