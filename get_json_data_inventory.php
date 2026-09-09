<?php
include "conn.php";
//$_SESSION["department_id"]=8;
$flag=$_GET["flag"];

	if($flag=="1"){	
	
		load_assets();
	
	}else if($flag=="2"){
		
		add_assets();
		
	}else if($flag=="3"){
		
		load_type();
		
	}else if($flag=="4"){
		
		add_type();
		
	}else if($flag=="5"){
		
		load_sub_type();
		
	}else if($flag=="6"){
		
		add_sub_type();
		
	}else if($flag=="7"){
		
		load_departments();
		
	}else if($flag=="8"){
		
		add_departments();
		
	}else if($flag=="9"){
		
		load_location();
		
	}else if($flag=="10"){
		
		add_location();
		
	}else if($flag=="11"){
		
		load_vendors();
	
	}else if($flag=="12"){
		
		add_vendors();
	
	}else if($flag=="13"){
		
		load_unit();
	
	}else if($flag=="14"){
		
		add_unit();
	
	}else if($flag=="15"){
		
		save_asset_data();
	
	}else if($flag=="16"){
		
		load_asset_data();
	
	}else if($flag=="17"){
		
		del_asset_stock();
	
	}else if($flag=="19"){
		
		load_asset_edit();
	
	}else if($flag=="20"){
		
		general_delete();
	
	}else if($flag=="21"){
		
		load_all_types();
		
	}else if($flag=="22"){
		
		load_asset_indent();
		
	}else if($flag=="23"){
		
		add_indent();
		
	}else if($flag=="24"){
	
		load_indents();
	
	}else if($flag=="25"){
	
		save_purchase_order();
	
	}else if($flag=="26"){
	
		load_purchase_orders();
	
	}else if($flag=="27"){
	
		load_purchase_order_data();
	
	}else if($flag=="28"){
	
		save_purchase_invoice();
	
	}else if($flag=="29"){
	
		load_purchase_invoice();
	
	}else if($flag=="30"){
	
		show_purchase_orders();
	
	}else if($flag=="31"){
	
		approve_orders();
	
	}else if($flag=="32"){
	
		show_purchase_order_details();
	
	}else if($flag=="33"){
	
		load_stock_report();
	
	}else if($flag=="34"){
	
		load_users();
	
	}else if($flag=="36"){
	
		load_user_role();
	
	}else if($flag=="39"){
	
		load_individual_asset();
	
	}else if($flag=="40"){
	
		get_product_names();
	
	}else if($flag=="41"){
	
		load_items();
	
	}else if($flag=="42"){
	
		search_batch_code();
	
	}else if($flag=="43"){
	
		save_sales_invoice();
	
	}else if($flag=="44"){

		load_sales_invoice();

	}else if($flag=="45"){
	
		load_doctors();
	
	}else if($flag=="46"){
	
		load_patient_uhid();
	
	}else if($flag=="47"){
	
		load_batch_code();
		/*$item_id=3;$batch_code_1='BT123';
		item_wise_stock_calculation($item_id,$batch_code_1);*/
	
	}else if($flag=="48"){
		item_wise_stock_calculation("","");
		
	}else if($flag=="49"){
		
		pharmacy_stock_report();
		
	}else if($flag=="50"){
		
		sales_report();
		
	}else if($flag=="51"){
	
		cancel_bill();
	
	}else if($flag=="52"){
		
		delete_purchase_inv();
	
	}else if($flag=="53"){
		
		save_stock_transfer();
	
	}else if($flag=="54"){
		
		load_stock_transfer();
	
	}else if($flag=="55"){
		
		cancel_stock_transfer();
	
	}else if($flag=="56"){
		
		save_consumed();
	
	}else if($flag=="57"){
	
		stock_update();
		
	}else if($flag=="58"){
	
		stock_internal();
	
	}
	else if($flag=="59"){
	
		load_hsn_code_gst_master();
	
	}
	else if($flag=="60"){
	
		add_hsn_code_gst_master();
	
	}
	else if($flag=="61"){
	
		get_gst_rate_hsn();
	
	}else if($flag=="62"){
	
		load_asset_batch_stock();
	
	}
	else if($flag=="63"){
	
		save_opening_stock_batchwise_invoice();
	
	}
	else if($flag=="64"){
	
		puchase_payment_due_calculate_vendor();
	
	}
	else if($flag=="65"){
	
		check_item();
	
	}else if($flag=="66"){
	
		temporary_save_sales_invoice();
	
	}
	else if($flag=="67"){
	
		reset_temporary_save_sales_invoice();
	
	}
	else if($flag=="68"){
	
		delete_temporary_save_sales_invoice();
	
	}
	else if($flag=="69"){
	
		load_pharmacy_ipd_order_data();
	
	}else if($flag=="70"){
		
		load_patient_types();
		
	}
	else if($flag=="71"){
	
		load_purchase_vendor_data_select();
	
	}
	else if($flag=="72"){
	
		reset_temporary_save_sales_stock_set();
	
	}else if($flag=="73"){
		item_wise_get_expire("","");
		
	}else if($flag=="74"){
		load_pharmacy_ipd_order_sell_medicine_data();		
	}
	else if($flag=="75"){
	
		save_sales_invoice_return();
	
	}else if($flag=="76"){

		load_sales_invoice_return();

	}else if($flag=="77"){

		load_indents_purchase_order();

	}else if($flag=="78"){

		delete_asset_inednts_new();

	}else if($flag=="79"){
		full_stock_report();	
	}else if($flag=="80"){
		load_consum_details();	
	}else if($flag=="81"){
		closing_stock_with_reorder_level();	
	}else if($flag=="82"){
		damaged_item_save();	
	}else if($flag=="83"){
		load_damage_item();	
	}else if($flag=="84"){
		load_damage_item_popup();	
	}else if($flag=="85"){
		load_item_serverside();	
	}else if($flag=="86"){
		full_stock_report_new();	
	}else if($flag=="87"){
		total_inventory_item();	
	}else if($flag=="88"){
		medicine_item_load_for_presc();	
	}else if($flag=="89"){
		load_asset_indent_details_for_po();	
	}else if($flag=="90"){
		load_vendor_payments();	
	}
	else{
		echo "Flag  Not Selected";
		
		}
	
	

	
	function load_assets(){
	
		global $conn;
				
		if(isset($_POST['type_id'])){
			$type_id=$_POST['type_id'];
			$sub_type_id=$_POST['sub_type_id'];
			
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1 and item_master.type_id='$type_id' and item_master.sub_type_id='$sub_type_id' ";
			
		}else{
		
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1 limit 20";
		}
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		//echo $sql;
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"hsm_code"=>$row['hsm_code'],"text"=>$row['asset_name'],"generic_name"=>$row['generic_name'],"category_name"=>$row['category_name'],"sub_cat"=>$row['sub_cat'],"size"=>$row['size'],"color"=>$row['color']);
			
		}		
		//print_r($arr);
		echo json_encode($arr);
		
	
	}
	
	function add_assets(){
	
		global $conn;
						
		$hsm_code=mysqli_real_escape_string($conn,$_REQUEST['hsm_code']);
		$type_id=mysqli_real_escape_string($conn,$_REQUEST['type_name']);
		$sub_type_id=mysqli_real_escape_string($conn,$_REQUEST['sub_type_name']);
		$item_name=mysqli_real_escape_string($conn,$_REQUEST['item_name']);
		$generic_name=mysqli_real_escape_string($conn,$_REQUEST['generic_name']);
		$size=mysqli_real_escape_string($conn,$_REQUEST['size']);
		$moq=mysqli_real_escape_string($conn,$_REQUEST['moq']);
		$unit=mysqli_real_escape_string($conn,$_REQUEST['unit']);
		$gst_rate=mysqli_real_escape_string($conn,$_REQUEST['gst_rate']);
		$cgst_rate=mysqli_real_escape_string($conn,$_REQUEST['cgst_rate']);
		$sgst_rate=mysqli_real_escape_string($conn,$_REQUEST['sgst_rate']);
		$color=mysqli_real_escape_string($conn,$_REQUEST['color']);
		$covid_item=mysqli_real_escape_string($conn,$_REQUEST['covid_item']);
		$specification=mysqli_real_escape_string($conn,$_REQUEST['specification']);
		$dept_name=mysqli_real_escape_string($conn,$_REQUEST['dept_name']);
		$location_name=mysqli_real_escape_string($conn,$_REQUEST['location_name']);
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
				
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$tans_sql="SET autocommit = 0;";
   			mysqli_query($conn,$tans_sql);
   	  
   			$tans_sql="START TRANSACTION;";
   			mysqli_query($conn,$tans_sql);
			
			$sql="UPDATE `item_master` SET `type_id`='".$type_id."', `hsm_code`='".$hsm_code."', `sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."', `moq`='".$moq."', `gst_rate`='".$gst_rate."', `cgst_rate`='".$cgst_rate."', `sgst_rate`='".$sgst_rate."', `color`='".$color."', `covid_item`='".$covid_item."' , `specification`='".$specification."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."' ";

			
			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0,"error"=>mysqli_error($conn))));
			
		}else{ 
		
		
		$sql="INSERT INTO `item_master` SET `type_id`='".$type_id."', `hsm_code`='".$hsm_code."', `sub_type_id`='".$sub_type_id."', `asset_name`='".$item_name."', `unit_id`='".$unit."', `generic_name`='".$generic_name."', `moq`='".$moq."', `gst_rate`='".$gst_rate."', `cgst_rate`='".$cgst_rate."', `sgst_rate`='".$sgst_rate."', `color`='".$color."', `covid_item`='".$covid_item."' , `specification`='".$specification."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

			
			$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
			
				$item_id = $conn->insert_id;
				$sql="INSERT INTO `opening_stock` SET `dept_id`='".$dept_name."', `location_id`='".$location_name."', `vendor_id`='1', `item_id`='".$item_id."', `qty`='0', `batch`='' ";
			
			$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		}
		
		
		$tans_sql="COMMIT;";
   		mysqli_query($conn,$tans_sql);
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	function load_type(){
	
		global $conn;
		
		$sql="select * from `type_master` where main_cat_id IS NULL and status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['category_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_type(){
	
		global $conn;
		
		$add_type=$_POST['type_name'];
		
		$sql="insert into type_master(`category_name`) values('$add_type')";
		
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	function load_sub_type(){
	
		global $conn;
		
		$type_id=$_POST['type_id'];
		
		$sql="select * from `type_master` where main_cat_id='$type_id' and status=1 ORDER BY `category_name` ASC ";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['category_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_sub_type(){
	
		global $conn;
		$type_id=mysqli_real_escape_string($conn,$_REQUEST['type_id']);	
		$sub_type_name=mysqli_real_escape_string($conn,$_REQUEST['sub_type_name']);	
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$sql=($_POST['type_id']=="") ? "UPDATE  `type_master` SET `category_name`='".$sub_type_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ": "UPDATE  `type_master` SET `category_name`='".$sub_type_name."',`main_cat_id`='".$type_id."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";	
		}else{			
			$sql=($_POST['type_id']=="") ? "INSERT INTO  `type_master` SET `category_name`='".$sub_type_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ": "INSERT INTO `type_master` SET `category_name`='".$sub_type_name."',`main_cat_id`='".$type_id."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";	
		}
		
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	function load_departments(){
	
		global $conn;
		
		$sql="select * from `department_master` where status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['department_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_departments(){
	
		global $conn;
		$dept_name=mysqli_real_escape_string($conn,$_REQUEST['dept_name']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$sql="UPDATE  `department_master` SET `department_name`='".$dept_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		
		}else{
			$sql="INSERT INTO `department_master` SET `department_name`='".$dept_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		}
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	
	function load_location(){
	
		global $conn;
		
		$sql="select * from `location_master` where status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['location_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_location(){
	
		global $conn;
		$location_name=mysqli_real_escape_string($conn,$_REQUEST['location_name']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$sql="UPDATE  `location_master` SET `location_name`='".$location_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		
		}else{
			$sql="INSERT INTO `location_master` SET `location_name`='".$location_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		}
		
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	
	function load_vendors(){
	
		global $conn;
		
		$sql="select * from `vendor_master` where status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-","address"=>"-Select-","email"=>"-Select-","phone"=>"-Select-","gst"=>"-Select-","contact_person"=>"-Select-","a_c_no"=>"-Select-","ifsc_code"=>"-Select-","bank_name"=>"-Select-","branch"=>"-Select-","bank_holder_name"=>"-Select-","contact_person_phone"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			if($row['vendor_name']==''){
				$vendor_name='';
			}else{
				$vendor_name=$row['vendor_name'];
			}
			if($row['bank_name']==''){
				$bank_name='';
			}else{
				$bank_name=$row['bank_name'];
			}
			if($row['address']==''){
				$address='';
			}else{
				$address=$row['address'];
			}
			if($row['email']==''){
				$email='';
			}else{
				$email=$row['email'];
			}
			if($row['phone']==''){
				$phone='';
			}else{
				$phone=$row['phone'];
			}
			if($row['gst']==''){
				$gst='';
			}else{
				$gst=$row['gst'];
			}
			if($row['contact_person']==''){
				$contact_person='';
			}else{
				$contact_person=$row['contact_person'];
			}
			if($row['a_c_no']==''){
				$a_c_no='';
			}else{
				$a_c_no=$row['a_c_no'];
			}
			if($row['ifsc_code']==''){
				$ifsc_code='';
			}else{
				$ifsc_code=$row['ifsc_code'];
			}
			if($row['branch']==''){
				$branch='';
			}else{
				$branch=$row['branch'];
			}
			if($row['bank_holder_name']==''){
				$bank_holder_name='';
			}else{
				$bank_holder_name=$row['bank_holder_name'];
			}
			if($row['contact_person_phone']==''){
				$contact_person_phone='';
			}else{
				$contact_person_phone=$row['contact_person_phone'];
			}
			$arr[]=array("id"=>$row['id'],"text"=>$vendor_name,"address"=>$address,"email"=>$email,"phone"=>$phone,"gst"=>$gst,"contact_person"=>$contact_person,"a_c_no"=>$a_c_no,"ifsc_code"=>$ifsc_code,"bank_name"=>$bank_name,"branch"=>$branch,"bank_holder_name"=>$bank_holder_name,"contact_person_phone"=>$contact_person_phone);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_vendors(){
	
		global $conn;
				
		$vendor_name=mysqli_real_escape_string($conn,$_REQUEST['vendor_name']);
		$vendor_address=mysqli_real_escape_string($conn,$_REQUEST['vendor_address']);
		$vendor_phone=mysqli_real_escape_string($conn,$_REQUEST['vendor_phone']);
		$vendor_email=mysqli_real_escape_string($conn,$_REQUEST['vendor_email']);
		$vendor_gst=mysqli_real_escape_string($conn,$_REQUEST['vendor_gst']);
		$contact_person=mysqli_real_escape_string($conn,$_REQUEST['contact_person']);
		$contact_person_phone=mysqli_real_escape_string($conn,$_REQUEST['contact_person_phone']);
		$a_c_no=mysqli_real_escape_string($conn,$_REQUEST['a_c_no']);
		$ifsc_code=mysqli_real_escape_string($conn,$_REQUEST['ifsc_code']);
		$bank_name=mysqli_real_escape_string($conn,$_REQUEST['bank_name']);
		$branch=mysqli_real_escape_string($conn,$_REQUEST['branch']);
		$bank_holder_name=mysqli_real_escape_string($conn,$_REQUEST['bank_holder_name']);
				
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$sql="UPDATE  `vendor_master` SET `vendor_name`='".$vendor_name."', `address`='".$vendor_address."', `email`='".$vendor_email."', `phone`='".$vendor_phone."', `gst`='".$vendor_gst."', `contact_person`='".$contact_person."', `contact_person_phone`='".$contact_person_phone."', `a_c_no`='".$a_c_no."', `ifsc_code`='".$ifsc_code."', `bank_name`='".$bank_name."', `branch`='".$branch."', `bank_holder_name`='".$bank_holder_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		
		}else{
			$sql="INSERT INTO `vendor_master` SET `vendor_name`='".$vendor_name."', `address`='".$vendor_address."', `email`='".$vendor_email."', `phone`='".$vendor_phone."', `gst`='".$vendor_gst."', `contact_person`='".$contact_person."', `contact_person_phone`='".$contact_person_phone."', `a_c_no`='".$a_c_no."', `ifsc_code`='".$ifsc_code."', `bank_name`='".$bank_name."', `branch`='".$branch."', `bank_holder_name`='".$bank_holder_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		}
		
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	
	function load_unit(){
	
		global $conn;
		
		$sql="select * from `unit_master` where status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['unit_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_unit(){
	
		global $conn;
		$unit_name=mysqli_real_escape_string($conn,$_REQUEST['unit_name']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$sql="UPDATE  `unit_master` SET `unit_name`='".$unit_name."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";		
		}else{
			$sql="INSERT INTO `unit_master` SET `unit_name`='".$unit_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		}
				
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	function save_asset_data(){
	
		global $conn;
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];
			$tans_sql="SET autocommit = 0;";
   			mysqli_query($conn,$tans_sql);
   	  
   			$tans_sql="START TRANSACTION;";
   			mysqli_query($conn,$tans_sql);
			
			$sql="delete from opening_stock where id='".$id."'";
			$res=mysqli_query($conn,$sql);
			
		} 
		
		$type_id=$_POST['type_name'];
		$sub_type_id=$_POST['sub_type_name'];
		$dept_name=$_POST['dept_name'];
		$location_name=$_POST['location_name'];
		$vendor_name=$_POST['vendor_name'];
		$item_id=$_POST['item_id'];
		$qty=$_POST['qty'];
		$unit_id=$_POST['unit'];
		$batch=$_POST['batch'];
		$expiry=date("Y-m-d",strtotime($_POST['expiry']));
		$mfg_date=date("Y-m-d",strtotime($_POST['mfg_date']));
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
				
			$sql="insert into opening_stock(`id`,`dept_id`, `location_id`, `vendor_id`, `item_id`, `qty`,`batch`,`mfg_date`,`expiry`) values('$id','$dept_name','$location_name','$vendor_name','$item_id','$qty','$batch','$mfg_date','$expiry')";
		
		}else{
		
			$sql="insert into opening_stock(`dept_id`, `location_id`, `vendor_id`, `item_id`, `qty`,`batch`,`mfg_date`,`expiry`) values('$dept_name','$location_name','$vendor_name','$item_id','$qty','$batch','$mfg_date','$expiry')";
		
		}
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res){ echo json_encode(array("flag"=>1));
		
			if(isset($_POST['id']) && $_POST['id']!="" ){
				$tans_sql="COMMIT;";
				mysqli_query($conn,$tans_sql);
			} 
		
		}else echo json_encode(array("flag"=>0));	
	
	}
	
	function load_asset_data(){
	
		global $conn;
		
		$sql="select opening_stock.id,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat, department_master.department_name,location_master.location_name,vendor_master.vendor_name,qty,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item from opening_stock left join item_master on item_master.id=opening_stock.item_id left join department_master on department_master.id=opening_stock.dept_id left join location_master on location_master.id=opening_stock.location_id left join vendor_master on vendor_master.id=opening_stock.vendor_id left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id;";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			//echo "P Val:". $product_id;
			//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
		?>
			
			<tr><td><?php echo $asset_name; ?></td><td><?php echo $category_name; ?></td><td><?php echo $sub_cat; ?></td><td><?php echo $department_name; ?></td><td><?php echo $location_name; ?></td><td><?php echo $vendor_name; ?></td><td><?php echo $qty; ?> <?php echo $unit_name; ?></td><td><?php echo $size; ?></td><td><?php echo $color; ?></td><td><?php echo $specification; ?></td><td><?php echo $covid_item; ?></td><td><span><a title='Edit' href="javascript:void(0)" onclick="edit(<?php echo $id; ?>)" ><i class="fa fa-edit"></i></a></span>&nbsp;&nbsp;<span><a title='Delete' href="javascript:void(0)" onclick="del(<?php echo $id; ?>)" ><i class="fa fa-trash"></i></a></span></td></tr>
		<?php
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function del_asset_stock(){
	
		global $conn;
		
		$id=$_POST['id'];
		$sql="delete from opening_stock where id='".$id."'";
		$res=mysqli_query($conn,$sql);
		
		echo ($res) ?  json_encode(array("flag"=>"1")) : json_encode(array("flag"=>"0"));
	
	}
	
	
	
	function load_asset_edit(){
	
		global $conn;
		
		$id=$_POST['id'];
	
		$sql="select opening_stock.*,item_master.type_id,item_master.sub_type_id from opening_stock inner join item_master on item_master.id=opening_stock.item_id where opening_stock.id='$id'";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
			//extract($row);
			$arr=$row;
			$arr["flag"]=1;
		}
		
		echo (isset($arr)) ? json_encode($arr) : json_encode(array("flag"=>0));
	}
	
	
	function general_delete(){
		
		global $conn;
		
		$id=$_POST['id'];
		$table=$_POST['table'];
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$sql="UPDATE $table SET `status`='0',`del_flag`='1', `deleted_by`='".$created_by."', `deleted_time`='".$created_on."'  WHERE `id`='".$id."' ";
		
		$res=mysqli_query($conn,$sql);
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
		
	}
	
	function load_all_types(){
	
		global $conn;
		
		$sql="SELECT `id`,main_cat_id,`category_name`,(select A.category_name from type_master as `A` where A.id=type_master.main_cat_id) as `main_cat` FROM `type_master` WHERE status=1;";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['category_name'],"main_cat"=>$row['main_cat'],"main_cat_id"=>$row['main_cat_id']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function load_asset_indent_old(){
	
		global $conn;
		
		$id=$_POST['id'];
		$location_name=$_POST['location_name'];
		$location_id_=$_POST['location_id'];
		
		$sql="";
		$optional=(isset($_POST['indent_flag'])) ? " ,indent_details.qty,indent_details.qty_ordered,indent.id as `indent_id`,indent_details.id as `indent_details_id`,department_master.department_name " : "" ;
		
		$sql1="select item_master.id,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item $optional from item_master left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id";
		
		if(isset($_POST['indent_flag'])) $sql=$sql1." inner join indent_details on item_master.id=indent_details.item_id left join indent on indent.id=indent_details.indent_id left join department_master on department_master.id=indent.department where indent.id='$id' "; 
		
		
		
		//if(isset($_POST["dept_name"]) && $_POST["dept_name"]!='') $sql=$sql1." where asset_stock.dept_id='".$_POST["dept_name"]."'";
		if(isset($_POST["type_name"]) && $_POST["type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.type_id='".$_POST["type_name"]."'" : $sql." and item_master.type_id='".$_POST["type_name"]."'";
		if(isset($_POST["sub_type_name"]) && $_POST["sub_type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.sub_type_id='".$_POST["sub_type_name"]."'" : $sql." and item_master.sub_type_id='".$_POST["sub_type_name"]."'";
		//if(isset($_POST["location_name"]) && $_POST["location_name"]!='') $sql=($sql=="") ? $sql1." where asset_stock.location_id='".$_POST["location_name"]."'" : $sql." and asset_stock.location_id='".$_POST["location_name"]."'";
		
		$sql=($sql=="") ? $sql1 : $sql;  
		
		//echo $sql;
		
			if($location_id_!="" || isset($_POST['indent_flag'])){
			
				$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				
				while($row=mysqli_fetch_assoc($res)){
					extract($row);
					//echo "P Val:". $product_id;
					//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
					if(isset($_POST['indent_flag'])){
				?>
					
					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_dept_name" ><?php echo $department_name; ?></td><td id="<?php echo $id ?>_location_name" data-location="<?php echo $location_id_; ?>"><?php echo $location_name; ?></td><td id="<?php echo $id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id ?>_color"><?php echo $color; ?></td><td id="<?php echo $id ?>_covid_item"><?php echo $covid_item; ?></td><td><input type="text" id="<?php echo $id ?>_qty" data-qty="<?php echo ($qty-$qty_ordered) ?>" value="<?php echo ($qty-$qty_ordered) ?>" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $indent_id ?>','<?php echo $indent_details_id ?>','<?php echo $location_id_; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
				<?php
					}else{
				?>
					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_location_name" data-location="<?php echo $location_id_; ?>"><?php echo $location_name; ?></td><td id="<?php echo $id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id ?>_color"><?php echo $color; ?></td><td id="<?php echo $id ?>_covid_item"><?php echo $covid_item; ?></td><td><input type="text" id="<?php echo $id ?>_qty" value="" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $location_id_; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
					
				<?php	
					}
				
				}		
			
			}
		//echo json_encode($arr);
	
	}
	
	function load_asset_indent(){
	
		global $conn;
		
		$id=$_POST['id'];
		$location_name=$_POST['location_name'];
		$location_id_=$_POST['location_id'];
		
		$sql="";
				
		if(isset($_POST['type_name'])){
			$type_id=$_POST['type_name'];
			$sub_type_id=$_POST['sub_type_name'];
			$sub_where="";
			if($sub_type_id!=''){
				$sub_where=" and item_master.sub_type_id='$sub_type_id' ";
			}
			
			 
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1 and item_master.type_id='$type_id' $sub_where ";
			
		}else{
		
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1";
		}			
				$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				
				while($row=mysqli_fetch_assoc($res)){
					extract($row);
					//echo "P Val:". $product_id;
					//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
					
				?>
					
					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_location_name" data-location="<?php echo $location_id_; ?>"><?php echo $location_name; ?></td><td><input type="text" id="<?php echo $id ?>_qty" data-qty="<?php echo ($qty-$qty_ordered) ?>" value="<?php echo ($qty-$qty_ordered) ?>" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $indent_id ?>','<?php echo $indent_details_id ?>','<?php echo $location_id_; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
				
					
				<?php	
				
				
					
			
			}
		//echo json_encode($arr);
	
	}
	
	function load_asset_indent_details_for_po(){
	
		global $conn;
		
		$id=$_POST['id'];
		$location_name=$_POST['location_name'];
		$location_id_=$_POST['location_id'];
		
		$sql="";
		$optional=(isset($_POST['indent_flag'])) ? " ,indent_details.qty,indent_details.qty_ordered,indent.id as `indent_id`,indent_details.id as `indent_details_id`,department_master.department_name " : "" ;
		
		$sql1="select item_master.id,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat,unit_name $optional from item_master left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id";
		
		if(isset($_POST['indent_flag'])) $sql=$sql1." inner join indent_details on item_master.id=indent_details.item_id left join indent on indent.id=indent_details.indent_id left join department_master on department_master.id=indent.department where indent.id='$id' "; 
		
		
		
		//if(isset($_POST["dept_name"]) && $_POST["dept_name"]!='') $sql=$sql1." where asset_stock.dept_id='".$_POST["dept_name"]."'";
		if(isset($_POST["type_name"]) && $_POST["type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.type_id='".$_POST["type_name"]."'" : $sql." and item_master.type_id='".$_POST["type_name"]."'";
		if(isset($_POST["sub_type_name"]) && $_POST["sub_type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.sub_type_id='".$_POST["sub_type_name"]."'" : $sql." and item_master.sub_type_id='".$_POST["sub_type_name"]."'";
		//if(isset($_POST["location_name"]) && $_POST["location_name"]!='') $sql=($sql=="") ? $sql1." where asset_stock.location_id='".$_POST["location_name"]."'" : $sql." and asset_stock.location_id='".$_POST["location_name"]."'";
		
		$sql=($sql=="") ? $sql1 : $sql;  
		
		//echo $sql;
		
			if($location_id_!="" || isset($_POST['indent_flag'])){
			
				$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				
				while($row=mysqli_fetch_assoc($res)){
					extract($row);
					//echo "P Val:". $product_id;
					//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
					if(isset($_POST['indent_flag'])){
				?>
					
					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_dept_name" ><?php echo $department_name; ?></td><td><input type="text" id="<?php echo $id ?>_qty" data-qty="<?php echo ($qty-$qty_ordered) ?>" value="<?php echo ($qty-$qty_ordered) ?>" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $indent_id ?>','<?php echo $indent_details_id ?>','<?php echo $location_id_; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
				<?php
					}else{
				?>
					<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?></td><td id="<?php echo $id ?>_main_cat"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_location_name" data-location="<?php echo $location_id_; ?>"><?php echo $location_name; ?></td><td id="<?php echo $id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id ?>_color"><?php echo $color; ?></td><td id="<?php echo $id ?>_covid_item"><?php echo $covid_item; ?></td><td><input type="text" id="<?php echo $id ?>_qty" value="" place-holder="qty" /></td><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $location_id_; ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
					
				<?php	
					}
				
				}		
			
			}
		//echo json_encode($arr);
	
	}
	
	function add_indent(){
	
		global $conn;
	
		$id=$_POST['id'];
		$qty=$_POST['qty'];
		$location=$_POST['location'];		
		$department=$_POST['department'];
		$user_id=$_SESSION['user_id'];
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$sql="INSERT INTO `indent` SET `department`='".$department."',`user_id`='".$user_id."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0")));
		
		$indent_id=mysqli_insert_id($conn);
		
		foreach($id as $key => $val){
		 	$sql="INSERT INTO `indent_details` SET `indent_id`='".$indent_id."',`location_id`='".$location."',`item_id`='".$val."',`qty`='".$qty[$key]."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0")));
		}
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		
		
		echo json_encode(array("flag"=>"1"));	
		
		
		
	}
	
	function load_indents(){
	
		global $conn;
		
		$sql="SELECT indent.*,department_master.department_name FROM `indent` left join department_master on department_master.id=indent.department where indent.status<>0 ORDER BY indent.id DESC";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
		
			$arr[]=array("id"=>$row["id"],"department"=>$row["department_name"],"date"=>date("d/m/Y",strtotime($row["date"])));
		}
		
		echo json_encode($arr);
	
	}
	
	function save_purchase_order(){
	
		global $conn;
		$indent_id=$_POST['indent_id'];
		$indent_details_id=$_POST['indent_details_id'];
		$asset_id=$_POST['id'];
		$qty=$_POST['qty'];	
		$asset_name=$_POST['asset_name'];	
		$department_name=$_POST['department_name'];
		$vendor_id=mysqli_real_escape_string($conn,$_REQUEST['vendor_id']);
		$vendor_name=mysqli_real_escape_string($conn,$_REQUEST['vendor_name']);
		$user_id=$_SESSION['user_id'];
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
	
		$purchase_order_no=get_purchase_order_number();
		
		$sql="INSERT INTO `purchase_order` SET `order_number`='".$purchase_order_no."',`user_id`='".$user_id."',`vendor_id`='".$vendor_id."',`vendor_name`='".$vendor_name."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
		
		
		$order_id=mysqli_insert_id($conn);
		
		$sql_sum="select (sum(qty)-sum(qty_ordered)) as sum_qty,indent_id from indent_details where qty>qty_ordered group by indent_id ";
		
		$res=mysqli_query($conn,$sql_sum) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
		
		while($row_sum=mysqli_fetch_assoc($res)){
		
			$sum_qty[$row_sum['indent_id']]=$row_sum['sum_qty'];				
		
		}
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($indent_details_id as $key => $val){
		
			if($indent_key!=$indent_id[$key]){
				$qty_sum=0;
			}
			
			
			$sql_update="UPDATE `indent` SET `status`='2', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$indent_id[$key]."'  ";					
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			
			$sql_update="UPDATE `indent_details` SET `status`='2',qty_ordered=qty_ordered+".$qty[$key].", `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$val."'  ";					
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));			
			$qty_sum=$qty_sum+$qty[$key];
			
			//echo "sum_qty:::".$sum_qty[$indent_id[$key]];
			
			if($qty_sum==$sum_qty[$indent_id[$key]]){
			  $sql_update="UPDATE `indent` SET `status`='0', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$indent_id[$key]."'  ";	
			  mysqli_query($conn,$sql_update)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			  $sql_update="UPDATE `indent_details` SET `status`='0', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$val."'  ";			
			  mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			}
			
		$sql="INSERT INTO `purchase_order_details` SET `order_id`='".$order_id."',`indent_id`='".$indent_id[$key]."',`indent_details_id`='".$val."',`item_id`='".$asset_id[$key]."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`qty`='".$qty[$key]."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			
			$indent_key=$indent_id[$key];
		
		}
		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1"));
	
	
	}
	
	
	function get_purchase_order_number(){
		global $conn;
		global $db;
		$sql="select count(*) from `purchase_order` where MONTH(date)=MONTH(CURRENT_DATE()) group by MONTH(date)";
		$res=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($res);
		$new_num=intval($row[0])+1;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'purchase_order'";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id="PO/".date("m").date("y")."/".$row1[0]."/".$new_num;
		return $new_id;
	}
	
	function get_purchase_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'purchase';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id="PUR/".date("m").date("y")."/".$row1[0];
		return $new_id;
	}
	
	function get_sales_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'pharma_invoice';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id=$row1[0]."/PHARM/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
	}
	
	function get_sales_number_return(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'pharma_invoice_return';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id=$row1[0]."/PHARM/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
	}
	
	function get_transfer_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'stock_transfer';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id=$row1[0]."/TRANS/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
	}
	
	function temporary_get_sales_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'temporary_pharma_invoice';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id=$row1[0]."/PHARM/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
	}
	
	function temporary_delete_sales_number($temporary_customer_id,$temporary_sales_id){
		global $conn;
		
		if($temporary_customer_id!=''){
			$sql_customer_delete="DELETE FROM `temporary_customer_master` WHERE `id`='$temporary_customer_id'";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Customer Delete")));
			
			$sql_customer_delete="DELETE FROM `temporary_pharma_invoice` WHERE `id`='$temporary_sales_id'";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Sale Delete")));
			
			$sql_customer_delete="DELETE FROM `temporary_pharma_invoice_details` WHERE `sales_id`='$temporary_sales_id'";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Sale Details Delete")));			
			
		}
		$new_id=1;
		return $new_id;
	}
	
	function temporary_delete_batch_item_sales_number($temporary_customer_id,$temporary_sales_id,$item_id,$batch_code_value){
		global $conn;
		if($temporary_customer_id!=''){			
			$sql_customer_delete="DELETE FROM `temporary_pharma_invoice_details` WHERE `sales_id`='$temporary_sales_id' AND `item_id`='$item_id' AND `batch_no`='$batch_code_value'";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Sale Details Delete")));			
			
		}
		$new_id=1;
		return $new_id;
	}
	
	function get_consumable_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'consumables';";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		$new_id=$row1[0]."/CONSU/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
	}
	
	
	function load_purchase_orders(){
	
		global $conn;
		
		$sql="SELECT purchase_order.* FROM `purchase_order` where purchase_order.status<>0 and purchase_order.status<>1 ORDER BY purchase_order.id DESC";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
		
			$arr[]=array("id"=>$row["id"],"order_number"=>$row["order_number"],"date"=>date("d/m/Y",strtotime($row["date"])));
		}
		
		echo json_encode($arr);
	
	}
	
	
	function load_purchase_order_data(){
	
		global $conn;
		
		$id=$_POST['id'];
		
		$sql="";
		//$optional=(isset($_POST['indent_flag'])) ? " ,indent_details.qty,indent_details.qty_ordered,indent.id as `indent_id`,indent_details.id as `indent_details_id`" : "" ;
		
		$sql="select item_master.id,item_master.hsm_code,item_master.gst_rate,item_master.cgst_rate,item_master.sgst_rate,purchase_order_details.item_name,purchase_order_details.qty_recieved,purchase_order.id as `order_id`,purchase_order_details.id as `order_details_id`,purchase_order_details.qty,purchase_order_details.qty_recieved, unit_name, size,color,IF(covid_item=1, 'YES', 'NO') as covid_item, purchase_order.vendor_id,purchase_order_details.department_name from item_master   left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id inner join purchase_order_details on item_master.id=purchase_order_details.item_id left join purchase_order on purchase_order.id=purchase_order_details.order_id where purchase_order.id='$id' ";
		
		
		//$sql=($sql=="") ? $sql1 : $sql;  
		
		//echo $sql;
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
				
		?>
			
			<tr id="<?php echo $id.$order_id ?>_asset_rows"><td id="<?php echo $id.$order_id ?>_asset"><?php echo $item_name; ?><input type="hidden" id="<?php echo $id.$order_id ?>_hsm_code" value="<?php echo $hsm_code ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_gst_rate" value="<?php echo $gst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_cgst_rate" value="<?php echo $cgst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_sgst_rate" value="<?php echo $sgst_rate ?>"  /><input type="hidden" id="<?php echo $id.$order_id ?>_vendor" value="<?php echo $vendor_id ?>"  /></td><td id="<?php echo $id.$order_id ?>_size"><?php echo $size; ?></td><td id="<?php echo $id.$order_id ?>_color"><?php echo $color; ?></td><td id="<?php echo $id.$order_id ?>_covid_item"><?php echo $covid_item; ?></td><td><input type="text" id="<?php echo $id.$order_id ?>_qty" data-qty="<?php echo ($qty-$qty_recieved) ?>" value="<?php echo ($qty-$qty_recieved) ?>" place-holder="qty" /></td><td><span><button id="<?php echo $id.$order_id ?>_qty_add_btn" onclick="add_indent('<?php echo $id.$order_id ?>','<?php echo $order_id ?>','<?php echo $order_details_id ?>','<?php echo $id ?>')"><i class="fa fa-add"></i>Add</button></span></td></tr>
		<?php
			
		
		}		
		
		//echo json_encode($arr);
	
	}
	
	
	function save_purchase_invoice(){
	
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
		$grand_total=round($_POST['grand_total']);
		
		$total_cgst_amount=mysqli_real_escape_string($conn,$_POST['total_cgst_amount']);
		$total_sgst_amount=mysqli_real_escape_string($conn,$_POST['total_sgst_amount']);
		$department_id=$_SESSION['department_id'];
		$supplier_invoice_no=mysqli_real_escape_string($conn,$_POST['supplier_invoice_no']);
		
		if($_REQUEST['purchase_bill_date']==''){
		$purchase_bill_date='NULL';
		}else{
			$purchase_bill_date= "'".date("Y-m-d", strtotime($_POST['purchase_bill_date']))."'";
		}
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		$adjust_type=mysqli_real_escape_string($conn,$_POST['adjust_type']);
		$adjust_amount=mysqli_real_escape_string($conn,$_POST['adjust_amount']);
		$grand_net_total_=mysqli_real_escape_string($conn,$_POST['grand_net_total_']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
	
		$purchase_no=get_purchase_number();
		
		
		$sql="INSERT INTO `purchase` SET `order_number`='".$purchase_no."',`user_id`='".$user_id."',`vendor_id`='".$vendor_id."',`department_id`='".$department_id."',`vendor_name`='".$vendor_name."',`gst_amount`='".$total_gst_amount."',`cgst_amount`='".$total_cgst_amount."',`sgst_amount`='".$total_sgst_amount."',`amount`='".$grand_total."',`supplier_invoice_no`='".$supplier_invoice_no."',`purchase_bill_date`=".$purchase_bill_date.",`adjust_type`='".$adjust_type."',`adjust_amount`='".$adjust_amount."',`grand_net_total_`='".$grand_net_total_."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Purchase insert")));
		
		$purchase_id=mysqli_insert_id($conn);
		
		$sql_sum="select (sum(qty)-sum(qty_recieved)) as sum_qty,order_id from purchase_order_details where qty>qty_recieved group by order_id ";
		
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
			
			$sql_update="UPDATE  `purchase_order` SET `status`='2', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$purchase_order_id[$key]."'  ";
			
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));			
			
			$sql_update="UPDATE  `purchase_order_details` SET `status`='2',`qty_recieved`=qty_recieved+".$qty[$key].", `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$val."'  ";
			
			mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			
			$qty_sum=$qty_sum+$qty[$key];
			
			//echo "sum_qty:::".$sum_qty[$indent_id[$key]];
			
			if($qty_sum==$sum_qty[$purchase_order_id[$key]]){
			  $sql_update="UPDATE  `purchase_order` SET `status`='0', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$purchase_order_id[$key]."'  ";
			  mysqli_query($conn,$sql_update)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			  $sql_update="UPDATE  `purchase_order_details` SET `status`='0', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$val."'  ";	
			  mysqli_query($conn,$sql_update) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn))));
			}
			$free_flag=($purchase_order_details_id=="") ? "free" : "";
		
			$sql="INSERT INTO `purchase_details` SET `purchase_id`='".$purchase_id."', `purchase_order_id`='".$purchase_order_id[$key]."', `purchase_order_details_id`='".$val."', `item_id`='".$asset_id[$key]."', `item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`disc_rate`='".$disc_rate[$key]."',`disc_amount`='".$disc_amount[$key]."',`gst_rate`='".$gst_rate[$key]."',`gst_amount`='".$gst_amount[$key]."',`cgst_rate`='".$cgst_rate[$key]."',`cgst_amount`='".$cgst_amount[$key]."',`sgst_rate`='".$sgst_rate[$key]."',`sgst_amount`='".$sgst_amount[$key]."',`total`='".$total_amount[$key]."',`mrp`='".$mrp[$key]."' , `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			
			$indent_key=$purchase_order_id[$key];
		
		}
		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","p_id"=>$purchase_id));
	
	
	}
	
	
	function load_purchase_invoice(){
		
		global $conn;
		
		$sql="select * from `purchase` WHERE `opening_stock_flag`='0' ORDER BY `id` DESC ";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
		?>
		
			<tr><td id="<?php echo $id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $id ?>_asset"><a href="purchase_invoice_print.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $order_number; ?></a><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_size"><?php echo $vendor_name; ?></td><td id="<?php echo $id ?>_amount"><?php echo $grand_net_total_; ?></td><td><a href="<?php echo ADMIN_URL; ?>purchase_invoice_print.php?inv_id=<?php echo $id ?>" target="_blank" title="Print Bill" > <img src="<?php echo ADMIN_URL; ?>icon/printButton.png" title="Print Bill"></a>  <!--|  <a href="javascript:void(0);" onclick="del_invoice('<?php echo $id ?>')"  title="Cancel Bill"><i class="fa fa-trash" title="Cancel Bill"></i></a>--></td></tr>
		
		<?php
		$sl++;
		}
	
	}
	
	function load_sales_invoice(){
		
		global $conn;
		$bill_pay_type="";
		$sql="select * from `pharma_invoice` ORDER BY `id` DESC ";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			if($status=='1'){
				$bill_pay_type="Cash Patient";
			}else{
				$bill_pay_type="Credit Patient";
			}
		?>	
			<tr><td id="<?php echo $id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $id ?>_asset"><a href="sales_invoice_print.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $order_number; ?></a><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php //echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_uhid"><?php echo $uhid; ?></td><td id="<?php echo $id ?>_doctor_name"><?php echo $doctor_name; ?></td><td id="<?php echo $id ?>_mode"><?php echo $bill_pay_type;?></td><td id="<?php echo $id ?>_size"><?php echo $customer_name; ?></td><td id="<?php echo $id ?>_amount"><?php echo $grand_total; ?></td><td id="<?php echo $id ?>_sl_no"><a href="<?php echo ADMIN_URL; ?>sales_invoice_print.php?inv_id=<?php echo $id ?>" target="_blank" title="Print Bill" > <img src="<?php echo ADMIN_URL; ?>icon/printButton.png" title="Print Bill"></a></td></tr>
		
		<?php
		$sl++;
		}
	
	}
	
	
	function show_purchase_orders(){
	
		global $conn;
		
		$sql="SELECT purchase_order.* FROM `purchase_order` WHERE purchase_order.status=1 ORDER BY purchase_order.date DESC;";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
		?>
		<tr><td id="<?php echo $id ?>_asset"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_color"><a href="javascript:" onclick="show_purchase_order('<?php echo $id ?>')" data-toggle="modal" data-target="#staticBackdrop"><?php echo $order_number; ?></a></td><td><?php echo $vendor_name; ?></td><td><button title="Approve" onclick="approve('<?php echo $id; ?>')"><i class="fa fa-check"></i></button>&nbsp;<button title="Cancel" onclick="cancel('<?php echo $apidprove; ?>')"><i class="fa fa-close"></i></button></td></tr>
		<?php
			
		}
		
		//echo json_encode($arr);
	
	}
	
	
	function approve_orders(){
		
		global $conn;
		
		$id=$_POST['id'];
		$sql="UPDATE  `purchase_order` SET `status`='3', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";	
		$res=mysqli_query($conn,$sql);
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
		
	
	}
	
	function show_purchase_order_details(){
	
		global $conn;
		
		$id=$_POST['id'];
		
		$sql="SELECT purchase_order.order_number,purchase_order.date,purchase_order.vendor_name,pd.item_name,pd.department_name,pd.qty FROM `purchase_order` inner join purchase_order_details as `pd` on purchase_order.id=pd.order_id where purchase_order.id='$id' ";
		
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
		
		$body.='<tr><td>'. date("d/m/Y",strtotime($date)) .'</td><td>'. $department_name.'</td><td>'.$item_name.'</td><td>'.$qty.'</td></tr>';
		
			
		}
		$arr=array("purchase_number"=>$pn,"date"=>$dt,"vendor_name"=>$vn,"body"=>$body);
		echo json_encode($arr);
	
	}
	
	
	function load_stock_report(){
		
	
		global $conn;
		
		 $sql="select item_master.id as `id_`,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat, department_master.department_name,location_master.location_name,vendor_master.vendor_name,qty,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item from item_master left join opening_stock on item_master.id=opening_stock.item_id left join department_master on department_master.id=opening_stock.dept_id left join location_master on location_master.id=opening_stock.location_id left join vendor_master on vendor_master.id=opening_stock.vendor_id left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id where opening_stock.status=0";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			//echo "P Val:". $product_id;
			//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
			//$sql_new="SELECT item_master.id,sum(`purchase_details`.`qty`) as purchase FROM `indent_details` inner join item_master on item_master.id=indent_details.item_id inner join purchase_order_details on indent_details.id=purchase_order_details.indent_details_id inner join purchase_details on purchase_details.purchase_order_details_id=purchase_order_details.id where item_master.id='".$row['id_']."' AND purchase_details.status=1 group by  item_master.id";
			$sql_new="SELECT item_master.id,sum(`purchase_details`.`qty`) as purchase FROM  item_master  inner join purchase_details on purchase_details.item_id= item_master.id where item_master.id='".$row['id_']."' AND purchase_details.status=1 group by  item_master.id";
			$res_new=mysqli_query($conn,$sql_new);
			$row_new=mysqli_fetch_assoc($res_new);
			$qty_purchased=($row_new['purchase']=='') ? 0 : $row_new['purchase'];
			$qty=($qty=='') ? 0 : $qty;
			
			$sql_sales="SELECT item_master.id,sum(`sales_details`.`qty`) as sales FROM `sales_details` inner join item_master on item_master.id=sales_details.item_id where item_master.id='".$row['id_']."' AND sales_details.status=1 group by  item_master.id";
			$res_sales=mysqli_query($conn,$sql_sales);
			$row_sales=mysqli_fetch_assoc($res_sales);
			$qty_sold=($row_sales['sales']=='') ? 0 : $row_sales['sales'];
			
			$sql_pharma_sales="SELECT item_master.id,sum(`pharma_invoice_details`.`qty`) as sales FROM `pharma_invoice_details` inner join item_master on item_master.id=pharma_invoice_details.item_id where item_master.id='".$row['id_']."' AND pharma_invoice_details.status=1 group by  item_master.id";
			$res_pharma_sales=mysqli_query($conn,$sql_pharma_sales);
			$row_pharma_sales=mysqli_fetch_assoc($res_pharma_sales);
			$qty_pharma_sold=($row_pharma_sales['sales']=='') ? 0 : $row_pharma_sales['sales'];
			
		?>
			
			<tr><td><?php echo $asset_name; ?></td><td><?php echo $category_name; ?></td><td><?php echo $sub_cat; ?></td><td><?php echo $department_name; ?></td><td><?php echo $location_name; ?></td><td><?php echo $vendor_name; ?></td><td><?php echo $qty; ?> <?php echo $unit_name; ?></td><td><?php echo $qty_purchased; ?> <?php echo $unit_name; ?></td><td><?php echo $qty_sold; ?> <?php echo $unit_name; ?></td><td><?php echo $qty_pharma_sold; ?> <?php echo $unit_name; ?></td><td><?php echo (($qty_purchased+$qty)-($qty_sold+$qty_pharma_sold)); ?> <?php echo $unit_name; ?></td><td><?php echo $size; ?></td><td><?php echo $color; ?></td><td><?php echo $specification; ?></td><td><?php echo $covid_item; ?></td></tr>
		<?php
		}		
		
		echo json_encode($arr);
	
	}
	
	function load_users(){
		global $conn;
		$sql="select user_masters.*,user_roles.role_name,department_master.department_name from user_masters inner join user_roles on user_masters.user_role=user_roles.id left join department_master on department_master.id=user_masters.department_id  where user_masters.flag<>2";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$inv="";
		$myamt=0;
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			//echo "P Val:". $product_id;
			//$inv.=($inv=="") ? $invoice_id.":".$myamt.":".$id : ";".$invoice_id.":".$myamt.":".$id;
		?>
			
			<tr><td><?php echo $fname; ?></td><td><?php echo $lname; ?></td><td><?php echo $username; ?></td><td><?php echo $email; ?></td><td><?php echo $phone; ?></td><td><?php echo $department_name; ?></td><td><?php echo $role_name; ?></td><td><?php echo ($flag=="1") ? "Active" : "Inactive"; ?></td><td><span><?php echo ($flag=="1") ? "<a href='javascript:void(0)' title='Deactivate' onclick='activate($id,0)'><i class='fa fa-check'></i></a>" : "<a href='javascript:void(0)' title='Activate' onclick='activate($id,1)'><i class='fa fa-key'></i></a>"; ?></span>&nbsp;&nbsp;<span><a href="javascript:void(0)" title='Edit' onclick="edit('<?php echo $id.":".$fname.":".$lname.":".$username.":".$email.":".$phone.":".$user_role.":".$flag.":".$password; ?>')" ><i class="fa fa-pencil"></i></a></span>&nbsp;&nbsp;<span><a title='Delete' href="javascript:void(0)" onclick="del(<?php echo $id; ?>)" ><i class="fa fa-trash"></i></a></span></td></tr>
		<?php
		}		
		

}

