<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "ems";
 

 $con = mysqli_connect($servername, $username, $password, $db);
 


 if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				
				$sql = "INSERT INTO `student`(`roll`, `sem`, `dept`, `shift`, `stype`) VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                   $result = mysqli_query($con, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"../../index.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"../../index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 


 ?>