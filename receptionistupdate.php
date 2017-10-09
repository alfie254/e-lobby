<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Security Guards</title>
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">e-lobby Visitor Management System</a>
    </div>
    <ul class="nav navbar-nav">
     <li class="active"><a href="#"><?php  echo $_SESSION['username']; ?> logged</a></li>
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
       <li><a href="reg_receptionist.php"><span class="glyphicon glyphicon-off"></span>Add Receptionist</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li class="active"><a href="registration.php"><span class="glyphicon glyphicon-off"></span> Add Security</a></li>
    </ul>

  </div>
</nav>
<div class="container">

<?php 

if(isset($_GET['id']))
{
   $id=$_GET['id'];

  $sql="SELECT * FROM users WHERE id=$id";
  $result=mysqli_query($con,$sql);

  $row=mysqli_fetch_assoc($result);

}
?>


<div class="container">
  <div class="containeradmin">
  <div class="jumbotron">
    
    <form class="adminform" action="" method="post" name="login">
      <fieldset><legend><h2><h2>Update Receptionist</h2></legend>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" name="email" placeholder="email address" required />
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
          <input type="submit" name="push" value="Update" />
        </div>
      </div>
      <fieldset>
    </form>   
  </div>
   
</div>
</div>
<?php
if (isset($_POST['push'])) {

 $username = stripslashes($_REQUEST['username']); // removes backslashes
    $username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    $dept = stripslashes($_REQUEST['dept']);
    $dept = mysqli_real_escape_string($con,$dept);
  echo $id; 

  $query="UPDATE receptionist SET username='$username', email='$email', dept='$dept', password='".md5($password)."' WHERE id='$id'";
  $result=mysqli_query($con,$query);
  
  if($result)
  {
    
                //header("location:viewdoctors.php");
                echo "<script type='text/javascript'>alert('Your update was successful!!'); document.location.href = 'viewreceptionist.php';</script>";
  }

  
}

?>

  
</div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>

