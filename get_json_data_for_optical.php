<?php

include "conn.php";

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/
error_reporting(0);




$flag=$_GET["flag"];

$db='drsujoysarkar_oec';
if($flag==1){
	save_asset();
}else if($flag==2){
	add_type();
}else if($flag==3){
	add_sub_type();
}else if($flag==4){
	add_unit();
}else if($flag==5){
	load_type();
}else if($flag==6){
	load_sub_type();
}else if($flag==7){
	load_unit();
}else if($flag==8){
	load_item();
}else if($flag==9){
	del_row();
}else if($flag==10){
	save_vendors();
}else if($flag==11){
	load_vendor();
}else if($flag==12){
	load_type_subtype();
}else if($flag==13){
	load_department();
}else if($flag==14){
	add_department();
}else if($flag==15){
	save_location();
}else if($flag==16){
	load_location();
}else if($flag==17){
	load_all_item();
}else if($flag==18){
	save_op_stock();
}else if($flag==19){
	load_opening_stock();
}else if($flag==20){
	load_stock_report();
}else if($flag==21){
	load_asset_indent();
}else if($flag==22){
	save_purchase_order();
}else if($flag==23){
	load_po_order_details();
}else if($flag==24){
	load_po_order();
}else if($flag==25){
	load_po_order_by_indent_id();
}else if($flag==26){
	save_purchase();
}else if($flag==27){
	load_purchase();
}else if($flag==28){
	load_batch_code();
}else if($flag==29){
	load_closing_stock_by_batch("","");
}else if($flag==30){
	search_batch_mrp();
}else if($flag==34){
	get_patient_info();
}else if($flag==35){
	load_doctors();
}else if($flag==36){
	save_sales_order();
}else if($flag==37){
	get_order_details();
}else if($flag==38){
	save_salse();
}else if($flag==39){
	expiry_or_damage_item();
}else if($flag==40){
	approve_po_order();
}else if($flag==41){
	approve_del_order();
}else if($flag==42){
	show_purchase_order_details();
}else if($flag==43){
	batch_wise_stock_all();
}else if($flag==45){
	load_individual_asset_edit();
}else if($flag==46){
	load_items_server_side();
}else if($flag==47){
	load_all_item_names();
}else if($flag==48){
	load_item_with_barcode();
}else if($flag==49){
	get_patient_order_vender();
}else if($flag==50){
	load_sales_customer();
}else if($flag==51){
	load_sales_orders_details();
}else if($flag==52){
	load_expiry_items_details();
}else if($flag==53){
	load_idivisul_expiry_items_details();
}

function save_asset(){

		global $conn;

		$hsm_code=mysqli_real_escape_string($conn,$_POST["hsm_code"]);

		$item_name=mysqli_real_escape_string($conn,$_POST['item_name']);

		$generic_name=mysqli_real_escape_string($conn,$_POST['generic_name']);

		$unit=mysqli_real_escape_string($conn,$_POST['unit']);

		$gst_rate=mysqli_real_escape_string($conn,$_POST['gst_rate']);

		$cgst_rate=mysqli_real_escape_string($conn,$_POST['cgst_rate']);

		$sgst_rate=mysqli_real_escape_string($conn,$_POST['sgst_rate']);

		$moq=mysqli_real_escape_string($conn,$_POST['moq']);

		$size=mysqli_real_escape_string($conn,$_POST["size"]);

		$color=mysqli_real_escape_string($conn,$_POST["color"]);

		$mrp=mysqli_real_escape_string($conn,$_POST["mrp"]);

		$specification=mysqli_real_escape_string($conn,$_POST["specification"]);

		$sub_type_id=mysqli_real_escape_string($conn,$_POST["sub_type_name"]);

		$type_id=mysqli_real_escape_string($conn,$_POST["type_name"]);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){



			$id=$_POST['id'];

			$tans_sql="SET autocommit = 0;";

   			mysqli_query($conn,$tans_sql);



   			$tans_sql="START TRANSACTION;";

   			mysqli_query($conn,$tans_sql);



			$sql="UPDATE `item_master_for_optical` SET `type_id`='".$type_id."',`hsm_code`='".$hsm_code."',`sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."',`moq`='".$moq."', `size`='".$size."',`gst_rate`='".$gst_rate."',`cgst_rate`='".$cgst_rate."',`sgst_rate`='".$sgst_rate."', `color`='".$color."', `specification`='".$specification."', `modified_by`='".$created_by."', `modified_time`='".$created_on."', `mrp`='".$mrp."' WHERE `id`='".$id."'";

			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));



		}else{ 



			$sql_vallidate="select asset_name from item_master_for_optical where asset_name='".$item_name."' and `status`<>0";

			$result=mysqli_query($conn,$sql_vallidate) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));

			$row=mysqli_fetch_assoc($result);

			$count=$result->num_rows;

			if($count==0){

			  $sql="INSERT INTO `item_master_for_optical` SET `type_id`='".$type_id."',`hsm_code`='".$hsm_code."',`sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."',`moq`='".$moq."', `size`='".$size."',`gst_rate`='".$gst_rate."',`cgst_rate`='".$cgst_rate."',`sgst_rate`='".$sgst_rate."', `color`='".$color."', `specification`='".$specification."', `created_by`='".$created_by."', `created_on`='".$created_on."', `mrp`='".$mrp."' ";

			$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

			}



		}

		

		$tans_sql="COMMIT;";

   		mysqli_query($conn,$tans_sql);

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));	

		}

function add_type(){

	

		global $conn;

		

		$add_type=$_POST['type_name'];

		$add_type=mysqli_real_escape_string($conn,$_REQUEST['type_name']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		$sql="INSERT INTO `type_master_for_optical` SET `category_name`='".$add_type."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) {echo json_encode(array("flag"=>1));}

		else {echo json_encode(array("flag"=>0));};

	

	}

function add_sub_type(){

	

		global $conn;

		

		$type_id=mysqli_real_escape_string($conn,$_REQUEST['type_id']);

		$sub_type_name=mysqli_real_escape_string($conn,$_REQUEST['sub_type_name']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql=($_POST['type_id']=="") ? "UPDATE  `type_master_for_optical` SET `category_name`='".$sub_type_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ": "UPDATE  `type_master_for_optical` SET `category_name`='".$sub_type_name."',`main_cat_id`='".$type_id."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";	

		}else{			

			$sql=($_POST['type_id']=="") ? "INSERT INTO  `type_master_for_optical` SET `category_name`='".$sub_type_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ": "INSERT INTO `type_master_for_optical` SET `category_name`='".$sub_type_name."',`main_cat_id`='".$type_id."', `created_by`='".$created_by."', `created_on`='".$created_on."'  ";	

		}

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function add_unit(){

	

		global $conn;

		

		$unit_name=mysqli_real_escape_string($conn,$_REQUEST['unit_name']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="UPDATE  `unit_master_for_optical` SET `unit_name`='".$unit_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		

		}else{

			$sql="INSERT INTO `unit_master_for_optical` SET `unit_name`='".$unit_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		}

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function load_type(){

	

		global $conn;

		

		$sql="select * from `type_master_for_optical` where main_cat_id IS NULL and status=1";

		

		$res=mysqli_query($conn,$sql);

		

		$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			$arr[]=array("id"=>$row['id'],"text"=>$row['category_name']);

		}		

		

		echo json_encode($arr);

	

	}

function load_sub_type(){

	

		global $conn;

		

		$type_id=$_POST['type_id'];

		

		$type_id_=$_POST['type_id_']; //Changes by soumitra

		

		$sql="select * from `type_master_for_optical` where main_cat_id IN ('$type_id','$type_id_') and `status`=1";   //changes by soumitra

		

		$res=mysqli_query($conn,$sql);

		

		$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			$arr[]=array("id"=>$row['id'],"text"=>$row['category_name']);

		}		

		

		echo json_encode($arr);

	

	}

function load_unit(){

	

		global $conn;

		

		$sql="select * from `unit_master_for_optical` where `status`=1";

		

		$res=mysqli_query($conn,$sql);

		

		while($row=mysqli_fetch_assoc($res)){

			$arr[]=array("id"=>$row['id'],"text"=>$row['unit_name']);

		}		

		

		echo json_encode($arr);

	

	}

function load_item(){

	

		global $conn;

		//"page_limit": page_limit,

		//"row_limit": row_limit

		$limit=$_POST['limit'];

		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";

		//$row_limit=(isset($_POST['row_limit'])) ? $_POST['row_limit'] : "2";

		//$initial_page = ($page_number-1) * $limit;

		//$row_limit=2;

		 $sql="select `item_master_for_optical`.*,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat from `item_master_for_optical` left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id where asset_name<>'' and item_master_for_optical.status<>2 limit $initial_page,$limit";

		$res=mysqli_query($conn,$sql);

		//$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$mrp=(isset($mrp)) ? $mrp : " ";

			$action_edit='<a href="javascript:void(0)" name="edit" id="edit" onClick="load_individual_asset('.$id.')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"asset_name"=>$asset_name,"type_id"=>$category_name,"sub_type_id"=>$sub_cat,"size"=>$size,"color"=>$color,"mrp"=>$mrp,"gst_rate"=>$gst_rate,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

	

	function load_items_server_side(){

	

	global $conn;

$aColumns = array('item_master_for_optical.id', 'item_master_for_optical.asset_name', 'type_master_for_optical.category_name','(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat','item_master_for_optical.size','item_master_for_optical.color','item_master_for_optical.mrp','item_master_for_optical.gst_rate','item_master_for_optical.moq','item_master_for_optical.id as edit_id');



/* Indexed column (used for fast and accurate table cardinality) */

	$sIndexColumn = "item_master_for_optical.id";

	/* DB table to use */

	$sTable = "item_master_for_optical";



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

			if(($i!='3')&&($i!='8')){ // Exceptional please delete if not neccesseary

			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";

			}

			//$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";

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

		 $sWhere .= " WHERE `item_master_for_optical`.`status`='1' " ;

	}else{



		 $sWhere .= " AND `item_master_for_optical`.`status`='1' " ;

	}

	//echo "Where::".$sWhere;

		$sQuery = "

		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."

		FROM   $sTable LEFT JOIN `type_master_for_optical` on ".$sTable.".type_id=type_master_for_optical.id 

		$sWhere 

		$sOrder

		$sLimit

	";



	//echo $sQuery;

	//exit;

	/*$sql="set time_zone='+5:30'";

	$res=$conn->query($sql);*/

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

			}else if ( $aColumns[$i] == "item_master_for_optical.id" )

			{

				$row[] =$aRow['id'];

			}else if ( $aColumns[$i] == "item_master_for_optical.asset_name" )

			{

				$row[] =$aRow['asset_name'];

			}else if ( $aColumns[$i] == "type_master_for_optical.category_name" )

			{

				$row[] =$aRow['category_name'];

			}else if ( $aColumns[$i] == "(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat" )

			{

				$row[] =$aRow['sub_cat'];

			}

			else if ( $aColumns[$i] == "item_master_for_optical.size" )

			{

				$row[] =$aRow['size'];

			}else if ( $aColumns[$i] == "item_master_for_optical.color" )

			{

				$row[] =$aRow['color'];

			}else if ( $aColumns[$i] == "item_master_for_optical.mrp" )

			{

				$row[] =$aRow['mrp'];

			}

			else if ( $aColumns[$i] == "item_master_for_optical.gst_rate" )

			{

				$row[] =$aRow['gst_rate'].' %';

			}else if ( $aColumns[$i] == "item_master_for_optical.moq" )

			{

				$row[] =$aRow['moq'];

			}else if ( $aColumns[$i] == "item_master_for_optical.id as edit_id" )

			{

				$row[]='<a href="javascript:void(0)" name="edit" id="edit" onClick="load_individual_asset('.$aRow['edit_id'].')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$aRow['edit_id'].')"><i class="fa fa-trash"></i></a>';

				//$row[] =$aRow['edit_id'];

			}else if ( !($aColumns[$i] == ' '))

			{

				/* General output */

				$row[] = $aRow[ $aColumns[$i] ];

			}

		}

		$output['aaData'][] = $row;

	}



	echo json_encode( $output );

	



		

	}

	

	function load_individual_asset_edit(){

	

		global $conn;

		

		$id=$_POST['id'];

		

		$sql="SELECT `item_master_for_optical`.*,`type_master_for_optical`.id as main_cat,(select id from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat from `item_master_for_optical` left join `type_master_for_optical` on `type_master_for_optical`.`id`=`item_master_for_optical`.`type_id`  where `item_master_for_optical`.`status`='1' AND `item_master_for_optical`.`id`='$id'";

		

		

		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		//echo $sql;

		//$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			$arr=array("id"=>$row['id'],"hsm_code"=>$row['hsm_code'],"text"=>$row['asset_name'],"generic_name"=>$row['generic_name'],"category_name"=>$row['main_cat'],"sub_cat"=>$row['sub_cat'],"size"=>$row['size'],"color"=>$row['color'],"gst_rate"=>$row['gst_rate'],"cgst_rate"=>$row['cgst_rate'],"sgst_rate"=>$row['sgst_rate'],"moq"=>$row['moq'],'mrp'=>$row['mrp'],'unit_name'=>$row['unit_id']);

		}		

		

		echo json_encode($arr);

	

	}

	

	

