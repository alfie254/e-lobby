<?php
require('db.php');
	if(isset($_POST))
	{
		$dept=$_POST['data'];
		$sql = mysqli_query($con, "SELECT  fname FROM staff WHERE dept='$dept'");
        if (mysqli_num_rows($sql) > 0)
	        {
	        	while ($row = mysqli_fetch_array($sql))
			        {
			            echo "<option value='". $row[ 'fname' ] ."'>" .$row['fname' ]."</option>";
			        }
		                             
			}	
	}						
?>