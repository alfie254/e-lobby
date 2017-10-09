<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update staff</title>
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="registration.php"class="navbar-brand">e-lobby Visitor Management System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><?php echo $_SESSION['username']; ?> logged</a></li>
    </ul>
      </li>
      </li>  
       <ul class="nav navbar-nav navbar-right">
       <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li  class="active"><a href="blacklist.php"><span class="glyphicon glyphicon-off"></span> Blacklist</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
       <li><a href="staff.php"><span class="glyphicon glyphicon-off"></span> Add Staff</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="deleted.php"><span class="glyphicon glyphicon-off"></span> Deleted Visitors</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="dashboard.php"><span class="glyphicon glyphicon-off"></span>view signed </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li><a href="viewsecurity.php"><span class="glyphicon glyphicon-off"></span> View Security</a></li>
    </ul>


  </div>
</nav>
<div class="container">

<?php 

if(isset($_GET['id']))
{
   $id=$_GET['id'];

  $sql="SELECT * FROM staff WHERE staff_id=$id";
  $result=mysqli_query($con,$sql);

  $row=mysqli_fetch_assoc($result);

}
?>


    <div class="indexform">
        <div class="jumbotron">
           <form id ="details" method="post" action="" enctype="multipart/form-data">
           <fieldset><legend><h2><b>Visitor Details</b></h2></legend>
                <center><input type="file" name="image"/> </center>   
                <input size="3" type="hidden" name="user" value="<?php echo $_SESSION['username']; ?>" readonly="readonly"/><br> 
                <label>First Name</label>       
                <input type="text" name="fname" placeholder="First Name" required /><br>
                <label>Last Name</label> 
                <input type="text" name="lname" placeholder="Last Name" required /><br>
                <label>ID Number</label> 
                <input type="text" name="idnumr" placeholder="Id Number" required /><br><br>
                <label>Comments</label> 
                <textarea rows="4" cols="40" name="comments" value="Id Number"> </textarea><br> 
                <input type="submit" name="push" value="Update"/>    
                </fieldset>                
    </form> 
    </div>
  
    </div>
<?php
if (isset($_POST['push'])) {


                        $image= addslashes($_FILES['image']['tmp_name']);
                        $name= addslashes($_FILES['image']['name']);
                        $image= file_get_contents($image);
                        $image= base64_encode($image);
                        $fname= $_POST["fname"];
                        $lname= $_POST["lname"];                        
                        $idnumr= $_POST["idnumr"];
                        $comments= $_POST["comments"];
                        $trn_date = date("Y-m-d H:i:s");

  $query="UPDATE blacklist SET fname='$fname', lname='$lname', idnumr='$idnumr', image='$image', comments='$comments' WHERE b_id='$id'";
  $result=mysqli_query($con,$query);
  
  if($result)
  {
    
                //header("location:viewdoctors.php");
                echo "<script type='text/javascript'>alert('Your update was successful!!'); document.location.href = 'viewblacklisted.php';</script>";
  }
else{echo"Failed to update";}
  
}

?>

  
</div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>

