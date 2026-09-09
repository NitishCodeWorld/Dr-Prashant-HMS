<?php

include "conn.php";
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

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
}else if($flag==32){
	save_consumables();
}else if($flag==33){
	save_stock_transfer();
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
}
/* Lens Part Addition*/
else if($flag==44){
	save_lens_recived();
}else if($flag==45){
	save_lens_transfer_to_ot();
}else if($flag==46){
	get_lens_issued_view();
}else if($flag==47){
	save_lens_return_from_ot();
}else if($flag==48){
	get_lens_recived_view_for_return();
}else if($flag==49){
	save_lens_return_vander();	
}else if($flag==50){
	lens_stock_report();	
}else if($flag==51){
	load_item_with_barcode();	
}else if($flag==52){
	save_lens_opening_stock();	
}else if($flag==53){
	load_lens_opening_stock();	
}else if($flag==54){
	load_lens_recive_stock();	
}else if($flag==55){
	lens_transfer_to_ot();	
}else if($flag==56){
	lens_return_from_ot();	
}else if($flag==57){
	lens_return_to_vendor();	
}

function save_asset(){

		global $conn;

		$hsm_code=mysqli_real_escape_string($conn,$_POST["hsm_code"]);

		$item_name=mysqli_real_escape_string($conn,$_POST['item_name']);

		$generic_name=mysqli_real_escape_string($conn,$_POST['generic_name']);

		$item_name=mysqli_real_escape_string($conn,$_POST['item_name']);

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



			$sql="UPDATE `item_master_for_optical` SET `type_id`='".$type_id."',`hsm_code`='".$hsm_code."',`sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."',`moq`='".$moq."', `size`='".$size."',`gst_rate`='".$gst_rate."',`cgst_rate`='".$cgst_rate."',`sgst_rate`='".$sgst_rate."', `color`='".$color."', `specification`='".$specification."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'";

			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));



		}else{ 



			$sql_vallidate="select `asset_name` from `item_master_for_optical` where `asset_name`='".$item_name."' and `status`<>0";

			$result=mysqli_query($conn,$sql_vallidate) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));

			$row=mysqli_fetch_assoc($result);

			$count=$result->num_rows;

			if($count==0){			  

			  $sql="INSERT INTO `item_master_for_optical` SET `type_id`='".$type_id."',`hsm_code`='".$hsm_code."',`sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."',`moq`='".$moq."', `size`='".$size."',`gst_rate`='".$gst_rate."',`cgst_rate`='".$cgst_rate."',`sgst_rate`='".$sgst_rate."', `color`='".$color."', `specification`='".$specification."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

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

		

		$sql="insert into type_master_for_optical(`category_name`) values('$add_type')";

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) {echo json_encode(array("flag"=>1));}

		else {echo json_encode(array("flag"=>0));};

	

	}

function add_sub_type(){

	

		global $conn;

		

		$type_id=$_POST['type_id'];

		$sub_type_name=$_POST['sub_type_name'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql=($_POST['type_id']=="") ? "update type_master_for_optical set category_name='$sub_type_name' where id='$id'" : "update type_master_for_optical set category_name='$sub_type_name',main_cat_id='$type_id' where id='$id'";			

		}else $sql=($_POST['type_id']=="") ? "insert into type_master_for_optical(`category_name`) values('$sub_type_name')" : "insert into type_master_for_optical(`category_name`,`main_cat_id`) values('$sub_type_name','$type_id')";

		

		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

		

		if($res) echo json_encode(array("flag"=>1));

		else echo json_encode(array("flag"=>0));

	

	}

function add_unit(){

	

		global $conn;

		

		$unit_name=$_POST['unit_name'];

				

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="update unit_master_for_optical set unit_name='$unit_name' where id='$id'";			

		}else $sql="insert into unit_master_for_optical(`unit_name`) values('$unit_name')";

		

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

		

		$arr[]=array("id"=>"","text"=>"-Select-");

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

			$action_edit='<a href="javascript:void(0)" name="edit" id="edit" onClick="edit('.$id.',\''.$hsm_code.'\',\''.$asset_name.'\',\''.$moq.'\','.$type_id.','.$sub_type_id.','.$unit_id.',\''.$size.'\',\''.$color.'\','.$gst_rate.','.$cgst_rate.','.$sgst_rate.',\''.$generic_name.'\')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';

			$arr[]=array("id"=>$id,"asset_name"=>$asset_name,"type_id"=>$category_name,"sub_type_id"=>$sub_cat,"size"=>$size,"color"=>$color,"mrp"=>$mrp,"action"=>$action_edit);

		}		

		

		echo json_encode($arr);

	

	}

