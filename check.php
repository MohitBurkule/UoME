<?php
$email=$_GET['email'];
$pwd=$_GET['pwd'];

$fn = fopen("db.txt","r");
$match=0;
  while(! feof($fn))  
  {
	$result = fgets($fn);
	$resobj = json_decode($result);
	if(is_null($resobj))
	  break;
	//echo $resobj->n;
  if($resobj->e==$email)
  {
	  if($resobj->p==$pwd)
	  {
		  $match=1;
		  echo "match";
		  setcookie("user", $resobj->r, time() + (86400 * 30), "/"); // 86400 = 1 day //keep logged in for 30 days 
		  setcookie("useremail", $resobj->e, time() + (86400 * 30), "/"); // 86400 = 1 day //keep logged in for 30 days
		  echo "redirecting to  mainpage..<br>";
		  sleep(2);
		  header("refresh:3;url= /splitwise/usermain.html");
		  exit; //break and skip rest of code ;
		  
	  }
	  else
	  {
		  $match=0;
		  echo "no match";
		  exit; //break and skip rest of code ;
		 
	  }
	  
  }
  
  
  }
  
  if($match==0)
  {
	  echo "no user found ";
  }

  fclose($fn);



?>