function load_user_role(){

	global $conn;
		$sql="select id,role_name from user_roles where flag=1";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$arr=array();
		while($row=mysqli_fetch_assoc($result)){
			
			extract($row);	
			$arr[]=array("value"=>$id,"text"=>$role_name);
		
		}
		
	echo json_encode($arr);

}



function load_individual_asset(){
	
		global $conn;
		
		$id=$_POST['id'];
		
		$sql="select item_master.*,type_master.id as main_cat,opening_stock.dept_id,opening_stock.location_id,opening_stock.vendor_id,(select id from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id left join opening_stock on opening_stock.item_id=item_master.id where item_master.status=1 and item_master.id='$id'";
		
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		//echo $sql;
		//$arr[]=array("id"=>"","text"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr=array("id"=>$row['id'],"hsm_code"=>$row['hsm_code'],"text"=>$row['asset_name'],"generic_name"=>$row['generic_name'],"category_name"=>$row['main_cat'],"sub_cat"=>$row['sub_cat'],"size"=>$row['size'],"color"=>$row['color'],"gst_rate"=>$row['gst_rate'],"cgst_rate"=>$row['cgst_rate'],"sgst_rate"=>$row['sgst_rate'],"moq"=>$row['moq'],'covid_item'=>$row['covid_item'],'unit_name'=>$row['unit_id'],'dept_id'=>$row['dept_id'],'location_id'=>$row['location_id']);
		}		
		
		echo json_encode($arr);
	
	}
	
	function get_product_names(){
	
		global $conn;
		$prod=$_GET["term"];
		$sql="select item_master.id, pl.mrp as `mrp` from item_master left join purchase_details `pl` on pl.item_id=item_master.id where asset_name like '%".$prod."%' and item_master.status=1";
		
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$arr=array();
		while($row=mysqli_fetch_assoc($result)){
			
			extract($row);	
			//$price=($price=="") ? 0 : $price;
			$mrp=(is_null($mrp)) ? 0 : $mrp;  
			echo $mrp;
			echo $asset_name;
			//$arr[]=array("id"=>$id,"alias_name"=>$partname_alias,"part_name"=>$part_name." ".$make." ".$sku." ".$model." ".$chapter_no." ".$serial_no,"part_name1"=>$part_name,"product_details"=>$make."~".$sku."~".$model."~".$chapter_no."~".$serial_no."~".$unit."~".$partname_alias."~".$mrp,"barcode"=>$barcode,"price"=>$price,"mrp"=>$mrp);
		
		}
		
		}
		
		
