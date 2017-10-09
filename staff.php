<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Staff</title>
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
       <li  class="active"><a href="staff.php"><span class="glyphicon glyphicon-off"></span> Add Staff</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="reg_receptionist.php"><span class="glyphicon glyphicon-off"></span>Add Receptionist</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="registration.php"><span class="glyphicon glyphicon-off"></span> Add Security</a></li>
    </ul>

  </div>
</nav>


<div class="container">
    <div class="containeradmin">
    <div class="jumbotron">

<form class="adminform" action="" method="post" name="red">
     <fieldset><legend><h2><h2>Sfaff portal</h2></legend>
        <div class="form-group">
                <label for="username">First Name</label>
                <input type="text" name="fname" placeholder="First Name" required />
        </div>
  
        <div class="form-group">
                <label for="username">Last Name</label>
                <input type="text" name="lname" placeholder="Last Name" required />
        </div>
           <div class="form-group">
                <label for="username">Email</label>
               <input type="email" name="mail" placeholder="Email" required />
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
                <label for="username">Extension</label>
                <input type="text" name="extension" placeholder="Extension Number" required />
        </div>            
    
    <input type="submit" name="submit" value="Register" />
</form>

</div>
 
<?php
     require('db.php');


            if(isset($_POST['submit']))
                {
                   	$fname= $_POST["fname"];                        
					$lname= $_POST["lname"];
                    $mail= $_POST["mail"];
					$dept= $_POST["dept"];
					$extension= $_POST["extension"];
                    $trn_date = date("Y-m-d H:i:s");
					           		
					$query = "INSERT into `staff` (fname, lname, email, dept, extension, trn_date ) VALUES ('$fname', '$lname', '$mail', '$dept', '$extension', '$trn_date')";
                    $result = mysqli_query($con,$query);

                        if($result)
	                        {
                               echo "<script type='text/javascript'>alert('Details Uploaded.!!')</script>";
	                           echo "<br/> Details Uploaded.";
	                        }
                        else
	                        {
                                echo "<script type='text/javascript'>alert('Failed to Upload Details.!!')</script>";
	                            echo "<br/> Failed to Upload Details.";
	                        }
                }
                


    require('db.php');
    // If form submitted, insert values into the database.
?>
 <center><a href="viewstaff.php"><input type ="submit" name="View" value="View Staff"></a></center><br><br>
</div>
</body>
</html>
