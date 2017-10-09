<?php

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<style type="text/css">
.jumbotron{padding-top:30px;padding-bottom:50px;margin-bottom:30px;color:inherit;background-color:#7076E6}
.indexform{
  width:100%;
    margin: 0 auto;
    border: 10px;
    padding: 30px;
    background-color: #111;
}
</style>
    <title>BLACKLIST</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    
    <style>
        #camera_wrapper, #show_saved_img{float:left; width: 340px;}
    </style>
    <script type="text/javascript" src="scripts/jquery.js"></script>    
    <script type="text/javascript" src="scripts/webcam.js"></script>
    <script>
        $(function(){
            //give the php file path
            webcam.set_api_url( 'saveimage.php' );
            webcam.set_swf_url( 'scripts/webcam.swf' );//flash file (SWF) file path
            webcam.set_quality( 100 ); // Image quality (1 - 100)
            webcam.set_shutter_sound( true ); // play shutter click sound
            
            var camera = $('#camera');
            camera.html(webcam.get_html(320, 240)); //generate and put the flash embed code on page
            
            $('#capture_btn').click(function(){
                //take snap
                webcam.snap();
                $('#show_saved_img').html('<h3>Please Wait...</h3>');
            });
            

            //after taking snap call sahow image
            webcam.set_hook( 'onComplete', function(img){
                $('#show_saved_img').html('<img src="' + img + '">');
                //reset camera for the next shot
                webcam.reset();
            });
            
        });
    </script>
<link href="css/slidefolio.css" rel="stylesheet">
 <link href="css/bootstrap.css" rel="stylesheet">
</head>


<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">e-lobby Visitor Management System</a>
    </div>
    <ul class="nav navbar-nav">
     <li class="active"><a href="#"><?php echo $_SESSION['username']; ?> logged</a></li>
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
       <li  class="active"><a href="blacklist.php"><span class="glyphicon glyphicon-off"></span> Blacklist</a></li>
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
       <li><a href="registration.php"><span class="glyphicon glyphicon-off"></span> Add Security</a></li>
    </ul>

  </div>
</nav>



    <center><p>Welcome <?php echo $_SESSION['username']; ?>!</p></center>

<div id="container">
    <div class="cameras">    
        <div class="camera" id="camera_wrapper">
            <div id="camera"></div>
            <button id="capture_btn">Capture</button>
        </div>  
        <div class="showcamera" id="show_saved_img" ></div> 
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="indexform">
        <div class="jumbotron">
           <form id ="details" method="post" action="" target="blank" enctype="multipart/form-data">
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
                <input type="submit" name="sumit" value="Blacklist"/>    
                </fieldset>                
    </form> 
    </div>
     <center><a href="viewblacklisted.php"><input type ="submit" name="View" value="View Blacklisted"></a></center><br><br>
    </div>
    </div>     
       

 

    <?php
     require('db.php');                  


            if(isset($_POST['sumit']))
                {              

                     if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
                    {
                        echo("Please select an image.");
                    }
                    else
                    {
                        $image= addslashes($_FILES['image']['tmp_name']);
                        $name= addslashes($_FILES['image']['name']);
                        $image= file_get_contents($image);
                        $image= base64_encode($image);
                        $fname= $_POST["fname"];
                        $lname= $_POST["lname"];                        
                        $idnumr= $_POST["idnumr"];
                        $comments= $_POST["comments"];
                        $trn_date = date("Y-m-d H:i:s");
                
                     $con = mysqli_connect("localhost","root","","register");
                     $query ="INSERT into `blacklist` (fname, lname, idnumr, trn_date, comments, image) values ('$fname', '$lname', '$idnumr','$trn_date','$comments','$image')";
                        $result = mysqli_query($con,$query);
                        if($result)
                        {
                            echo "<br/>$fname Blacklisted Successfully.";
                        }
                        else
                        {
                            echo "<br/>Failed to Uploaded Details.";
                        }                                   
                                
                    }
                }
                


    require('db.php');
    // If form submitted, insert values into the database.
?>


</div> 
</html>
