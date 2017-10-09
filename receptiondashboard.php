<?php

require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Receptionist Dashboard</title>
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
      <li class="active"><a href="#"><?php echo $_SESSION['username']; ?> logged</a></li>
    </ul>
      </li>   
    </ul>
    <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
    </ul>
  </div>
</nav>
    <center><p><?php echo $_SESSION['username']; ?> logged in!</p></center>

<div class="formdash">
<p>Dashboard</p>
<form id ="search" method="post">
    <input type="text" name="search" placeholder="Search Record" /><br>
    <input type="submit" name="sach" value="Search"/>
 </form>

 <?php
  if(isset($_POST['sach']))
    {
        $search= $_POST["search"];
        $ser =mysqli_query($con, "SELECT * FROM visitors WHERE day='$search' OR fname ='$search' OR lname ='$search' OR idnum ='$search' ORDER BY Id DESC");
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
                    echo "  <td><font size=5px><b>Signed out?</td>\n";
                    echo "  <td><font size=5px><b>Signed in by</td>\n"; 
                    echo "  <td><font size=5px><b>Approve</td>\n"; 
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
                        echo "  <td contenteditable='true'>" . $row["sign_out"] ."</td>\n";

                        echo "  <td contenteditable='true'>" . $row["user"] ."</td>\n";
                        echo "  <td bgcolor='teal'><form action='' method='POST'><input type='hidden' name='tempId1' value='".$row["id"]."'/><input type='submit' name='approve' value='Allow' /></form></td>\n";
                        echo "  </tr>\n";
                
                } 
         if(isset($_POST['approve']))
            {
                $ID = $_POST['tempId1']; 
                $query=mysqli_query($con, "UPDATE visitors SET approved = 'Yes' WHERE id='$ID'");  
                //$query=mysqli_query($con, "DELETE fname FROM visitors WHERE id='$ID'");  
                if($query)
                    {   
                        echo "<script type='text/javascript'>alert('Approved Successfully!!')</script>";
                        echo "Success";
                    }
                else{echo "Error";}
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

$user = $_SESSION['username'];

$sq = mysqli_query($con, "SELECT dept FROM  `receptionist` WHERE username='$user'");            //$s = implode(',', $sq);

    if (mysqli_num_rows($sq) > 0)
    {
        while($row = mysqli_fetch_assoc($sq))
         {
           echo "<center><b><h3><font color='white'>"; 
           echo $dep = $row["dept"];  
           echo " Department Receptionist</b></center></h3></font>";   
         }
    }
$sql = "SELECT * FROM visitors WHERE dept='$dep' AND approved='No' ORDER BY Id DESC";

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



$t="SELECT id, fname,lname, trn_date FROM visitors WHERE typ='client'";
$res = $conn->query($t);
 while($row = $res->fetch_assoc())
 {
    echo "<br><br>" .$row["id"]." | ". $row["fname"]." | ".$row["lname"];
        
  } */



if (mysqli_num_rows($result) > 0) {
    echo (' <br><b><h2>'. $result->num_rows. ' Visitors</b></h2>');



                   
                    echo "<table border=1 width='100%' cellspacing=0 >\n";
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
                    echo "  <td><font size=5px><b>Approve</td>\n"; 
                    echo " </tr>\n";


    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       


                        echo " <tr align=center bgcolor='silver' >\n";
                        echo "  <td contenteditable='false'>" . $row["id"] ."</td>\n";
                        echo "  <td contenteditable='false'>".'<img height="80" width="90" src="data:image;base64,'.$row["image"].' "> '."</td>\n";                        
                        echo "  <td contenteditable='true'>" . $row["fname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["lname"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["idnum"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["typ"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["dept"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["staff"] ."</td>\n";
                        echo "  <td contenteditable='true'>" . $row["trn_date"] ."</td>\n";
                        echo "  <td bgcolor='#566573'><form action='' method='POST'><input type='hidden' name='tempId1' value='".$row["id"]."'/><input type='submit' name='approve' value='Allow' /></form></td>\n";
                        echo "  </tr>\n";

    }

  if(isset($_POST['approve']))
        
    
    {
        $ID = $_POST['tempId1']; 
        $query=mysqli_query($con, "UPDATE visitors SET approved = 'Yes' WHERE id='$ID'");  
        //$query=mysqli_query($con, "DELETE fname FROM visitors WHERE id='$ID'");  
        if($query)
            {   
                echo "<script type='text/javascript'>alert('Approved Successfully!!')</script>";
                echo "Success";
            }
        else{echo "Error";}
        
    }


    echo "</table>";
    //$result close();

} else {
    echo "0 results";
}

mysqli_close($conn);

}

?> 

<br><br>

</div>
</body>
</html>
