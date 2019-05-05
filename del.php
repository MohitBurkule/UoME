<?php
$delo='';//object to be deleted 

$fn="userpage/".$_COOKIE['user'].".txt"; //filename
$tn=3;//transaction no to be deleted 
$counter=1;//counter to count transactions in file //TODO:: add transaction no to each pbject so that directly $tn can be compared with it 
$match=0;
$fp = fopen($fn, "r");
			while(! feof($fp))  
			{
				$result = fgets($fp);
				
				$resobj = json_decode($result);
				if(is_null($resobj))
				break;
				if($counter==$tn)//FUTURE : if(resobj->transID == $tn )
				{
					$delo=$resobj;
					$match=1;
					break;
				}
				$counter=$counter+1;
			
			}
			if($match==0)
			{
				echo 'not found';
				exit;
			}
			fclose($fp);
			$result = file_get_contents($fn);
			//$resobj = json_decode($result);
			$delo = json_encode($delo);
			var_dump($result);
			echo '<br><br><br>';
			var_dump($delo);
			$result = str_replace(chr(10).$delo,'', $result);
			file_put_contents($fn, $result);

?>