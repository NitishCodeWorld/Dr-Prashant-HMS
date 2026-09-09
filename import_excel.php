<?php 
include 'conn.php'; 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
ini_set('memory_limit', '-1');

if(isset($_POST["Import"])){
		

		$filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	    
	          //It wiil insert a row to our subject table from our csv file`
	          /* $sql = "INSERT into subject (`SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`,COURSE_ID, `AY`, `SEMESTER`) 
	            	values('$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]')";*/
					
					$uhid_no = mysqli_real_escape_string($conn,$emapData[0]);
					$old_prefix = mysqli_real_escape_string($conn,$emapData[1]);
					$patient_name = mysqli_real_escape_string($conn,$emapData[2]);
					$registration_date = date("Y-m-d", strtotime($emapData[3]));
					$dob = date("Y-m-d", strtotime($emapData[4]));
					$gender=0;
					if($emapData[5]=='M'){
						$gender=1;
					}
					if($emapData[5]=='F'){
						$gender=2;
					}
					$old_gender = mysqli_real_escape_string($conn,$emapData[5]);
					$phone_no = mysqli_real_escape_string($conn,$emapData[6]);
					$address = mysqli_real_escape_string($conn,$emapData[7]);
					$created_by=1;
					$created_on=date('Y-m-d H:i:s');
					$appt_id=0;
					$patient_admission_type=2;
					
					
					 $sql = "INSERT INTO `patient_registration_form`( `uhid_no`, `patient_name`, `registration_date`, `dob`, `gender`, `phone_no`, `address`, `created_by`, `created_on`, `appt_id`, `patient_admission_type`, `old_prefix`, `old_gender`) VALUES ('".$uhid_no."','".$patient_name."','".$registration_date."','".$dob."','".$gender."','".$phone_no."','".$address."','".$created_by."','".$created_on."','".$appt_id."','".$patient_admission_type."','".$old_prefix."','".$old_gender."') ";
	         //we are using mysql_query function. it returns a resource on true else False on error
	        $result = mysqli_query( $conn, $sql );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"import_excel_index.php\"
						</script>";
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"import_excel_index.php\"
					</script>";
	        
			 

			 //close of connection
			mysqli_close($conn); 
				
		 	
			
		 }
	}	 
?>