function del_row(){

	global $conn;

	$table=$_POST['table'];

	$id=$_POST['id'];

	$sql="UPDATE $table SET `status`='2' WHERE id='".$id."'";

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	if($res) {echo json_encode(array("flag"=>1));}

	else {echo json_encode(array("flag"=>0));};	}

function save_vendors(){

	

		global $conn;

		

		$vendor_name=$_POST['vendor_name_'];

		$vendor_address=$_POST['vendor_address_'];

		$vendor_phone=$_POST['vendor_phone_'];

		$vendor_email=$_POST['vendor_email_'];

		$vendor_gst=$_POST['vendor_gst_'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="update vendor_master_for_optical set vendor_name='$vendor_name',address='$vendor_address',email='$vendor_email',phone='$vendor_phone',gst='$vendor_gst' where id='$id'";			

		}else $sql="insert into vendor_master_for_optical(`vendor_name`, `address`,`phone`,`email`, `gst`) values('$vendor_name','$vendor_address','$vendor_phone','$vendor_email','$vendor_gst')";

		

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

		

		$department_name=$_POST['department_name'];

				

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="update department_master_for_optical set department_name='$department_name' where id='$id'";			

		}else $sql="insert into department_master_for_optical(`department_name`) values('$department_name')";

		

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

		

		$location_name=$_POST['location'];

		

		if(isset($_POST['id']) && $_POST['id']!="" ){

			$id=$_POST['id'];

			$sql="update location_master_for_optical set location_name='$location_name' where id='$id'";			

		}else $sql="insert into location_master_for_optical(`location_name`) values('$location_name')";

		

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



function get_lens_recived_number(){

		global $conn;

		global $db;

		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'lens_recieved_for_lens_library';";

		$res1=mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($res1);

		$new_id=$row1[0]."/LR/".date("y")."-".date("y",strtotime("+1 years"));

		return $new_id;

	}

function get_lens_recived_transfer_to_ot_number(){

	global $conn;

	global $db;

	$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'lens_issued_for_lens_library';";

	$res1=mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_array($res1);

	$new_id=$row1[0]."/LR/T/OT/".date("y")."-".date("y",strtotime("+1 years"));

	return $new_id;

}



/*End Unic Number Creation*/

function load_all_item(){

	

		global $conn;

		$type_id=($_POST['type_id']!='') ? ' and type_id='.$_POST['type_id'].'' : '' ;

		$sub_type_id=($_POST['sub_type_id']!='') ? ' and sub_type_id='.$_POST['sub_type_id'].'' : '' ;

		$sql="select * from `item_master_for_optical` where asset_name<>''$type_id$sub_type_id and `status`<>2";

		$res=mysqli_query($conn,$sql);

		$arr[]=array("id"=>"","text"=>"-Select-");

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$cgst=($gst_rate/2);

			$sgst=($gst_rate/2);

			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst,"text"=>$asset_name);
			$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp,"text"=>$asset_name);

		}		

		

		echo json_encode($arr);

	

	}

	