function del_row(){

	global $conn;

	$table=$_POST['table'];

	$id=$_POST['id'];

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$sql="UPDATE $table SET `status`='2',`del_flag`='1', `deleted_by`='".$created_by."', `deleted_time`='".$created_on."'  WHERE `id`='".$id."' ";

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	if($res) {echo json_encode(array("flag"=>1));}

	else {echo json_encode(array("flag"=>0));};	}

function save_vendors(){

	

		global $conn;

				

		$vendor_name=mysqli_real_escape_string($conn,$_REQUEST['vendor_name_']);

		$vendor_address=mysqli_real_escape_string($conn,$_REQUEST['vendor_address_']);

		$vendor_phone=mysqli_real_escape_string($conn,$_REQUEST['vendor_phone_']);

		$vendor_email=mysqli_real_escape_string($conn,$_REQUEST['vendor_email_']);

		$vendor_gst=mysqli_real_escape_string($conn,$_REQUEST['vendor_gst_']);

				

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="UPDATE  `vendor_master_for_optical` SET `vendor_name`='".$vendor_name."', `address`='".$vendor_address."', `email`='".$vendor_email."', `phone`='".$vendor_phone."', `gst`='".$vendor_gst."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		

		}else{

			$sql="INSERT INTO `vendor_master_for_optical` SET `vendor_name`='".$vendor_name."', `address`='".$vendor_address."', `email`='".$vendor_email."', `phone`='".$vendor_phone."', `gst`='".$vendor_gst."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		}

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function load_vendor(){

	

		global $conn;

		

		 $sql="select * from `vendor_master_for_optical` where vendor_name<>'' and `status`<>2";

		$res=mysqli_query($conn,$sql);

		$arr[]=array("id"=>"","vendor_name"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$action_edit='<a href="javascript:void(0)" name="edit" id="edit" onClick="edit('.$id.',\''.$vendor_name.'\',\''.$address.'\',\''.$phone.'\',\''.$email.'\',\''.$gst.'\')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"vendor_name"=>$vendor_name,"address"=>$address,"phone"=>$phone,"email"=>$email,"gst"=>$gst,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

function load_type_subtype(){

	

		global $conn;

		$limit=$_POST['limit'];

		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";

		$sql="SELECT `id`,main_cat_id,`category_name`,(select A.category_name from type_master_for_optical as `A` where A.id=type_master_for_optical.main_cat_id) as `main_cat` FROM `type_master_for_optical` WHERE `status`=1;";

		$res=mysqli_query($conn,$sql);

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			if($main_cat!=''){

			$main_cat=$main_cat;	

			}else{

			$main_cat='-';	

			}

			$action_edit='<a href="javascript:void(0)" name="edit" id="edit" onClick="edit('.$id.',\''.$category_name.'\','.$main_cat_id.')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"category_name"=>$category_name,"main_cat"=>$main_cat,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

function add_department(){

	

		global $conn;

				

		$dept_name=mysqli_real_escape_string($conn,$_REQUEST['department_name']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="UPDATE  `department_master_for_optical` SET `department_name`='".$dept_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		

		}else{

			$sql="INSERT INTO `department_master_for_optical` SET `department_name`='".$dept_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		}

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function load_department(){

	

		global $conn;

		

		$sql="select * from `department_master_for_optical` where `status`=1";

		

		$res=mysqli_query($conn,$sql);

		

		$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			$arr[]=array("id"=>$row['id'],"text"=>$row['department_name']);

		}		

		

		echo json_encode($arr);

	

	}

function save_location(){

	

		global $conn;

				

		$location_name=mysqli_real_escape_string($conn,$_REQUEST['location']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="UPDATE  `location_master_for_optical` SET `location_name`='".$location_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		

		}else{

			$sql="INSERT INTO `location_master_for_optical` SET `location_name`='".$location_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		}

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function load_location(){

	

		global $conn;

		

		 $sql="select * from `location_master_for_optical` where location_name<>'' and `status`<>2";

		$res=mysqli_query($conn,$sql);

		$arr[]=array("id"=>"","location_name"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$action_edit='<a href="javascript:void(0)" name="edit" id="edit" onClick="edit('.$id.',\''.$location_name.'\')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"location_name"=>$location_name,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

function load_doctors(){

	

		global $conn;

		

		$sql="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'";

		$res=mysqli_query($conn,$sql);		

		while($row=mysqli_fetch_assoc($res)){		

			//if(strtoupper(substr($row['name'],0,2))=="DR") $arr[]=array("value"=>$row['id'],"text"=>$row['name']);

			 $arr[]=array("id"=>$row['id'],"text"=>$row['name']);

		}	

		

		echo json_encode($arr);

	

	}	

/*END For Master Load And Master ADD*/

/*Get Number For Unic*/

function get_purchase_order_number(){

		global $conn;

		global $db;

		$sql="select count(*) from `purchase_order_for_optical` where MONTH(date)=MONTH(CURRENT_DATE()) group by MONTH(date)";

		$res=mysqli_query($conn,$sql);

		$row=mysqli_fetch_array($res);

		$new_num=intval($row[0])+1;

		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'purchase_order_for_optical'";

		$res1=mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($res1);

		$new_id="PO/".date("m").date("y")."/".$row1[0]."/".$new_num;

		return $new_id;

	}

function get_purchase_number(){

		global $conn;

		global $db;

		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'purchase_for_optical';";

		$res1=mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($res1);

		$new_id="PUR/".date("m").date("y")."/".$row1[0];

		return $new_id;

	}





function get_sales_order_number(){

		global $conn;

		global $db;

		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'sales_order_for_optical';";

		$res1=mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($res1);

		$new_id="OMC/ORD/".$row1[0]."/".date("y")."-".date("y",strtotime("+1 years"));

		return $new_id;

	}

function get_expiry_number(){

	global $conn;

	global $db;

	$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'expiry_or_damage_for_optical';";

	$res1=mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_array($res1);

	$new_id="OMC/EXP/DMG/".$row1[0]."/".date("y")."-".date("y",strtotime("+1 years"));

	return $new_id;

}

	

function get_sales_number(){

		global $conn;

		global $db;

		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'pharma_invoice_for_optical';";

		$res1=mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($res1);

		//$new_id="OMC/ORD/".$row1[0]."/".date("y")."-".date("y",strtotime("+1 years"));

		if(date("m")<4){ 

			$current_year=date("y",strtotime("-1 years"));

			$next_year=date("y");

		}else{

		 	$current_year=date("y");

			$next_year=date("y",strtotime("+1 years"));

		}

		$new_id="OMC/".$row1[0]."/".$current_year."-".$next_year;

		return $new_id;

		/*$new_id="OMC/".$row1[0]."/".date("y")."-".date("y",strtotime("+1 years"));

		return $new_id;*/

	}

/*End Unic Number Creation*/

function load_all_item(){

	

		global $conn;

		$type_id=($_POST['type_id']!='') ? ' and type_id='.$_POST['type_id'].'' : '' ;

		$sub_type_id=($_POST['sub_type_id']!='') ? ' and sub_type_id='.$_POST['sub_type_id'].'' : '' ;

		$sql="select * from `item_master_for_optical` where asset_name<>'' $type_id $sub_type_id and `status`<>2";

		$res=mysqli_query($conn,$sql);

		$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$cgst=($gst_rate/2);

			$sgst=($gst_rate/2);

			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$cgst.'^'.$mrp,"text"=>$asset_name);
			$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp,"text"=>$asset_name);

		}		

		

		echo json_encode($arr);

	

	}

function save_op_stock(){

	global $conn;

	$type_name=$_POST['type_name'];

	$sub_type_name=$_POST['sub_type_name'];

	$dept_name=$_POST['dept_name'];

	$item_id=$_POST['item_id'];

	//$item_id=explode('^',$item_id);

	$location_name=$_POST['location_name'];

	$vendor_name=$_POST['vendor_name'];

	$qty=$_POST['qty'];

	$unit=$_POST['unit'];

	$batch=mysqli_real_escape_string($conn,$_POST['batch']);

	$mrp=mysqli_real_escape_string($conn,$_POST['mrp']);

	//$mfg_date=$_POST['mfg_date'];

	//$expiry=$_POST['expiry'];

	if($_POST['mfg_date']==''){

    $mfg_date='NULL';

	}else{

	$mfg_date= "'".date("Y-m-d", strtotime($_POST['mfg_date']))."'";

	}

	if($_POST['expiry']==''){

    $expiry='NULL';

	}else{

	$expiry= "'".date("Y-m-d", strtotime($_POST['expiry']))."'";

	}

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];



		  $tans_sql="SET autocommit = 0;";

		  mysqli_query($conn,$tans_sql);

		  

		  $tans_sql="START TRANSACTION;";

		  mysqli_query($conn,$tans_sql);

		  

		  $sql="INSERT INTO `opening_stock_for_optical` SET  `dept_id`='".$dept_name."', `location_id`='".$location_name."', `vendor_id`='".$vendor_name."', `item_id`='".$item_id."', `batch`='".$batch."', `expiry`=".$expiry.", `mfg_date`=".$mfg_date.", `qty`='".$qty."', `mrp`='".$mrp."', `status`='1', `created`='".$created_on."', `type_id`='".$type_name."', `sub_type_id`='".$sub_type_name."' , `created_by`='".$created_by."', `created_on`='".$created_on."' ";

		  $res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));

		  

		  $tans_sql="COMMIT;";

		  mysqli_query($conn,$tans_sql);

		  if($res) echo json_encode(array("flag"=>1));

		  else echo json_encode(array("flag"=>0));		

}



function load_opening_stock(){

	

		global $conn;

		/*$limit=$_POST['limit'];

		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";

		$sql="select `opening_stock_for_optical`.*, `opening_stock_for_optical`.`mrp`,`opening_stock_for_optical`.`qty`, (select `category_name` from `type_master_for_optical` where `id`=`opening_stock_for_optical`.`sub_type_id`) as `sub_cat`,(select `category_name` from `type_master_for_optical` where `id`=`opening_stock_for_optical`.`type_id`) as `type_name`,(select `department_name` from `department_master_for_optical` where `id`=`opening_stock_for_optical`.`dept_id`) as `department`,(select `asset_name` from `item_master_for_optical` where `id`=`opening_stock_for_optical`.`item_id`) as `item_name`,(select `location_name` from `location_master_for_optical` where `id`=`opening_stock_for_optical`.`location_id`) as `location_name`,(select `vendor_name` from `vendor_master_for_optical` where `id`=`opening_stock_for_optical`.`vendor_id`) as `vendor` from `opening_stock_for_optical` where `opening_stock_for_optical`.`status`<>2 limit $initial_page,$limit";*/

		$sql="select `opening_stock_for_optical`.*, `opening_stock_for_optical`.`mrp`,`opening_stock_for_optical`.`qty`, (select `category_name` from `type_master_for_optical` where `id`=`opening_stock_for_optical`.`sub_type_id`) as `sub_cat`,(select `category_name` from `type_master_for_optical` where `id`=`opening_stock_for_optical`.`type_id`) as `type_name`,(select `asset_name` from `item_master_for_optical` where `id`=`opening_stock_for_optical`.`item_id`) as `item_name`,(select `vendor_name` from `vendor_master_for_optical` where `id`=`opening_stock_for_optical`.`vendor_id`) as `vendor` from `opening_stock_for_optical` where `opening_stock_for_optical`.`status`<>2 ";

		$res=mysqli_query($conn,$sql);

		//$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$mrp=(isset($mrp)) ? $mrp : "";

			$batch=(isset($batch)) ? $batch : "";

			$expiry=(isset($expiry)) ? date("d-m-Y", strtotime($expiry)) : "";

			$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"item_name"=>$item_name,"type_name"=>$type_name,"sub_cat"=>$sub_cat,"batch"=>$batch,"expiry"=>$expiry,"vendor"=>$vendor,"mrp"=>$mrp,"qty"=>$qty,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

	

function load_stock_report(){
		global $conn;
		$from_=($_POST['from_date']!='') ? date('Y-m-d',strtotime($_POST['from_date'])) : '' ;
		$to_=($_POST['to_date']!='') ?  date('Y-m-d',strtotime($_POST['to_date'])) : '' ;
		$item=explode('^',$_POST["item_id"]);
		$item_id=($_POST["item_id"]!='') ? ' and item_master_for_optical.id='.$item[0].'' : '';
		if($from_=="" || $to_==""){
			$date_filter_purchase="";
			$date_filter_sales="";
			$date_filter_sales_returns="";	
			$date_filter_sales_order="";	
			$date_filter_expiry="";
		}else{
			$date_filter_purchase=" and (DATE(purchase_for_optical.date) BETWEEN '$from_' and '$to_')  ";
			$date_filter_sales=" and (DATE(pharma_invoice_details_for_optical.date) BETWEEN '$from_' and '$to_')  ";
			$date_filter_expiry=" and (DATE(expiry_or_damage_for_optical.date) BETWEEN '$from_' and '$to_')  ";
			$date_filter_opening_stock=" and (DATE(opening_stock_for_optical.date) BETWEEN '$from_' and '$to_')  ";
			$date_filter_sales_order=" and (DATE(sales_order_details_for_optical.date) BETWEEN '$from_' and '$to_')  ";
			//$date_filter_sales_returns=" and (DATE(`sales_return`.date) BETWEEN '$from_' and '$to_')  ";
		}
		$sql="select item_master_for_optical.*,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat FROM item_master_for_optical left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id where `asset_name`<>''$item_id and item_master_for_optical.status<>2 and item_master_for_optical.type_id<>2";
		$res=mysqli_query($conn,$sql);

		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			//echo "P Val:". $asset_name;
			$sql_op_stock="select sum(qty) as op_stock from opening_stock_for_optical where item_id='".$id."' and opening_stock_for_optical.status=1 $date_filter_opening_stock group by item_id;";
			$res_op_stock=mysqli_query($conn,$sql_op_stock);
			$row_op_stock=mysqli_fetch_assoc($res_op_stock);
			$qty_op_stock=($row_op_stock['op_stock']=='') ? 0 : $row_op_stock['op_stock'];
			
			/*purchase*/
			$sql_new="select sum(qty) as purchase_for_optical from purchase_details_for_optical inner join purchase_for_optical on purchase_for_optical.id=purchase_details_for_optical.purchase_id where item_id='".$id."' and purchase_details_for_optical.status=1 $date_filter_purchase group by item_id;";
			$res_new=mysqli_query($conn,$sql_new);
			$row_new=mysqli_fetch_assoc($res_new);
			$qty_purchased=($row_new['purchase_for_optical']=='') ? 0 : $row_new['purchase_for_optical'];
			$qty=($qty=='') ? 0 : $qty;
			
			/*Sale*/
		    $sql_sales_ph="select sum(pharma_invoice_details_for_optical.qty) as sales from pharma_invoice_details_for_optical inner join pharma_invoice_for_optical on pharma_invoice_for_optical.id=pharma_invoice_details_for_optical.sales_id where pharma_invoice_details_for_optical.item_id='".$id."' and pharma_invoice_for_optical.status=1 $date_filter_sales $date_filter_sales group by item_id;";
			$res_pharma_sales=mysqli_query($conn,$sql_sales_ph);
			$row_pharma_sales=mysqli_fetch_assoc($res_pharma_sales);
			$qty_pharma_sold=($row_pharma_sales['sales']=='') ? 0 : $row_pharma_sales['sales'];

			/*Customer Order*/
			 $sql_order="select sum(sales_order_details_for_optical.qty) as customer_order from sales_order_details_for_optical inner join sales_order_for_optical on sales_order_for_optical.id=sales_order_details_for_optical.sales_id where sales_order_details_for_optical.item_id='".$id."' and (sales_order_for_optical.status=1 or sales_order_for_optical.status=2) $date_filter_sales_order group by item_id;";
			$res_order=mysqli_query($conn,$sql_order);
			$row_order=mysqli_fetch_assoc($res_order);
			$qty_order=($row_order['customer_order']=='') ? 0 : $row_order['customer_order'];

			/*expiry_or_damage*/
			$sql_exp="select sum(qty) as expiry_or_damage from expiry_or_damage_for_optical inner join expiry_or_damage_details_for_optical on expiry_or_damage_for_optical.id=expiry_or_damage_details_for_optical.consumables_id where item_id='".$id."' and expiry_or_damage_details_for_optical.status=1 $date_filter_expiry group by item_id;";
			$res_exp=mysqli_query($conn,$sql_exp);
			$row_exp=mysqli_fetch_assoc($res_exp);
			$qty_expari=($row_exp['expiry_or_damage']=='') ? 0 : $row_exp['expiry_or_damage'];
		?>
			<?php //echo $id;?>
            <tr><td><?php echo $asset_name; ?></td><td><?php echo $category_name; ?></td><td><?php echo $sub_cat; ?></td><td><?php echo $size; ?></td><td><?php echo $color; ?></td><td><?php echo $specification; ?></td><td><?php echo $qty_op_stock; ?></td><td><?php echo $qty_purchased; ?></td><td><?php echo $qty_order; ?></td><td><?php echo $qty_expari; ?></td><td><?php echo (($qty_purchased+$qty+$qty_lens+$qty_op_stock)-($qty_sold+$qty_order+$qty_lens_return+$qty_expari)); ?></td></tr>
		<?php
		}		
		//echo json_encode($arr);
	}

function load_batch_code(){

	global $conn;



	$item_id=(!isset($_POST['item_id'])) ? $item_id : $_POST['item_id'] ;



	$sql="select batch_no from purchase_details_for_optical inner join purchase_for_optical on purchase_for_optical.id=purchase_details_for_optical.purchase_id where item_id='$item_id' group by batch_no order by purchase_details_for_optical.expiry_date";

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){

		if(trim($row['batch_no'])!=""){

			$batch_code_=load_closing_stock_by_batch($item_id,$row['batch_no']);

			if($batch_code_>0) $arr[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no']);

		}

	}

	$batch_code_=0;

	$sql="select batch,qty from opening_stock_for_optical where item_id='$item_id' and status=1 order by expiry";

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){

		if(trim($row['batch'])!=""){

			$batch_code_=load_closing_stock_by_batch($item_id,$row['batch']);

			if($batch_code_>0) $arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);

			/*if(multi_array_search($row['batch'],$arr)<0){

			 if($batch_code_>0) $arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);

			}*/

		}



	}

	//echo json_encode($arr);

	if(isset($arr)){

		//echo '<pre>';print_r($arr);

		$fl=0;

		foreach( $arr as $key => $val){

			if(!is_null($val["value"]) && $val["value"]!="null" )	$fl=1;

		}

		if($fl==1){

			$arr_=$arr;

		 	echo json_encode($arr);

			return true;

		}else{

			 echo json_encode("");

			 return false;

		 }

	}

	else{

	 echo json_encode("");

	}



}