function load_items(){
	
		global $conn;
		
		$id=$_POST['id'];
		$location_name=$_POST['location_name'];
		$location_id_=$_POST['location_id'];
		
		$sql="";
		$optional=(isset($_POST['indent_flag'])) ? " ,indent_details.qty,indent_details.qty_ordered,indent.id as `indent_id`,indent_details.id as `indent_details_id`,department_master.department_name " : "" ;
		
		$sql1="select item_master.id,item_master.asset_name,item_master.hsm_code,item_master.size,item_master.color,item_master.gst_rate,item_master.cgst_rate,item_master.sgst_rate,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item $optional from item_master left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id";
		
	if(isset($_POST['indent_flag'])) $sql=$sql1." inner join indent_details on item_master.id=indent_details.item_id left join indent on indent.id=indent_details.indent_id left join department_master on department_master.id=indent.department where indent.id='$id' "; 
		
		
		//echo $sql1;
		
		
		//if(isset($_POST["dept_name"]) && $_POST["dept_name"]!='') $sql=$sql1." where asset_stock.dept_id='".$_POST["dept_name"]."'";
		if(isset($_POST["type_name"]) && $_POST["type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.type_id='".$_POST["type_name"]."'" : $sql." and item_master.type_id='".$_POST["type_name"]."'";
		if(isset($_POST["sub_type_name"]) && $_POST["sub_type_name"]!='') $sql=($sql=="") ? $sql1." where item_master.sub_type_id='".$_POST["sub_type_name"]."'" : $sql." and item_master.sub_type_id='".$_POST["sub_type_name"]."'";
		//if(isset($_POST["location_name"]) && $_POST["location_name"]!='') $sql=($sql=="") ? $sql1." where asset_stock.location_id='".$_POST["location_name"]."'" : $sql." and asset_stock.location_id='".$_POST["location_name"]."'";
		
		$sql=($sql=="") ? $sql1 : $sql;  
		
		//echo $sql;
		
			
				$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				
				while($row=mysqli_fetch_assoc($res)){
					//extract($row);
					$arr[]=array("id"=>$row['id']."^".$row['hsm_code']."^".$row['size']."^".$row['color']."^".$row['covid_item']."^".$row['gst_rate']."^".$row['cgst_rate']."^".$row['sgst_rate'],"text"=>$row['asset_name']);
					
				}
			
			
			echo json_encode($arr);
			
}

function search_batch_code(){

	global $conn;
	
	$batch_code=$_POST['batch_code'];
	$item_id=$_POST['item_id'];
	$batch_flag=0;
	$patient_type=$_POST['patient_type'];
	
	$sql="select * from opening_stock where item_id='".$item_id."' and batch='".$batch_code."' and status=0";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	while($row=mysqli_fetch_assoc($res)){
	
		extract($row);
		//$mrp;
		//$expiry_date;
		/*$sql_="select * from purchase_details where item_id='".$item_id."' and expiry_date<'".$expiry_date."' and expiry_date<>'0000-00-00' and expiry_date<>'1970-01-01' ";
		$res_=mysqli_query($conn,$sql_);
		while($row_=mysqli_fetch_assoc($res_)){
			$exp_date[]=array("batch_code"=>$row_['batch_no'],"expiry_date"=>$row_['expiry_date']);
		}*/
		$arr=array("mrp"=>$mrp,"expiry_date"=>$expiry_date,"item_id"=>$item_id,"mfg_date"=>$mfg_date);
		$batch_flag=1;
	}
	
	if($batch_flag==0){
	
	$sql="select * from purchase_details where item_id='".$item_id."' and batch_no='".$batch_code."'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	while($row=mysqli_fetch_assoc($res)){
	
		extract($row);
		//$mrp;
		//$expiry_date;
		/*$sql_="select * from purchase_details where item_id='".$item_id."' and expiry_date<'".$expiry_date."' and expiry_date<>'0000-00-00' and expiry_date<>'1970-01-01' ";
		$res_=mysqli_query($conn,$sql_);
		while($row_=mysqli_fetch_assoc($res_)){
			$exp_date[]=array("batch_code"=>$row_['batch_no'],"expiry_date"=>$row_['expiry_date']);
		}*/
		$ex_date=date("d-m-Y",strtotime($expiry_date));
		$man_date=date("d-m-Y",strtotime($manufacturing_date));
		if($patient_type=='6'){
		$arr=array("mrp"=>$rate,"expiry_date"=>$ex_date,"item_id"=>$item_id,"rate"=>$rate,"mfg_date"=>$man_date );
		}else{
		$arr=array("mrp"=>$mrp,"expiry_date"=>$ex_date,"item_id"=>$item_id,"rate"=>$rate,"mfg_date"=>$man_date);
		}
	}
	
	}
	
	echo json_encode($arr);
}

function save_sales_invoice(){	
	
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
		$total_cgst_amount=mysqli_real_escape_string($conn,$_POST['total_cgst_amount']);
		$total_sgst_amount=mysqli_real_escape_string($conn,$_POST['total_sgst_amount']);
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		if($_REQUEST['inv_date']==''){
		$inv_date='NULL';
		}else{
			$inv_date= "'".date("Y-m-d", strtotime($_POST['inv_date']))."'";
		}
		$customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
		$phone_number=mysqli_real_escape_string($conn,$_POST['phone_number']);
		$cash=mysqli_real_escape_string($conn,$_POST['cash']);
		$card=mysqli_real_escape_string($conn,$_POST['card']);
		$upi=mysqli_real_escape_string($conn,$_POST['upi']);
		$doctor=mysqli_real_escape_string($conn,$_POST['doctor']);
		$uhid=mysqli_real_escape_string($conn,$_POST['uhid']);
		
		$net_total=mysqli_real_escape_string($conn,$_POST['net_total']);
		$discount_type=mysqli_real_escape_string($conn,$_POST['discount_type']);
		$discount_val=mysqli_real_escape_string($conn,$_POST['discount_val']);
		$discount_total=mysqli_real_escape_string($conn,$_POST['discount_total']);
		$round_off_total=mysqli_real_escape_string($conn,$_POST['round_off_total']);
		$grand_total=mysqli_real_escape_string($conn,$_POST['grand_total']);
		$due_bill=mysqli_real_escape_string($conn,$_POST['due_bill']);
		$status=1;
		if($due_bill=='1'){
			$status=2;
		}
		$patient_id=mysqli_real_escape_string($conn,$_POST['patient_id']);
		
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_customer_id=mysqli_real_escape_string($conn,$_POST['temporary_customer_id']);
		$temporary_sales_id=mysqli_real_escape_string($conn,$_POST['temporary_sales_id']);
		$delete_flag_no=temporary_delete_sales_number($temporary_customer_id,$temporary_sales_id);
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		
		$sql_customer="INSERT INTO `customer_master` SET `vendor_name`='".$customer_name."',`phone`='".$phone_number."',`uhid`='".$uhid."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		mysqli_query($conn,$sql_customer) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Customer insert")));
		
		$customer_id=mysqli_insert_id($conn);		
	
		$sales_no=get_sales_number();
		
			
		 $sql="INSERT INTO `pharma_invoice` SET `order_number`='".$sales_no."',`user_id`='".$user_id."',`customer_id`='".$customer_id."',`uhid`='".$uhid."',`customer_name`='".$customer_name."',`doctor_name`='".$doctor."',`gst_amount`='".$total_gst_amount."',`cgst_amount`='".$total_cgst_amount."',`sgst_amount`='".$total_sgst_amount."',`amount`='".$net_total."',`discount_type`='".$discount_type."',`discount_val`='".$discount_val."',`discount_total`='".$discount_total."',`round_off_total`='".$round_off_total."',`grand_total`='".$grand_total."',`status`='".$status."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($asset_id as $key => $val){
			
			$qty_sum=$qty_sum+$qty[$key];			
			
			$sql="INSERT INTO `pharma_invoice_details` SET `sales_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`disc_rate`='".$disc_rate[$key]."',`disc_amount`='".$disc_amount[$key]."',`gst_rate`='".$gst_rate[$key]."',`gst_amount`='".$gst_amount[$key]."',`cgst_rate`='".$cgst_rate[$key]."',`cgst_amount`='".$cgst_amount[$key]."',`sgst_rate`='".$sgst_rate[$key]."',`sgst_amount`='".$sgst_amount[$key]."',`total`='".$total_amount[$key]."',`status`='".$status."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			
			//$indent_key=$purchase_order_id[$key];
		
		}
		
		if(($cash!="")&&($cash!="0")){
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='cash',`amount`='".$cash."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if(($card!="")&&($card!="0")){
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='card',`amount`='".$card."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if(($upi!="")&&($upi!="0")){
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='upi',`amount`='".$upi."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
				
		$drug_order_id_arr=$_POST['drug_order_id_arr'];
	
		$drug_arr=array($drug_order_id_arr);
		$str_arr = explode(',', $drug_order_id_arr) ;
		$length_arr= count($str_arr);
		for($i=0;$i<$length_arr;$i++){			
			$sql_mode="UPDATE `drugsheet` SET `billing_flag`='1', `billing_by`='".$created_by."', `billing_time`='".$created_on."'  WHERE `id`='".$str_arr[$i]."'";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Bill Done")));
		}
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id));
	

}