function load_batch_code($item_id=''){

	global $conn;

	global $arr_;

	$item_id=(!isset($_POST['item_id'])) ? $item_id : $_POST['item_id'] ;



	$batch_code_=0;



	/*Lens*/

	$batch_code_=0;

	$sql_="select batch from lens_recieved_for_lens_library where item_id='".$item_id."' and status=1";

	$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));

	while($row_=mysqli_fetch_assoc($res_)){

		if(trim($row_['batch'])!=""){

			//echo $row_['batch'];	

			$batch_code_=load_closing_stock_by_batch($item_id,$row_['batch']);

			if($batch_code_>0) $arr[]=array("value"=>$row_['batch'],"text"=>$row_['batch']);

		}

	}

	/**/

	$batch_code_=0;

	$sql="select batch,qty from lens_opening_stock_for_lens_library where item_id='$item_id' and status=1 order by expiry_date";

	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){
//echo $row['batch'];
		if(trim($row['batch'])!=""){

			$batch_code_=load_closing_stock_by_batch($item_id,$row['batch']);

			if($batch_code_>0) $arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);

			/*if(multi_array_search($row['batch'],$arr)<0){

			 if($batch_code_>0) $arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);

			}*/

		}



	}

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

	   global $lens_recived;

	   global $lens_used;

	   global $lens_return;
	   global $opening_stock_;

	   global $closing_stock_;

	  //$item_id=(isset($item_id)) ? ' and item_master_for_optical.id='.$item_id.'' : '';

	  $item_id=(!isset($_POST['item_id'])) ? ' and item_master_for_optical.id='.$item_id.'' : ' and item_master_for_optical.id='.$_POST['item_id'].'' ;
	  $batch_code_=(isset($_POST["batch_code"])) ? $_POST["batch_code"] : $batch_code_1;
	  $batch_code1=($batch_code_!="undefined" && $batch_code_!="") ? " and lens_recieved_for_lens_library.batch='".$batch_code_."' " : "" ;
	  $batch_code2=($batch_code_!="undefined" && $batch_code_!="") ? " and lens_issued_for_lens_library.batch='".$batch_code_."' " : "" ;
	  $batch_code3=($batch_code_!="undefined" && $batch_code_!="") ? " and lens_returned_to_vendor_for_lens_library.batch='".$batch_code_."' " : "" ;
	  $batch_code4=($batch_code_!="undefined" && $batch_code_!="") ? " and lens_opening_stock_for_lens_library.batch='".$batch_code_."' " : "" ;

		$sql="select item_master_for_optical.*,type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat FROM item_master_for_optical left join type_master_for_optical on type_master_for_optical.id=item_master_for_optical.type_id where `asset_name`<>''$item_id and item_master_for_optical.status<>2;";

		$res=mysqli_query($conn,$sql);

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

				

			/*Lens Part*/

			$sql_recived="select sum(qty) as lens_recived from lens_recieved_for_lens_library where item_id='".$id."' and status=1 $batch_code1 group by item_id;";

			$res_recived=mysqli_query($conn,$sql_recived);

			$row_recived=mysqli_fetch_assoc($res_recived);

			$qty_recived=($row_recived['lens_recived']=='') ? 0 : $row_recived['lens_recived'];

			

			$sql_used="select sum(qty) as lens_used from lens_issued_for_lens_library where item_id='".$id."' and sold=1 $batch_code2 group by item_id;";

			$res_used=mysqli_query($conn,$sql_used);

			$row_used=mysqli_fetch_assoc($res_used);

			$qty_used=($row_used['lens_used']=='') ? 0 : $row_used['lens_used'];

			

			$sql_return="select sum(qty) as lens_return from lens_returned_to_vendor_for_lens_library where item_id='".$id."' and status=1 $batch_code3 group by item_id;";

			$res_return=mysqli_query($conn,$sql_return);

			$row_return=mysqli_fetch_assoc($res_return);

			$qty_return=($row_return['lens_return']=='') ? 0 : $row_return['lens_return'];
			
			$sql_ope_stock="select sum(qty) as lens_ope_stock from lens_opening_stock_for_lens_library where item_id='".$id."' and status=1 $batch_code4 group by item_id;";

			$res_ope_stock=mysqli_query($conn,$sql_ope_stock);

			$row_ope_stock=mysqli_fetch_assoc($res_ope_stock);

			$qty_ope_stock=($row_ope_stock['lens_ope_stock']=='') ? 0 : $row_ope_stock['lens_ope_stock'];

			

		}

	$closing_stock_=0;



	$closing_stock=(($qty_recived+$qty_ope_stock)-($qty_used+$qty_return));	

	$lens_recived=$qty_recived;

	$lens_used=$qty_used;

	$lens_return=$qty_return;
	$opening_stock_=$qty_ope_stock;

	$closing_stock_=$closing_stock;

	

	if($batch_code_1=="") echo json_encode(array("closing_stock"=>$closing_stock));

	else return $closing_stock;

}



function search_batch_mrp(){

	global $conn;
	$batch_code=$_POST["batch_code"];
	$batch_code_o=(isset($_POST["batch_code"])) ? ' and batch="'.$_POST["batch_code"].'"' : '';
	$item_id=$_POST['item_id'];
	$batch_flag=0;

	$sql="select * from lens_opening_stock_for_lens_library where item_id='".$item_id."'$batch_code_o and status=1";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
//echo 'san';
	while($row=mysqli_fetch_assoc($res)){
		extract($row);
		$expiry=($expiry_date!='1969-12-31') ? $expiry_date : "";
		$expiry=($expiry_date!='1970-01-01') ? $expiry_date : "";
		$arr=array("mrp"=>0,"expiry_date"=>$expiry,"mfg_date"=>$manufacturing_date,"item_id"=>$item_id,"rate"=>$mrp,"bar_code"=>$bar_code);
		$batch_flag=1;
	}

	$sql="select * from lens_recieved_for_lens_library where item_id='".$item_id."' and batch='".$batch_code."' and status=1";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		extract($row);
		$expiry=($expiry!='1969-12-31') ? $expiry : "";
		$expiry=($expiry!='1970-01-01') ? $expiry : "";
		$arr=array("mrp"=>0,"expiry_date"=>$expiry_date,"mfg_date"=>$manufacturing_date,"item_id"=>$item_id,"rate"=>0,"bar_code"=>$bar_code);
		$batch_flag=1;
	}

	if($batch_flag==0){
	$sql="select * from `purchase_details_for_optical` where item_id='".$item_id."' and batch_no='".$batch_code."'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		extract($row);
		$expiry_date=($expiry_date!='1970-01-01') ? $expiry_date : "";
		$arr=array("mrp"=>$mrp,"expiry_date"=>$expiry_date,"mfg_date"=>$manufacturing_date,"item_id"=>$item_id,"rate"=>$rate);
	}
	}
	echo json_encode($arr);
}



