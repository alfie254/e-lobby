<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<style type="text/css">
.jumbotron{padding-top:30px;padding-bottom:50px;margin-bottom:30px;color:inherit;background-color:#999}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">e-lobby Visitor Management System</a>
    </div>
    <ul class="nav navbar-nav">
     <li class="active"><a href="#"><?php include("auth.php"); echo $_SESSION['username']; ?> logged</a></li>
    </ul>
     <ul class="nav navbar-nav">
     <li class="active"><a href="registration.php">Home</a></li>
    </ul>
      </li>   
    </ul>
       <ul class="nav navbar-nav navbar-right">
       <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="blacklist.php"><span class="glyphicon glyphicon-off"></span> Blacklist</a></li>
    </ul>    
    <ul class="nav navbar-nav navbar-right">
       <li><a href="deleted.php"><span class="glyphicon glyphicon-off"></span> Deleted Visitors</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="dashboard.php"><span class="glyphicon glyphicon-off"></span>view signed </a></li>
    </ul> 
    <ul class="nav navbar-nav navbar-right">
       <li><a href="staff.php"><span class="glyphicon glyphicon-off"></span> Add Staff</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li  class="active"><a href="reg_receptionist.php"><span class="glyphicon glyphicon-off"></span>Add Receptionist</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="registration.php"><span class="glyphicon glyphicon-off"></span> Add Security</a></li>
    </ul>

  </div>
</nav>

  </div>
</nav>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
    $dept = stripslashes($_REQUEST['dept']);
    $dept = mysqli_real_escape_string($con,$dept);
		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `receptionist` (username, email, password, dept, trn_date) VALUES ('$username',  '$email','".md5($password)."', '$dept', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/></div>";
        }
    }else{
?><br><br>
<div class="container">
	<div class="containeradmin">
	<div class="jumbotron">
		
		<form class="adminform" action="" method="post" name="login">
			<fieldset><legend><h2><h2>Register Receptionist</h2></legend>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" placeholder="Username" required />
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Email</label>
				<input type="email" name="email" placeholder="email address" required />
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" placeholder="Password" required />
			</div>
       <div class="form-group">
     <select name="dept" required> 
                   <option value=""> ---Select Department--- </option>
                    <?php
                        require('db.php');
                        $sql = mysqli_query($con, "SELECT name FROM department");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_array($sql))
                            {
                                echo "<option value='". $row[ 'name' ] ."'>" .$row['name' ] . "</option>" ;
                            }
                    ?>       
            </select><br> 
            </div>
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" name="submit" value="Register" />
				</div>
			</div>
			<fieldset>
		</form>
		
	</div>
  <center><a href="viewreceptionist.php"><input type ="submit" name="View" value="View Receptionist"></a></center>
</div>
</div>

<?php } ?>
</body>
</html>