function load_closing_stock_by_batch($item_id,$batch_code_1){

	   global $conn;
	  //$item_id=(isset($item_id)) ? ' and item_master_for_optical.id='.$item_id.'' : '';
	  $item_id=(!isset($_POST['item_id'])) ? $item_id : ' and item_master_for_optical.id='.$_POST['item_id'].'' ;
	  $batch_code_=(isset($_POST["batch_code"])) ? $_POST["batch_code"] : $batch_code_1;
	  $batch_code1=($batch_code_!="undefined" && $batch_code_!="" ) ? " and opening_stock_for_optical.batch='".$batch_code_."' " : "" ;
	  $batch_code2=($batch_code_!="undefined" && $batch_code_!="" ) ? " and purchase_details_for_optical.batch_no='".$batch_code_."' " : "" ;
	  $batch_code3=($batch_code_!="undefined" && $batch_code_!="") ? " and pharma_invoice_details_for_optical.batch_no='".$batch_code_."' " : "" ; 
	  $batch_code10=($batch_code_!="undefined" && $batch_code_!="") ? " and sales_order_details_for_optical.batch_no='".$batch_code_."' " : "" ;
	  $batch_code11=($batch_code_!="undefined" && $batch_code_!="") ? " and expiry_or_damage_details_for_optical.batch_no='".$batch_code_."' " : "" ;

	  
		$sql="select item_master_for_optical.*,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat FROM item_master_for_optical left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id where `asset_name`<>''$item_id and item_master_for_optical.status<>2;";
		$res=mysqli_query($conn,$sql);
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			/*opening_stock*/
			$sql_op_stock="select sum(qty) as op_stock from opening_stock_for_optical where item_id='".$id."' and opening_stock_for_optical.status=1 $batch_code1 group by item_id;";
			$res_op_stock=mysqli_query($conn,$sql_op_stock);
			$row_op_stock=mysqli_fetch_assoc($res_op_stock);
			$qty_op_stock=($row_op_stock['op_stock']=='') ? 0 : $row_op_stock['op_stock'];
			
			/*purchase*/
			$sql_new="select sum(qty) as purchase_for_optical from purchase_details_for_optical inner join purchase_for_optical on purchase_for_optical.id=purchase_details_for_optical.purchase_id where item_id='".$id."' and purchase_details_for_optical.status=1 $date_filter_purchase $batch_code2 group by item_id;";
			$res_new=mysqli_query($conn,$sql_new);
			$row_new=mysqli_fetch_assoc($res_new);
			$qty_purchased=($row_new['purchase_for_optical']=='') ? 0 : $row_new['purchase_for_optical'];
			$qty=($qty=='') ? 0 : $qty;
			
			/*Sale*/
		    $sql_sales_ph="select sum(pharma_invoice_details_for_optical.qty) as sales from pharma_invoice_details_for_optical inner join pharma_invoice_for_optical on pharma_invoice_for_optical.id=pharma_invoice_details_for_optical.sales_id where pharma_invoice_details_for_optical.item_id='".$id."' and pharma_invoice_for_optical.status=1 $date_filter_sales $batch_code3 group by item_id;";
			$res_pharma_sales=mysqli_query($conn,$sql_sales_ph);
			$row_pharma_sales=mysqli_fetch_assoc($res_pharma_sales);
			$qty_pharma_sold=($row_pharma_sales['sales']=='') ? 0 : $row_pharma_sales['sales'];

			/*Customer Order*/
			 $sql_order="select sum(sales_order_details_for_optical.qty) as customer_order from sales_order_details_for_optical inner join sales_order_for_optical on sales_order_for_optical.id=sales_order_details_for_optical.sales_id where sales_order_details_for_optical.item_id='".$id."' and (sales_order_for_optical.status=1 or sales_order_for_optical.status=2) $date_filter_sales_returns $batch_code10 group by item_id;";
			$res_order=mysqli_query($conn,$sql_order);
			$row_order=mysqli_fetch_assoc($res_order);
			$qty_order=($row_order['customer_order']=='') ? 0 : $row_order['customer_order'];

			/*expiry_or_damage*/
			$sql_exp="select sum(qty) as expiry_or_damage from expiry_or_damage_for_optical inner join expiry_or_damage_details_for_optical on expiry_or_damage_for_optical.id=expiry_or_damage_details_for_optical.consumables_id where item_id='".$id."' and expiry_or_damage_details_for_optical.status=1 $date_filter_expiry group by item_id;";
			$res_exp=mysqli_query($conn,$sql_exp);
			$row_exp=mysqli_fetch_assoc($res_exp);
			$qty_expari=($row_exp['expiry_or_damage']=='') ? 0 : $row_exp['expiry_or_damage'];
		}
	$closing_stock_=0;
	$closing_stock=(($qty_purchased+$qty+$qty_lens+$qty_op_stock)-($qty_sold+$qty_pharma_sold+$qty_lens_return+$qty_order+$qty_expari));	
	if($batch_code_1=="") echo json_encode(array("closing_stock"=>$closing_stock));

	else return $closing_stock;

}

