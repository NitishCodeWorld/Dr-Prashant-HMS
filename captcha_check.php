<?php session_start();
// (A) CAPTCHA CHECK
$result = "";
$fl=0;

require "captcha.php";
if (!$PHPCAP->verify($_POST["captcha"])) {
  $result = "CAPTCHA does not match!";
  $fl=0;
}

// (B) PROCEED IF CAPTCHA CHECK OK
if ($result == "") {
  // DO SOMETHING
  $result = "Congrats, CAPTCHA is correct.";
  $fl=1;
}

// (C) THE END
//print_r($_POST);
//echo $result;
echo json_encode(array("fl"=>$fl));
?>