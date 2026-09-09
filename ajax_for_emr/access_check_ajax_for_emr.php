<?php
include '../conn.php';
$optom_id=$_POST["access_id"];
function checkTime($time1,$time2)
{
  $start = strtotime($time1);
  $end = strtotime($time2);
  if ($start-$end > 0)
	return 1;
  else
   return 0;
}
$login_flag=0;
//$currentTime = time() + 3600;
$currentTime = time() ;
$now_time = date('H:i',$currentTime);
$before_time = '21:00';  //Stop Access time
$after_time = '08:00'; 	//Start Access time

$today_which_day=date('l');  //i.e Monday , Tuesday , Wednesday , Thursday , Friday , Saturday , Sunday 
if($today_which_day=='Sunday'){
	$login_flag=1;

}else{
	if(checkTime($now_time,$before_time)){
	  //echo "First parameter is greater";
	   $login_flag=1;
	}
	else{
	  //echo "Second parameter is greater";
	   $login_flag=0;
	}
	//echo '<br/>';
	
	if(checkTime($now_time,$after_time)){
	  //echo "First parameter is greater";
	   $login_flag=0;
	}
	else{
	  //echo "Second parameter is greater";
	   $login_flag=1;
	}
}

$arr=array("login_flag" => $login_flag,"now_time" => $now_time,"before_time" => $before_time,"after_time" => $after_time);
echo json_encode($arr);
?> 