function load_asset_indent(){

	

		global $conn;

		

		$id=$_POST['id'];

		$location_name=$_POST['location_name'];

		$location_id_=$_POST['location_id'];

		

		$sql="";

		$optional=(isset($_POST['indent_flag'])) ? " ,indent_details.qty,indent_details.gp_id, indent_details.qty_ordered,indent.id as `indent_id`,indent_details.id as `indent_details_id`,department_master.department_name " : "" ;

		

		$sql1="select item_master_for_optical.id,item_master_for_optical.asset_name,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item $optional from item_master_for_optical left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id left join unit_master_for_optical on unit_master_for_optical.id=item_master_for_optical.unit_id";

		

		if(isset($_POST['indent_flag'])) $sql=$sql1." inner join indent_details on item_master_for_optical.id=indent_details.item_id left join indent on indent.id=indent_details.indent_id left join department_master on department_master.id=indent.department where indent.id='$id' "; 

		

		

		

		//if(isset($_POST["dept_name"]) && $_POST["dept_name"]!='') $sql=$sql1." where asset_stock.dept_id='".$_POST["dept_name"]."'";

		if(isset($_POST["type_name"]) && $_POST["type_name"]!='') $sql=($sql=="") ? $sql1." where item_master_for_optical.type_id='".$_POST["type_name"]."'" : $sql." and item_master_for_optical.type_id='".$_POST["type_name"]."'";

		if(isset($_POST["sub_type_name"]) && $_POST["sub_type_name"]!='') $sql=($sql=="") ? $sql1." where item_master_for_optical.sub_type_id='".$_POST["sub_type_name"]."'" : $sql." and item_master_for_optical.sub_type_id='".$_POST["sub_type_name"]."'";

		if($_POST["asset_id"]!='') $sql=($sql=="") ? $sql1." where item_master_for_optical.id='".$_POST["asset_id"]."'" : $sql." and item_master_for_optical.id='".$_POST["asset_id"]."'";

		//if(isset($_POST["location_name"]) && $_POST["location_name"]!='') $sql=($sql=="") ? $sql1." where asset_stock.location_id='".$_POST["location_name"]."'" : $sql." and asset_stock.location_id='".$_POST["location_name"]."'";

		

		$sql=($sql=="") ? $sql1 : $sql;  

		

		//echo $sql;

		$location_id_="1";

		

			if($location_id_!="" || isset($_POST['indent_flag'])){

			

				$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

				

				while($row=mysqli_fetch_assoc($res)){

					extract($row);

					//echo "P Val:". $product_id;

					//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;

					if(isset($_POST['indent_flag'])){

				?>

					

					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_dept_name" ><?php echo $department_name; ?></td><td id="<?php echo $id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id ?>_color"><?php echo $color; ?></td><td id="<?php echo $id ?>_covid_item"><?php echo $covid_item; ?></td><td><input type="text" id="<?php echo $id ?>_qty" data-qty="<?php echo ($qty-$qty_ordered) ?>" value="<?php echo ($qty-$qty_ordered) ?>" place-holder="qty" /></td><td id="<?php echo $id ?>_gp" >

					<?php $sql_gp="select * from gp_item_master_for_optical where id='$gp_id'"; 

					

						  $res_gp=mysqli_query($conn,$sql_gp) or die(mysqli_error($conn));

						  while($row_gp=mysqli_fetch_assoc($res_gp)){

					

					?>

					<table>

					<thead>

					<th></th><th>SPH</th><th>Cyl</th><th>Axis</th><th>Add</th>

					</thead>

					<tbody>

					<tr>

					<td><b>RE</b></td><td><?php echo $row_gp['rspf']; ?></td><td><?php echo $row_gp['rcyl']; ?></td></td><td><?php echo $row_gp['raxis']; ?></td><td><?php echo $row_gp['radd']; ?></td>

					<tr>

					<td><b>LE</b></td><td><?php echo $row_gp['lspf']; ?></td><td><?php echo $row_gp['lcyl']; ?></td><td><?php echo $row_gp['laxis']; ?></td><td><?php echo $row_gp['laxis']; ?><td><?php echo $row_gp['ladd']; ?></td>

					</tr>

					</tr>

					</tbody>

					</table>

					<?php } ?>

					</td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $indent_id ?>','<?php echo $indent_details_id ?>','<?php echo $gp_id; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>

				<?php

					}else{

				?>

					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id ?>_color"><?php echo $color; ?></td><td><input type="text" id="<?php echo $id ?>_qty" value="" place-holder="qty" style="width:70px" /></td><td>

					<table>

					<thead>

					<th></th><th>SPH</th><th>Cyl</th><th>Axis</th><th>Add</th>

					</thead>

					<tbody>

					<tr>

					<td><b>RE</b></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_rspf"  /></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_rcyl"  /></td><td><input type="text" style="width:70px" id="<?php echo $id ?>_raxis"  /></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_radd"  /></td>

					<tr>

					<td><b>LE</b></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_lspf"  /></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_lcyl"  /></td><td><input type="text" style="width:70px" id="<?php echo $id ?>_laxis"  /></td><td><input style="width:70px" type="text" id="<?php echo $id ?>_ladd"  /></td>

					</tr>

					</tr>

					</tbody>

					</table>

					</td><td><span><button onclick="add_indent('<?php echo $id ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>

					

				<?php	

					}

				

				}		

			

			}

		//echo json_encode($arr);

	

	}