function load_doctors(){

	global $conn;
	
	$sql="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'";
	
	$res=mysqli_query($conn,$sql);
	
	
	while($row=mysqli_fetch_assoc($res)){
	
		//if(strtoupper(substr($row['name'],0,2))=="DR") $arr[]=array("value"=>$row['id'],"text"=>$row['name']);
		 $arr[]=array("value"=>$row['id'],"text"=>$row['name']);
	
	}
	
	echo json_encode($arr);

}

function load_patient_uhid(){

	global $conn;
	
	$uhid=$_POST['uhid'];
	
	$sql="SELECT * FROM `patient_registration_form` where `uhid_no`='$uhid' ORDER BY `id` DESC LIMIT 1";	
	$res=mysqli_query($conn,$sql);
	$patient_type_names="";
	$consultant="";
	$count_rows=$res->num_rows;
	if($count_rows>0){	
	//while($row=mysqli_fetch_assoc($res)){
		$row=mysqli_fetch_assoc($res);
		if($row['patient_type']!=''){		
			$sql_patient_type="SELECT  `name` FROM `patient_type_master` WHERE  `id`='".$row['patient_type']."' ";
			$res_patient_type=mysqli_query($conn,$sql_patient_type);
			$row_patient_type=mysqli_fetch_assoc($res_patient_type);
			$patient_type_names=$row_patient_type['name'];
		}
		$consultant=$row['admiting_doctor'];
		$sql_emr="SELECT * FROM `patient_slip_generate_form` where `uhid_no`='$uhid' ORDER BY `id` DESC LIMIT 1";	
		$res_emr=mysqli_query($conn,$sql_emr);
		$count_rows_emr=$res_emr->num_rows;
		if($count_rows_emr>0){	
			$row_emr=mysqli_fetch_assoc($res_emr);
			$consultant=$row_emr['admiting_doctor'];
		}
		$arr=array("customer_name"=>$row['patient_name'],"phone_number"=>$row['phone_no'],"patient_id"=>$row['id'],"uhid_no"=>$row['uhid_no'],"consultant"=>$consultant,"flag"=>'1',"patient_type"=>$row['patient_type'],"patient_type_names"=>$patient_type_names);
	
	}else{
		$arr=array("customer_name"=>'',"phone_number"=>'',"patient_id"=>'',"uhid_no"=>'',"consultant"=>'',"flag"=>'0',"patient_type"=>'',"patient_type_names"=>$patient_type_names);
	}
	
	echo json_encode($arr);

}

function load_batch_code(){

	global $conn;
	$item_exist=0;
	$item_id=$_POST['item_id'];
	$sql="select batch_no from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' and purchase.department_id='".$_SESSION['department_id']."' group by batch_no ORDER BY `expiry_date` ASC";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){		
		$batch_code_=item_wise_stock_calculation($item_id,$row['batch_no']);
		//echo "Batch No ".$row['batch_no'].":".$batch_code_; 
		if($batch_code_>0) { $arr[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no']); $item_exist=1;}
	}
	
	$sql="select batch_no from stock_transfer_details inner join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id where item_id='$item_id' and stock_transfer.to_department_id='".$_SESSION['department_id']."' group by batch_no";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$batch_code_=item_wise_stock_calculation($item_id,$row['batch_no']);
		//echo "Batch No ".$row['batch_no'].":".$batch_code_; 
		if($batch_code_>0) { $arr[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no']);  $item_exist=1;}
	}
	
	$sql="select batch,qty from opening_stock where item_id='$item_id' and status=0";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
		//if($row['qty']>0) $arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);
		if($item_exist==0){
			$arr[]=array("value"=>$row['batch'],"text"=>$row['batch']);
		}
	}
	
	echo json_encode($arr);

}

function item_wise_stock_calculation($item_id,$batch_code_1){
	

	global $conn;
	$_SESSION[$item_id]=array();
	//$_SESSION[$item_id][$batch_code_] = array();
	//$_SESSION[$item_id]=0;
	$batch_code_="";
	$batch_code_=(isset($_POST["batch_code"])) ? $_POST["batch_code"] : $batch_code_1;  	
	$_SESSION[$item_id][$batch_code_]=0;
	
	$item_id=(isset($_POST["item_id"])) ? $_POST["item_id"] : $item_id;
	$batch_code=($batch_code_!="undefined") ? " and purchase_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code1=($batch_code_!="undefined") ? " and pharma_invoice_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code2=($batch_code_!="undefined") ? " and stock_transfer_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code3=($batch_code_!="undefined") ? " and consumables_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code4=($batch_code_!="undefined") ? " and temporary_pharma_invoice_details.batch_no='".$batch_code_."' and temporary_pharma_invoice_details.medicine_return_flag='0' " : "" ;
	$batch_code5=($batch_code_!="undefined") ? " and pharma_invoice_details_return.batch_no='".$batch_code_."' " : "" ;
	$batch_code6=($batch_code_!="undefined") ? " and expired_dameged_items_details.batch_no='".$batch_code_."' " : "" ;
	
	$pur_qty=0;
	$op_qty=0;
	$stock_transfer_qty=0;
	$stock_transfer_qty_in=0;
	
	
	$sql="select sum(qty) as qty from opening_stock where item_id='$item_id' and status=0 and dept_id='".$_SESSION['department_id']."' group by item_id;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$op_qty=mysqli_fetch_assoc($res);
	
	
	
	
	$sql="select sum(qty) as qty from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' $batch_code and purchase.department_id='".$_SESSION['department_id']."' and status=1 group by item_id;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$pur_qty=mysqli_fetch_assoc($res);
	
	
	
	$pharma_sale_qty=0;
	
	$temporary_pharma_sale_qty=0;
	
	if($_SESSION['department_id']=="8"){
	
		$sql="select sum(qty) as qty from pharma_invoice_details where item_id='$item_id' $batch_code1 and (status=1 OR status=2) group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$pharma_sale_qty=mysqli_fetch_assoc($res);
		
		$sql="select sum(qty) as qty from temporary_pharma_invoice_details where item_id='$item_id' $batch_code4 and (status=1 OR status=2) group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$temporary_pharma_sale_qty=mysqli_fetch_assoc($res);
		
		$sql="select sum(qty) as qty from pharma_invoice_details_return where item_id='$item_id' $batch_code5 and (status=1 OR status=2) group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$pharma_sale_qty_return=mysqli_fetch_assoc($res);
		
	
	}
	
	if($_SESSION['department_id']!=""){
	
		//$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and from_department_id='".$_SESSION['department_id']."' group by item_id;";
		$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and  from_department_id='".$_SESSION['department_id']."' and to_department_id<>'0' and to_department_id<>'".$_SESSION['department_id']."' and stock_transfer.status=1 and from_department_id='".$_SESSION['department_id']."' group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$stock_transfer_qty=mysqli_fetch_assoc($res);
		
		$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and to_department_id='".$_SESSION['department_id']."' group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$stock_transfer_qty_in=mysqli_fetch_assoc($res);
	
	}
	
	if($_SESSION['department_id']!=""){
	
		$sql="select sum(qty) as qty from consumables_details left join consumables on consumables.id=consumables_details.consumables_id  where item_id='$item_id' $batch_code3 and consumables.status=1 and consumables.department_id='".$_SESSION['department_id']."' group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$consumables_qty=mysqli_fetch_assoc($res);
	
	}
	
	if($_SESSION['department_id']!=""){
	
		$sql="select sum(qty) as qty from expired_dameged_items_details left join expired_dameged_items on expired_dameged_items.id=expired_dameged_items_details.expired_dameged_items_id  where item_id='$item_id' $batch_code6 and expired_dameged_items.status=1 and expired_dameged_items.department_id='".$_SESSION['department_id']."' group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$expired_dameged_items_qty=mysqli_fetch_assoc($res);
	
	}
	
	//$sql="select sum(qty) as qty from sales_details where item_id='$item_id' and status=1 group by item_id;";
	//$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	//$sale_qty=mysqli_fetch_assoc($res);
	
	//echo $pur_qty['qty'];
	//$closing_stock=($op_qty['qty']+$pur_qty['qty'])-($pharma_sale_qty['qty']+$sale_qty['qty']);
	
	$closing_stock=($op_qty['qty']+$pur_qty['qty']+$stock_transfer_qty_in['qty']+$pharma_sale_qty_return['qty'])-($pharma_sale_qty['qty']+$stock_transfer_qty['qty']+$consumables_qty['qty']+$temporary_pharma_sale_qty['qty']+$expired_dameged_items_qty['qty']);	
	
	//$_SESSION[$item_id]=$closing_stock;
	//$_SESSION[$item_id][$batch_code_]=$closing_stock;
	
	$log="";
	if($batch_code_1==""){
		$log="\n\nWhen Batch Code for $item_id is not there:\n";
		$log.="Opening Stock:".$op_qty['qty'].":: Pur Quantity:".$pur_qty['qty'].":: Stock Transfer In:".$stock_transfer_qty_in['qty'].":: ----- Pharma Sale:".$pharma_sale_qty['qty'].":: Stock Transfer Out:".$stock_transfer_qty['qty'].":::::::: Closing Stock: $closing_stock";
				
	}else{
		$log="\n\nWhen Batch Code($batch_code_1) for $item_id is THERE:\n";
		$log.="Opening Stock:".$op_qty['qty'].":: Pur Quantity:".$pur_qty['qty'].":: Stock Transfer In:".$stock_transfer_qty_in['qty'].":: ----- Pharma Sale:".$pharma_sale_qty['qty'].":: Stock Transfer Out:".$stock_transfer_qty['qty'].":::::::: Closing Stock: $closing_stock";
	} 
	
	$fp = fopen('stock_log.txt', 'a');
	fwrite($fp, $log);
	fclose($fp);
	
	if($batch_code_1=="") echo json_encode(array("closing_stock"=>$closing_stock));
	else return $closing_stock;
	

} 


function pharmacy_stock_report(){

	global $conn;
	
	//$sql="select item_master.id as `id_`,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item from item_master left join type_master on type_master.id=item_master.type_id left join unit_master on unit_master.id=item_master.unit_id where item_master.type_id=1 order by sub_cat";
	
	$sql="select item_master.id as `id_`,item_master.asset_name,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat,unit_name, size,color,specification, IF(covid_item=1, 'YES', 'NO') as covid_item from item_master left join type_master on type_master.id=item_master.type_id left join opening_stock on opening_stock.item_id=item_master.id left join unit_master on unit_master.id=item_master.unit_id where opening_stock.dept_id='".$_SESSION['department_id']."' and item_master.type_id=1 order by sub_cat";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			
		?>
			<tr id="<?php echo $id_; ?>"><td><?php echo $asset_name; ?></td><td><?php echo $category_name; ?></td><td><?php echo $sub_cat; ?></td><td class="spinner-border" role="status" ><span id="<?php echo $id_; ?>_cs" ><img src="loader.gif" style="width:15px" /></span> <?php echo $unit_name; ?></td><td><?php echo $size; ?></td><td><?php echo $color; ?></td><td><?php echo $specification; ?></td><td><?php echo $covid_item; ?></td></tr>
		<?php	
		}
	

}

function sales_report(){

	global $conn;
	$from=$_POST["from"];
	$to=$_POST["to"];
	$sql="select pharma_invoice.id,order_number,payment_mode.mode,payment_mode.amount,DATE(pharma_invoice.date) as date, `pharma_invoice`.status as `status` from pharma_invoice inner join payment_mode on pharma_invoice.id=payment_mode.pharma_invoice_id where DATE(date)>='".date("Y-m-d",strtotime($from))."' and DATE(date)<='".date("Y-m-d",strtotime($to))."' and payment_mode.amount<>0 order by pharma_invoice.id desc";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		extract($row);
		$arr[]=array("invoice_number"=>$order_number,"date"=>date("d/m/Y",strtotime($date)),"mode"=>$mode,"amount"=>$amount,"invoice_id"=>$id,"status"=>$status);
	
	}
	
	echo json_encode($arr);
}

function cancel_bill(){
	
	global $conn;
	$inv_id=$_POST['inv_id'];
	
	$status=mysqli_escape_string($conn,$_POST['status']);
	$created_on=date('Y-m-d H:i:s');
	$created_by=$_SESSION['id'];
	
	$tans_sql="SET autocommit = 0;";
	mysqli_query($conn,$tans_sql);
  
	$tans_sql="START TRANSACTION;";
	mysqli_query($conn,$tans_sql);
	
	$sql="UPDATE  `pharma_invoice` SET `status`='".$status."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$inv_id."'  ";	
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$sql="UPDATE  `pharma_invoice_details` SET `status`='".$status."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `sales_id`='".$inv_id."'  ";	
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$tans_sql="COMMIT;";
	mysqli_query($conn,$tans_sql);
	
	echo json_encode(array("flag"=>"1"));
	
	
}

function delete_purchase_inv(){
	
	global $conn;
	$inv_id=$_POST['inv_id'];
	
	$status=mysqli_escape_string($conn,$_POST['status']);
	
	$tans_sql="SET autocommit = 0;";
	mysqli_query($conn,$tans_sql);
  
	$tans_sql="START TRANSACTION;";
	mysqli_query($conn,$tans_sql);
	
	$sql="delete from purchase where id='$inv_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$sql="delete from purchase_details where purchase_id='$inv_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$tans_sql="COMMIT;";
	mysqli_query($conn,$tans_sql);
	
	echo json_encode(array("flag"=>"1"));

}


function save_stock_transfer(){	
	
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
		$mrp=$_POST['mrp'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];
		$user_id=$_SESSION['user_id'];
		$grand_total=round($_POST['grand_total']);
		$inv_date=mysqli_real_escape_string($conn,$_POST['inv_date']);
		$from_department_id=$_SESSION['department_id'];
		$to_department_id=mysqli_real_escape_string($conn,$_POST['department_id']);
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];	
		
		$transfer_no=get_transfer_number();
		
		if($to_department_id==0) die(json_encode(array("flag"=>"0")));
		
		$sql="INSERT INTO `stock_transfer` SET `transfer_number`='".$transfer_no."',`user_id`='".$user_id."',`from_department_id`='".$from_department_id."',`to_department_id`='".$to_department_id."',`amount`='".$grand_total."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($asset_id as $key => $val){
		
			
			$qty_sum=$qty_sum+$qty[$key];
			
			$sql="INSERT INTO `stock_transfer_details` SET `stock_transfer_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`total`='".$total_amount[$key]."',`mrp`='".$mrp[$key]."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Stock Transfer Details insert")));
			
			//$indent_key=$purchase_order_id[$key];
		
		}
		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id));
	

}


function load_stock_transfer(){
	
		
		
		global $conn;
		
		$sql="select stock_transfer.*,department_master.department_name from stock_transfer left join department_master on department_master.id=stock_transfer.to_department_id where from_department_id='".$_SESSION['department_id']."'";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		while($row=mysqli_fetch_assoc($res)){
			
			extract($row);
		?>
		
			<tr><td><?php echo $sl;?></td><td id="<?php echo $id ?>_asset"><a href="stock_transfer_print.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $transfer_number; ?></a><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php //echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_size"><?php echo $department_name; ?></td><td id="<?php echo $id ?>_amount"><?php echo $amount; ?></td></tr>
		
		<?php
		
		$sl++;}
	
	
	
	}
	
	
	function cancel_stock_transfer(){
	
	global $conn;
	$inv_id=$_POST['inv_id'];
	
	$status=mysqli_escape_string($conn,$_POST['status']);
	
	$tans_sql="SET autocommit = 0;";
	mysqli_query($conn,$tans_sql);
  
	$tans_sql="START TRANSACTION;";
	mysqli_query($conn,$tans_sql);
	
	$sql="update stock_transfer set status='$status' where id='$inv_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$sql="update stock_transfer_details set status='$status' where stock_transfer_id='$inv_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$tans_sql="COMMIT;";
	mysqli_query($conn,$tans_sql);
	
	echo json_encode(array("flag"=>"1"));
	
	
}

function save_consumed(){

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
		$rate=$_POST['rate'];
		$mrp=$_POST['mrp'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];
		$user_id=$_SESSION['user_id'];
		
		if($_REQUEST['inv_date']==''){
		$inv_date='NULL';
		}else{
			$inv_date= "'".date("Y-m-d", strtotime($_POST['inv_date']))."'";
		}
		$department_id=$_SESSION['department_id'];
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];	
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
	
		
		$transfer_no=get_consumable_number();
		
		$sql="INSERT INTO `consumables` SET `transfer_number`='".$transfer_no."',`user_id`='".$user_id."',`department_id`='".$department_id."',`date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($asset_id as $key => $val){
		
			$sql="INSERT INTO `consumables_details` SET `consumables_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Consumables Transfer Details insert")));

		}
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","c_id"=>$sales_id));

}


function stock_update(){

	global $conn;
	
	$sql="select id,qty from pharma_invoice_details where item_id='221' and batch_no='GTD0588A' order by date desc";
	$res=mysqli_query($conn,$sql);
	$tot_qty=0;
	while($row=mysqli_fetch_assoc($res)){
			echo "<BR>";
			echo $tot_qty+=$row['qty'];
			
			if($tot_qty>10){			
				echo $sql_update="update pharma_invoice_details set batch_no='GTD0742A' where id ='".$row['id']."' and batch_no='GTD0588A'";
				$res_=mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
			}
	}

}

function stock_internal(){

	global $conn;

	$sql="select item_name,item_id,batch_no,sum(qty) as qty from pharma_invoice_details group by item_id, batch_no;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$tot_qty=0;
	$stock=0;
	while($row=mysqli_fetch_assoc($res)){
		
		$sql_puch="select sum(qty) as qty from purchase_details where batch_no='".$row['batch_no']."' group by batch_no";
		$res_puch=mysqli_query($conn,$sql_puch) or die(mysqli_error($conn));
		$purch=0;
		while($row_puch=mysqli_fetch_assoc($res_puch)){
			$stock=$row_puch['qty']-$row['qty'];
			$purch=$row_puch['qty'];
		}
		
		$col=($stock<0) ? "background: #ff0000; color:ffffff" : ""; 
		echo "<BR><span style='".$col."'>".$row['item_id'] . " - ". $row['item_name'] ."(".$row['batch_no'].") >>> ". $stock . " >> ". $purch ."</span>";
	}
}

