<?php
require('connect.php');
include("auth.php");
echo "".$_SESSION['username']."'s Quote Form";

$username = $_SESSION['username'];
$address = $_SESSION['address'];

// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){

 $Gallons = $_POST['Gallons'];
 $date = $_POST['deliverydate'];
 $price = $_POST['price'];
 $total = $_POST['total'];
        $query = "INSERT into `history` (username, gallons, address, date, price, total)
VALUES ('$username', '$Gallons', '$address', '$date', '$price', '$total')";
        $result = mysqli_query($con,$query);
    }
   
?>


<!DOCTYPE html>
<html>


<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<title>Fuel Quote</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="quote" style="align-content: center">
	<h2 align="center">Fuel Quote Form</h2>
		<form method="post" class="quote-form" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>
	  Gallons Requested:
	  <input type="number" id="Gallons" name="Gallons" required>
	  </label><br>
	  <label>
	  <!-- session variable for address -->
	  Delivery Address: <input type="text" id=deliveryaddress name="deliveryaddress" value="<?php echo $_SESSION['address']?>" readonly>
	  </label><br>
	  <label>
	  Delivery Date:
	<input type="date" id="date" name="deliverydate" required="">
	  </label><br>
	  <label>
	  Suggested Price (USD):
	  <input type="number" id="SPrice" name="price" readonly required>
	  </label><br>
	  <!-- script to multiple on html page <label>
	  <input type="button" onClick="multiplyBy()" Value="Calculate" />
	  </label><br> -->
	  <label>
	  Total Amount Due (USD):
	 <!-- <span id = "total"></span> -->
	 <input type="text" id="TPrice" name="total" required readonly>
	  </label><br>
	  <button type="button" id="Price">Get Price</button>
	  <input type="submit" value="Submit Quote">
		</form>
	</div>

<!--
	Simple script to multiply on html page
	<script>
	function multiplyBy(){
        num1 = document.getElementById("quantity").value;
        num2 = document.getElementById("price").value;
        document.getElementById("total").innerHTML = num1 * num2;
        document.getElementById("total").innerHTML = Number(document.getElementById("total").innerHTML).toFixed(2);
	}
	</script>
-->

<p><a href="index.php">Home</a></p>
<a href="logout.php">Logout</a>
</body>
</html>

<script type="text/javascript">
	
	function post()
	{
		alert("working");
	}

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#Price").click(function(e){
			//alert(e.type);
			var Gal = $(Gallons).val();
			var Date = $(date).val();
			//if(Gal !== '' && Date !== '')
			//{
				var Month = Date.substring(5,7);
				if(Month.charAt(0) == '0')
				{
					Month = Month.substring(1);
				}
				$.ajax({
					url: "pricingmodule.php",
					type: "POST",
					dataType: "json",
					data: {Gallons : Gal,
						Month : Month },
					success: function (response) {
						get response from php page
						//$("#SPrice").val(response.a);
						$("#TPrice").val(response.b);
						console.log("Done");
					},
					error: function()
					{
						console.log("Failed");
					}
				});
			//}
		});
	});

</script>