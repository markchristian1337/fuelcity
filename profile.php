<?php
require('connect.php');
include("auth.php");
echo "".$_SESSION['username']."'s profile";



// If form submitted, insert values into the database.
if (isset($_REQUEST['fullname'])){
        // removes backslashes
 $fullname = stripslashes($_REQUEST['fullname']);
        //escapes special characters in a string
 $fullname = mysqli_real_escape_string($con,$fullname); 
 $address = stripslashes($_REQUEST['address']);
 $address = mysqli_real_escape_string($con,$address);
 $address2 = stripslashes($_REQUEST['address2']);
 $address2 = mysqli_real_escape_string($con,$address2);
 $city = stripslashes($_REQUEST['city']);
 $city = mysqli_real_escape_string($con,$city);
 $state = stripslashes($_REQUEST['state']);
 $state = mysqli_real_escape_string($con,$state);
 $zipcode = stripslashes($_REQUEST['zipcode']);
        $query = "UPDATE users SET fullname = '$fullname', address = '$address', address2 = '$address2', city = '$city', state = '$state', zipcode = '$zipcode' WHERE username = '".$_SESSION['username']."'";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>Profile updated successfully.</h3>
<br/><a href='index.php'>Home</a></div>";

        }else{
        	echo "Update Failed";
        }
    }else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Client Profile - Secured Page</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div class="profile">
	<h2 align="center">Manage Your Profile</h2>
		<form class="profile-form">
			<label>
		  Full Name:
		  <input type="text" name="fullname" size="50" required maxlength="50">
		  </label><br>
		  <label>
		  Address:
		  <input type="text" name="address" size="100" required maxlength="100">
		  </label><br>
		  <label>
		  Address 2:
		  <input type="text" name="address2" size="100" maxlength="100">
		  </label><br>
		  <label>
		  City:
		  <input type="text" name="city" size="100" required maxlength="100">
			</label><br>
			<label>
		  State:<br>
			<select name="state" required>
				<option value="" selected disabled hidden>Please select</option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District Of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
			</select>
			</label>
			<br>
			<label>
		  Zipcode:<br>
		  <input type="text" name="zipcode" size="9" required minlength="5" maxlength="9">
		  </label>
		  <br>
		  <button type = "submit">Update</button>
		</form>
	</div>
<p><a href="index.php">Home</a></p>
<a href="logout.php">Logout</a>
</div>
</body>
<?php } ?>
</html>