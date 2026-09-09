<?php

function limit_text($text, $limit) {

      if (str_word_count($text, 0) > $limit) {

          $words = str_word_count($text, 2);

          $pos = array_keys($words);

          $text = substr($text, 0, $pos[$limit]) . '...';

      }

      return $text;

}

function calculateFiscalYearForDate($inputDate, $fyStart, $fyEnd){

	$date = strtotime($inputDate); 

    //$inputyear = strftime('%y',$date); 
	$inputyear = date('y',$date);
	

	$start_date = date('m/d/y', strtotime($fyStart.'/'.$inputyear));

	$end_date = date('m/d/y', strtotime($fyEnd.'/'.($inputyear+1)));



	

    $fystartdate = strtotime($start_date); 

	$fyenddate = strtotime($end_date); 



    if(($date <= $fyenddate) && ($date >= $fystartdate)){ 

        $fy = intval($inputyear); 

    }else{ 

        $fy = intval(intval($inputyear) - 1); 

    }

	$m_fn =  substr($fy, -2);

	$fin_year = $m_fn.'-'.($m_fn + 1);

	return $fin_year;

}

function convertNumber($num)

{

   list($num, $dec) = explode(".", $num);



   $output = "";



   if($num[0] == "-")

   {

      $output = "negative ";

      $num = ltrim($num, "-");

   }

   else if($num[0] == "+")

   {

      $output = "positive ";

      $num = ltrim($num, "+");

   }

   

   if($num[0] == "0")

   {

      $output .= "zero";

   }

   else

   {

      $num = str_pad($num, 36, "0", STR_PAD_LEFT);

      $group = rtrim(chunk_split($num, 3, " "), " ");

      $groups = explode(" ", $group);



      $groups2 = array();

      foreach($groups as $g) $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);



      for($z = 0; $z < count($groups2); $z++)

      {

         if($groups2[$z] != "")

         {

            $output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))

             && $groups2[11] != '' && $groups[11][0] == '0' ? " and " : " ");

         }

      }



      $output = rtrim($output, " ");

   }



   if($dec > 0)

   {

      $output .= " point";

      for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec[$i]);

   }



   return $output;

}

function convertGroup($index)

{

   switch($index)

   {

      case 11: return " decillion";

      case 10: return " nonillion";

      case 9: return " octillion";

      case 8: return " septillion";

      case 7: return " sextillion";

      case 6: return " quintrillion";

      case 5: return " quadrillion";

      case 4: return " trillion";

      case 3: return " billion";

      case 2: return " million";

      case 1: return " thousand";

      case 0: return "";

   }

}



function convertThreeDigit($dig1, $dig2, $dig3)

{

   $output = "";



   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";



   if($dig1 != "0")

   {

      $output .= convertDigit($dig1)." hundred";

      if($dig2 != "0" || $dig3 != "0") $output .= " and ";

   }



   if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);

   else if($dig3 != "0") $output .= convertDigit($dig3);



   return $output;

}



function convertTwoDigit($dig1, $dig2)

{

   if($dig2 == "0")

   {

      switch($dig1)

      {

         case "1": return "ten";

         case "2": return "twenty";

         case "3": return "thirty";

         case "4": return "forty";

         case "5": return "fifty";

         case "6": return "sixty";

         case "7": return "seventy";

         case "8": return "eighty";

         case "9": return "ninety";

      }

   }

   else if($dig1 == "1")

   {

      switch($dig2)

      {

         case "1": return "eleven";

         case "2": return "twelve";

         case "3": return "thirteen";

         case "4": return "fourteen";

         case "5": return "fifteen";

         case "6": return "sixteen";

         case "7": return "seventeen";

         case "8": return "eighteen";

         case "9": return "nineteen";

      }

   }

   else

   {

      $temp = convertDigit($dig2);

      switch($dig1)

      {

         case "2": return "twenty-$temp";

         case "3": return "thirty-$temp";

         case "4": return "forty-$temp";

         case "5": return "fifty-$temp";

         case "6": return "sixty-$temp";

         case "7": return "seventy-$temp";

         case "8": return "eighty-$temp";

         case "9": return "ninety-$temp";

      }

   }

}

      

function convertDigit($digit)

{

   switch($digit)

   {

      case "0": return "zero";

      case "1": return "one";

      case "2": return "two";

      case "3": return "three";

      case "4": return "four";

      case "5": return "five";

      case "6": return "six";

      case "7": return "seven";

      case "8": return "eight";

      case "9": return "nine";

   }

}