function load_hsn_code_gst_master(){
	
		global $conn;
		
		$sql="select * from `hsn_code_gst_master` where status=1";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array("id"=>"","hsn_code"=>"-Select-","gst_rate"=>"-Select-","cgst_rate"=>"-Select-","sgst_rate"=>"-Select-");
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"hsn_code"=>$row['hsn_code'],"gst_rate"=>$row['gst_rate'],"cgst_rate"=>$row['cgst_rate'],"sgst_rate"=>$row['sgst_rate']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function add_hsn_code_gst_master(){
	
		global $conn;
		
		$hsn_code=mysqli_real_escape_string($conn,$_POST['hsn_code']);
		$gst_rate=mysqli_real_escape_string($conn,$_POST['gst_rate']);
		$cgst_rate=mysqli_real_escape_string($conn,$_POST['cgst_rate']);
		$sgst_rate=mysqli_real_escape_string($conn,$_POST['sgst_rate']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		if(isset($_POST['id']) && $_POST['id']!="" ){
			$id=$_POST['id'];			
			$sql="UPDATE  `hsn_code_gst_master` SET `hsn_code`='".$hsn_code."', `gst_rate`='".$gst_rate."', `cgst_rate`='".$cgst_rate."', `sgst_rate`='".$sgst_rate."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."'  ";				
		}else {  
		$sql="INSERT INTO `hsn_code_gst_master` SET `hsn_code`='".$hsn_code."', `gst_rate`='".$gst_rate."', `cgst_rate`='".$cgst_rate."', `sgst_rate`='".$sgst_rate."' , `created_by`='".$created_by."', `created_on`='".$created_on."'  ";				
				}
		
		$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
		if($res) echo json_encode(array("flag"=>1));
		else echo json_encode(array("flag"=>0));
	
	}
	
	function get_gst_rate_hsn(){
	
		global $conn;
		$hsn_id=$_POST['hsn_id'];
		
		$sql="select * from `hsn_code_gst_master` where `id`='".$hsn_id."' AND status=1";
		
		$res=mysqli_query($conn,$sql);
		
		
		while($row=mysqli_fetch_assoc($res)){
			$arr=array("id"=>$row['id'],"hsn_code"=>$row['hsn_code'],"gst_rate"=>$row['gst_rate'],"cgst_rate"=>$row['cgst_rate'],"sgst_rate"=>$row['sgst_rate']);
		}		
		
		echo json_encode($arr);
	
	}
	
	
	function load_asset_batch_stock(){
	
		global $conn;
		
		$id=$_POST['id'];
		
		$vendor_name=$_POST['vendor_name'];
		
		
		$sql="";
		
		if(isset($_POST['type_name'])){
			$type_id=$_POST['type_name'];
			$sub_type_id=$_POST['sub_type_name'];
			$sub_where="";
			if($sub_type_id!=''){
				$sub_where=" and item_master.sub_type_id='$sub_type_id' ";
			}
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1 and item_master.type_id='$type_id' $sub_where ";
			
		}else{
		
			$sql="select item_master.*,type_master.category_name,(select category_name from type_master where id=item_master.sub_type_id) as sub_cat from `item_master` left join type_master on type_master.id=item_master.type_id where item_master.status=1";
		}
		
		
		
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$count=$res->num_rows;
		if($count>0){
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
				
		?>
			
			<tr><td id="<?php echo $id ?>_asset"><?php echo $asset_name; ?><input type="hidden" id="<?php echo $id ?>_hsm_code" value="<?php echo $hsm_code ?>"  /><input type="hidden" id="<?php echo $id ?>_gst_rate" value="<?php echo $gst_rate ?>"  /><input type="hidden" id="<?php echo $id ?>_cgst_rate" value="<?php echo $cgst_rate ?>"  /><input type="hidden" id="<?php echo $id ?>_sgst_rate" value="<?php echo $sgst_rate ?>"  /><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php echo $vendor_name ?>"  /></td><td id="<?php echo $id ?>_category_name"><?php echo $category_name; ?></td><td id="<?php echo $id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $id ?>_gst"><?php echo $gst_rate; ?></td><input type="hidden" id="<?php echo $id ?>_qty"  data-qty="0" value="0" place-holder="qty" /><td><span><button onclick="add_indent('<?php echo $id ?>','<?php echo $id ?>','<?php echo $id ?>','<?php echo $id ?>',document.getElementById('iop_count').value)"><i class="fa fa-add"></i>Add</button></span></td></tr>
            
         
		<?php
		}	
		}else{
			//echo '<tr><td></td><td></td><td></td><td></td><td></td></tr>';
		}
		
		//echo json_encode($arr);
	
	}
	
	function save_opening_stock_batchwise_invoice(){
	
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
		$grand_total=round($_POST['grand_total']);
		$total_cgst_amount=mysqli_real_escape_string($conn,$_POST['total_cgst_amount']);
		$total_sgst_amount=mysqli_real_escape_string($conn,$_POST['total_sgst_amount']);
		$department_id=$_SESSION['department_id'];
		$supplier_invoice_no=mysqli_real_escape_string($conn,$_POST['supplier_invoice_no']);
		if($_REQUEST['purchase_bill_date']==''){
		$purchase_bill_date='NULL';
		}else{
			$purchase_bill_date= "'".date("Y-m-d", strtotime($_POST['purchase_bill_date']))."'";
		}
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		$adjust_type=mysqli_real_escape_string($conn,$_POST['adjust_type']);
		$adjust_amount=mysqli_real_escape_string($conn,$_POST['adjust_amount']);
		$grand_net_total_=mysqli_real_escape_string($conn,$_POST['grand_net_total_']);
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
	
		$purchase_no=get_purchase_number();
		
			
		$sql="INSERT INTO `purchase` SET `order_number`='".$purchase_no."',`user_id`='".$user_id."',`vendor_id`='".$vendor_id."',`department_id`='".$department_id."',`vendor_name`='".$vendor_name."',`gst_amount`='".$total_gst_amount."',`cgst_amount`='".$total_cgst_amount."',`sgst_amount`='".$total_sgst_amount."',`amount`='".$grand_total."',`supplier_invoice_no`='".$supplier_invoice_no."',`purchase_bill_date`=".$purchase_bill_date.",`opening_stock_flag`='1',`adjust_type`='".$adjust_type."',`adjust_amount`='".$adjust_amount."',`grand_net_total_`='".$grand_net_total_."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Purchase insert")));
		
		$purchase_id=mysqli_insert_id($conn);
		
	
		
		foreach($purchase_order_details_id as $key => $val){
				
			
			$sql="INSERT INTO `purchase_details` SET `purchase_id`='".$purchase_id."', `purchase_order_id`='0', `purchase_order_details_id`='0', `item_id`='".$asset_id[$key]."', `item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`disc_rate`='".$disc_rate[$key]."',`disc_amount`='".$disc_amount[$key]."',`gst_rate`='".$gst_rate[$key]."',`gst_amount`='".$gst_amount[$key]."',`cgst_rate`='".$cgst_rate[$key]."',`cgst_amount`='".$cgst_amount[$key]."',`sgst_rate`='".$sgst_rate[$key]."',`sgst_amount`='".$sgst_amount[$key]."',`total`='".$total_amount[$key]."',`mrp`='".$mrp[$key]."', `free_item_not_flag`='1' , `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			
			$indent_key=$purchase_order_id[$key];
		
		}
		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","p_id"=>$purchase_id));
	
	
	}
	
function puchase_payment_due_calculate_vendor(){
	global $conn;	
	$vendor_id=$_POST["vendor_id"];
	$opening_bal=$_POST["opening_bal"];
	$total_purchase_amt['total_purchase_amt']=0;
	$total_payment_amt['total_payment_amt']=0;
	$due_amt=0;
	
	$sql="SELECT SUM(`amount`) AS `total_purchase_amt` FROM `purchase` WHERE  `vendor_id`='".$vendor_id."' ;";	
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$total_purchase_amt=mysqli_fetch_assoc($res);
	
	$sql2="SELECT SUM(`amount_to_be_paid`) AS `total_payment_amt` FROM `invoice_ledger_wise_payment_to_vendor` WHERE  `vendor_id`='".$vendor_id."' AND `del_flag`='0' ;";	
	$res2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
	$total_payment_amt=mysqli_fetch_assoc($res2);
	
	$due_amt=($total_purchase_amt['total_purchase_amt']-$total_payment_amt['total_payment_amt'])+$opening_bal;
	echo json_encode(array("flag"=>"1","due_amt"=>$due_amt));
} 

function check_item(){
	
		global $conn;
		$item_name=$_POST['item_name'];
		
		$sql="select * from `item_master` where `asset_name`='".$item_name."' AND status=1";
		$flag=0;		
		$res=mysqli_query($conn,$sql);		
		while($row=mysqli_fetch_assoc($res)){
			$flag=1;			
		}		
		$arr=array("flag"=>$flag);
		echo json_encode($arr);
	
	}
	
function temporary_save_sales_invoice(){	
	
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
		$grand_total=mysqli_real_escape_string($conn,round($_POST['grand_total']));
		$total_cgst_amount=mysqli_real_escape_string($conn,$_POST['total_cgst_amount']);
		$total_sgst_amount=mysqli_real_escape_string($conn,$_POST['total_sgst_amount']);
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		
		if($_REQUEST['inv_date']==''){
		$inv_date='NULL';
		}else{
			$inv_date= "'".date("Y-m-d", strtotime($_POST['inv_date']))."'";
		}
		$customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
		$phone_number=mysqli_real_escape_string($conn,$_POST['phone_number']);
		
		$doctor=mysqli_real_escape_string($conn,$_POST['doctor']);
		$uhid=mysqli_real_escape_string($conn,$_POST['uhid']);
		$due_bill=mysqli_real_escape_string($conn,$_POST['due_bill']);
		$status=1;
		if($due_bill=='1'){
			$status=2;
		}
		$patient_id=mysqli_real_escape_string($conn,$_POST['patient_id']);
		
		$medicine_return_flag=0;
		if(isset($_POST['medicine_return_flag'])){
			$medicine_return_flag=mysqli_real_escape_string($conn,$_POST['medicine_return_flag']);	
		}
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_customer_id=mysqli_real_escape_string($conn,$_POST['temporary_customer_id']);
		$temporary_sales_id=mysqli_real_escape_string($conn,$_POST['temporary_sales_id']);
		$delete_flag_no=temporary_delete_sales_number($temporary_customer_id,$temporary_sales_id);
		
		
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		
		$sql_customer="INSERT INTO `temporary_customer_master` SET `vendor_name`='".$customer_name."',`phone`='".$phone_number."',`uhid`='".$uhid."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.",`medicine_return_flag`='".$medicine_return_flag."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		
		mysqli_query($conn,$sql_customer) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Customer insert")));
		
		$customer_id=mysqli_insert_id($conn);		
	
		$sales_no=temporary_get_sales_number();
		
				
		$sql="INSERT INTO `temporary_pharma_invoice` SET `order_number`='".$sales_no."',`user_id`='".$user_id."',`customer_id`='".$customer_id."',`uhid`='".$uhid."',`customer_name`='".$customer_name."',`doctor_name`='".$doctor."',`gst_amount`='".$total_gst_amount."',`cgst_amount`='".$total_cgst_amount."',`sgst_amount`='".$total_sgst_amount."',`amount`='".$grand_total."',`status`='".$status."',`medicine_return_flag`='".$medicine_return_flag."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($asset_id as $key => $val){			
			$qty_sum=$qty_sum+$qty[$key];		
			
				$sql="INSERT INTO `temporary_pharma_invoice_details` SET `sales_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`disc_rate`='".$disc_rate[$key]."',`disc_amount`='".$disc_amount[$key]."',`gst_rate`='".$gst_rate[$key]."',`gst_amount`='".$gst_amount[$key]."',`cgst_rate`='".$cgst_rate[$key]."',`cgst_amount`='".$cgst_amount[$key]."',`sgst_rate`='".$sgst_rate[$key]."',`sgst_amount`='".$sgst_amount[$key]."',`total`='".$total_amount[$key]."',`status`='".$status."',`medicine_return_flag`='".$medicine_return_flag."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
		}
		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id,"temporary_customer_id"=>$customer_id,"temporary_sales_id"=>$sales_id));
	

}	

function reset_temporary_save_sales_invoice(){	
	
		global $conn;
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_customer_id=mysqli_real_escape_string($conn,$_POST['temporary_customer_id']);
		$temporary_sales_id=mysqli_real_escape_string($conn,$_POST['temporary_sales_id']);
		$delete_flag_no=temporary_delete_sales_number($temporary_customer_id,$temporary_sales_id);		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","temporary_customer_id"=>$customer_id,"temporary_sales_id"=>$sales_id));
	

}

function delete_temporary_save_sales_invoice(){	
	
		global $conn;
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_customer_id=mysqli_real_escape_string($conn,$_POST['temporary_customer_id']);
		$temporary_sales_id=mysqli_real_escape_string($conn,$_POST['temporary_sales_id']);
		$item_id=mysqli_real_escape_string($conn,$_POST['item_id']);
		$batch_code_value=mysqli_real_escape_string($conn,$_POST['batch_code_value']);
		
		$delete_flag_no=temporary_delete_batch_item_sales_number($temporary_customer_id,$temporary_sales_id,$item_id,$batch_code_value);		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","temporary_customer_id"=>$customer_id,"temporary_sales_id"=>$sales_id));
	

}

function load_pharmacy_ipd_order_data(){
	
		global $conn;
		
		$patient_id=$_POST['patient_id'];
		$uhid=$_POST['uhid'];
		$drug_order_id_arr=$_POST['drug_order_id_arr'];
		$order_id_val="";
		if(isset($_POST['order_id_val'])){
		 $order_id_val=$_POST['order_id_val'];
		}
		$treat_flag=$_POST['treat_flag'];
		$sql="";		
		if($treat_flag=='3'){
		$sql="SELECT `item_master`.`asset_name`,`item_master`.`hsm_code`,`item_master`.`gst_rate`,`drugsheet`.`qty`,`drugsheet`.`id` AS `drug_order_id`,`drugsheet`.`chart_date`,`type_master`.`category_name`,(SELECT `category_name` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_cat`,(SELECT `sub_type_id` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_type_id`, `drugsheet`.`drug` AS `drug_unique_id`, `unit_master`.`unit_name` ,`drugsheet`.`prescription_flag`,`drugsheet`.`discharge_flag`,`item_master`.`cgst_rate`,`item_master`.`sgst_rate`,`item_master`.`id` AS `item_unique_id`,`item_master`.`size`,`item_master`.`color`,`item_master`.`covid_item`  FROM `drugsheet` INNER JOIN `item_master` ON `item_master`.`id`=`drugsheet`.`drug` LEFT JOIN `type_master` ON `type_master`.`id`=`item_master`.`type_id` LEFT JOIN `unit_master` ON `unit_master`.`id`=`item_master`.`unit_id` WHERE `drugsheet`.`del_flag`='0' AND `drugsheet`.`discharge_flag`='1' AND `drugsheet`.`billing_flag`='0' AND `drugsheet`.`patient_id`='".$patient_id."' AND `drugsheet`.`hospital_number`='".$uhid."' AND `drugsheet`.`purchased_flag`='1' ";
		}else if($treat_flag=='1'){
			$sql="SELECT `item_master`.`asset_name`,`item_master`.`hsm_code`,`item_master`.`gst_rate`,`drugsheet`.`qty`,`drugsheet`.`id` AS `drug_order_id`,`drugsheet`.`chart_date`,`type_master`.`category_name`,(SELECT `category_name` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_cat`,(SELECT `sub_type_id` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_type_id`, `drugsheet`.`drug` AS `drug_unique_id`, `unit_master`.`unit_name` ,`drugsheet`.`prescription_flag`,`drugsheet`.`discharge_flag` ,`item_master`.`cgst_rate`,`item_master`.`sgst_rate`,`item_master`.`id` AS `item_unique_id`,`item_master`.`size`,`item_master`.`color`,`item_master`.`covid_item` FROM `drugsheet` INNER JOIN `item_master` ON `item_master`.`id`=`drugsheet`.`drug` LEFT JOIN `type_master` ON `type_master`.`id`=`item_master`.`type_id` LEFT JOIN `unit_master` ON `unit_master`.`id`=`item_master`.`unit_id` WHERE `drugsheet`.`del_flag`='0' AND `drugsheet`.`prescription_flag`='1' AND `drugsheet`.`billing_flag`='0' AND `drugsheet`.`patient_id`='".$patient_id."' AND `drugsheet`.`hospital_number`='".$uhid."' AND `drugsheet`.`purchased_flag`='1' ";
		}else{
			$sql="SELECT `item_master`.`asset_name`,`item_master`.`hsm_code`,`item_master`.`gst_rate`,`drugsheet`.`qty`,`drugsheet`.`id` AS `drug_order_id`,`drugsheet`.`chart_date`,`type_master`.`category_name`,(SELECT `category_name` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_cat`,(SELECT `sub_type_id` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_type_id`, `drugsheet`.`drug` AS `drug_unique_id`, `unit_master`.`unit_name` ,`drugsheet`.`prescription_flag`,`drugsheet`.`discharge_flag`,`item_master`.`cgst_rate`,`item_master`.`sgst_rate`,`item_master`.`id` AS `item_unique_id`,`item_master`.`size`,`item_master`.`color`,`item_master`.`covid_item` FROM `drugsheet` INNER JOIN `item_master` ON `item_master`.`id`=`drugsheet`.`drug` LEFT JOIN `type_master` ON `type_master`.`id`=`item_master`.`type_id` LEFT JOIN `unit_master` ON `unit_master`.`id`=`item_master`.`unit_id` WHERE `drugsheet`.`del_flag`='0'  AND `drugsheet`.`billing_flag`='0' AND `drugsheet`.`patient_id`='".$patient_id."' AND `drugsheet`.`hospital_number`='".$uhid."' AND `drugsheet`.`purchased_flag`='1' ";	
		}
		
		$from_which_sheet='All Sheet( Prescription Sheet + Discharge Sheet)';
		$select_option_val="";
		
		//$sql=($sql=="") ? $sql1 : $sql;  
		
		//echo $sql;
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			$select_option_val="";
			//$string = "123,456,78,000"; 
			$drug_arr=array($drug_order_id_arr);
		$str_arr = explode(',', $drug_order_id_arr) ;
		$length_arr= count($str_arr);
		for($i=0;$i<$length_arr;$i++){
			if($str_arr[$i]==$drug_order_id){
			$flag_order=1;
			}
		}
		
		if($row['prescription_flag']=='1'){
			$from_which_sheet='From Prescription Sheet Prescribed';
		}
		
		if($row['discharge_flag']=='1'){
			$from_which_sheet='From Discharge Sheet Prescribed';
		}
		 
		if($row['covid_item']=='1'){
			$covid_item_text="YES";
		}else{
			$covid_item_text="NO";
		}
		
		$select_option_val= $row['item_unique_id']."^".$row['hsm_code']."^".$row['size']."^".$row['color']."^".$covid_item_text."^".$row['gst_rate']."^".$row['cgst_rate']."^".$row['sgst_rate'];
		//print_r($str_arr);
		
				
		?>
			
			<tr <?php if($flag_order==1){ echo 'style="background-color:red !important;"' ;} ?>><td id="<?php echo $asset_name.$drug_order_id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_prescribe_date"><?php echo  date("d-m-Y", strtotime($chart_date)); ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_from_which_sheet"><b><?php echo $from_which_sheet; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_hsm_code"><?php echo $hsm_code; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_asset_name"><b><?php echo $asset_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_category_name"><?php echo $category_name; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_qty"><b><?php echo $qty.' '.$unit_name; ?></b></td><td><input id="<?php echo $asset_name.$drug_order_id ?>_tick" type="checkbox" value="0" <?php if($flag_order==1){ echo 'checked' ;} ?> onclick="add_indent_sale_pharma('<?php echo $drug_order_id ?>','<?php echo $sub_type_id ?>','<?php echo $drug_unique_id ?>','<?php echo mysqli_real_escape_string($conn,$asset_name); ?>','<?php echo $qty ?>','<?php echo $select_option_val ?>')" /><span> Tick</span></td></tr>
		<?php
			
		$sl++;
		}		
		
		//echo json_encode($arr);
	
	}
	function load_patient_types(){
	
		global $conn;
		
		 $sql="select * from `patient_type_master` ";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['name']);
		}		
		
		echo json_encode($arr);
	
	}
	
	function load_purchase_vendor_data_select(){		
		global $conn;		
		$id=$_POST['id'];
		$sql="SELECT `vendor_id` FROM `purchase_order` WHERE `id`='$id' ";				
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			echo json_encode(array("vendor_id"=>$vendor_id));
		}
	}
	
	function reset_temporary_save_sales_stock_set(){	
	
		global $conn;
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_stock=$_POST['temporary_stock'];
		if($temporary_stock!=''){
			$sql_customer_delete="DELETE FROM `temporary_customer_master` WHERE 1=1";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Customer Delete")));
			
			$sql_customer_delete="DELETE FROM `temporary_pharma_invoice` WHERE 1=1";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Sale Delete")));
			
			$sql_customer_delete="DELETE FROM `temporary_pharma_invoice_details`  WHERE 1=1 ";
			mysqli_query($conn,$sql_customer_delete) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Temporary Sale Details Delete")));			
			
		}		
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1"));
	

}
function item_wise_get_expire($item_id,$batch_code_1){
	

	global $conn;
	$_SESSION[$item_id]=array();
	//$_SESSION[$item_id][$batch_code_] = array();
	//$_SESSION[$item_id]=0;
	$batch_code_="";
	$batch_code_=(isset($_POST["batch_code"])) ? $_POST["batch_code"] : $batch_code_1;  	
	$_SESSION[$item_id][$batch_code_]=0;
	
	$item_id=(isset($_POST["item_id"])) ? $_POST["item_id"] : $item_id;
	$batch_code=($batch_code_!="undefined") ? " and purchase_details.batch_no='".$batch_code_."' " : "" ;
	
	$sql="select * from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' $batch_code and purchase.department_id='".$_SESSION['department_id']."' and status=1 group by item_id;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$pur_qty=mysqli_fetch_assoc($res);
	
	$expiry_date=$pur_qty['expiry_date'];
	$expiry_modify=date("d-m-Y", strtotime($expiry_date));
	
	 echo json_encode(array("expiry_date"=>$expiry_modify));
	

} 

