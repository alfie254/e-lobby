<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admin panel</title>
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">elobby Visitor Management System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Admin Panel</a></li>
    </ul>
      </li>   
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="reception.php"><span class="glyphicon glyphicon-off"></span>Receptionist</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php"><span class="glyphicon glyphicon-off"></span>Login as user</a></li>
    </ul>
  </div>
</nav>
<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `administrator` WHERE username='$username' and password='$password'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['username'] = $username;
			header("Location: registration.php"); // Redirect user to index.php
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
    }else{
?>
<div class="container">
	<div class="containeradmin">
	<div class="jumbotron">
		
		<form class="adminform" action="" method="post" name="login">
			<fieldset><legend><h2><h1>Admin Login</h1></legend>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" placeholder="Admin Username" required />
			</div>
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" placeholder="Admin Password" required />
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<input name="submit" type="submit" value="Login" />
				</div>
			</div>
			<fieldset>
		</form>
		
	</div>
</div>
</div>
<?php } ?>


</body>
</html>