function get_patient_info(){

		global $conn;

		$mrd_no=($_POST['uhid']!='') ? " where mrd_no='".$_POST['uhid']."'" : '' ;

		$phone_no=($_POST['phone_no']!='') ? " where mobile='".$_POST['phone_no']."'" : '' ;

		$sql="select * from `prescription_details` $mrd_no$phone_no";

		$res=mysqli_query($conn,$sql);

		while($row=mysqli_fetch_assoc($res)){

			extract($row);

			$arr=array("name"=>$prefix.' '.$fname.' '.$lname,"mobile"=>$mobile,"doc_id"=>$primary_doctor,"glass_block"=>$glass_block,"distance_sph_r"=>$row['distance_sph_r'],"distance_cyl_r"=>$row['distance_cyl_r'],"distance_axis_r"=>$row['distance_axis_r'],"distance_va_r"=>$row['distance_va_r'],"distance_sph_l"=>$row['distance_sph_l'],"distance_cyl_l"=>$row['distance_cyl_l'],"distance_axis_l"=>$row['distance_axis_l'],"distance_va_l"=>$row['distance_va_l'],"near_sph_r"=>$row['near_sph_r'],"near_va_r"=>$row['near_va_r'],"near_va_l"=>$row['near_va_l'],"add_re_eye"=>$row['near_sph_r'],"add_le_eye"=>$row['near_sph_l']);

		}		

		

		echo json_encode($arr);

}



/*Lens Addition*/

function save_lens_recived(){

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
		$bar_code=$_POST['bar_code'];

		$mfg_date=$_POST['mfg_date'];

		$expiry_date=$_POST['expiry_date'];

		$vendor_id=$_POST['vendor_id'];

		$asset_name=$_POST['asset_name'];

		$user_id=$_SESSION['user_id'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		$mfg_date_="";

		$expiry_date_="";

		$tans_sql="SET autocommit = 0;";

   		mysqli_query($conn,$tans_sql);

   	  

   		$tans_sql="START TRANSACTION;";

   		mysqli_query($conn,$tans_sql);

	

		

		$transfer_no=get_lens_recived_number();

		

		foreach($asset_id as $key => $val){

		

			$mfg_date_=($mfg_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($mfg_date[$key]))."'";

			$expiry_date_=($expiry_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($expiry_date[$key]))."'";

		

			$sql="insert into `lens_recieved_for_lens_library`(`item_id`, `batch`, `name`,`vendor_id`, `manufacturing_date`, `expiry_date`, `qty`,`user_id`,`created_on`,`created_by`,`bar_code`) values('".$asset_id[$key]."','".mysqli_real_escape_string($conn,$batch_no[$key])."','".mysqli_real_escape_string($conn,$asset_name[$key])."','".$vendor_id."',".$mfg_date_.",".$expiry_date_.",'".$qty[$key]."','".$user_id."','".$created_on."','".$created_by."','".mysqli_real_escape_string($conn,$bar_code[$key])."')";

			

			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn).$sql)));

		

		}

				

		$tans_sql="COMMIT;";

		mysqli_query($conn,$tans_sql);

		

		echo json_encode(array("flag"=>"1"));

	}

function save_lens_transfer_to_ot(){

		global $conn;
		if($_SESSION[$asset_id]>$_POST['qty']){
			echo json_encode(array("flag"=>"0","reason"=>"Item stock not available"));
			return;
		}
		$asset_id=$_POST['id'];

		$qty=$_POST['qty'];

		$batch_no=$_POST['batch_no'];

		$mfg_date=$_POST['mfg_date'];

		$expiry_date=$_POST['expiry_date'];

		$vendor_id=$_POST['vendor_id'];

		$asset_name=$_POST['asset_name'];
		$bar_code=$_POST['bar_code'];

		$user_id=$_SESSION['user_id'];

		$mfg_date_="";

		$expiry_date_="";

		$mrd=$_POST['uhid'];

		$doctor_id=$_POST['doctor_id'];

		$doctor_name=$_POST['doctor_name'];

		$patient_name=$_POST['patient_name'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		$tans_sql="SET autocommit = 0;";

   		mysqli_query($conn,$tans_sql);

   	  

   		$tans_sql="START TRANSACTION;";

   		mysqli_query($conn,$tans_sql);

		$transfer_no=get_lens_recived_transfer_to_ot_number();
		foreach($asset_id as $key => $val){
			$mfg_date_=($mfg_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($mfg_date[$key]))."'";
			$expiry_date_=($expiry_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($expiry_date[$key]))."'";
			$sql="insert into `lens_issued_for_lens_library`(`item_id`, `batch`, `mrd`, `doctor_id`, `patient_name`, `doctor_name`, `qty`,`mfg_date`,`expiry_date`, `date`, `sold`, `user_id`, `created_on`, `created_by`,`bar_code`) values('".$asset_id[$key]."','".$batch_no[$key]."','".$mrd."','".$doctor_id."','".$patient_name."','".$doctor_name."','".$qty[$key]."',".$mfg_date_.",".$expiry_date_.",'".date('Y-m-d')."','1','".$user_id."','".$created_on."','".$created_by."','".$bar_code[$key]."')";
			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn).$sql)));
		}

				

		$tans_sql="COMMIT;";

		mysqli_query($conn,$tans_sql);

		

		echo json_encode(array("flag"=>"1"));

	}