function save_purchase_order(){

		

		global $conn;

		

		$id=$_POST['id'];
		$qty=$_POST['qty'];
		$rspf="0";
		$rcyl="0";
		$raxis="0";
		$lspf="0";
		$lcyl="0";
		$laxis="0";
		//$qty=$_POST['qty'];
		$vendor_id=$_POST['vendor_id'];
		$vendor_name=$_POST['vendor_name'];
		$user_id=$_SESSION['user_id'];
		$asset_name=$_POST['asset_name'];	
		$created_on=date('Y-m-d');
		$created_by=$_SESSION['id'];

		

		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);

   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);

		$purchase_order_no=get_purchase_order_number();

		$sql="insert into `purchase_order_for_optical`(`order_number`, `user_id`,`vendor_id`,`vendor_name`,`created_on`,`created_by`) values('$purchase_order_no','$user_id','$vendor_id','$vendor_name','$created_on','$created_by')";
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
		$order_id=mysqli_insert_id($conn);

		
		foreach($id as $key => $val){

			//echo $val;

			$gp_id="";

			if($_POST['rspf']!=""){		
				/*$rspf=$_POST['rspf'][$key];
				$rcyl=$_POST['rcyl'][$key];
				$raxis=$_POST['raxis'][$key];
				$lspf=$_POST['lspf'][$key];
				$lcyl=$_POST['lcyl'][$key];
				$laxis=$_POST['laxis'][$key];
				$radd=$_POST['radd'][$key];
				$ladd=$_POST['ladd'][$key];*/
				$rspf=($_POST['rspf'][$key]!='') ? $_POST['rspf'][$key] : "0";
				$rcyl=($_POST['rcyl'][$key]!='') ? $_POST['rcyl'][$key] : "0";
				$raxis=($_POST['raxis'][$key]!='') ? $_POST['raxis'][$key] : "0";
				$lspf=($_POST['lspf'][$key]!='') ? $_POST['lspf'][$key] : "0";
				$lcyl=($_POST['lcyl'][$key]!='') ? $_POST['lcyl'][$key] : "0";
				$laxis=($_POST['laxis'][$key]!='') ? $_POST['laxis'][$key] : "0";
				$radd=($_POST['radd'][$key]!='') ? $_POST['radd'][$key] : "0";
				$ladd=($_POST['ladd'][$key]!='') ? $_POST['ladd'][$key] : "0";
				

				$sql_="INSERT INTO `gp_item_master_for_optical` (`item_id`, `rspf`, `rcyl`, `raxis`, `lspf`, `lcyl`, `laxis`, `radd`, `ladd`, `status`,`created_on`) VALUES ('$val', '$rspf', '$rcyl', '$raxis', '$lspf', '$lcyl', '$laxis','$radd','$ladd', '1','$created_on');";
				$res_=mysqli_query($conn,$sql_) or die(json_encode(array("flag"=>"0")));
				$row_gp_id_=mysqli_insert_id($conn);

				$sql_gp_id="select `id` from `gp_item_master_for_optical` where `item_id`='".$val."' and `id`='".$row_gp_id_."' and `created_on`='".$created_on."'";
				$result_gp_id=mysqli_query($conn,$sql_gp_id) or die($conn);
				while($row_gp_id=mysqli_fetch_array($result_gp_id)){
			   	$sql="insert into  `purchase_order_details_for_optical` (`order_id`,`item_id`, `item_name`,`gp_id`,`qty`) values('$order_id','".$val."','".$asset_name[$key]."','".$row_gp_id['id']."','".$qty[$key]."')";
				$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));

				}
			}
		}

		

		$tans_sql="COMMIT;";

		mysqli_query($conn,$tans_sql);

		

		echo json_encode(array("flag"=>"1"));}



function load_po_order_details(){
		global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select * FROM `purchase_order_for_optical` limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mrp=(isset($mrp)) ? $mrp : " ";
			$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("order_number"=>$order_number,"id"=>$id,"vendor_name"=>$vendor_name,"date"=>date('d-m-Y',strtotime($date)),"status"=>$status,"action"=>$action_edit);
		}		
		echo json_encode($arr);
	}

function load_po_order(){

	

		global $conn;

		 $sql="select * FROM `purchase_order_for_optical` where status<>0 and status<>1 and status<>4";

		$res=mysqli_query($conn,$sql);

		//$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$mrp=(isset($mrp)) ? $mrp : " ";

			$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("order_number"=>$order_number,"id"=>$id,"date"=>date('d-m-Y',strtotime($date)));

		}		

		

		echo json_encode($arr);

	

	}

function load_po_order_by_indent_id(){

	

	

		global $conn;

		

		$id=$_POST['id'];

		

		$sql="";

		

		$sql="select item_master_for_optical.*,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat,purchase_order_details_for_optical.item_name,purchase_order_details_for_optical.qty_recieved,purchase_order_for_optical.id as `order_id`,purchase_order_details_for_optical.id as `order_details_id`,purchase_order_details_for_optical.qty,purchase_order_details_for_optical.qty_recieved, unit_name, size,color,IF(covid_item=1, 'YES', 'NO') as covid_item, purchase_order_for_optical.vendor_id,purchase_order_details_for_optical.department_name,purchase_order_details_for_optical.batch as `pur_batch`,purchase_order_details_for_optical.gp_id from item_master_for_optical left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id left join unit_master_for_optical on unit_master_for_optical.id=item_master_for_optical.unit_id inner join purchase_order_details_for_optical on item_master_for_optical.id=purchase_order_details_for_optical.item_id left join purchase_order_for_optical on purchase_order_for_optical.id=purchase_order_details_for_optical.order_id where purchase_order_for_optical.id='$id' ";
		//$sql=($sql=="") ? $sql1 : $sql;  
		//echo $sql;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
		?>

			

			<tr data-vender="<?php echo $vendor_id ?>"><td id="<?php echo $id.$order_id ?>_asset"><?php echo $item_name; ?><input type="hidden" id="<?php echo $id.$order_id ?>_hsm_code" value="<?php echo $hsm_code ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_gst_rate" value="<?php echo $gst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_cgst_rate" value="<?php echo $cgst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_sgst_rate" value="<?php echo $sgst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_vendor" value="<?php echo $vendor_id ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_gp_id" value="<?php echo $gp_id ?>"  /></td><td id="<?php echo $id.$order_id ?>_covid_item"><?php echo $category_name; ?></td><td id="<?php echo $id.$order_id ?>_covid_item"><?php echo $sub_cat; ?></td><td id="<?php echo $id.$order_id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id.$order_id ?>_color"><?php echo $color; ?></td>

			<td id="<?php echo $id.$order_id ?>_gp">

					<?php $sql_gp="select * from gp_item_master_for_optical where id='$gp_id'"; 

					

						  $res_gp=mysqli_query($conn,$sql_gp) or die(mysqli_error($conn));

						  while($row_gp=mysqli_fetch_assoc($res_gp)){

					

					?>

					<table>

					<thead>

					<th></th><th>SPH</th><th>Cyl</th><th>Axis</th><th>Add</th>

					</thead>

					<tbody>

					<tr>

					<td><b>RE</b></td><td><?php echo $row_gp['rspf']; ?></td><td><?php echo $row_gp['rcyl']; ?></td></td><td><?php echo $row_gp['raxis']; ?></td><td><?php echo $row_gp['radd']; ?></td>

					<tr>

					<td><b>LE</b></td><td><?php echo $row_gp['lspf']; ?></td><td><?php echo $row_gp['lcyl']; ?></td><td><?php echo $row_gp['laxis']; ?></td><td><?php echo $row_gp['ladd']; ?></td>

					</tr>

					</tr>

					</tbody>

					</table>

					<?php } ?>

					</td>

			<td><input type="text" id="<?php echo $id.$order_id ?>_qty" data-qty="<?php echo ($qty-$qty_recieved) ?>" value="<?php echo ($qty-$qty_recieved) ?>" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id.$order_id ?>','<?php echo $order_id ?>','<?php echo $order_details_id ?>','<?php echo $id ?>','<?php echo $pur_batch; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>

		<?php

			

		

		}		

		

		//echo json_encode($arr);

	

	}

