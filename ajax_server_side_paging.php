<?php 

$aColumns = array('opd_schedules.mrd_no', 'patient_infos.name', 'patient_infos.phone_no', 'patient_infos.email_id', 'start_time', 'branches.branch_name','user_infos.name as doctor_name', '`opd_procedures`.procedure_name', '`ot_procedures`.procedure_name as ot_proc','(select user_infos.name from user_infos where user_infos.users_id=opd_schedules.admin_user_id) as admin_user','opd_schedules.description','opd_schedules.reffer_procedures','opd_schedules.id','opd_schedules.patient_infos_id');

/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "opd_schedules.id";
	/* DB table to use */
	$sTable = "opd_schedules";

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	/*  * Paging */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysqli_real_escape_string($conn, $_GET['iDisplayStart'] ).", ".
			mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );
	}

	/* * Ordering	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysqli_real_escape_string($conn, $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY " )
		{
			$sOrder = "";
		}
	}

	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}

	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
	  if(isset($_GET['bSearchable_'.$i])){
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";
		}
	  }	
	}

	if ( $sWhere == "" )
    {
		 $sWhere .= ($_GET["schedule_type"]!="") ? " WHERE scheduled_type = '".mysqli_real_escape_string($conn,$_GET["schedule_type"])."'" : "";
	}else{

		$sWhere .= ($_GET["schedule_type"]!="") ? " and scheduled_type = '".mysqli_real_escape_string($conn,$_GET["schedule_type"])."'" : "";
	}
	//echo "Where::".$sWhere;

	if($_GET["date_filter"]!=""){
	 $param=$_GET["date_filter"];
	 $param_=explode("-",$param);
	 $from_param=date("Y-m-d",strtotime($param_[0]));
	 $to_param=date("Y-m-d",strtotime($param_[1]));
	}

	if($_GET["branches_list"]!=""){ 
	 $branch_id=$_GET['branches_list'];
	} 
	if($_GET["doctors_list"]!=""){ 
	 $doctors_list=$_GET['doctors_list'];
	}
	if($_GET["procedure_list"]!=""){ 
	 $procedure_list=$_GET['procedure_list'];
	}

	if($_GET["patient_name_search"]!=""){ 
	 $patient_name_search=$_GET['patient_name_search'];
	 $where_info= "and patient_infos.name like '%".$patient_name_search."%' ";
	}else{
		$where_info= " ";
		}

	if($procedure_list=="All"){
		if ( $sWhere == "" )
    {
		$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);
		 $sWhere .= ($_GET["date_filter"]!="") ? " WHERE (DATE(start_time) between '".$from_param."' and '".$to_param."') and ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."'  " : "";

	}else{
		$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);
		$sWhere .= ($_GET["date_filter"]!="") ? " and (DATE(start_time) between '".$from_param."' and '".$to_param."') ".$where_info." and ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' " : "";
	}
	}else{
		if ( $sWhere == "" )
		{
			$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);
			 $sWhere .= ($_GET["date_filter"]!="") ? " WHERE (DATE(start_time) between '".$from_param."' and '".$to_param."') and ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' and ".$sTable.".opd_procedures_id='".$procedure_list."'   " : "";
		}else{
			$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);
			$sWhere .= ($_GET["date_filter"]!="") ? " and (DATE(start_time) between '".$from_param."' and '".$to_param."') ".$where_info."  and ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' and ".$sTable.".opd_procedures_id='".$procedure_list."' " : "";
		}
	}
	//$date = new DateTime($aRow[ $aColumns[$i] ], new DateTimeZone('America/Los_Angeles'));
	//$date->setTimezone(new DateTimeZone('Asia/Kolkata'));
	/* * SQL queries * Get data to display	 */
	if($_SESSION['role']=='2'){
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable left join opd_procedures on ".$sTable.".opd_procedures_id=opd_procedures.id left join ot_procedures on ".$sTable.".ot_procedures_id=ot_procedures.id left join user_infos on  ".$sTable.".users_id=user_infos.users_id left join patient_infos on  ".$sTable.".patient_infos_id=patient_infos.id left join branches on branches.branches_id=".$sTable.".branches_id
		$sWhere
		$sOrder
		$sLimit
	";}
	else{
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable left join opd_procedures on ".$sTable.".opd_procedures_id=opd_procedures.id left join ot_procedures on ".$sTable.".ot_procedures_id=ot_procedures.id left join user_infos on  ".$sTable.".users_id=user_infos.users_id left join patient_infos on  ".$sTable.".patient_infos_id=patient_infos.id left join branches on branches.branches_id=".$sTable.".branches_id
		$sWhere  AND ".$sTable.".users_id=".$_SESSION['choose_doctors']." 
		$sOrder
		$sLimit
	";
	}

	//echo $sQuery;
	$sql="set time_zone='+5:30'";
	$res=$conn->query($sql);
	$rResult = mysqli_query( $conn,$sQuery) or die(error_log(mysqli_error($conn)));

	/* Data set length after filtering */

	$sQuery = "
		SELECT FOUND_ROWS()
	";
	
	$rResultFilterTotal = mysqli_query($conn, $sQuery) or die(mysqli_error($conn));
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysqli_query( $conn,$sQuery) or die(mysqli_error());
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
		/*	 * Output	 */
		
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}else if ( $aColumns[$i] == "opd_schedules.mrd_no" )
			{
				$row[] =$aRow['mrd_no'];
			}else if ( $aColumns[$i] == "patient_infos.phone_no" )
			{
				$row[] =$aRow['phone_no'];
			}else if ( $aColumns[$i] == "patient_infos.name" )
			{
				$row[] =$aRow['name'];
			}else if ( $aColumns[$i] == "patient_infos.email_id" )
			{
				$row[] =$aRow['email_id'];
			}else if ( $aColumns[$i] == "patient_infos.name" )
			{
				$row[] =$aRow['name'];
			}else if ( $aColumns[$i] == "branches.branch_name" )
			{
				$row[] =$aRow['branch_name'];
			}else if ( $aColumns[$i] == "start_time" )
			{
				$row[] =date("d-m-y H:i a",strtotime($aRow['start_time']));
			}else if ( $aColumns[$i] == "user_infos.name as doctor_name" )
			{
				$row[] =$aRow['doctor_name'];
			}else if ( $aColumns[$i] == "`opd_procedures`.procedure_name" )
			{
				$row[] =($aRow['procedure_name']=="") ? $aRow['ot_proc'] : $aRow['procedure_name'];
			}else if ( $aColumns[$i] == "`ot_procedures`.procedure_name as ot_proc" )
			{

			}else if ( $aColumns[$i] == "(select user_infos.name from user_infos where user_infos.users_id=opd_schedules.admin_user_id) as admin_user" )
			{
				$row[] =$aRow['admin_user'];
			}else if ( $aColumns[$i] == "opd_schedules.description" )
			{
				$row[] =$aRow['description'];
			}
			else if ( $aColumns[$i] == "opd_schedules.reffer_procedures" )
			{
				$row[] =$aRow['reffer_procedures'];
			}else if ( $aColumns[$i] == "opd_schedules.id" )
			{
				$row[] ="<a href='javascript:void(0);' onclick='edit_infos(".$aRow['patient_infos_id'].")'><span class='glyphicon glyphicon-edit'></span></a> | <a href='javascript:void(0);' onclick='ask_pw(".$aRow['id'].")'><span class='glyphicon glyphicon-trash'></span></a>";
			}else if ( !($aColumns[$i] == ' '))
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}

	echo json_encode( $output );


	

?>