function load_pharmacy_ipd_order_sell_medicine_data(){
	
		global $conn;
		$cust_check=$_POST['cust_check'];
		if($cust_check=='1'){
		$new_cust_ids=$_POST['new_cust_ids'];
		$cust_order=0;
			//$string = "123,456,78,000"; 
			$cust_arr=array($new_cust_ids);
			$str_arr_cust = explode(',', $new_cust_ids) ;
			$length_arr_cust= count($str_arr_cust);
			$first_id=$str_arr_cust[0];
			for($k=1;$k<($length_arr_cust-1);$k++){
				//echo $str_arr_cust[$k];
				if($str_arr_cust[$k]!=$first_id){
				$cust_order=1;
				}
			}
			echo json_encode(array("cust_order"=>$cust_order));
			
		}else{
		$patient_id=$_POST['patient_id'];
		$uhid=$_POST['uhid'];
		$drug_order_id_arr=$_POST['drug_order_id_arr'];
		$order_id_val="";
		if(isset($_POST['order_id_val'])){
		 $order_id_val=$_POST['order_id_val'];
		}
		$walk_in_patient_flag=$_POST['walk_in_patient_flag'];
		$sql="";	
		if($walk_in_patient_flag==1){
		 $sql="SELECT `item_master`.`asset_name`,`item_master`.`hsm_code`,`item_master`.`gst_rate`,`pharma_invoice_details`.`qty`,`pharma_invoice_details`.`id` AS `drug_order_id`,`type_master`.`category_name`,(SELECT `category_name` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_cat`,(SELECT `sub_type_id` FROM 	`type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_type_id`, `pharma_invoice_details`.`item_id` AS `drug_unique_id`, `unit_master`.`unit_name` , `pharma_invoice_details`.`batch_no`,`pharma_invoice_details`.`date` AS `prescribed_date`,`customer_master`.`vendor_name`,`customer_master`.`phone`,`customer_master`.`id` AS `cust_unique_id` FROM `pharma_invoice` INNER JOIN `pharma_invoice_details` ON `pharma_invoice`.`id`=`pharma_invoice_details`.`sales_id`  INNER JOIN `item_master` ON `item_master`.`id`=`pharma_invoice_details`.`item_id` LEFT JOIN `type_master` ON `type_master`.`id`=`item_master`.`type_id` LEFT JOIN `unit_master` ON `unit_master`.`id`=`item_master`.`unit_id` INNER JOIN `customer_master` ON `pharma_invoice`.`customer_id`=`customer_master`.`id` WHERE  `pharma_invoice`.`uhid`='' ";
		 
		}else{
			$sql="SELECT `item_master`.`asset_name`,`item_master`.`hsm_code`,`item_master`.`gst_rate`,`pharma_invoice_details`.`qty`,`pharma_invoice_details`.`id` AS `drug_order_id`,`type_master`.`category_name`,(SELECT `category_name` FROM `type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_cat`,(SELECT `sub_type_id` FROM 	`type_master` WHERE `type_master`.`id`=`item_master`.`sub_type_id`) AS `sub_type_id`, `pharma_invoice_details`.`item_id` AS `drug_unique_id`, `unit_master`.`unit_name` , `pharma_invoice_details`.`batch_no`,`pharma_invoice_details`.`date` AS `prescribed_date`,`customer_master`.`vendor_name`,`customer_master`.`phone`,`customer_master`.`id` AS `cust_unique_id` FROM `pharma_invoice` INNER JOIN `pharma_invoice_details` ON `pharma_invoice`.`id`=`pharma_invoice_details`.`sales_id`  INNER JOIN `item_master` ON `item_master`.`id`=`pharma_invoice_details`.`item_id` LEFT JOIN `type_master` ON `type_master`.`id`=`item_master`.`type_id` LEFT JOIN `unit_master` ON `unit_master`.`id`=`item_master`.`unit_id`  INNER JOIN `customer_master` ON `pharma_invoice`.`customer_id`=`customer_master`.`id` WHERE  `pharma_invoice`.`patient_id`='".$patient_id."' AND `pharma_invoice`.`uhid`='".$uhid."'";
		}
		
		
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		$new_cust_ids=$_POST['new_cust_ids'];
		$cust_order=0;
			//$string = "123,456,78,000"; 
			$cust_arr=array($new_cust_ids);
			$str_arr_cust = explode(',', $new_cust_ids) ;
			$length_arr_cust= count($str_arr_cust);
			$first_id=$str_arr_cust[0];
			for($k=1;$k<($length_arr_cust-1);$k++){
				//echo $str_arr_cust[$k];
				if($str_arr_cust[$k]!=$first_id){
				$cust_order=1;
				}
			}
			//echo $cust_order;
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			//$string = "123,456,78,000"; 
			$drug_arr=array($drug_order_id_arr);
			$str_arr = explode(',', $drug_order_id_arr) ;
			$length_arr= count($str_arr);
			for($i=0;$i<$length_arr;$i++){
				if($str_arr[$i]==$drug_order_id){
				$flag_order=1;
				}
			}
			
			if($walk_in_patient_flag==1){
		//print_r($str_arr);		
		$sql_retn="SELECT SUM(`qty`) AS `return_qty` FROM `pharma_invoice_details_return`  WHERE `item_id`='".$drug_unique_id."' AND `batch_no`='".$batch_no."' AND `pharma_invoice_dtls_id`='".$drug_order_id."' AND `status`='1' ";
	$res_retn=mysqli_query($conn,$sql_retn) or die(mysqli_error($conn));
	$pur_qty_retn=mysqli_fetch_assoc($res_retn);	
	$return_qty=0;
	if($pur_qty_retn['return_qty']!=''){
		$return_qty=$pur_qty_retn['return_qty'];
	}
		?>
			
			<tr <?php if($flag_order==1){ echo 'style="background-color:red !important;"' ;} ?>><td id="<?php echo $asset_name.$drug_order_id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_prescribe_date"><?php echo  date("d-m-Y", strtotime($prescribed_date)); ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_customer_name"><?php echo $vendor_name; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_customer_phone"><?php echo $phone; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_hsm_code"><?php echo $hsm_code; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_asset_name"><b><?php echo $asset_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_batch_no"><b><?php echo $batch_no; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_category_name"><?php echo $category_name; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_purchase_qty"><b><?php echo $qty.' '.$unit_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_return_qty"><b><?php echo $return_qty.' '.$unit_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_qty"><b><?php echo ($qty-$return_qty).' '.$unit_name; ?></b></td><td><input id="<?php echo 'item_'.$qty.'_'.$drug_order_id ?>_tick" type="checkbox" value="0" <?php if($flag_order==1){ echo 'checked' ;} ?> onclick="add_indent_sale_pharma_return('<?php echo $drug_order_id; ?>','<?php echo $sub_type_id; ?>','<?php echo $drug_unique_id; ?>','<?php echo mysqli_real_escape_string($conn,$asset_name); ?>','<?php echo ($qty-$return_qty); ?>','<?php echo $batch_no; ?>','<?php echo $cust_unique_id; ?>','<?php echo $vendor_name; ?>','<?php echo $phone; ?>')" /><span> Tick</span></td></tr>
            <?php }else{
				//print_r($str_arr);		
		$sql_retn="SELECT SUM(`qty`) AS `return_qty` FROM `pharma_invoice_details_return`  WHERE `item_id`='".$drug_unique_id."' AND `batch_no`='".$batch_no."' AND `pharma_invoice_dtls_id`='".$drug_order_id."' AND `status`='1' ";
	$res_retn=mysqli_query($conn,$sql_retn) or die(mysqli_error($conn));
	$pur_qty_retn=mysqli_fetch_assoc($res_retn);	
	$return_qty=0;
	if($pur_qty_retn['return_qty']!=''){
		$return_qty=$pur_qty_retn['return_qty'];
	}
					?>
            <tr <?php if($flag_order==1){ echo 'style="background-color:red !important;"' ;} ?>><td id="<?php echo $asset_name.$drug_order_id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_prescribe_date"><?php echo  date("d-m-Y", strtotime($prescribed_date)); ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_hsm_code"><?php echo $hsm_code; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_asset_name"><b><?php echo $asset_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_batch_no"><b><?php echo $batch_no; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_category_name"><?php echo $category_name; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_sub_cat"><?php echo $sub_cat; ?></td><td id="<?php echo $asset_name.$drug_order_id ?>_purchase_qty"><b><?php echo $qty.' '.$unit_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_return_qty"><b><?php echo $return_qty.' '.$unit_name; ?></b></td><td id="<?php echo $asset_name.$drug_order_id ?>_qty"><b><?php echo ($qty-$return_qty).' '.$unit_name; ?></b></td><td><input id="<?php echo 'item_'.$qty.'_'.$drug_order_id ?>_tick" type="checkbox" value="0" <?php if($flag_order==1){ echo 'checked' ;} ?> onclick="add_indent_sale_pharma_return('<?php echo $drug_order_id ?>','<?php echo $sub_type_id ?>','<?php echo $drug_unique_id ?>','<?php echo mysqli_real_escape_string($conn,$asset_name); ?>','<?php echo ($qty-$return_qty); ?>','<?php echo $batch_no ?>','<?php echo $cust_unique_id; ?>','<?php echo $vendor_name; ?>','<?php echo $phone; ?>')" /><span> Tick</span></td></tr>
            <?php }	?>
		<?php
			
		$sl++;
		}		
		
		//echo json_encode($arr);
		}
	
	}
	
	function save_sales_invoice_return(){	
	
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
		$total_cgst_amount=mysqli_real_escape_string($conn,$_POST['total_cgst_amount']);
		$total_sgst_amount=mysqli_real_escape_string($conn,$_POST['total_sgst_amount']);
		$total_gst_amount=$total_cgst_amount+$total_sgst_amount;
		if($_REQUEST['inv_date']==''){
		$inv_date='NULL';
		}else{
			$inv_date= "'".date("Y-m-d", strtotime($_POST['inv_date']))."'";
		}
		$customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
		$phone_number=mysqli_real_escape_string($conn,$_POST['phone_number']);
		$cash=mysqli_real_escape_string($conn,$_POST['cash']);
		$card=mysqli_real_escape_string($conn,$_POST['card']);
		$upi=mysqli_real_escape_string($conn,$_POST['upi']);
		$doctor=mysqli_real_escape_string($conn,$_POST['doctor']);
		$uhid=mysqli_real_escape_string($conn,$_POST['uhid']);
		
		$net_total=mysqli_real_escape_string($conn,$_POST['net_total']);
		$discount_type=mysqli_real_escape_string($conn,$_POST['discount_type']);
		$discount_val=mysqli_real_escape_string($conn,$_POST['discount_val']);
		$discount_total=mysqli_real_escape_string($conn,$_POST['discount_total']);
		$round_off_total=mysqli_real_escape_string($conn,$_POST['round_off_total']);
		$grand_total=mysqli_real_escape_string($conn,$_POST['grand_total']);
		$due_bill=mysqli_real_escape_string($conn,$_POST['due_bill']);
		$status=1;
		if($due_bill=='1'){
			$status=2;
		}
		$patient_id=mysqli_real_escape_string($conn,$_POST['patient_id']);
		$medicine_return_flag=0;
		if(isset($_POST['medicine_return_flag'])){
			$medicine_return_flag=mysqli_real_escape_string($conn,$_POST['medicine_return_flag']);	
		}
		
		
		$created_by=$_SESSION['id'];
		$created_on=date('Y-m-d H:i:s');
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);
		
		$temporary_customer_id=$_POST['temporary_customer_id'];
		$temporary_sales_id=$_POST['temporary_sales_id'];
		$delete_flag_no=temporary_delete_sales_number($temporary_customer_id,$temporary_sales_id);
		
		
		$sql_customer="INSERT INTO `customer_master_return` SET `vendor_name`='".$customer_name."',`phone`='".$phone_number."',`uhid`='".$uhid."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		mysqli_query($conn,$sql_customer) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Customer insert")));
		
		$customer_id=mysqli_insert_id($conn);		
	
		$sales_no=get_sales_number_return();
					
		$sql="INSERT INTO `pharma_invoice_return` SET `order_number`='".$sales_no."',`user_id`='".$user_id."',`customer_id`='".$customer_id."',`uhid`='".$uhid."',`customer_name`='".$customer_name."',`doctor_name`='".$doctor."',`gst_amount`='".$total_gst_amount."',`cgst_amount`='".$total_cgst_amount."',`sgst_amount`='".$total_sgst_amount."',`amount`='".$net_total."',`discount_type`='".$discount_type."',`discount_val`='".$discount_val."',`discount_total`='".$discount_total."',`round_off_total`='".$round_off_total."',`grand_total`='".$grand_total."',`status`='".$status."',`patient_id`='".$patient_id."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		$return_details_id="";
		
		foreach($asset_id as $key => $val){
			
			$qty_sum=$qty_sum+$qty[$key];
						
			$sql="INSERT INTO `pharma_invoice_details_return` SET `sales_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`department_name`='".$department_name[$key]."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`rate`='".$rate[$key]."',`disc_rate`='".$disc_rate[$key]."',`disc_amount`='".$disc_amount[$key]."',`gst_rate`='".$gst_rate[$key]."',`gst_amount`='".$gst_amount[$key]."',`cgst_rate`='".$cgst_rate[$key]."',`cgst_amount`='".$cgst_amount[$key]."',`sgst_rate`='".$sgst_rate[$key]."',`sgst_amount`='".$sgst_amount[$key]."',`total`='".$total_amount[$key]."',`status`='".$status."',`inv_date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."P Details insert")));
			
			//$indent_key=$purchase_order_id[$key];
			$return_details_unique_id=mysqli_insert_id($conn);	
			//$return_details_id=$return_details_id.",".$return_details_unique_id;
			if($return_details_id==""){
				$return_details_id=$return_details_unique_id;
			}else{
				$return_details_id=$return_details_id.",".$return_details_unique_id;
			}
		
		
		}
		
		if(($cash!="")&&($cash!="0")){			
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='cash',`amount`='".$cash."',`medicine_return_flag`='".$medicine_return_flag."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		if(($card!="")&&($card!="0")){		
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='card',`amount`='".$card."',`medicine_return_flag`='".$medicine_return_flag."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}		
		if(($upi!="")&&($upi!="0")){	
			$sql_mode="INSERT INTO `payment_mode` SET `pharma_invoice_id`='".$sales_id."',`mode`='upi',`amount`='".$upi."',`medicine_return_flag`='".$medicine_return_flag."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."MODE insert")));
		}
		
		
		$drug_order_id_arr=$_POST['drug_order_id_arr'];
		//echo $return_details_id;
		
		$drug_arr=array($drug_order_id_arr);
		$str_arr = explode(',', $drug_order_id_arr) ;
		$return_details_id_arr=$return_details_id;
		$return_details_id_str_arr = explode(',', $return_details_id_arr) ;
		//print_r($str_arr);
		//print_r($return_details_id_str_arr);
		$length_arr= count($str_arr);
		for($i=0;$i<$length_arr;$i++){			
			$sql_mode="UPDATE `pharma_invoice_details_return` SET `pharma_invoice_dtls_id`='".$str_arr[$i]."' WHERE `id`='".$return_details_id_str_arr[$i]."'";
			mysqli_query($conn,$sql_mode) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Bill Done")));
		}
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		
		echo json_encode(array("flag"=>"1","s_id"=>$sales_id));
	

}
function load_sales_invoice_return(){
		
		global $conn;
		$inside_flag=$_POST['inside_flag'];
		$bill_pay_type="";
		if($inside_flag=='1'){
			$sql="select * from `pharma_invoice_return` WHERE `uhid`<>'' ORDER BY `id` DESC ";
		}else{
			$sql="select * from `pharma_invoice_return` WHERE `uhid`='' ORDER BY `id` DESC ";
		}
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		$count_rows=$res->num_rows;
		if($count_rows>0){
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			if($status=='1'){
				$bill_pay_type="Cash Patient";
			}else{
				$bill_pay_type="Credit Patient";
			}
		?>	
			<tr><td id="<?php echo $id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $id ?>_asset"><a href="sales_invoice_print_return.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $order_number; ?></a><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php //echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_uhid" style="text-transform: uppercase;"><?php echo $uhid; ?></td><td id="<?php echo $id ?>_doctor_name"><?php echo $doctor_name; ?></td><td id="<?php echo $id ?>_mode"><?php echo $bill_pay_type; ?></td><td id="<?php echo $id ?>_size"><?php echo $customer_name; ?></td><td id="<?php echo $id ?>_amount"><?php echo $grand_total; ?></td><td id="<?php echo $id ?>_sl_no"><a href="<?php echo ADMIN_URL; ?>sales_invoice_print_return.php?inv_id=<?php echo $id ?>" target="_blank" title="Print Bill" > <img src="<?php echo ADMIN_URL; ?>icon/printButton.png" title="Print Bill"></a></td></tr>
		
		<?php
		$sl++;
		}
		}else{
			?>
		<!--<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>-->
        
        <?php 	
		}
	
	}