function save_purchase(){
		global $conn;
		$purchase_order_id=$_POST['purchase_id'];
		$purchase_order_details_id=$_POST['purchase_details_id'];
		$asset_id=$_POST['id'];
		$qty=$_POST['qty'];
		$batch_no=$_POST['batch_no'];
		$mfg_date=$_POST['mfg_date'];
		$expiry_date=$_POST['expiry_date'];
		$rate=$_POST['rate'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];
		$vendor_id=$_POST['vendor_id'];
		$vendor_name=$_POST['vendor_name'];
		$mrp=$_POST['mrp'];
		$user_id=$_SESSION['user_id'];
		$disc_rate=$_POST['disc_rate'];
		$disc_amount=$_POST['disc_amount'];
		$gst_rate=$_POST['gst_rate'];
		$gst_amount=$_POST['gst_amount'];
		$cgst_rate=$_POST['cgst_rate'];
		$cgst_amount=$_POST['cgst_amount'];
		$sgst_rate=$_POST['sgst_rate'];
		$sgst_amount=$_POST['sgst_amount'];
		$gp_id=$_POST['gp_id'];
		$bar_code=$_POST['bar_code'];
		$grand_total=round($_POST['grand_total']);
		$total_cgst_amount=$_POST['total_cgst_amount'];
		$total_sgst_amount=$_POST['total_sgst_amount'];
		$department_id=$_SESSION['department_id'];
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);

   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);

		$purchase_no=get_purchase_number();
		$sql="insert into `purchase_for_optical`(`order_number`, `user_id`,`vendor_id`,`department_id`,`vendor_name`,`gst_amount`,`cgst_amount`,`sgst_amount`,`amount`,`created_by`,`created_on`) values('$purchase_no','$user_id','$vendor_id','$department_id','$vendor_name','$total_gst_amount','$total_cgst_amount','$total_sgst_amount','$grand_total','$created_by','$created_on')";
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Purchase insert")));
		$purchase_id=mysqli_insert_id($conn);

		$sql_sum="select (sum(qty)-sum(qty_recieved)) as sum_qty,order_id from purchase_order_details_for_optical where qty>qty_recieved group by order_id ";
		$res=mysqli_query($conn,$sql_sum) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
		while($row_sum=mysqli_fetch_assoc($res)){
			$sum_qty[$row_sum['order_id']]=$row_sum['sum_qty'];				
		}		
		$indent_key="";
		$qty_sum=0;
		foreach($purchase_order_details_id as $key => $val){
			if($indent_key!=$purchase_order_id[$key]){
				$qty_sum=0;
			}
			$sql_update="update purchase_order_for_optical set status=2 where id='".$purchase_order_id[$key]."'";
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));

			$sql_update="update purchase_order_details_for_optical set status=2,qty_recieved=qty_recieved+".$qty[$key]." where id='".$val."'";
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));

			$qty_sum=$qty_sum+$qty[$key];
			//echo "sum_qty:::".$sum_qty[$indent_id[$key]];
			if($qty_sum<=$sum_qty[$purchase_order_id[$key]]){
			  $sql_update="update purchase_order_for_optical set status=0 where id='".$purchase_order_id[$key]."'";
			  mysqli_query($conn,$sql_update)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			  $sql_update="update purchase_order_details_for_optical set status=0 where id='".$val."'";			
			  mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			}

			$free_flag=($purchase_order_details_id=="") ? "free" : "";
			$sql="insert into  purchase_details_for_optical (`purchase_id`, `purchase_order_id`, `purchase_order_details_id`, `item_id`, `item_name`,`department_name`,`batch_no`,`manufacturing_date`,`expiry_date`,`qty`,`rate`,`disc_rate`,`disc_amount`,`gst_rate`,`gst_amount`,`cgst_rate`,`cgst_amount`,`sgst_rate`,`sgst_amount`,`total`,`mrp`,`gp_id`,`bar_code`) values('$purchase_id','".$purchase_order_id[$key]."','".$val."','".$asset_id[$key]."','".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."','".$department_name[$key]."','".$batch_no[$key]."','".date("Y-m-d",strtotime($mfg_date[$key]))."','".date("Y-m-d",strtotime($expiry_date[$key]))."','".$qty[$key]."','".$rate[$key]."','".$disc_rate[$key]."','".$disc_amount[$key]."','".$gst_rate[$key]."','".$gst_amount[$key]."','".$cgst_rate[$key]."','".$cgst_amount[$key]."','".$sgst_rate[$key]."','".$sgst_amount[$key]."','".$total_amount[$key]."','".$mrp[$key]."','".$gp_id[$key]."','".$bar_code[$key]."')";
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			$indent_key=$purchase_order_id[$key];
		}

		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		echo json_encode(array("flag"=>"1","p_id"=>$purchase_id));

}

function load_purchase(){

		global $conn;

		$sql="select * from purchase_for_optical order by purchase_for_optical.date desc";

		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

		?>
<!--<a href="purchase_invoice_print_for_optical.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $order_number; ?></a>-->
			<tr><td id="<?php echo $id ?>_asset"><?php echo $order_number; ?><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_size"><?php echo $vendor_name; ?></td><td id="<?php echo $id ?>_amount"><?php echo $amount; ?></td><td><a href="javascript:void(0);" onclick="del_invoice('<?php echo $id ?>')"><i class="fa fa-trash"></i></a></td></tr>

		

		<?php

		}

}

function search_batch_mrp(){

	global $conn;

	

	$batch_code=$_POST["batch_code"];

	$batch_code_o=(isset($_POST["batch_code"])) ? ' and batch="'.$_POST["batch_code"].'"' : '';

	$item_id=$_POST['item_id'];

	$batch_flag=0;

	

	$sql="select * from opening_stock_for_optical where item_id='".$item_id."' $batch_code_o and status=1";

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){

		extract($row);

		$expiry=($expiry!='1969-12-31') ? $expiry : "";

		$mfg_date=($mfg_date!='1970-01-01') ? $mfg_date : "";

		$batch_flag=1;

		$arr=array("mrp"=>$mrp,"expiry_date"=>$expiry,"mfg_date"=>$mfg_date,"item_id"=>$item_id,"rate"=>$mrp,"batch_flag"=>$batch_flag);

		



	}

	if($batch_flag==0){

	$sql="select * from purchase_details_for_optical where item_id='".$item_id."' and batch_no='".$batch_code."'";

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){

		extract($row);

		$expiry_date=($expiry_date!='1970-01-01') ? $expiry_date : "";

		$mfg_date=($mfg_date!='1970-01-01') ? $mfg_date : "";

		$batch_flag=1;

		$arr=array("mrp"=>$mrp,"expiry_date"=>$expiry_date,"mfg_date"=>$manufacturing_date,"item_id"=>$item_id,"rate"=>$rate,"batch_flag"=>$batch_flag);

		

	}

	}

	if($batch_flag==0){

		$arr=array("mrp"=>"","expiry_date"=>"","mfg_date"=>"","item_id"=>$item_id,"rate"=>"","batch_flag"=>$batch_flag);

	}

	

	echo json_encode($arr);



}



function get_patient_info(){

		global $conn;

		$mrd_no=($_POST['uhid']!='') ? " where mrd_no='".$_POST['uhid']."'" : '' ;

		$phone_no=($_POST['phone_no']!='') ? " where mobile='".$_POST['phone_no']."'" : '' ;

		$sql="select `prescription_details_for_emr`.*,`prefix_masters`.`prefix_name` FROM `prescription_details_for_emr` LEFT JOIN `prefix_masters` ON `prescription_details_for_emr`.`prefix`=`prefix_masters`.`id` $mrd_no $phone_no";

		$res=mysqli_query($conn,$sql);

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$arr=array("name"=>$prefix_name.' '.$fname.' '.$lname,"mobile"=>$mobile,"doc_id"=>$primary_doctor,"glass_block"=>$glass_block,"distance_sph_r"=>$row['distance_sph_r'],"distance_cyl_r"=>$row['distance_cyl_r'],"distance_axis_r"=>$row['distance_axis_r'],"distance_va_r"=>$row['distance_va_r'],"distance_sph_l"=>$row['distance_sph_l'],"distance_cyl_l"=>$row['distance_cyl_l'],"distance_axis_l"=>$row['distance_axis_l'],"distance_va_l"=>$row['distance_va_l'],"near_sph_r"=>$row['near_sph_r'],"near_va_r"=>$row['near_va_r'],"near_va_l"=>$row['near_va_l'],"add_re_eye"=>$row['near_sph_r'],"add_le_eye"=>$row['near_sph_l']);

		}		

		

		echo json_encode($arr);

}

