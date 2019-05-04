<!DOCTYPE html><html lang='en'><head> 
<meta charset='UTF-8'> 
 <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
 <script src='assets/JS/jquery-3.0.0.min.js' > </script> 
 <script src='assets/JS/uikindle.js' > </script> 
 <link rel='stylesheet' type='text/css' href='assets/CSS/drawer.css'>
 <link href="assets/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet"> 
<script src="assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script> 
<link href="assets/semantic/components/divider.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/site.min.css" rel="stylesheet"><link href="assets/semantic/components/button.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/icon.min.css" rel="stylesheet"><link href="assets/semantic/components/table.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/label.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/menu.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/reset.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/header.min.css" rel="stylesheet"> 
<link href="assets/semantic/components/segment.min.css" rel="stylesheet"></head> 
<body style='width: 100%; height: 100%; left: 0px;'><div class="draggable" style="top: 0px; width: 949px; height: 37px;">
<div class="ui menu se_menu draggable" style="top: 0px; width: 945px; height: 57px;">
  <div class="header item mg">SPLITWISE
</div>
  <a class="item mg" href="aboutus.html">
    About Us
  </a>
   <a class="item mg" href="usermain.html">
    Home
  </a>
  <a class="item active mg" href="history.php">
    HISTORY
  </a>
  <a class="item mg" href="add.html">
    NEW TRANSACTION
  </a>
  <a class="item mg" href="logout.html">
    LOG OUT
  </a>

<script>
  $(function(){
     $('.se_menu .item').on('click', function() {
       $('.se_menu .item').removeClass('active');
       $(this).addClass('active');
     });     
  });
</script>
<!----header ends ------------------------------------------------------------------------>
</div></div> 
<table class="ui celled table draggable" style="top: 102px; width: 950px; height: 216px; left: -2px;">
  <thead>
    <tr class="mg">
      <th>Name</th>
      <th>Status</th>
      <th>Amount</th>
    </tr>
  </thead>


 <tbody>
 
<?php
if(!isset($_COOKIE['user']))
{
	echo "redirecting to  login..<br>";
	sleep(2);
	header("refresh:3;url= /splitwise/login.html");
	
}
else
{
	/*
	class transaction 
	{
		public $u; // user -> reciever/sender
		public $c; // credited 
		public $d; //debited
		public $s; // status of transaction
	}
	
	*/
$fn="userpage/".$_COOKIE['user'].".txt";	
$fn = fopen($fn,"r");
	if($fn)
	{
			$match=0;
			while(! feof($fn))  
			{
				$result = fgets($fn);
				$resobj = json_decode($result);
				if(is_null($resobj))
				break;
				//echo $resobj->n;
				$c=1; // flag if credited 
				if($resobj->c!="")
				{
					echo '<tr class="negative mg">';
				}
				else if ($resobj->d!="")
				{
					$c=0;
					echo '<tr class="positive mg">';
				}
				else
				{
					echo '<tr class="mg">';
				}
				echo '<td>'.$resobj->u.'</td>';
				echo '<td>'.$resobj->s.'</td>';
				if($c==1)
				{
					echo '<td> CREDITED '.$resobj->c.' </td>';
				}
				else
				{
					echo '<td> DEBITED '.$resobj->d.'</td>';
				}
				echo '</tr>';
				//echo $resobj->u." ".$resobj->c." ".$resobj->d."	".$resobj->s."<br>"; // todo : display in table format 
			
			
			}
			
			
			
			fclose($fn);
	}
	
	
	
}

?>
 <!--
    <tr class="mg">
      <td>No Name Specified</td>
      <td>Unknown</td>
      <td class="negative">None</td>
    </tr>
    <tr class="positive mg">
      <td>Jimmy</td>
      <td><i class="icon checkmark"></i> Approved</td>
      <td>None</td>
    </tr>
    <tr class="mg">
      <td>Jamie</td>
      <td>Unknown</td>
      <td class="positive"><i class="icon close"></i> Requires call</td>
    </tr>
    <tr class="negative mg">
      <td>Jill</td>
      <td>Unknown</td>
      <td>None</td>
    </tr>
	-->
  </tbody>
</table> 
</body> 
 </html>