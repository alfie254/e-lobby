<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>
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
       <li   class="active"><a href="deleted.php"><span class="glyphicon glyphicon-off"></span> Deleted Visitors</a></li>
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
       <li><a href="registration.php"><span class="glyphicon glyphicon-off"></span> Add Security</a></li>
    </ul>

  </div>
</nav>
<p><?php echo $_SESSION['username']; ?> logged in!<center><p></p></center>
</p>
<div class="formdash">
<p><a href="index.php">Home</a></p>

<form id ="search" method="post">
    <input type="text" name="search" placeholder="Search Record" /><br>
    <input type="submit" name="sach" value="Search"/>
 </form>

 <?php
  if(isset($_POST['sach']))
    {
        $search= $_POST["search"];
        $ser =mysqli_query($con, "SELECT * FROM deleted_visitor WHERE user='$search' OR fname ='$search' OR lname ='$search' OR idnum ='$search' ORDER BY Id DESC");
        echo (' <br><b><h2>'. $ser->num_rows. ' Records</b></h2>');
            if ($ser->num_rows > 0) {
            echo "<table border=0 width='100%' cellspacing=0 >\n";
                    echo " <tr bgcolor='orange' align=center class=\"heading\" >\n";
                    echo "  <td width=70px><font size=5px><b>Id</td>\n";
                    echo "  <td><font size=5px><b> Image</td>\n";
                    echo "  <td><font size=5px><b>First Name</td>\n";
                    echo "  <td><font size=5px><b>Last Name</td>\n";
                    echo "  <td><font size=5px><b>Id Number</td>\n";
                    echo "  <td><font size=5px><b>Type</td>\n";
                    echo "  <td><font size=5px><b>Department</td>\n";
                    echo "  <td><font size=5px><b>Staff</td>\n";
                    echo "  <td width=90px><font size=5px><b>Time</td>\n";
                    echo "  <td><font size=5px><b>Approved</td>\n";
                    echo "  <td><font size=5px><b>Deleted By</td>\n";
                    echo "  <td><font size=5px><b>Delete</td>\n"; 
                    echo " </tr>\n";


    // output data of each row
    while($row = mysqli_fetch_assoc($ser))
     {
       


                        echo " <tr align=center bgcolor='white' >\n";
                        echo "  <td contenteditable='false'><b>" . $row["id"] ."</td>\n";
                        echo "  <td contenteditable='false'>".'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '."</td>\n";                        
                        echo "  <td contenteditable='true'>" . $row["fname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["lname"] ."</td>\n";
                        echo "  <td contenteditable='true'><b>" . $row["idnum"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["typ"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["dept"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["staff"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["trn_date"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["approved"] ."</td>\n";

                        echo "  <td contenteditable='true'>" . $row["user"] ."</td>\n";
                        echo "  <td bgcolor='teal'><form action='' method='POST'><input type='hidden' name='tempId2' value='".$row["id"]."'/><input type='submit' name='submit-btn' value='Delete' /></form></td>\n";
                        echo "  </tr>\n";
                
                } 
        } else {
            echo "0 results";
        }
        }

                    
   else{     
    
// Create connection
$conn = new mysqli("localhost", "root", "" , "register");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Create connection
$conn = new mysqli("localhost", "root", "" , "register");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM deleted_visitor ORDER BY Id DESC; ";
$result = $conn->query($sql);

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<br><br>" . $row["id"].'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '.$row["fname"]. " " . $row["lname"]. " | ".$row["idnum"]. " | ".$row["typ"]. " | ".$row["dept"]. " | ".$row["staff"] . " | ".$row["trn_date"]	;
         ;
        
        } 
} else {
    echo "0 results";
}
*/

if (mysqli_num_rows($result) > 0) {
     echo (' <br><b><h2>'. $result->num_rows. ' Deleted visitors</b></h2>');



                    echo "<table border=0 width='100%' cellspacing=0 >\n";
                    echo " <tr bgcolor='grey' align=center class=\"heading\" >\n";
                    echo "  <td width=70px><font size=5px><b>Id</td>\n";
                    echo "  <td><font size=5px><b> Image</td>\n";
                    echo "  <td><font size=5px><b>First Name</td>\n";
                    echo "  <td><font size=5px><b>Last Name</td>\n";
                    echo "  <td><font size=5px><b>Id Number</td>\n";
                    echo "  <td><font size=5px><b>Type</td>\n";
                    echo "  <td><font size=5px><b>Department</td>\n";
                    echo "  <td><font size=5px><b>Staff</td>\n";
                    echo "  <td width=90px><font size=5px><b>Time</td>\n";
                    echo "  <td width=90px><font size=5px><b>Deleted By</td>\n";
                    echo "  <td><font size=5px><b>Delete</td>\n"; 
                    echo " </tr>\n";


    // output data of each row
    while($row = mysqli_fetch_assoc($result))
     {
       


                        echo " <tr align=center bgcolor='silver' >\n";
                        echo "  <td contenteditable='false'><b>" . $row["id"] ."</td>\n";
                        echo "  <td contenteditable='false'>".'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '."</td>\n";                        
                        echo "  <td contenteditable='true'>" . $row["fname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["lname"] ."</td>\n";
                        echo "  <td contenteditable='true'><b>" . $row["idnum"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["typ"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["dept"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["staff"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["trn_date"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["user"] ."</td>\n";
                        echo "  <td bgcolor='#566573'><form action='' method='POST'><input type='hidden' name='tempId2' value='".$row["id"]."'/><input type='submit' name='submit-btn' value='Delete' /></form></td>\n";
                        echo "  </tr>\n";
	}
    if(isset($_POST['submit-btn']))
        
    
    {
        $ID = $_POST['tempId2'];    
        //$query=mysqli_query($con, "UPDATE visitors SET * = contenteditable' WHERE id='$ID'");  
        //$sql=mysqli_query($con, "UPDATE visitors SET approved = 'Yes' WHERE id='$ID'");


       
        $query=mysqli_query($con, "DELETE FROM deleted_visitor WHERE id='$ID'");  
        if($query)
            {   echo "<script type='text/javascript'>alert('Deleted successfully!!')</script>";
                echo "Success";
            }
        else{echo "Error"or die(mysql_error());}
        
    }
    echo "</table>";
    //$result close();

} else {
    echo "0 results";
}

mysqli_close($conn);
}

?>


</div>
</body>
</html>
