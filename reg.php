<?php

$name=$_GET['name'];
$email=$_GET['email'];
$pwd=$_GET['pwd'];

//todo : check if all valid 
//todo : check if user exhists already 

class user 
{
	public $n;
	public $e;
	public $p;
	public $r;
	//todo : add random id 
	
} 

$obj = new user();
$obj->n=$name;
$obj->e=$email;
$obj->p=$pwd;
$obj->r=mt_rand(0,300);
$jsonData = json_encode($obj);

$myfile = file_put_contents('db.txt', $jsonData.PHP_EOL , FILE_APPEND | LOCK_EX); // donno bout lock_ex


//make user page 
setcookie("user", $obj->r, time() + (86400 * 30), "/"); // 86400 = 1 day //keep logged in for 30 days
setcookie("useremail", $obj->e, time() + (86400 * 30), "/"); // 86400 = 1 day //keep logged in for 30 days

echo "redirecting to  mainpage..<br>";
	sleep(2);
	header("refresh:3;url= /splitwise/usermain.html");
?>