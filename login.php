<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MyBicycle: Login</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style>
  	
  		.button {
  			background-color: black;
		    border: none;
		    color: white;
		    border-radius: 6px;
		    padding: 15px 32px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 18px;
		    margin: 4px 2px;
		    cursor: pointer;
  		}  		
  	</style>
  	<style>
		.center {
		    display: block;
		    padding-top: 10px;
		    margin-left: auto;
		    margin-right: auto;
		    width: 30%;

		}

	</style>
<style>
label{
	color: white;

	font-size: 18px;
}
</style>

<!--<link rel="stylesheet" href="css/style.css" />-->
</head>
<body>
	<style>
	body{
		margin:0;
		background-color: #FFFFFF;
		background-image: url("bg1.jpg") ;
        background-size: 100%;

	}
	</style>
	
<?php
	include("db.php");
	session_start();
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If form submitted, insert values into the database.
    if (isset($_POST['username1'])){
		
		$username = stripslashes($_REQUEST['username1']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password1']);
		$password = mysqli_real_escape_string($con,$password);
		
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `tbl_staffs_a169167_pt2final` WHERE fld_staff_email='$username' and fld_staff_password='".($password)."'";
        $query2 = "SELECT * FROM `tbl_staffs_a169167_pt2final` WHERE fld_staff_email='$username' and fld_staff_password='".($password)."'";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);
		$level0 = mysqli_fetch_all($result);

		$statement = $conn -> prepare($query2);
        $statement -> execute();
        $result2 = $statement -> fetch();
        if($rows==1){
        	if(!empty($result2)){
			$_SESSION['username1'] = $username;
			//$_SESSION['userlevel'] = $level0[0][5];
			$_SESSION['name1'] =$result2["fld_staff_name"];
			$_SESSION['position1'] =$result2["fld_staff_position"];
			header("Location: index.php"); // Redirect user to index.php
		}
            }else{
            	echo "<script>alert('Username/password is incorrect.');
						window.location.href='login.php';  
					  </script>";            	
				}
    }else{
?>

<div class="container-fluid">
	 <div class="row">	  	
	   <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
	    	<center>
	    	<img src="logo2.png" width="30%" class="img-responsive">
	    </center>
	    <div class="page-header">
	        <h2 style="color:white;">Please Login</h2>
	    </div>

		<form action="login.php" method="post" class="form-horizontal" name="login">
	    	<div class="form-group">
				<label for = "username"  class="col-sm-3 control-label">Username:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username1" name="username1"  placeholder = "Enter Username" required autofocus />
				</div>
			</div>
			<div class="form-group">
				<label for = "password" class="col-sm-3 control-label">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password1" name="password1" placeholder = "Enter Password" required />
				</div>
			</div>
			<div class = "form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button class="button btn-primary" name="submit" type="submit">Login</a>
				</div>
			</div>
		</form>
	</div>
</div>	
<?php } ?>
</body>
</html>