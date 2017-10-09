<?php

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
	<title>WebCam</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	
	<style>
		#camera_wrapper, #show_saved_img{float:left; width: 340px;}
	</style>
	
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
			

			//after taking snap call show image
			webcam.set_hook( 'onComplete', function(img){
				$('#show_saved_img').html('<img src="' + img + '">');
				//reset camera for the next shot
				webcam.reset();
			});
			
		});
	</script>
</head>


<body>
	<p>Welcome <?php echo $_SESSION['username']; ?>!</p>



	<div id="camera_wrapper">
		<div id="camera"></div>
		<br />
		<button id="capture_btn">Capture</button><br>Or
	</div>
	<div id="show_saved_img" ></div>

	<form method="post" enctype="multipart/form-data">
		<br>
			<input type="file" name="image"/>
			<br/><br/>
			<input type="text" name="fname" placeholder="First Name" required />
			<input type="text" name="lname" placeholder="Last Name" required />
			<input type="text" name="idnum" placeholder="Id Number" required />

			<select name="typ">
			    <option value="Client"> Client </option>
			    <option value="Constructor" selected> Constructor </option>
			    <option value="Delivery"> Delivery </option>
			    <option value="Visitor" selected> Visitor </option>
			    <option value="Meeting"> Meeting </option>
			</select>

			<select name="dept">
			    <option value="ICT"> ICT </option>
			    <option value="HR" selected> Human Resource </option>
			    <option value="Finance"> Finance </option>
			    <option value="procurement"> procurement </option>
			    <option value="Audit"> Audit </option>
			</select>

			<input type="text" name="staff" placeholder="Staff" required /><br>
			<input type="submit" name="sumit" value="Upload"/>

	</form>	

	
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
				
						$con = mysqli_connect("localhost","root","","register");
						$query ="INSERT into `visitors` (fname, lname, idnum, typ, dept, staff, trn_date, image, name) values ('$fname', '$lname', '$idnum', '$typ', '$dept', '$staff', '$trn_date', '$image','$name')";
						$result = mysqli_query($con,$query);
						if($result)
						{
							echo "<br/> Image Uploaded.";
							echo "<br/> Details Uploaded.";
						}
						else
						{
							echo "<br/> Image Not Uploaded.";
						}									
								
					}
				}
				


    require('db.php');
    // If form submitted, insert values into the database.
?>



</div> 
</html>