function save_sales_order(){	
		global $conn;
		$asset_id=$_POST['id'];
		$qty=$_POST['qty'];
		$batch_no=$_POST['batch_no'];
		$mfg_date=$_POST['mfg_date'];
		$expiry_date=$_POST['expiry_date'];
		$rate=$_POST['rate'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];
		$user_id=$_SESSION['user_id'];
		$disc_rate=$_POST['disc_rate'];
		$disc_amount=$_POST['disc_amount'];
		$gst_rate=$_POST['gst_rate'];
		$gst_amount=$_POST['gst_amount'];
		$cgst_rate=$_POST['cgst_rate'];
		$cgst_amount=$_POST['cgst_amount'];
		$sgst_rate=$_POST['sgst_rate'];
		$sgst_amount=$_POST['sgst_amount'];
		$grand_total=round($_POST['grand_total']);
		$total_cgst_amount=$_POST['total_cgst_amount'];
		$total_sgst_amount=$_POST['total_sgst_amount'];
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		$inv_date=$_POST['inv_date'];
		$customer_name=$_POST['customer_name'];
		$phone_number=$_POST['phone_number'];
		$cash=$_POST['cash'];
		$card=$_POST['card'];
		$upi=$_POST['upi'];
		$tpa=$_POST['tpa_amount'];
		$tpa_company=$_POST['tpa'];
		$doctor=$_POST['doctor'];
		$uhid=$_POST['uhid'];
		$advance_amount=$_POST['advance_amount'];
		$operator=$_POST['operator'];
		$item_hsn_code=$_POST['item_hsn_code'];
		$rspf=$_POST['rspf'];
		$rcyl=$_POST['rcyl'];
		$raxis=$_POST['raxis'];
		$radd=$_POST['radd'];
		$lspf=$_POST['lspf'];
		$lcyl=$_POST['lcyl'];
		$laxis=$_POST['laxis'];
		$ladd=$_POST['ladd'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);

   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);

		$sql_customer="insert into customer_master_for_optical(`vendor_name`, `phone`,`uhid`) values('$customer_name','$phone_number','$uhid')";
		mysqli_query($conn,$sql_customer) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Customer insert")));
		$customer_id=mysqli_insert_id($conn);
		$sales_no=get_sales_order_number();

		$sql="insert into `sales_order_for_optical`(`order_number`, `user_id`,`customer_id`,`uhid`,`customer_name`,`doctor_name`,`gst_amount`,`cgst_amount`,`sgst_amount`,`amount`,`advance_amount`,`status`,`operator`,`phone_number`,`created_by`,`created_on`,`rspf`, `rcyl`, `1_raxis`, `radd`, `lspf`, `lcyl`, `1_laxis`, `ladd`) values('$sales_no','$user_id','$customer_id','$uhid','$customer_name','$doctor','$total_gst_amount','$total_cgst_amount','$total_sgst_amount','$grand_total','$advance_amount','2','$operator','$phone_number','$created_by','$created_on','$rspf', '$rcyl', '$raxis', '$radd', '$lspf', '$lcyl', '$laxis', '$ladd')";
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		$sales_id=mysqli_insert_id($conn);
		$indent_key="";
		$qty_sum=0;
		//print_r($asset_name);
		foreach($asset_id as $key => $val){			
			$qty_sum=$qty_sum+$qty[$key];
			$mfg_date_=($mfg_date[$key]=="" || $mfg_date[$key]=="null") ? 'NULL' : "'".date("Y-m-d",strtotime($mfg_date[$key]))."'";
			$expiry_date_=($expiry_date[$key]=="" || $expiry_date[$key]=="null") ? 'NULL' : "'".date("Y-m-d",strtotime($expiry_date[$key]))."'";
			$sql="insert into  sales_order_details_for_optical (`sales_id`, `item_id`, `item_name`,`department_name`,`batch_no`,`manufacturing_date`,`expiry_date`,`qty`,`rate`,`disc_rate`,`disc_amount`,`gst_rate`,`gst_amount`,`cgst_rate`,`cgst_amount`,`sgst_rate`,`sgst_amount`,`total`,`item_hsn_code`) values('$sales_id','".$val."','".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."','".$department_name[$key]."','".$batch_no[$key]."',".$mfg_date_.",".$expiry_date_.",'".$qty[$key]."','".$rate[$key]."','".$disc_rate[$key]."','".$disc_amount[$key]."','".$gst_rate[$key]."','".$gst_amount[$key]."','".$cgst_rate[$key]."','".$cgst_amount[$key]."','".$sgst_rate[$key]."','".$sgst_amount[$key]."','".$total_amount[$key]."','".$item_hsn_code[$key]."')";
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."S Order Details insert")));
		}
		/*if($cash!="" && $cash!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`) values('$sales_id','cash','$cash')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($card!="" && $card!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`) values('$sales_id','card','$card')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($upi!="" && $upi!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`) values('$sales_id','upi','$upi')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($tpa!="" && $tpa!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`,`amount`,`tpa_company`) values('$sales_id','tpa','$tpa','$tpa_company')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}*/
		if($cash!="" && $cash!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','cash','$cash','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($card!="" && $card!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','card','$card','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($upi!="" && $upi!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','upi','$upi','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($tpa!="" && $tpa!="0"){
			$sql_mode="insert into payment_mode_for_optical(`sales_order_id`, `mode`,`amount`,`tpa_company`,`created_on`,`created_by`) values('$sales_id','tpa','$tpa','$tpa_company','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		$vendor_id=(isset($_POST['vendor_id'])) ? $_POST['vendor_id'] : ""; 
		$pd=(isset($_POST['pd'])) ? $_POST['pd'] : "";
		$seg_ht=(isset($_POST['seght'])) ? $_POST['seght'] : "";
		$coating=(isset($_POST['coating'])) ? $_POST['coating'] : "";
		$color=(isset($_POST['color'])) ? $_POST['color'] : "";
		//$order_date=(isset($_POST['order_date'])) ? $_POST['order_date'] : "";
		//$delivery_date=(isset($_POST['delivery_date'])) ? $_POST['delivery_date'] : "";
		$remarks=(isset($_POST['remarks'])) ? $_POST['remarks'] : "";
		$sql="insert into vendor_order_for_optical(`sales_order_id`, `customer_id`, `vendor_id`, `pd`, `seg_ht`, `coating`, `color`,`remarks`, `status`) values('$sales_id','$customer_id','$vendor_id','$pd','$seg_ht','$coating','$color','$remarks','1')";
		mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."vendor insert")));

		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id));
}

function get_order_details(){

	global $conn;
	$uhid=$_POST['uhid'];
	$phone_number=$_POST['phone_no'];
	if($uhid!=""){
	$sql="select sales_order_for_optical.id,sales_order_for_optical.order_number,sales_order_for_optical.amount from sales_order_for_optical where sales_order_for_optical.uhid='$uhid' and (sales_order_for_optical.status=1 || sales_order_for_optical.status=2)";
	}

	if($phone_number!=""){
	$sql="select sales_order_for_optical.id,sales_order_for_optical.order_number,sales_order_for_optical.amount from sales_order_for_optical where sales_order_for_optical.phone_number='$phone_number' and (sales_order_for_optical.status=1 || sales_order_for_optical.status=2)";
	}

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$arr=array();
	while($row=mysqli_fetch_assoc($res)){
		$arr[]=array("id"=>$row['id'],"order_number"=>$row['order_number'].' ('.$row['amount'].')');
	}
	echo json_encode($arr);
}
function get_patient_order_vender(){

	global $conn;
	$order_id=$_POST['order_id'];
	$sql="select * from vendor_order_for_optical where sales_order_id='$order_id'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	//$arr=array();
	$row=mysqli_fetch_assoc($res);
	//$arr[]=array("value"=>$row['vendor_id']);
	
	echo json_encode(array("value"=>$row['vendor_id']));
}

function save_salse(){
		global $conn;
		//$purchase_order_id=$_POST['purchase_id'];
		//$purchase_order_details_id=$_POST['purchase_details_id'];
		if($_SESSION[$asset_id]>$_POST['qty']){
			echo json_encode(array("flag"=>"0","reason"=>"Item stock not available"));
			return;
		}

		$asset_id=$_POST['id'];
		$qty=$_POST['qty'];
		$batch_no=$_POST['batch_no'];
		$mfg_date=$_POST['mfg_date'];
		$expiry_date=$_POST['expiry_date'];
		$rate=$_POST['rate'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];
		$user_id=$_SESSION['user_id'];
		$disc_rate=$_POST['disc_rate'];
		$disc_amount=$_POST['disc_amount'];
		$gst_rate=$_POST['gst_rate'];
		$gst_amount=$_POST['gst_amount'];
		$cgst_rate=$_POST['cgst_rate'];
		$cgst_amount=$_POST['cgst_amount'];
		$sgst_rate=$_POST['sgst_rate'];
		$sgst_amount=$_POST['sgst_amount'];
		$grand_total=round($_POST['grand_total']);
		$total_cgst_amount=$_POST['total_cgst_amount'];
		$total_sgst_amount=$_POST['total_sgst_amount'];
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		$inv_date=$_POST['inv_date'];
		$customer_name=$_POST['customer_name'];
		$phone_number=$_POST['phone_number'];
		$cash=$_POST['cash'];
		$card=$_POST['card'];
		$upi=$_POST['upi'];
		$tpa=$_POST['tpa_amount'];
		$tpa_company=$_POST['tpa'];
		$doctor=$_POST['doctor'];
		$uhid=$_POST['uhid'];
		$sales_order_id=$_POST['sales_order_id'];
		$hsn_code=$_POST['hsn_code'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);

   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);

		$sales_no=get_sales_number();
		
		$sql="insert into `pharma_invoice_for_optical`(`order_number`, `user_id`,`uhid`,`customer_name`,`doctor_name`,`gst_amount`,`cgst_amount`,`sgst_amount`,`amount`,`phone_number`,`created_on`,`created_by`,`sales_order_id`) values('$sales_no','$user_id','$uhid','$customer_name','$doctor','$total_gst_amount','$total_cgst_amount','$total_sgst_amount','$grand_total','$phone_number','$created_on','$created_by','$sales_order_id')";
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		$sales_id=mysqli_insert_id($conn);
		$indent_key="";
		$qty_sum=0;

		foreach($asset_id as $key => $val){
			$qty_sum=$qty_sum+$qty[$key];
			$sql="insert into  pharma_invoice_details_for_optical (`sales_id`, `item_id`, `item_name`,`department_name`,`batch_no`,`manufacturing_date`,`expiry_date`,`qty`,`rate`,`disc_rate`,`disc_amount`,`gst_rate`,`gst_amount`,`cgst_rate`,`cgst_amount`,`sgst_rate`,`sgst_amount`,`total`,`hsn_code`) values('$sales_id','".$val."','".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."','".$department_name[$key]."','".$batch_no[$key]."','".date("Y-m-d",strtotime($mfg_date[$key]))."','".date("Y-m-d",strtotime($expiry_date[$key]))."','".$qty[$key]."','".$rate[$key]."','".$disc_rate[$key]."','".$disc_amount[$key]."','".$gst_rate[$key]."','".$gst_amount[$key]."','".$cgst_rate[$key]."','".$cgst_amount[$key]."','".$sgst_rate[$key]."','".$sgst_amount[$key]."','".$total_amount[$key]."','".$hsn_code[$key]."')";
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			//$indent_key=$purchase_order_id[$key];
		}

		if($cash!="" && $cash!="0"){
			$sql_mode="insert into payment_mode_for_optical(`pharma_invoice_id`,`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','$sales_order_id','cash','$cash','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($card!="" && $card!="0"){
			$sql_mode="insert into payment_mode_for_optical(`pharma_invoice_id`,`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','$sales_order_id','card','$card','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($upi!="" && $upi!="0"){
			$sql_mode="insert into payment_mode_for_optical(`pharma_invoice_id`,`sales_order_id`, `mode`, `amount`,`created_on`,`created_by`) values('$sales_id','$sales_order_id','upi','$upi','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($tpa!="" && $tpa!="0"){
			$sql_mode="insert into payment_mode_for_optical(`pharma_invoice_id`,`sales_order_id`, `mode`,`amount`,`tpa_company`,`created_on`,`created_by`) values('$sales_id','$sales_order_id','tpa','$tpa','$tpa_company','$created_on','$created_by')";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if($sales_order_id!=""){
			$sql_order_update="update sales_order_for_optical set status='3',pharma_invoice_id='$sales_id' where id='$sales_order_id'";
			mysqli_query($conn,$sql_order_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."ORDER Update")));
		}	
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id));
}

