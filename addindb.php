<?php
if(!isset($_COOKIE['user']))
{
	echo "redirecting to  login..<br>";
	sleep(2);
	header("refresh:3;url= /splitwise/login.html");
	
	
}
else
{
	
	
		class transaction 
	{
		public $u; // user -> reciever/sender
		public $c; // credited 
		public $d; //debited
		public $s; // status of transaction
	}
	
	
		$fn="userpage/".$_COOKIE['user'].".txt";
	if(isset($_GET['user'])) // todo: check other conditions also if set 
	{
		$t = new transaction();
		$t->u= $_GET['user'];

		if(isset($_GET['credit']))
			$t->c= $_GET['amount'];
		if(isset($_GET['debit']))
			$t->d= $_GET['amount'];

		if(isset($_GET['paid']))
			$t->s="paid";
		if(isset($_GET['unpaid']))
			$t->s="unpaid";
		
		

		// add transaction to other user 
		// find his file ( random id )
		
			$fn = fopen("db.txt","r");
			$match=0;
			while(! feof($fn))  
			{
				$result = fgets($fn);
				$resobj = json_decode($result);
				if(is_null($resobj))
				break;
				//echo $resobj->n;
			if($resobj->e==$t->u)
			{
					$match=1;
					// user found so add this transaction to his transaction 
					
					$fn1="userpage/".$resobj->r.".txt";
					$tinv = new transaction(); // t inverse because credit and debit is reversed 
					$tinv->u= $_COOKIE['useremail'];   // current user email to be stored in other persons transaction record 
					if(isset($_GET['credit']))
						$tinv->d= $_GET['amount'];
					if(isset($_GET['debit']))
						$tinv->c= $_GET['amount'];

					if(isset($_GET['paid']))
						$tinv->s="paid";
					if(isset($_GET['unpaid']))
						$tinv->s="unpaid";
					// write  to his transaction 
					$jsonData = json_encode($tinv);
					$myfile = file_put_contents($fn1, $jsonData.PHP_EOL , FILE_APPEND | LOCK_EX);
					
							// add transaction to loggined user 
						$fn2="userpage/".$_COOKIE['user'].".txt";	
						$jsonData = json_encode($t);
						$myfile = file_put_contents($fn2, $jsonData.PHP_EOL , FILE_APPEND | LOCK_EX); // donno bout lock_ex
						
						echo "Transaction successful..<br>";
						sleep(2);
						header("refresh:3;url= /splitwise/history.php");
					
			}
			
			
			}
			
			if($match==0)
			{
				echo "no user found ";
			}
					
	}
}

?>