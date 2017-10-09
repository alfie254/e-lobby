<?php

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />
<script src="scripts/jquery.js"></script>

    <title>Index</title>
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
      <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> View Visitors</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
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
    <script type ="text/javascript" >
function submitForm(action)
 {
var form = document.getElementById( 'details' );
    form.action = action;
    form.submit();
  }
</script>

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
                <input type="text" name="idnum" placeholder="Id Number" required /><br><br>

                <select name="typ">
                    <option value=""> ---Visitor Type--- </option>
                    <option value="Client"> Client </option>
                    <option value="Constructor"> Constructor </option>
                    <option value="Delivery"> Delivery </option>
                    <option value="Visitor"> Visitor </option>
                    <option value="Meeting"> Meeting </option>
                </select><br><br>

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
                </select><br><br>
                
                       
                
                <select name="staff" required> 
                       <option value="">------ ---Select Staff--- ------</option>
                        <?php
                            require('db.php');
                            $sql = mysqli_query($con, "SELECT * FROM staff");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql))
                                {
                                    echo "<option value='". $row[ 'fname' ] ."'>" .$row['fname' ] .'  '.$row['lname' ] .' - '.$row['extension' ] . "</option>" ;
                                }
                             
                        ?>       
                </select><br><br>

                <input type ="submit" name="print" value="Print" onclick="submitForm('form.php')"/>
                <input type="submit" name="sumit" value="Upload"/>    
                </fieldset>                
    </form> 
    </div>
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
                        $idnum= $_POST["idnum"];
                        $typ= $_POST["typ"];
                        $dept= $_POST["dept"];
                        $staff= $_POST["staff"];
                        $trn_date = date("Y-m-d H:i:s");
                        $day = date("Y-m-d"); 
                        $user= $_POST["user"];
                
                        $con = mysqli_connect("localhost","root","","register");

                        
                        //$blk = ifexist ("SELECT idnumr FROM blacklist where idnumr=$idnum");
                        $blk = mysqli_query($con, "SELECT idnumr from blacklist WHERE idnumr = '$idnum'");
                            if (mysqli_num_rows($blk) > 0)
                                {
                                    echo "<script type='text/javascript'>alert('$fname $lname $idnum is Blacklisted!!')</script>";
                                    die(" $fname $lname, idnumber: $idnum is Blacklisted and cannot be allowed in!!!!!");

                                }
                            else  {  
                        $staff_id = mysqli_query($con, "SELECT staff_id FROM staff WHERE fname='$staff'");
                          if (mysqli_num_rows($staff_id) > 0)
                                {
                                    while($row = mysqli_fetch_assoc($staff_id))
                                     {
                                       echo $st_id = $row["staff_id"];     
                                     }
                                }
                        $query ="INSERT into `visitors` (fname, lname, idnum, typ, dept, staff, trn_date, day, image, name, user, staff_id) values ('$fname', '$lname', '$idnum', '$typ', '$dept', '$staff', '$trn_date', '$day', '$image','$name','$user', '$st_id ')";
                        $result = mysqli_query($con,$query);
                        if($result)
                        {
                             echo "<script type='text/javascript'>alert('Successfully Uploaded Details!!')</script>";
                            echo "<br/>Successfully Uploaded Details.";
                        }
                        else
                        {
                            echo "<script type='text/javascript'>alert('Failed to Uploaded Details!!')</script>";
                            echo "<br/>Failed to Uploaded Details.";
                        }   
                        }                                
                                
                    }
                }
                


if(isset($_POST['sumit'])){
        $staff= $_POST["staff"];
        $fname= $_POST["fname"];
        $lname= $_POST["lname"]; 
        require 'phpmailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
                                      // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'alfredwmaina25@gmail.com';                 // SMTP username
        $mail->Password = '1alfiey25';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('alfredwmaina25@gmail.com','Security Desk');


        $cont = mysqli_query($con, "SELECT staff from visitors WHERE staff='$staff' ");
             if (mysqli_num_rows($cont) > 0)
            {
                while($row = mysqli_fetch_assoc($cont))
                 {
                   $d = $row["staff"];     
                 }
            }
        $sq = mysqli_query($con, "SELECT email FROM staff WHERE fname='$d'");
         if (mysqli_num_rows($sq) > 0)
            {
                while($row = mysqli_fetch_assoc($sq))
                 {
                    $emailaddresses[] = $row["email"];     
 
        foreach ($emailaddresses as $address) {
            $mail->addAddress($address);
        }
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');


        $mail->addAttachment('msgfile');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Visitor Alert!';
        $mail->Body    =  $fname.' '.$lname. ' is here to see you!.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        }}
        if(!$mail->send()) {
            echo "<script type='text/javascript'>alert('Message could not be sent!!')</script>";
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script type='text/javascript'>alert('Message has been sent to $staff!!')</script>";
            echo 'Message has been sent';
        }
        }


?>
 <script>
      function ConfirmDelete(){
    var del=confirm("Are you sure you want to delete this record?");
    if (del){
       alert ("record deleted")
    }else{
        alert("Record Not Deleted")
    }
    return del;
    }
</script>


</body>
</div> 
</html>