function get_lens_issued_view(){



	global $conn;

	

	$patient_id=$_POST['uhid'];

	

	$sql="select lens_issued_for_lens_library.id as `id`,lens_issued_for_lens_library.item_id as `item_id`,lens_issued_for_lens_library.*,item_master_for_optical.asset_name as `item_name` from lens_issued_for_lens_library inner join item_master_for_optical on item_master_for_optical.id=lens_issued_for_lens_library.item_id where lens_issued_for_lens_library.mrd='$patient_id' and lens_issued_for_lens_library.sold=1";
	$res=mysqli_query($conn,$sql);
	$ret_val="";

	$flag=0;

	while($row=mysqli_fetch_assoc($res)){

		extract($row);
/*<button class="btn btn-success" onclick="sold('.$id.',1)">Sold</button>*/
		$ret_val.='<tr><td>'.$item_name.'</td><td>'.$batch.'</td><td>'.$bar_code.'</td><td>'.$qty.'</td><td id="'.$id.'"><button class="btn btn-danger" onclick="sold('.$id.',0)">Return</button><button class="btn btn-success" onclick="sold('.$id.',1)">Sold</button></td></tr>';

		$arr_id=array("id"=>$item_id);

		$flag=1;

	}

	

	echo json_encode(array("flag"=>$flag,"id"=>$arr_id,"ret_val"=>$ret_val));	

	



}

function save_lens_return_from_ot(){

		global $conn;

	

		$returned=$_POST['returned'];

		$mrd=$_POST['mrd'];

		$user_id=$_SESSION['user_id'];
		  $created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		

		$tans_sql="SET autocommit = 0;";

   		mysqli_query($conn,$tans_sql);

   	  

   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		foreach($returned as $key => $val){
			$sql="UPDATE `lens_issued_for_lens_library` SET `sold`='2',`return_user`='".$user_id."',`modified_by`='".$created_by."',`modified_time`='".$created_on."' WHERE id='".$val."' and mrd='".$mrd."'";
			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn).$sql)));

		}

		$tans_sql="COMMIT;";

		mysqli_query($conn,$tans_sql);

		

		echo json_encode(array("flag"=>"1"));

	}