function calcFY($startDate,$endDate) {



    $prefix = 'FY-';



    $ts1 = strtotime($startDate);

    $ts2 = strtotime($endDate);



    $year1 = date('Y', $ts1);

    $year2 = date('Y', $ts2);



    $month1 = date('m', $ts1);

    $month2 = date('m', $ts2);



    //get months

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);



    /**

     * if end month is greater than april, consider the next FY

     * else dont consider the next FY

     */

    $total_years = ($month2 >= 4)?ceil($diff/12):floor($diff/12);



    $fy = array();



    while($total_years >= 0) {



        $prevyear = $year1;



        //We dont need 20 of 20** (like 2014)

        $fy[] = $prevyear;



        $year1 += 1;



        $total_years--;

    }

    /**

     * If start month is greater than or equal to april, 

     * remove the first element

     */

    if($month1 >= 4) {

        //unset($fy[0]);

    }

	

    /* Concatenate the array with ',' */

    return $fy;

}



function number_to_indian_rupees_convert($number){	

	if($number==0){
		return  'Zero' ;	
	}else if($number==''){
		return  ' ' ;
	}else{

   $decimal = round($number - ($no = floor($number)), 2) * 100;

    $hundred = null;

    $digits_length = strlen($no);

    $i = 0;

    $str = array();

    $words = array(0 => '', 1 => 'one', 2 => 'two',

        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',

        7 => 'seven', 8 => 'eight', 9 => 'nine',

        10 => 'ten', 11 => 'eleven', 12 => 'twelve',

        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',

        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',

        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',

        40 => 'forty', 50 => 'fifty', 60 => 'sixty',

        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');

    $digits = array('', 'hundred','thousand','lakh', 'crore');

    while( $i < $digits_length ) {

        $divider = ($i == 2) ? 10 : 100;

        $number = floor($no % $divider);

        $no = floor($no / $divider);

        $i += $divider == 10 ? 1 : 2;

        if ($number) {

            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;

        } else $str[] = null;

    }

    $Rupees = implode('', array_reverse($str));

    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';

    return ($Rupees ? $Rupees . ' ' : '') . $paise;	
	
	}
	

}

function get_client_ip() {

    $ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}



///============== Setar SMS ============================

function sendSms($message_p,$sms_from_p,$mobile_p)

{

	$seq=substr(str_shuffle(rand().time()),0,6);

	$returnVal=0;	

	$patterns = array();

	$patterns[0] = '/\"/';

	$patterns[1] = '/\r\n/';

	$patterns[2] = '/>/';

	$patterns[3] = '/</';

	$replacements = array();

	$replacements[0] = '&quot;';

	$replacements[1] = '&#013;';

	$replacements[2] = '&gt;';

	$replacements[3] = '&lt;';

	$message_p=stripslashes($message_p);

	$message_p=preg_replace($patterns,$replacements,$message_p);	

	$message_p=urlencode($message_p);		

	//$sms_from="BBEVIP";

	$profile_id="1201159628110577697";

	//$sender_id="BBEVIP";

	$api_key="3a23945e2e877a2e155ba0dca8efa116";

	$curl=curl_init();

	curl_setopt_array($curl, array(

		  CURLOPT_URL => "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$api_key&message=$message_p&senderId=$sms_from_p&routeId=1&mobileNos=$mobile_p&smsContentType=english",

		  CURLOPT_RETURNTRANSFER => true,

		  CURLOPT_ENCODING => "",

		  CURLOPT_MAXREDIRS => 10,

		  CURLOPT_TIMEOUT => 30,

		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

		  CURLOPT_CUSTOMREQUEST => "GET",

		  CURLOPT_HTTPHEADER => array(

			"Cache-Control: no-cache"

		  ),

		));



		$response = curl_exec($curl);

		$err = curl_error($curl);

		//echo($response);

		//echo $err;

		$res=json_decode($response);

		curl_close($curl);

		$file = fopen("smsLog.txt","a");

		fwrite($file,$message_p."\n\n".$res->responseCode."\n".$res->response."\n"."http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$api_key&message=$message_p&senderId=$sms_from_p&routeId=1&mobileNos=$mobile_p&smsContentType=english");

		fclose($file);

		if ($err) {

		  //echo "cURL Error #:" . $err;

		} else {

		  //echo "Response Code:".$res->responseCode;

		  //echo "Response:".$res->response;

		  if($res->responseCode=="3001")  $returnVal=1;

		}

		return $returnVal;	

}



///============== End SMS ============================





//================Tiny URL Change In Sandip=================

function get_tiny_url($url)  {  

	$ch = curl_init(); 

	$timeout = 5;  

	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  

	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  

	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  

	$data = curl_exec($ch);  

	curl_close($ch);  

	return $data;  

}



?>