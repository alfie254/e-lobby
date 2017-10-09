<?php
	ini_set('mysqli.connect_timeout', 300);
	ini_set('default_socket_timeout', 300);
?>

<html>


<head>
	<title>WebCam jQuery and PHP script</title>
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

		<link rel="stylesheet" href="style.css">
</head>



	<body>


	<h1>Capture photo with Web Camera - PHP Script</h1>
	<h4><a href="http://blog.theonlytutorials.com/capture-web-camera-image-php-jquery/">Go to Tutorial</a></h4>
	<!-- camera screen -->
	<div id="camera_wrapper">
	<div id="camera"></div>
	<br />
	<button id="capture_btn">Capture</button><br>Or

	</div>
	<!-- show captured image -->
	<div id="show_saved_img" ></div>
	


		<form method="post" enctype="multipart/form-data">
		<br>
			<input type="file" name="image"/>
			<br/><br/>
			<input type="submit" name="sumit" value="Upload"/>			
		</form>	
		<?php
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
						saveimage($name, $image);					
					}
				}

				function saveimage($name, $image)
					{
						$con = mysqli_connect("localhost","root","","register");
						$query ="INSERT into `images` (name,image) values ('$name','$image')";
						$result = mysqli_query($con,$query);
						if($result)
						{
							echo "<br/> Image Uploaded.";
						}
						else
						{
							echo "<br/> Image Not Uploaded.";
						}
					}
			?>
	</body>
<html>