function get_lens_recived_view_for_return(){



	global $conn;

	/*global $lens_recived_qty;
	$lens_recived_qty=array();*/
	$vendor_name=($_POST['vendor_name']=="") ? '' : " and lens_recieved_for_lens_library.vendor_id='".$_POST['vendor_name']."'";
	$vendor_name1=($_POST['vendor_name']=="") ? '' : " and lens_opening_stock_for_lens_library.vendor_id='".$_POST['vendor_name']."'";
	//$lens_recived_id=($_POST['lens_recived_id']=="") ? '' : " and lens_recieved_for_lens_library.vendor_id='".$_POST['lens_recived_id']."'";
	$sql="select * from lens_recieved_for_lens_library where lens_recieved_for_lens_library.status=1$vendor_name;";
	$res=mysqli_query($conn,$sql);
	$ret_val="";
	$flag=0;
	while($row=mysqli_fetch_assoc($res)){
		extract($row);
		//$lens_recived_qty[]=$qty;
		$unused_qty=get_unused_qty($item_id,$batch,$qty);
		if($unused_qty>0){
		$ret_val.='<tr id="tr_'.$item_id.'_'.$batch.'" data-indent="'.$item_id.'" data-recive-id="'.$id.'"><td id="item_name'.$item_id.'_'.$batch.'" style="display:none;">'.$name.'</td><td id="item_qty'.$item_id.'_'.$batch.'" style="display:none;">'.$unused_qty.'</td><td id="name'.$item_id.'_'.$batch.'">'.$name.'('.$unused_qty.')'.'</td><td id="batch'.$item_id.'_'.$batch.'">'.$batch.'</td><td id="batch'.$item_id.'_'.$batch.'">'.$bar_code.'</td><td><input type="text" class="form-control" name="unsed_qty'.$item_id.'_'.$batch.'" id="unsed_qty'.$item_id.'_'.$batch.'" value="0"></td><td><a href="javascript:void(0);" onclick="add_item('.$item_id.',\''.$batch.'\','.$id.')" class="btn green">ADD Item</a></td></tr>';
		$arr_id=array("id"=>$item_id);
		$flag=1;
		}
	}
	$sql_ope_stock="select * from lens_opening_stock_for_lens_library where lens_opening_stock_for_lens_library.status=1$vendor_name1;";
	$res_ope_stock=mysqli_query($conn,$sql_ope_stock);
	while($row_ope_stock=mysqli_fetch_assoc($res_ope_stock)){
		extract($row_ope_stock);
		//$lens_recived_qty[]=$qty;
		$unused_qty=get_unused_qty($item_id,$batch,$qty);
		if($unused_qty>0){
		$ret_val.='<tr id="tr_'.$item_id.'_'.$batch.'" data-indent="'.$item_id.'" data-recive-id="'.$id.'"><td id="item_name'.$item_id.'_'.$batch.'" style="display:none;">'.$name.'</td><td id="item_qty'.$item_id.'_'.$batch.'" style="display:none;">'.$unused_qty.'</td><td id="name'.$item_id.'_'.$batch.'">'.$name.'('.$unused_qty.')'.'</td><td id="batch'.$item_id.'_'.$batch.'">'.$batch.'</td><td id="batch'.$item_id.'_'.$batch.'">'.$bar_code.'</td><td><input type="text" class="form-control" name="unsed_qty'.$item_id.'_'.$batch.'" id="unsed_qty'.$item_id.'_'.$batch.'" value="0"></td><td><a href="javascript:void(0);" onclick="add_item('.$item_id.',\''.$batch.'\','.$id.')" class="btn green">ADD Item</a></td></tr>';
		$arr_id=array("id"=>$item_id);
		$flag=1;
		}
	}

	

	echo json_encode(array("flag"=>$flag,"id"=>$arr_id,"ret_val"=>$ret_val));	

	



}

function get_unused_qty($item_id,$batch,$qty){

	global $conn;

	$lens_recived_qty=0;

	$sql="select * from lens_issued_for_lens_library where sold=1 and item_id='$item_id' and batch='$batch'";

	$res=mysqli_query($conn,$sql);

	$row=mysqli_fetch_assoc($res);

	

	$sql_return="select * from lens_returned_to_vendor_for_lens_library where status=1 and item_id='$item_id' and batch='$batch'";

	$res_return=mysqli_query($conn,$sql_return);

	$row_return=mysqli_fetch_assoc($res_return);

	

	$lens_recived_qty=$qty-$row['qty']-$row_return['qty'];

	return $lens_recived_qty;

}

function save_lens_return_vander(){

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

		$vendor_id=$_POST['vendor'];

		$asset_name=$_POST['asset_name'];

		$recived_id=$_POST['recived_id'];

		$user_id=$_SESSION['user_id'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		

		$tans_sql="SET autocommit = 0;";

   		mysqli_query($conn,$tans_sql);

   	  

   		$tans_sql="START TRANSACTION;";

   		mysqli_query($conn,$tans_sql);

	

		

		//$transfer_no=get_lens_return_number();

		

		foreach($asset_id as $key => $val){

		

			$sql="insert into `lens_returned_to_vendor_for_lens_library`(`item_id`, `batch`, `name`, `vendor_id`, `qty`, `user_id`, `cur_date`, `status`,`recived_id`,`created_on`,`created_by`) values('".$asset_id[$key]."','".$batch_no[$key]."','".$asset_name[$key]."','".$vendor_id."','".$qty[$key]."','".$user_id."','".date('Y-m-d')."','1','".$recived_id[$key]."','".$created_on."','".$created_by."')";

			

			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn).$sql)));

		

		}

				

		$tans_sql="COMMIT;";

		mysqli_query($conn,$tans_sql);

		

		echo json_encode(array("flag"=>"1"));

	}

