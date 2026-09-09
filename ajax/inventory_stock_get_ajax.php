<?php
include '../conn.php';
$item_id=$_POST["item_id"];
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

echo json_encode(array("closing_stock"=>$closing_stock));
?> 