function load_indents_purchase_order(){
	
		global $conn;
		
		//$dept=(isset($_POST['department_id'])) ? " and indent.department='".$_POST['department_id']."' " : "";  
		
		$sql="SELECT indent.*,department_master.department_name FROM `indent` left join department_master on department_master.id=indent.department where indent.status<>0 ORDER BY indent.id DESC";
		
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_assoc($res)){
		
			$arr[]=array("id"=>$row["id"],"department"=>$row["department_name"],"date"=>date("d/m/Y",strtotime($row["date"])));
		}
		
		echo json_encode($arr);
	
	}
	function delete_asset_inednts_new(){
	
	global $conn;
	$indent_id=$_POST['indent_id'];
	
	//$status=mysqli_escape_string($con,$_POST['status']);
	
	$tans_sql="SET autocommit = 0;";
	mysqli_query($conn,$tans_sql);
  
	$tans_sql="START TRANSACTION;";
	mysqli_query($conn,$tans_sql);
	
	$sql="delete from `indent` where id='$indent_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$sql="delete from indent_details where indent_id='$indent_id'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>0)));
	
	$tans_sql="COMMIT;";
	mysqli_query($conn,$tans_sql);
	
	echo json_encode(array("flag"=>"1"));

}
/*STOCK REPOART*/ 
function full_stock_report(){

	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	global $conn;
	
	
	global $opening_stock_;
	global $purchase_;
	global $sale_;
	global $stock_transfer_in_;
	global $stock_transfer_out_;
	global $consumables_;
	global $arr_;
	global $closing_stock_;
	global $purchase_return_;
	global $sale_return_new_;
	//global $damaged_items_;
	global $temporary_pharma_sale_qty_out_;
	global $expired_dameged_items_qty_;
	
	$from_=(isset($_POST['from_']) and $_POST['from_']!="" ) ? date("Y-m-d",strtotime($_POST['from_'])) : "";
	$to_=(isset($_POST['to_']) and $_POST['to_']!="") ? date("Y-m-d",strtotime($_POST['to_'])) : ""; 
	
	$filter="";
	
	if($from_=="" || $to_==""){
		$date_filter_item="";	
	}else{
		$date_filter_item=" and (date(item_master.created) BETWEEN '$from_' and '$to_')  ";
	}
	
	$sql="select * from item_master where status=1 $date_filter_item  order by asset_name ";

	$res=mysqli_query($conn,$sql);
	$slno=1;
	$total_val=0;
	$table_body="";
	while($row=mysqli_fetch_assoc($res)){
		if(load_batch_code_($row['id'],$from_,$to_)){
		foreach($arr_ as $key => $val){
			if(item_wise_stock_calculation_($row['id'],$val['value'],$from_,$to_)){
			}
				
		$gst_amount=$val['rate']*($val['gst_rate']/100);
		$rate_=$val['rate']+((isset($val['gst_rate'])) ?  $gst_amount : 0); //Adding tax amount
		$margin=$val['mrp']-$rate_;
		//echo "\nRate:".$val['rate']."\n";
		$rate=($val['rate']!="" && $val['rate']!=0) ? $rate_ : 1;
		$tmp=$margin/$rate;
		$perc=round($tmp*100,2);
		$total_val=($total_val)+($closing_stock_*$rate);
		
		$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >".$val['value']."</td><td >".$opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td >".$stock_transfer_in_."</td><td>".$sale_return_new_."</td><td >".$stock_transfer_out_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$purchase_return_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$val['mrp']."</td><td>".$perc."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		}
		}else{
		
		item_wise_stock_calculation_($row['id'],'',$from_,$to_);
		
		$rate=0;
		
		$sql_="select rate,mrp,purchase_details.gst_rate from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='".$row['id']."' and purchase.department_id='".$_SESSION['department_id']."' order by purchase_details.expiry_date";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$mrp_=$row_['mrp'];
		$rate_including_gst=$row_['rate']+($row_['rate']*($row_['gst_rate']/100));
		$rate=($row_['rate']!="" && $row_['rate']!=0) ? $rate_including_gst : 1;
		
		$sql_="select batch_no,rate from stock_transfer_details inner join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id where item_id='".$row['id']."' and stock_transfer.to_department_id='".$_SESSION['department_id']."' group by batch_no order by stock_transfer_details.expiry_date";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$rate=($row_['rate']!="" && $row_['rate']!=0) ? $row_['rate'] : $rate;
		
		$sql_="select batch,qty,mrp from opening_stock where item_id='".$row['id']."' and status=0 order by expiry";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$rate=($row_['mrp']!="" && $row_['rate']!=0) ? $row_['mrp'] : $rate;
		
		$total_val=($total_val)+($closing_stock_*$rate);		
		$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >-</td><td >". $opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td >".$stock_transfer_in_."</td><td>".$sale_return_new_."</td><td >".$stock_transfer_out_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$purchase_return_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$mrp_."</td><td>".((($mrp_-$rate)/$rate)*100)."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		
			
		}
		
		$slno++;
		
		$arr_=array();
		
	}
	
	echo json_encode(array("table_body"=>$table_body,"total_val"=> round($total_val,2)));

}

function load_batch_code_($item_id="",$from_="",$to_=""){	

	global $conn;
	global $arr_;
	
	$log_="";
	$batch_="";
	$date_filter_purchase="";
	$date_filter_transfer="";
	$query_log="";
	
	if($from_=="" || $to_==""){
		$date_filter="";	
	}else{
	
		$date_filter_purchase=" and (date(purchase.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_transfer=" and (date(stock_transfer.date) BETWEEN '$from_' and '$to_')  ";
	
	}
	
	$item_id=(!isset($_POST['item_id'])) ? $item_id : $_POST['item_id'] ;
	$sql="select batch_no,rate,mrp,purchase_details.gst_rate from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' and purchase.department_id='".$_SESSION['department_id']."' $date_filter_purchase group by batch_no order by purchase_details.expiry_date";
	$query_log.="\n".$sql;
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		if(trim($row['batch_no'])!=""){
			//$batch_code_=item_wise_stock_calculation($item_id,$row['batch_no']);
			//echo "Batch No ".$row['batch_no'].":".$batch_code_; 
			$log_.="\nvalue Purchase=>".$row['batch_no']." text=>".$row['batch_no']." rate=>".$row['rate'];
			//if($batch_code_>0) 
			$arr_[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no'],"rate"=>$row['rate'],"mrp"=>$row['mrp'],"gst_rate"=>$row['gst_rate']);
			$batch_=$row['batch'];
		}//else $arr_[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no'],"rate"=>$row['rate']);
	}
	$batch_code_=0;
	$sql="select batch_no,rate,mrp from stock_transfer_details inner join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id where item_id='$item_id' and stock_transfer.to_department_id='".$_SESSION['department_id']."' $date_filter_transfer group by batch_no order by stock_transfer_details.expiry_date";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		if(trim($row['batch_no'])!=""){		
		
			if(multi_array_search($row['batch_no'],$arr_)<0){
				$log_.="\nvalue=>".$row['batch_no']." text=>".$row['batch_no']." rate=>".$row['rate']." mrp=>".$row['mrp'];
				
				$arr_[]=array("value"=>$row['batch_no'],"text"=>$row['batch_no'],"rate"=>$row['rate'],"mrp"=>$row['mrp']);
			}
		}
	}
	$batch_code_=0;
	$sql="select batch,qty,mrp from opening_stock where item_id='$item_id' and status=0 order by expiry";
	$res=mysqli_query($conn,$sql)or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		if(trim($row['batch'])!=""){
			
			if(multi_array_search($row['batch'],$arr_)<0){
			 $log_.="\nvalue OP St=>".$row['batch_no']." text=>".$row['batch_no']." rate=>".$row['rate'];
			 if(!$key) $arr_[]=array("value"=>$row['batch'],"text"=>$row['batch'],"rate"=>$row['mrp']);
			}
		}
	}
	

	$fp=fopen("batch_wise_query_batch_load.txt",'a');
	fwrite($fp,$query_log);
	fclose($fp);
	
	if(isset($arr_)){
		$fl=0;
		foreach( $arr_ as $key => $val){
			//echo "\nVal:".$val["value"];
			if(!is_null($val["value"]) && $val["value"]!="null" )	$fl=1;
		}
		if($fl==1){
			
			return true;
		}else{
			
			 return false;
		 }
	}
	else{
	
	}

}

function item_wise_stock_calculation_($item_id,$batch_code_1,$from_="",$to_=""){

	global $conn;
	global $opening_stock_;
	global $purchase_;
	global $sale_;
	global $stock_transfer_in_;
	global $stock_transfer_out_;
	global $consumables_;
	//global $arr_;
	global $closing_stock_;
	global $purchase_return_;
	global $damaged_items_;
	global $sale_return_new_;
	global $temporary_pharma_sale_qty_out_;
 	global $expired_dameged_items_qty_;
	//$_SESSION[$item_id]=0;
	$batch_code_="";
	$batch_code_=(isset($_POST["batch_code"])) ? $_POST["batch_code"] : $batch_code_1;  
	//$_SESSION[$item_id][$batch_code_]=0;
	$item_id=(isset($_POST["item_id"])) ? $_POST["item_id"] : $item_id;
	
	if($from_=="" || $to_==""){
		$date_filter="";
		$date_filter_sales="";
		$date_filter_transfer="";
		$date_filter_consumables="";
		//$date_filter_returns="";
		$date_filter_sales_returns_new="";	
		$date_filter_temporary_pharma_invoice="";
	}else{
		$date_filter_purchase=" and (DATE(purchase.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_sales=" and (DATE(pharma_invoice_details.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_transfer=" and (DATE(stock_transfer.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_consumables=" and (DATE(consumables.date) BETWEEN '$from_' and '$to_')  ";
		//$date_filter_returns=" and (DATE(purchase_return.date)>='$from_' and DATE(purchase_return.date)<='$to_')  ";
		$date_filter_sales_returns_new=" and (DATE(`pharma_invoice_details_return`.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_temporary_pharma_invoice=" and (DATE(temporary_pharma_invoice_details.date) BETWEEN '$from_' and '$to_')  ";
		$date_filter_expired_dameged_items=" and (DATE(expired_dameged_items.date) BETWEEN '$from_' and '$to_')  ";
		
	
	}	
	
	$batch_code4=($batch_code_!="undefined" && $batch_code_!="" ) ? " and opening_stock.batch='".$batch_code_."' " : "" ;
	$batch_code=($batch_code_!="undefined" && $batch_code_!="" ) ? " and purchase_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code1=($batch_code_!="undefined" && $batch_code_!="") ? " and pharma_invoice_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code2=($batch_code_!="undefined" && $batch_code_!="") ? " and stock_transfer_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code3=($batch_code_!="undefined" && $batch_code_!="") ? " and consumables_details.batch_no='".$batch_code_."' " : "" ;
	//$batch_code5=($batch_code_!="undefined" && $batch_code_!="") ? " and purchase_return_details.batch_no='".$batch_code_."' " : "" ;
	//$batch_code6=($batch_code_!="undefined" && $batch_code_!="") ? " and damaged_items.batch_no='".$batch_code_."' " : "" ;
	//$batch_code7=($batch_code_!="undefined" && $batch_code_!="") ? " and `sales_return_details`.batch_no='".$batch_code_."' " : "" ;
	$batch_code8=($batch_code_!="undefined" && $batch_code_!="" ) ? " and temporary_pharma_invoice_details.batch_no='".$batch_code_."' " : "" ;
	$batch_code9=($batch_code_!="undefined" && $batch_code_!="" ) ? " and pharma_invoice_details_return.batch_no='".$batch_code_."' " : "" ;
	$batch_code10=($batch_code_!="undefined" && $batch_code_!="" ) ? " and expired_dameged_items_details.batch_no='".$batch_code_."' " : "" ;
	
	
	$pur_qty="";
	$op_qty="";
	$pharma_sale_qty="";
	$stock_transfer_qty="";
	$stock_transfer_qty_in="";
	$purchase_return="";
	$sale_return_new="";
	$damaged_items="";
	$query_log="";
	$temporary_pharma_sale_qty_out="";
	
	/*//$sql="select sum(qty) as qty from opening_stock where item_id='$item_id' and status=0 and dept_id='".$_SESSION['department_id']."' $batch_code4 group by item_id;";
	$sql="select sum(qty) as qty from opening_stock where item_id='$item_id' and status=0 $batch_code4 group by item_id;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
	$op_qty=mysqli_fetch_assoc($res);
	*/
	//$sql="select sum(qty) as qty from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' $batch_code and purchase.department_id='".$_SESSION['department_id']."' and purchase_details.status=1 group by item_id;";
	//if($_SESSION['department_id']=="3" || $_SESSION['department_id']=="8"){
		
		 $sql="select sum(qty) as qty from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' $batch_code and purchase_details.status=1 AND  purchase.opening_stock_flag='1' $date_filter_purchase group by item_id;";
		$query_log.="\n".$sql;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$op_qty=mysqli_fetch_assoc($res);
		

		$sql="select sum(qty) as qty from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' $batch_code and purchase_details.status=1 AND  purchase.opening_stock_flag='0' $date_filter_purchase group by item_id;";
		$query_log.="\n".$sql;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$pur_qty=mysqli_fetch_assoc($res);
	
	//}
	
	
	//if($_SESSION['department_id']=="8" || $_SESSION['department_id']=="3"){
	
		$sql="select sum(qty) as qty from pharma_invoice_details where item_id='$item_id' $batch_code1 and (status=1 OR status=2) $date_filter_sales group by item_id;";
		$query_log.="\n".$sql;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$pharma_sale_qty=mysqli_fetch_assoc($res); 
		
	
	//}
	
	//if($_SESSION['department_id']!=""){
		
		//$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and from_department_id='".$_SESSION['department_id']."' group by item_id;";
		$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and  from_department_id='".$_SESSION['department_id']."' and to_department_id<>'0' and to_department_id<>'".$_SESSION['department_id']."' and stock_transfer.status=1 $date_filter_transfer group by item_id;";
		$query_log.="\n".$sql;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$stock_transfer_qty=mysqli_fetch_assoc($res);
		
		/*$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and to_department_id='".$_SESSION['department_id']."' group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$stock_transfer_qty_in=mysqli_fetch_assoc($res);*/
		
		
			$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and to_department_id='8' $date_filter_transfer group by item_id;";
		
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$stock_transfer_qty_in=mysqli_fetch_assoc($res);
		//$stock_transfer_qty_in=0;
	
	//}
	
	//if($_SESSION['department_id']!=""){
	
		$sql="select sum(qty) as qty from consumables_details left join consumables on consumables.id=consumables_details.consumables_id  where item_id='$item_id' $batch_code3 and consumables.status=1 and consumables.department_id='".$_SESSION['department_id']."' $date_filter_consumables group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$consumables_qty=mysqli_fetch_assoc($res);
	
	//}
	
		$sql="select sum(qty) as qty from expired_dameged_items_details left join expired_dameged_items on expired_dameged_items.id=expired_dameged_items_details.expired_dameged_items_id  where item_id='$item_id' $batch_code10 and expired_dameged_items.status=1 and expired_dameged_items.department_id='".$_SESSION['department_id']."' $date_filter_expired_dameged_items group by item_id;";
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$expired_dameged_items_qty=mysqli_fetch_assoc($res);
//*****************************************************Purchase Returns************************************************************
		
	
//*****************************************************End Purchase Returns************************************************************	

//*****************************************************Sales Returns************************************************************
	$sql="select sum(qty) as qty from pharma_invoice_details_return where item_id='$item_id' $batch_code9 and (status=1 OR status=2)  $date_filter_sales_returns_new group by item_id;";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$sale_return_new=mysqli_fetch_assoc($res); //Sale Return stock
	

//*****************************************************End Sales Returns************************************************************	

//*******************************************************Temporary stock***************************************************	
	$sql="select sum(qty) as qty from temporary_pharma_invoice_details where item_id='$item_id' $batch_code8 and (status=1 OR status=2) $date_filter_temporary_pharma_invoice group by item_id;";
	$query_log.="\n".$sql;
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
	$temporary_pharma_sale_qty_out=mysqli_fetch_assoc($res);
	
	//echo '****'.$temporary_pharma_sale_qty_in['qty'].'***';
	
//*******************************************************END Temporary stock************************************************
	
	$fp=fopen("batch_wise_query.txt",'a');
	fwrite($fp,$query_log);
	fclose($fp);
	
	$opening_stock_=0;
	$purchase_=0;
	$sale_=0;
	$stock_transfer_in_=0;
	$stock_transfer_out_=0;
	$consumables_=0;
	$closing_stock_=0;
	$purchase_return_=0;
	$sale_return_new_=0;
	//$damaged_items_=0;
	$temporary_pharma_sale_qty_out_=0;
	$expired_dameged_items_qty_=0;
	
	/*$closing_stock=($op_qty['qty']+$pur_qty['qty']+$stock_transfer_qty_in['qty']+$sale_return['qty'])-($pharma_sale_qty['qty']+$stock_transfer_qty['qty']+$consumables_qty['qty']+$purchase_return['qty']);*/	
	
	$closing_stock=($op_qty['qty']+$pur_qty['qty']+$stock_transfer_qty_in['qty']+$sale_return_new['qty'])-($pharma_sale_qty['qty']+$stock_transfer_qty['qty']+$consumables_qty['qty']+$temporary_pharma_sale_qty_out['qty']+$expired_dameged_items_qty['qty']);
	 
	//$opening_stock_=$op_qty['qty'];
	$opening_stock_=$op_qty['qty'];
	$purchase_=$pur_qty['qty'];
	$sale_=$pharma_sale_qty['qty'];
	$stock_transfer_in_=$stock_transfer_qty_in['qty'];
	$stock_transfer_out_=$stock_transfer_qty['qty'];
	$consumables_=$consumables_qty['qty'];
	//$purchase_return_=$purchase_return['qty'];
	$purchase_return_=0;
	$sale_return_new_=$sale_return_new['qty'];
	//$sale_return_=0;
	//$damaged_items_=$damaged_items['qty'];
	//$damaged_items_=0;
	$closing_stock_=$closing_stock;
	$temporary_pharma_sale_qty_out_=$temporary_pharma_sale_qty_out['qty'];
	$expired_dameged_items_qty_=$expired_dameged_items_qty['qty'];
	//$_SESSION[$item_id]=$closing_stock;
	//$_SESSION[$item_id][$batch_code_]=$closing_stock;
	
	return;

} 

function multi_array_search($id,$array){

  foreach ($array as $key => $val) {
  	//echo "Value::".$val['value']."-ID:".$id
       if ($val['value'] == $id) {
	   	   return $key;
       }
   }
   return -1;


}

function load_consum_details(){
	
		
		
		global $conn;
		
		$sql="SELECT `consumables`.*,`department_master`.`department_name` FROM `consumables` LEFT JOIN `department_master` ON `department_master`.`id`=`consumables`.`department_id` ORDER BY `consumables`.`id` DESC ";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl_no=1;
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
		?>
		
			<tr><td><?php echo $sl_no ?></td><td id="<?php echo $id ?>_asset"><a href="stock_transfer_print_new.php?inv_id=<?php echo $id ?>" target="_blank" ><?php echo $transfer_number; ?></a><input type="hidden" id="<?php echo $id ?>_vendor" value="<?php //echo $vendor_id ?>"  /></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td id="<?php echo $id ?>_size"><a href="<?php echo ADMIN_URL; ?>stock_transfer_print_new.php?inv_id=<?php echo $id ?>" target="_blank" title="Print Bill" > <img src="<?php echo ADMIN_URL; ?>icon/printButton.png" title="Print Bill"></a> </td></tr>
		
		<?php
		$sl_no++;
		}
	
	
	
	}
function total_stock_once($item_id){
	//$item_id=$_POST["item_id"];
	global $conn;
$closing_stock=0;

$pur_qty=0;
$op_qty=0;
$stock_transfer_qty=0;
$stock_transfer_qty_in=0;


$sql="select sum(qty) as qty from opening_stock where item_id='$item_id' and status=0  group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$op_qty=mysqli_fetch_assoc($res); //Opening stock

$sql="select sum(qty) as qty from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='$item_id' and status=1 group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$pur_qty=mysqli_fetch_assoc($res); //purchase stock

$pharma_sale_qty=0;	
$temporary_pharma_sale_qty=0;
$pharma_sale_qty_return=0;

$sql="select sum(qty) as qty from pharma_invoice_details where item_id='$item_id'  and (status=1 OR status=2) group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$pharma_sale_qty=mysqli_fetch_assoc($res); //Sale stock

$sql="select sum(qty) as qty from temporary_pharma_invoice_details where item_id='$item_id'  and (status=1 OR status=2) group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$temporary_pharma_sale_qty=mysqli_fetch_assoc($res); //Temporary stock

$sql="select sum(qty) as qty from pharma_invoice_details_return where item_id='$item_id'  and (status=1 OR status=2) group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$pharma_sale_qty_return=mysqli_fetch_assoc($res); //Sale Return stock

$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id'  and stock_transfer.status=1 and from_department_id='8' group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$stock_transfer_qty=mysqli_fetch_assoc($res); //Transfer Out stock
	
$sql="select sum(qty) as qty from stock_transfer_details left join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id  where item_id='$item_id' $batch_code2 and stock_transfer.status=1 and to_department_id='8' group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$stock_transfer_qty_in=mysqli_fetch_assoc($res);  //Transfering In stock


$sql="select sum(qty) as qty from consumables_details left join consumables on consumables.id=consumables_details.consumables_id  where item_id='$item_id' and consumables.status=1 and consumables.department_id='8' group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$consumables_qty=mysqli_fetch_assoc($res); //Consumabe stock

$sql="select sum(qty) as qty from expired_dameged_items_details left join expired_dameged_items on expired_dameged_items.id=expired_dameged_items_details.expired_dameged_items_id  where item_id='$item_id' and expired_dameged_items.status=1 and expired_dameged_items.department_id='8' group by item_id;";
$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$expired_dameged_items_qty=mysqli_fetch_assoc($res); //Consumabe stock


$closing_stock=($op_qty['qty']+$pur_qty['qty']+$stock_transfer_qty_in['qty']+$pharma_sale_qty_return['qty'])-($pharma_sale_qty['qty']+$stock_transfer_qty['qty']+$consumables_qty['qty']+$temporary_pharma_sale_qty['qty']+$expired_dameged_items_qty['qty']);

return $closing_stock;
}	
function closing_stock_with_reorder_level(){
	global $conn;
	
	$re_order_level=$_POST['re_order_level'];
	if($re_order_level==''){
	$sql="select * from item_master where `asset_name`<>'' order by id desc";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		
		$sql_="select category_name,(select category_name from type_master where id='".$row['sub_type_id']."') as sub_cat from type_master where id='".$row['type_id']."'";
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		
		$sql_unit="select unit_name,id from unit_master where id='".$row['unit_id']."'";
		$res_unit=mysqli_query($conn,$sql_unit) or die(mysqli_error($conn));
		$row_unit=mysqli_fetch_assoc($res_unit);
		//extract($row_);
		$close_stock_val=total_stock_once($row['id']);
		$re_order_level=$row['moq'];
		$colour="";
		if($re_order_level>$close_stock_val){
			$colour="#f5c6cb";
		}
		?>
			<tr id="<?php echo $row['id']; ?>" style="background-color:<?php echo $colour; ?>"><td class="re_order_td"><?php echo $row['asset_name']; ?></td><td class="re_order_td"><?php echo $row_['category_name']; ?></td><td class="re_order_td"><?php echo $row_['sub_cat'];; ?></td><td class="re_order_td"> <?php echo $close_stock_val.' '.$row_unit['unit_name']; ?></td><td class="re_order_td"><?php echo $re_order_level.' '.$row_unit['unit_name'];?></td></tr>
		<?php	
		}
	}else{
		$sql="select * from item_master where `asset_name`<>'' order by id desc";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($res)){
		
		$sql_="select category_name,(select category_name from type_master where id='".$row['sub_type_id']."') as sub_cat from type_master where id='".$row['type_id']."'";
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		
		$sql_unit="select unit_name,id from unit_master where id='".$row['unit_id']."'";
		$res_unit=mysqli_query($conn,$sql_unit) or die(mysqli_error($conn));
		$row_unit=mysqli_fetch_assoc($res_unit);
		//extract($row_);
		$close_stock_val=total_stock_once($row['id']);
		$re_order_level=$row['moq'];
		$colour="";
		if($re_order_level>$close_stock_val){
			$colour="#f5c6cb";
		
		?>
			<tr id="<?php echo $row['id']; ?>" style="background-color:<?php echo $colour; ?>"><td class="re_order_td" ><?php echo $row['asset_name']; ?></td><td class="re_order_td" ><?php echo $row_['category_name']; ?></td><td class="re_order_td" ><?php echo $row_['sub_cat'];; ?></td><td  class="re_order_td"> <?php echo $close_stock_val.' '.$row_unit['unit_name']; ?></td><td class="re_order_td" ><?php echo $re_order_level.' '.$row_unit['unit_name'];?></td></tr>
		<?php	
			}
		}
	}
	
}

