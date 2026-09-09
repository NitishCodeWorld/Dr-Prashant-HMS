<?php

	$style_class1="";

	$style_class2="";

	$style_class3="";

	$style_class4="";

	$style_class5="";

	

	$style_class1=(basename($_SERVER['PHP_SELF'])=="lens_transfer_to_ot_for_lens_library.php") ? "class='active'" : "";

	$style_class2=(basename($_SERVER['PHP_SELF'])=="lens_openning_stock_for_lens_library.php") ? "class='active'" : "";

	$style_class3=(basename($_SERVER['PHP_SELF'])=="lens_received_for_lens_library.php") ? "class='active'" : "";

	$style_class4=(basename($_SERVER['PHP_SELF'])=="lens_return_from_ot_for_lens_library.php") ? "class='active'" : "";

	$style_class5=(basename($_SERVER['PHP_SELF'])=="lens_stock_for_lens_library.php") ? "class='active'" : "";

	$style_class6=(basename($_SERVER['PHP_SELF'])=="lens_return_for_lens_library.php") ? "class='active'" : "";



?>



<div class="tabbable tabbable-tabdrop">

  <ul class="nav nav-pills">

    <li <?php echo $style_class2; ?>> <a href="lens_openning_stock_for_lens_library.php">Opening Stock</a> </li>

    <li <?php echo $style_class3; ?>> <a href="lens_received_for_lens_library.php">Lens Received From Vendor For OT</a> </li>

    <li <?php echo $style_class1; ?>> <a href="lens_transfer_to_ot_for_lens_library.php" >Lens Transfer to OT</a> </li>

    <li <?php echo $style_class4; ?>> <a href="lens_return_from_ot_for_lens_library.php" >Lens Return from OT</a> </li>

    <li <?php echo $style_class6; ?>> <a href="lens_return_for_lens_library.php" >Lens Returned to Vendor</a> </li>

    <li <?php echo $style_class5; ?>> <a href="lens_stock_for_lens_library.php">Lens Library Stock</a> </li>

  </ul>

</div>