function expiry_or_damage_item(){

	

		global $conn;

		$asset_id=$_POST['id'];
		$qty=$_POST['qty'];
		$batch_no=$_POST['batch_no'];
		$mfg_date=$_POST['mfg_date'];
		$expiry_date=$_POST['expiry_date'];
		$asset_name=$_POST['asset_name'];
		$user_id=$_SESSION['user_id'];
		//$inv_date=str_replace('/','-',$_POST['inv_date']);
		//$inv_date=date('Y-m-d',strtotime($inv_date));
		$inv_date=($_POST['inv_date']=="" || $_POST['inv_date']=="null") ? 'NULL' : "'".date("Y-m-d",strtotime($_POST['inv_date']))."'";
		$department_id=$_SESSION['department_id'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);



   		$tans_sql="START TRANSACTION;";

   		mysqli_query($conn,$tans_sql);

		$transfer_no=get_expiry_number();
		//if($to_department_id==0) die(json_encode(array("flag"=>"0")));
		$sql="insert into `expiry_or_damage_for_optical`(`transfer_number`, `user_id`, `department_id`, `date`,`created_on`,`created_by`) values('$transfer_no','$user_id','$department_id',".$inv_date.",'$created_on','$created_by')";
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		$sales_id=mysqli_insert_id($conn);
		$indent_key="";
		$qty_sum=0;
		foreach($asset_id as $key => $val){
			$mfg_date_=($mfg_date[$key]=="" || $mfg_date[$key]=="null") ? 'NULL' : "'".date("Y-m-d",strtotime($mfg_date[$key]))."'";
			$expiry_date_=($expiry_date[$key]=="" || $expiry_date[$key]=="null") ? 'NULL' : "'".date("Y-m-d",strtotime($expiry_date[$key]))."'";
			$sql="insert into  `expiry_or_damage_details_for_optical` (`consumables_id`, `item_id`, `item_name`, `batch_no`, `manufacturing_date`, `expiry_date`, `qty`, `date`) values('$sales_id','".$val."','".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."','".$batch_no[$key]."',".$mfg_date_.",".$expiry_date_.",'".$qty[$key]."',".$inv_date.")";
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Expiry Transfer Details insert")));
		}

		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);

		echo json_encode(array("flag"=>"1","c_id"=>$sales_id));


}

function approve_po_order(){

	global $conn;

	$id=$_POST['id'];

	$sql="update purchase_order_for_optical set status='3' where id='$id'";			

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	if($res) echo json_encode(array("flag"=>1));

	else echo json_encode(array("flag"=>0));

}

function approve_del_order(){

	global $conn;

	$id=$_POST['id'];

	$sql="update purchase_order_for_optical set status='4' where id='$id'";			

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	if($res) echo json_encode(array("flag"=>1));

	else echo json_encode(array("flag"=>0));

}

function show_purchase_order_details(){

	

		global $conn;

		

		$id=$_POST['id'];

		

		$sql="SELECT purchase_order_for_optical.order_number,purchase_order_for_optical.date,purchase_order_for_optical.vendor_name,pd.item_name,pd.department_name,pd.qty,pd.qty,pd.gp_id FROM `purchase_order_for_optical` inner join purchase_order_details_for_optical as `pd` on purchase_order_for_optical.id=pd.order_id where purchase_order_for_optical.id='$id'";

		

		$res=mysqli_query($conn,$sql);

		$pn=0;

		$dt="";

		$vn="";

		$body="";		

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			

			$pn=$order_number;

			$dt=date("d/m/Y",strtotime($date));

			$vn=$vendor_name;	

		

		$sql_gp="select * from gp_item_master_for_optical where id='".$gp_id."'";

		$res_gp=mysqli_query($conn,$sql_gp);

		while($row_gp=mysqli_fetch_assoc($res_gp)){

		

			$gp_table='<table class="table table-bordered"><thead><th></th><th>SPH</th><th>Cyl</th><th>Axis</th><th>Add</th></thead><tbody><tr><td><b>RE</b></td><td>'.$row_gp['rspf'].'</td><td>'.$row_gp['rcyl'].'</td></td><td>'.$row_gp['raxis'].'</td><td>'.$row_gp['radd'].'</td><tr><td><b>LE</b></td><td>'.$row_gp['lspf'].'</td><td>'.$row_gp['lcyl'].'</td><td>'.$row_gp['laxis'].'</td><td>'.$row_gp['ladd'].'</td></tr></tr></tbody></table>';

			

		}

		$body.='<tr><td>'. date("d/m/Y",strtotime($date)) .'</td><td>'. $department_name.'</td><td>'.$item_name.'</td><td>'.$qty.'</td><td>'.$gp_table.'</td></tr>';

		

			

		}

		$arr=array("purchase_number"=>$pn,"date"=>$dt,"vendor_name"=>$vn,"body"=>$body);

		echo json_encode($arr);

	

	}



function batch_wise_stock_all(){

global $conn;

	

}

function load_all_item_names(){
		global $conn;
		$type_id=($_POST['type_id']!='') ? ' and type_id='.$_POST['type_id'].'' : '' ;
		$sub_type_id=($_POST['sub_type_id']!='') ? ' and sub_type_id='.$_POST['sub_type_id'].'' : '' ;
		$sql="select * from `item_master_for_optical` where asset_name<>'' $type_id $sub_type_id and `status`<>2 ORDER BY `asset_name` ";
		$res=mysqli_query($conn,$sql);
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$arr[]=array("id"=>$id,"text"=>$asset_name);
		}		
		echo json_encode($arr);
	}
function load_item_with_barcode(){
	global $conn;
	$barcode=$_POST['barcode'];
	$sql="select purchase_details_for_optical.*,item_master_for_optical.*,purchase_details_for_optical.item_id as asset_id from purchase_details_for_optical inner join item_master_for_optical on item_master_for_optical.id=purchase_details_for_optical.item_id where purchase_details_for_optical.bar_code='$barcode'";
	$res_bercode=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$row_bercode=mysqli_fetch_assoc($res_bercode);	
	extract($row_bercode);
	$cgst=($gst_rate/2);
	$sgst=($gst_rate/2);
			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$cgst.'^'.$mrp,"text"=>$asset_name);
			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp,"text"=>$asset_name);
	echo json_encode(array("sub_type_id"=>$sub_type_id,"type_id"=>$type_id,"asset_name"=>$asset_id,"asset_name_text"=>$asset_name,"hsm_code"=>$hsm_code,"item_details"=>$asset_id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp));
	//echo '<pre>';print_r($row_bercode);
}
function load_sales_customer(){
	global $conn;
	$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select * FROM `pharma_invoice_for_optical` limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mrp=(isset($mrp)) ? $mrp : " ";
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("order_number"=>$order_number,"id"=>$id,"customer_name"=>$customer_name,"date"=>date('d-m-Y',strtotime($date)),"status"=>$status,"amount"=>$amount,"doctor_name"=>$doctor_name);
		}		
		echo json_encode($arr);
}

function load_sales_orders_details(){
		global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select * FROM `sales_order_for_optical` limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mrp=(isset($mrp)) ? $mrp : " ";
			$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a> | <a href="sale_invoice_order_print_vender_for_optical.php?inv_id='.$id.'" name="vender_print" id="vender_print" title="Vendor Print"><i class="fa fa-print"></i></a>';
			$arr[]=array("order_number"=>$order_number,"id"=>$id,"customer_name"=>$customer_name,"date"=>date('d-m-Y',strtotime($date)),"status"=>$status,"amount"=>$amount,"advance_amount"=>$advance_amount,"action"=>$action_edit);
		}		
		echo json_encode($arr);
	}
function load_expiry_items_details(){
	  global $conn;
	  $limit=$_POST['limit'];
	  $initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
	  $sql="select * FROM `expiry_or_damage_for_optical` limit $initial_page,$limit";
	  $res=mysqli_query($conn,$sql);
	  //$arr[]=array("id"=>"","text"=>"-Select-");
	  while($row=mysqli_fetch_assoc($res)){
		  	extract($row);
		  $mrp=(isset($mrp)) ? $mrp : " ";
		 // $action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
		  $arr[]=array("order_number"=>$transfer_number,"id"=>$id,"date"=>date('d-m-Y',strtotime($date)),"status"=>$status);
	  }		
	  echo json_encode($arr);
}
function load_idivisul_expiry_items_details(){
	  		global $conn;
			$cons_id=$_POST['id'];
		    $sql_det="select * FROM `expiry_or_damage_details_for_optical` where consumables_id='".$cons_id."'";
	  		$res_det=mysqli_query($conn,$sql_det);
			while($row_det=mysqli_fetch_assoc($res_det)){
				extract($row_det);
				$arr[]=array("item_name"=>$item_name,"batch_no"=>$batch_no,"qty"=>$qty);
			}
		  //$arr[]=array("item_det"=>$item_det);
	  	  echo json_encode($arr);
}
?>