function damaged_item_save(){
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
		$rate=$_POST['rate'];
		$mrp=$_POST['mrp'];
		$total_amount=$_POST['total_amount'];	
		$asset_name=$_POST['asset_name'];	
		$user_id=$_SESSION['user_id'];
		//$inv_date=str_replace('/','-',$_POST['inv_date']);
		if($_REQUEST['inv_date']==''){
		$inv_date='NULL';
		}else{
			$inv_date= "'".date("Y-m-d", strtotime($_POST['inv_date']))."'";
		}
		$department_id=$_SESSION['department_id'];
		$created_on=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];	
		
		$tans_sql="SET autocommit = 0;";
   		mysqli_query($conn,$tans_sql);
   	  
   		$tans_sql="START TRANSACTION;";
   		mysqli_query($conn,$tans_sql);	
		
		$transfer_no=get_expired_dameged_number();
		
		$sql="INSERT INTO `expired_dameged_items` SET `transfer_number`='".$transfer_no."',`user_id`='".$user_id."',`department_id`='".$department_id."',`date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
		$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Sale insert")));
		
		
		$sales_id=mysqli_insert_id($conn);
		
		$indent_key="";
		$qty_sum=0;
		
		foreach($asset_id as $key => $val){
			
			
			$sql="INSERT INTO `expired_dameged_items_details` SET `expired_dameged_items_id`='".$sales_id."',`item_id`='".$val."',`item_name`='".mysqli_escape_string($conn,strip_tags($asset_name[$key]))."',`batch_no`='".$batch_no[$key]."',`manufacturing_date`='".date("Y-m-d",strtotime($mfg_date[$key]))."',`expiry_date`='".date("Y-m-d",strtotime($expiry_date[$key]))."',`qty`='".$qty[$key]."',`date`=".$inv_date.", `created_by`='".$created_by."', `created_on`='".$created_on."' ";
		
			$res=mysqli_query($conn,$sql)or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Consumables Transfer Details insert")));

		}
		
		$tans_sql="COMMIT;";
		mysqli_query($conn,$tans_sql);
		
		echo json_encode(array("flag"=>"1","c_id"=>$sales_id));

}
function get_expired_dameged_number(){
		global $conn;
		global $db;
		$sql1="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."' AND   TABLE_NAME   = 'expired_dameged_items';";
		//$sql1="SELECT * FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db."'";
		$res1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($res1);
		//echo "<pre>";print_r($row1);die;
		$new_id=$row1[0]."/DMG/".date("y")."-".date("y",strtotime("+1 years"));
		return $new_id;
}
function load_damage_item(){
		
		global $conn;
		$sql="select * from `expired_dameged_items` ORDER BY `id` DESC ";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
		?>
		
			<tr><td id="<?php echo $id ?>_sl_no"><?php echo $sl; ?></td><td id="<?php echo $id ?>_asset"><a href="javascript:void(0);" data-toggle="modal" data-target="#expireditemmodel" target="_blank" onclick="damagepopup(<?php echo $id ?>)"><?php echo $transfer_number; ?></a></td><td id="<?php echo $id ?>_color"><?php echo date("d/m/Y",strtotime($date)); ?></td><td><a href="javascript:void(0);" data-toggle="modal" data-target="#expireditemmodel"  onclick="damagepopup(<?php echo $id ?>)"> <i class="fa fa-eye" aria-hidden="true" title="View Item"></i></a>  <!--|  <a href="javascript:void(0);" onclick="del_invoice('<?php echo $id ?>')"  title="Cancel Bill"><i class="fa fa-trash" title="Cancel Bill"></i></a>--></td></tr>
		
		<?php
		$sl++;
		}
		
	
	}
function load_damage_item_popup(){
			global $conn;
			$expire_damaged_item=$_POST['exp_id'];
			$sql_="select * from `expired_dameged_items_details` where `expired_dameged_items_id`='".$expire_damaged_item."' ORDER BY `id` DESC ";
			$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
			$sl_=1;
			while($row_=mysqli_fetch_assoc($res_)){
				extract($row_);
				?>
                <tr style="text-align:center"><td><?php echo $sl_; ?></td><td><?php echo strip_tags($row_['item_name']); ?> (<?php echo ($row_['expiry_date']=="0000-00-00" || $row_['expiry_date']=="1970-01-01") ? "" : "Expiry Date: ".date("d-m-y",strtotime($row_['expiry_date'])); ?> <?php echo ($row_['manufacturing_date']=="0000-00-00" || $row_['manufacturing_date']=="1970-01-01") ? "" : "Mfg Date: ".date("d-m-y",strtotime($row_['manufacturing_date'])); ?> )</td><td><?php echo $row_['batch_no']; ?></td><td><?php echo $row_['qty']; ?></td></tr>
                <?php	
			$sl_++;}
}
function load_item_serverside(){
	
	global $conn;
$aColumns = array('item_master.id','item_master.hsm_code', 'item_master.asset_name', 'item_master.generic_name', 'type_master.category_name','(select category_name from type_master where id=item_master.sub_type_id) as sub_cat','item_master.moq','item_master.gst_rate','item_master.id as edit_id','item_master.cgst_rate','item_master.sgst_rate');

/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "item_master.id";
	/* DB table to use */
	$sTable = "item_master";

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
			if(($i!='5')&&($i!='8')){ // Exceptional please delete if not neccesseary
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
		 $sWhere .= " WHERE `item_master`.`status`='1' " ;
	}else{

		 $sWhere .= " AND `item_master`.`status`='1' " ;
	}
	//echo "Where::".$sWhere;
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable LEFT JOIN `type_master` on ".$sTable.".type_id=type_master.id 
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
			}else if ( $aColumns[$i] == "item_master.id" )
			{
				$row[] =$aRow['id'];
			}else if ( $aColumns[$i] == "item_master.hsm_code" )
			{
				$row[] =$aRow['hsm_code'];
			}else if ( $aColumns[$i] == "item_master.asset_name" )
			{
				$row[] =$aRow['asset_name'];
			}else if ( $aColumns[$i] == "item_master.generic_name" )
			{
				$row[] =$aRow['generic_name'];
			}else if ( $aColumns[$i] == "type_master.category_name" )
			{
				$row[] =$aRow['category_name'];
			}else if ( $aColumns[$i] == "(select category_name from type_master where id=item_master.sub_type_id) as sub_cat" )
			{
				$row[] =$aRow['sub_cat'];
			}else if ( $aColumns[$i] == "item_master.moq" )
			{
				$row[] =$aRow['moq'];
			}
			else if ( $aColumns[$i] == "item_master.gst_rate" )
			{
				$row[] =$aRow['gst_rate'].'%( '.$aRow['cgst_rate'].' , '.$aRow['sgst_rate'].' )';
			}else if ( $aColumns[$i] == "item_master.id as edit_id" )
			{
				//$row[] ="<a class='edit' href='javascript:void(0);' onclick='edit(".$aRow['edit_id'].",".$aRow['asset_name']."')' ><i class='fa fa-edit'></i></a>&nbsp;&nbsp;<a class='delete' href='javascript:void(0);' onclick='del(".$aRow['edit_id'].")' ><i class='fa fa-trash'></i></a>";
				$row[] ='<a class="edit" href="javascript:void(0);" onclick="edit('.$aRow['edit_id'].')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:void(0);" onclick="del('.$aRow['edit_id'].')" ><i class="fa fa-trash"></i></a>';
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
function full_stock_report_new(){

	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	global $conn;
	
	
	global $opening_stock_;
	global $purchase_;
	global $sale_;
	global $stock_transfer_in_;
	global $stock_transfer_out_;
	global $consumables_;
	global $arr_;
	global $closing_stock_;
	global $purchase_return_;
	global $sale_return_new_;
	//global $damaged_items_;
	global $temporary_pharma_sale_qty_out_;
	global $expired_dameged_items_qty_;
	
	$from_=(isset($_POST['from_']) and $_POST['from_']!="" ) ? date("Y-m-d",strtotime($_POST['from_'])) : "";
	$to_=(isset($_POST['to_']) and $_POST['to_']!="") ? date("Y-m-d",strtotime($_POST['to_'])) : ""; 
	$batch_exist_=(isset($_POST['batch_exist_'])) ? $_POST['batch_exist_'] : "1"; 
	$item_range=(isset($_POST['item_range'])) ? $_POST['item_range'] : "1-100"; 
	
	$filter="";
	
	if($from_=="" || $to_==""){
		$date_filter_item="";	
	}else{
		$date_filter_item=" and (date(item_master.created) BETWEEN '$from_' and '$to_')  ";
	}
	
	$temp_name=explode("-",$item_range);
	$iniitial_range=$temp_name[0];
	$end_range=$temp_name[1];
	$range_query=" AND `id` BETWEEN '".$iniitial_range."' AND '".$end_range."' ";
	
	$sql="select * from item_master where status=1 $date_filter_item $range_query order by asset_name ";

	$res=mysqli_query($conn,$sql);
	$slno=1;
	$total_val=0;
	$table_body="";
	while($row=mysqli_fetch_assoc($res)){
		if($batch_exist_=='1'){
		if(load_batch_code_($row['id'],$from_,$to_)){
		foreach($arr_ as $key => $val){			
			if(item_wise_stock_calculation_($row['id'],$val['value'],$from_,$to_)){
			}
				
		$gst_amount=$val['rate']*($val['gst_rate']/100);
		$rate_=$val['rate']+((isset($val['gst_rate'])) ?  $gst_amount : 0); //Adding tax amount
		$margin=$val['mrp']-$rate_;
		//echo "\nRate:".$val['rate']."\n";
		$rate=($val['rate']!="" && $val['rate']!=0) ? $rate_ : 1;
		$tmp=$margin/$rate;
		$perc=round($tmp*100,2);
		$total_val=($total_val)+($closing_stock_*$rate);
		
		//$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >".$val['value']."</td><td >".$opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td >".$stock_transfer_in_."</td><td>".$sale_return_new_."</td><td >".$stock_transfer_out_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$purchase_return_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$val['mrp']."</td><td>".$perc."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >".$val['value']."</td><td >".$opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td>".$sale_return_new_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$val['mrp']."</td><td>".$perc."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		
		}
		$slno++;
		}		
		}else{
		
		item_wise_stock_calculation_($row['id'],'',$from_,$to_);
		
		$rate=0;
		
		$sql_="select rate,mrp,purchase_details.gst_rate from purchase_details inner join purchase on purchase.id=purchase_details.purchase_id where item_id='".$row['id']."' and purchase.department_id='".$_SESSION['department_id']."' order by purchase_details.expiry_date";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$mrp_=$row_['mrp'];
		$rate_including_gst=$row_['rate']+($row_['rate']*($row_['gst_rate']/100));
		$rate=($row_['rate']!="" && $row_['rate']!=0) ? $rate_including_gst : 1;
		
		$sql_="select batch_no,rate from stock_transfer_details inner join stock_transfer on stock_transfer.id=stock_transfer_details.stock_transfer_id where item_id='".$row['id']."' and stock_transfer.to_department_id='".$_SESSION['department_id']."'  group by batch_no order by stock_transfer_details.expiry_date";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$rate=($row_['rate']!="" && $row_['rate']!=0) ? $row_['rate'] : $rate;
		
		$sql_="select batch,qty,mrp from opening_stock where item_id='".$row['id']."' and status=0 order by expiry";
		
		$res_=mysqli_query($conn,$sql_) or die(mysqli_error($conn));
		$row_=mysqli_fetch_assoc($res_);
		$rate=($row_['mrp']!="" && $row_['rate']!=0) ? $row_['mrp'] : $rate;
		
		$total_val=($total_val)+($closing_stock_*$rate);		
		//$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >-</td><td >". $opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td >".$stock_transfer_in_."</td><td>".$sale_return_new_."</td><td >".$stock_transfer_out_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$purchase_return_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$mrp_."</td><td>".((($mrp_-$rate)/$rate)*100)."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		$table_body.="<tr ><td >".$slno."</td><td >".$row['asset_name']."</td><td >-</td><td >". $opening_stock_."</td><td >".$purchase_."</td><td >".$sale_."</td><td>".$sale_return_new_."</td><td >".$consumables_."</td><td >".$expired_dameged_items_qty_."</td><td>".$temporary_pharma_sale_qty_out_."</td><td>".$rate."</td><td>".$mrp_."</td><td>".((($mrp_-$rate)/$rate)*100)."%</td><td><b>".$closing_stock_."</b></td><td><b>&#8377;".($closing_stock_*$rate)."</b></td></tr>";
		
			$slno++;
		}
		
		
		
		$arr_=array();
		
	}
	
	echo json_encode(array("table_body"=>$table_body,"total_val"=> round($total_val,2)));

}
function total_inventory_item(){	
	global $conn;	
	$sql="select * from item_master where status=1 order by `id` DESC limit 1";
	$res=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($res);	
	echo json_encode(array("count"=>$row['id']));
}
function medicine_item_load_for_presc(){
	
		global $conn;
		
		$sql="SELECT `id`, `asset_name` FROM `item_master` WHERE `status`='1' AND `type_id`='1' ORDER BY `asset_name` ASC ";
		
		$res=mysqli_query($conn,$sql);
		
		$arr[]=array();
		while($row=mysqli_fetch_assoc($res)){
			$arr[]=array("id"=>$row['id'],"text"=>$row['asset_name']);
		}		
		
		echo json_encode($arr);
	
	}
	
function load_vendor_payments(){
		
		global $conn;
		$vendor_id=$_POST['vendor_id'];
		$sql_vendor="SELECT `invoice_ledger_wise_payment_to_vendor`.*,`vendor_master`.`vendor_name`  FROM `invoice_ledger_wise_payment_to_vendor` INNER JOIN `vendor_master` ON `invoice_ledger_wise_payment_to_vendor`.`vendor_id`=`vendor_master`.`id` WHERE `invoice_ledger_wise_payment_to_vendor`.`vendor_id`='".$vendor_id."' AND `invoice_ledger_wise_payment_to_vendor`.`del_flag`='0' ORDER BY `id` ASC LIMIT 1 ";		
		$res_vendor=mysqli_query($conn,$sql_vendor) or die(mysqli_error($conn));
		$row_vendor=mysqli_fetch_array($res_vendor);
		?>
        <table class="table table-striped table-hover table-bordered">
         <thead>
            	<tr>
                	<td class="th_head"><b>Vendor:</b></td>
                    <td class="th_head"><b>Starting Date:</b></td>
                    <td class="th_head"><b>Opening Balance<br />(Due):</b></td>
            	</tr>
            </thead>
            <tbody>
            	<tr>
                	<td><b><?php echo $row_vendor['vendor_name']; ?></b></td>
                    <td><b><?php echo date("d-m-Y", strtotime($row_vendor['payment_date'])); ?></b></td>
                    <td><b><?php echo $row_vendor['opening_bal']; ?></b></td>
            	</tr>
            </tbody>
        </table>
        <p>&nbsp;<br /></p>
         <table class="table table-striped table-hover table-bordered">
            <thead>
            	<tr>
                	<td class="th_head"><b>Payment Date:</b></td>
                    <td class="th_head"><b>Payment Mode:</b></td>
                    <td class="th_head"><b>Payment Amount.:</b></td>
            	</tr>
            </thead>
            <tbody>
        <?php 
		
		$sql="SELECT `invoice_payment_ledger_wise_payment_to_vendor`.* ,`invoice_ledger_wise_payment_to_vendor`.`payment_date` FROM `invoice_payment_ledger_wise_payment_to_vendor` INNER JOIN `invoice_ledger_wise_payment_to_vendor` ON `invoice_payment_ledger_wise_payment_to_vendor`.`i_id`=`invoice_ledger_wise_payment_to_vendor`.`id` WHERE `invoice_ledger_wise_payment_to_vendor`.`vendor_id`='".$vendor_id."' AND `invoice_ledger_wise_payment_to_vendor`.`del_flag`='0' ORDER BY `id` ASC ";
		
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$sl=1;
		while($row=mysqli_fetch_assoc($res)){
		?>
		
			<tr>
                	<td><b><?php echo date("d-m-Y", strtotime($row['payment_date'])); ?></b></td>
                    <td><b><?php echo $row['p_key']; ?></b></td>
                    <td><b><?php echo $row['p_value']; ?></b></td>
            	</tr>
		
		<?php
		$sl++;
		}
		
		?>
        </tbody>
        </table>
        <p ><span style="color:blue;font-weight:bold;font-size:16px;">Total Due Amt(Rs.) Till Present Date : </span><span style="color:red;font-weight:bold;font-size:16px;"><?php $due_amt=get_due_for_vendor($vendor_id);echo $due_amt+$row_vendor['opening_bal']; ?></span></p>          
        <?php 
		
	
}
	
function get_due_for_vendor($vendor_id){
		global $conn;	
		//$vendor_id=$_POST["vendor_id"];
		$total_purchase_amt['total_purchase_amt']=0;
		$total_payment_amt['total_payment_amt']=0;
		$due_amt=0;
		
		$sql="SELECT SUM(`amount`) AS `total_purchase_amt` FROM `purchase` WHERE  `vendor_id`='".$vendor_id."' ;";	
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$total_purchase_amt=mysqli_fetch_assoc($res);
		
		$sql2="SELECT SUM(`amount_to_be_paid`) AS `total_payment_amt` FROM `invoice_ledger_wise_payment_to_vendor` WHERE  `vendor_id`='".$vendor_id."' AND `del_flag`='0' ;";	
		$res2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
		$total_payment_amt=mysqli_fetch_assoc($res2);
		
		$due_amt=($total_purchase_amt['total_purchase_amt']-$total_payment_amt['total_payment_amt']);
		return $due_amt;
} 
?>