function lens_stock_report(){

	global $conn;

	global $lens_recived;

	global $lens_used;

	global $lens_return;
	global $opening_stock_;

	global $closing_stock_;	

	global $arr_;

	$from_=(isset($_POST['from_']) and $_POST['from_']!="" ) ? date("Y-m-d",strtotime($_POST['from_'])) : "";

	$to_=(isset($_POST['to_']) and $_POST['to_']!="") ? date("Y-m-d",strtotime($_POST['to_'])) : ""; 

	

	$filter=" and (type_id='2') ";

	

	$sql="select * from item_master_for_optical where status=1 $filter order by asset_name";

	//else $sql="select * from item_master where status=1 order by asset_name";



	$res=mysqli_query($conn,$sql);

	

	$total_val=0;

	$table_body="";

	while($row=mysqli_fetch_assoc($res)){

		if(load_batch_code($row['id'])){

			$slno=1;

			foreach($arr_ as $key => $val){

			if(load_closing_stock_by_batch($row['id'],$val['value'])){

			}

		

		$table_body.="<tr><td>".$slno."</td><td>".$row['asset_name'].'('.$row['type_id']."</td><td>".$val['value']."</td><td>".$opening_stock_."</td><td>".$lens_recived."</td><td>".$lens_used."</td><td>".$lens_return."</td><td><b>".$closing_stock_."</b></td></tr>";



			

		$slno++;}

			

		}

		

		

		

		//$arr_=array();

		

	}

	echo $table_body;

	

	//echo json_encode(array("table_body"=>$table_body));





}
function load_item_with_barcode(){
	global $conn;
	$barcode=$_POST['barcode'];
	$sql="select lens_recieved_for_lens_library.*,item_master_for_optical.*,lens_recieved_for_lens_library.item_id as asset_id from lens_recieved_for_lens_library inner join item_master_for_optical on item_master_for_optical.id=lens_recieved_for_lens_library.item_id where lens_recieved_for_lens_library.bar_code='$barcode'";
	$res_bercode=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count=$res_bercode->num_rows;
	$row_bercode=mysqli_fetch_assoc($res_bercode);	
	if($count==0){
	$sql_ope="select lens_opening_stock_for_lens_library.*,item_master_for_optical.*,lens_opening_stock_for_lens_library.item_id as asset_id from lens_opening_stock_for_lens_library inner join item_master_for_optical on item_master_for_optical.id=lens_opening_stock_for_lens_library.item_id where lens_opening_stock_for_lens_library.bar_code='$barcode'";
	$res_bercode_ope=mysqli_query($conn,$sql_ope) or die(mysqli_error($conn));
	$row_bercode_ope=mysqli_fetch_assoc($res_bercode_ope);	
	extract($row_bercode_ope);
	}else{
	extract($row_bercode);	
	}
	$cgst=($gst_rate/2);
	$sgst=($gst_rate/2);
			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$cgst.'^'.$mrp,"text"=>$asset_name);
			//$arr[]=array("id"=>$id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp,"text"=>$asset_name);
	echo json_encode(array("sub_type_id"=>$sub_type_id,"type_id"=>$type_id,"asset_name"=>$asset_id,"asset_name_text"=>$asset_name,"hsm_code"=>$hsm_code,"item_details"=>$asset_id.'^'.$hsm_code.'^'.$gst_rate.'^'.$size.'^'.$color.'^'.$cgst.'^'.$sgst.'^'.$mrp));
	//echo '<pre>';print_r($row_bercode);
}
function save_lens_opening_stock(){

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
		$bar_code=$_POST['bar_code'];

		$mfg_date=$_POST['mfg_date'];

		$expiry_date=$_POST['expiry_date'];

		$vendor_id=$_POST['vendor_id'];

		$asset_name=$_POST['asset_name'];

		$user_id=$_SESSION['user_id'];
		$created_on=date('Y-m-d H:i:s');
        $created_by=$_SESSION['id'];

		$mfg_date_="";

		$expiry_date_="";

		$tans_sql="SET autocommit = 0;";

   		mysqli_query($conn,$tans_sql);

   	  

   		$tans_sql="START TRANSACTION;";

   		mysqli_query($conn,$tans_sql);

	

		

		//$transfer_no=get_lens_recived_number();

		

		foreach($asset_id as $key => $val){
			$mfg_date_=($mfg_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($mfg_date[$key]))."'";
			$expiry_date_=($expiry_date[$key]=="") ? 'NULL' : "'".date("Y-m-d",strtotime($expiry_date[$key]))."'";
			$sql="insert into `lens_opening_stock_for_lens_library`(`item_id`, `batch`, `name`,`vendor_id`, `manufacturing_date`, `expiry_date`, `qty`,`user_id`,`created_on`,`created_by`,`bar_code`) values('".$asset_id[$key]."','".mysqli_real_escape_string($conn,$batch_no[$key])."','".mysqli_real_escape_string($conn,$asset_name[$key])."','".$vendor_id."',".$mfg_date_.",".$expiry_date_.",'".$qty[$key]."','".$user_id."','".$created_on."','".$created_by."','".mysqli_real_escape_string($conn,$bar_code[$key])."')";
			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn).$sql)));

		}

				
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);

		echo json_encode(array("flag"=>"1"));

	}
