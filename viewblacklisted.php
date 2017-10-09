<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Blacklist </title>
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet"/>
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
 <center><p>Welcome <?php echo $_SESSION['username']; ?>!</p></center>
<div class="formdash">

    <form id ="search" method="post">
    <input type="text" name="search" placeholder="Search Record" /><br>
    <input type="submit" name="sach" value="Search"/>
 </form>

 <?php
  if(isset($_POST['sach']))
    {
        $search= $_POST["search"];
        $ser =mysqli_query($con, "SELECT * FROM blacklist WHERE  fname ='$search' OR lname ='$search' OR idnumr ='$search' ORDER BY b_id DESC");
        echo (' <br><b><h2>'. $ser->num_rows. 'Records</b></h2>');
            if ($ser->num_rows > 0) {
           echo "<table border=0 width='100%' cellspacing=0 >\n";
                    echo " <tr bgcolor='orange' align=center class=\"heading\" >\n";
                    echo "  <td width=70px><font size=5px><b>Id</td>\n";
                    echo "  <td><font size=5px><b> Image</td>\n";
                    echo "  <td><font size=5px><b>First Name</td>\n";
                    echo "  <td><font size=5px><b>Last Name</td>\n";
                    echo "  <td><font size=5px><b>Id Number</td>\n";
                    echo "  <td><font size=5px><b>Time</td>\n";
                    echo "  <td><font size=5px><b>Comments</td>\n";
                    echo "  <td><font size=5px><b>Delete</td>\n"; 
                    echo " </tr>\n";



    // output data of each row
    while($row = mysqli_fetch_assoc($ser))
     {
       


                      echo " <tr align=center bgcolor='silver' >\n";
                        echo "  <td contenteditable='false'><b>" . $row["b_id"] ."</td>\n";
                        echo "  <td contenteditable='false'>".'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '."</td>\n";                        
                        echo "  <td contenteditable='true'>" . $row["fname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["lname"] ."</td>\n";
                        echo "  <td contenteditable='true'><b>".$row["idnumr"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["trn_date"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["comments"] ."</td>\n";
                        echo "  <td bgcolor='red'><form action='' method='POST'><input type='hidden' name='tempId2' value='".$row["b_id"]."'/><input type='submit' name='submit-btn' value='Unblacklist' /></form></td>\n";
                        echo "  </tr>\n";
                
                } 
                 if(isset($_POST['submit-btn']))
        
    
    {
        $ID = $_POST['tempId2'];
        $query=mysqli_query($con, "DELETE FROM blacklist WHERE b_id='$ID'");  
        if($query){echo "Success";}
        else{echo "Error"or die(mysql_error());}
        
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

$sql = "SELECT * FROM blacklist ORDER BY b_id DESC; ";
$result = $conn->query($sql);


if (mysqli_num_rows($result) > 0) {
     echo (' <br><b><h2>'. $result->num_rows. ' Blacklisted</b></h2>');



                    echo "<table border=0 width='100%' cellspacing=0 >\n";
                    echo " <tr bgcolor='grey' align=center class=\"heading\" >\n";
                    echo "  <td width=70px><font size=5px><b>Id</td>\n";
                    echo "  <td><font size=5px><b> Image</td>\n";
                    echo "  <td><font size=5px><b>First Name</td>\n";
                    echo "  <td><font size=5px><b>Last Name</td>\n";
                    echo "  <td><font size=5px><b>Id Number</td>\n";
                    echo "  <td><font size=5px><b>Time</td>\n";
                    echo "  <td><font size=5px><b>Comments</td>\n";
                    echo "  <td><font size=5px><b>Edit</td>\n";
                    echo "  <td><font size=5px><b>Delete</td>\n"; 
                    echo " </tr>\n";


    // output data of each row
    while($row = mysqli_fetch_assoc($result))
     {
       


                        echo " <tr align=center bgcolor='silver' >\n";
                        echo "  <td contenteditable='false'><b>" . $row["b_id"] ."</td>\n";
                        echo "  <td contenteditable='false'>".'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '."</td>\n";                        
                        echo "  <td contenteditable='true'>" . $row["fname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["lname"] ."</td>\n";
                        echo "  <td contenteditable='true'><b>".$row["idnumr"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["trn_date"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["comments"] ."</td>\n";
                        echo "<td bgcolor='' width='100'>"."<a class='btn btn-primary' href='updateblacklist.php?id=".$row['b_id']."'>"."Edit"."</a>"."</td>\n";
                        echo "  <td bgcolor='brown'><form action='' method='POST'><input type='hidden' name='tempId2' value='".$row["b_id"]."'/><input  type='submit'  name='submit-btn' value='Unblacklist' /></form></td>\n";
                        echo "  </tr>\n";
    }
    if(isset($_POST['submit-btn']))
        
    
    {
        $ID = $_POST['tempId2'];
        $query=mysqli_query($con, "DELETE FROM blacklist WHERE b_id='$ID'");  
        if($query){echo "Success";}
        else{echo "Error"or die(mysql_error());}
        
    }

    echo "</table>";
    //$result close();

} else {
    echo "0 results";
}
echo" <center><a href='printblacklisted.php'><input type ='submit' name='print' value='Print'></a><br><br></center>";
mysqli_close($conn);

}
?>


</div>
<br><br>
</body>
</html>