function load_lens_opening_stock(){
	global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select `lens_opening_stock_for_lens_library`.*,vendor_master_for_optical.vendor_name FROM `lens_opening_stock_for_lens_library` left join vendor_master_for_optical on vendor_master_for_optical.id=lens_opening_stock_for_lens_library.vendor_id limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mfg_date_=($manufacturing_date=="") ? '' : date("Y-m-d",strtotime($manufacturing_date));
			$expiry_date=($expiry_date=="") ? '' : date("Y-m-d",strtotime($expiry_date));
			$bar_code=($bar_code=="") ? '' : $bar_code;
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("batch"=>$batch,"id"=>$id,"name"=>$name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"status"=>$status,"bar_code"=>$bar_code,"qty"=>$qty,"vendor_id"=>$vendor_name);
		}		
		echo json_encode($arr);
}
function load_lens_recive_stock(){
	global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select `lens_recieved_for_lens_library`.*,vendor_master_for_optical.vendor_name FROM `lens_recieved_for_lens_library` left join vendor_master_for_optical on vendor_master_for_optical.id=lens_recieved_for_lens_library.vendor_id limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mfg_date_=($manufacturing_date=="") ? '' : date("Y-m-d",strtotime($manufacturing_date));
			$expiry_date=($expiry_date=="") ? '' : date("Y-m-d",strtotime($expiry_date));
			$bar_code=($bar_code=="") ? '' : $bar_code;
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("batch"=>$batch,"id"=>$id,"name"=>$name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"status"=>$status,"bar_code"=>$bar_code,"qty"=>$qty,"vendor_id"=>$vendor_name);
		}		
		echo json_encode($arr);
}
function lens_transfer_to_ot(){
	global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select `lens_issued_for_lens_library`.*,item_master_for_optical.asset_name FROM `lens_issued_for_lens_library` left join item_master_for_optical on item_master_for_optical.id=lens_issued_for_lens_library.item_id limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mfg_date_=($mfg_date=="") ? '' : date("Y-m-d",strtotime($mfg_date));
			$expiry_date=($expiry_date=="") ? '' : date("Y-m-d",strtotime($expiry_date));
			$sold_=($sold=="1") ? 'Sold' : 'Returned';
			
			$bar_code=($bar_code=="") ? '' : $bar_code;
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("asset_name"=>$asset_name,"id"=>$id,"batch"=>$batch,"mrd"=>$mrd,"patient_name"=>$patient_name,"doctor_name"=>$doctor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"sold"=>$sold_,"status"=>$sold,"bar_code"=>$bar_code,"qty"=>$qty,"created_on"=>date("Y-m-d",strtotime($created_on)));
		}		
		echo json_encode($arr);
}
function lens_return_from_ot(){
	global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select `lens_issued_for_lens_library`.*,item_master_for_optical.asset_name FROM `lens_issued_for_lens_library` left join item_master_for_optical on item_master_for_optical.id=lens_issued_for_lens_library.item_id where lens_issued_for_lens_library.sold='2' limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mfg_date_=($mfg_date=="") ? '' : date("Y-m-d",strtotime($mfg_date));
			$expiry_date=($expiry_date=="") ? '' : date("Y-m-d",strtotime($expiry_date));
			$sold_=($sold=="1") ? 'Sold' : 'Returned';
			
			$bar_code=($bar_code=="") ? '' : $bar_code;
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("asset_name"=>$asset_name,"id"=>$id,"batch"=>$batch,"mrd"=>$mrd,"patient_name"=>$patient_name,"doctor_name"=>$doctor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"sold"=>$sold_,"status"=>$sold,"bar_code"=>$bar_code,"qty"=>$qty,"created_on"=>date("Y-m-d",strtotime($modified_time)));
		}		
		echo json_encode($arr);
}
function lens_return_to_vendor(){
	global $conn;
		$limit=$_POST['limit'];
		$initial_page=(isset($_POST['initial_page'])) ? $_POST['initial_page'] : "0";
		$sql="select `lens_returned_to_vendor_for_lens_library`.*,vendor_master_for_optical.vendor_name FROM `lens_returned_to_vendor_for_lens_library` left join vendor_master_for_optical on vendor_master_for_optical.id=lens_returned_to_vendor_for_lens_library.vendor_id limit $initial_page,$limit";
		$res=mysqli_query($conn,$sql);
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$mfg_date_=($manufacturing_date=="") ? '' : date("Y-m-d",strtotime($manufacturing_date));
			$expiry_date=($expiry_date=="") ? '' : date("Y-m-d",strtotime($expiry_date));
			
			//$action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("asset_name"=>$name,"id"=>$id,"batch"=>$batch,"vendor_name"=>$vendor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"date"=>date("Y-m-d",strtotime($cur_date)),"qty"=>$qty);
		}		
		echo json_encode($arr);
}
?>