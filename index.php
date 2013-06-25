<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php"; ?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Snake and ladder</title>
<style type='text/css'>
div {
	border: 1px solid red;
}

table td {
	height: 10%;
	width: 10%;
}

#roll {
	clear: left;
	float: left;
	width: 520px;
	height: 24pt;
	margin: 40px 0 0 0;
	font-size: 18pt;
	font-weight: bold;
	border-style: outset;
	background: white;
}

#snakeandladder {
	background-image: url(images/snakeandladder.jpg);
	background-position: center;
	background-size: 102% 102%;
	background-repeat: no-repeat;
}

#container {
	background-image: url(images/faltu.jpg);
	background-repeat: no-repeat;
	background-size: 100% 100%;
}
</style>

<script type='text/javascript'> 
   var pos = 0;
var snakeface = new Array(17,54,62,64,87,93,95,98 );
var snaketail = new Array(7,34,19,60,24,73,75,79 );
var laddertail = new Array(1,4,9,21,28,51,71,80 );
var ladderface = new Array(38,14,31,42,84,67,91,100 );

     function animateRoll(times)
     {
         times = times || 1;
        
         var roll = generateRoll();
         drawRoll(roll[0], roll[1]);
         
         if (times > 10)
         {
               var sum = checkRoll(roll[0], roll[1]);
               $("#"+pos).html('');
		
               pos += sum;
		for(var i = 0 ; i < snakeface.length ; i ++)
		{
			if(pos == snakeface[i])
			{
				pos = snaketail[i];
			}
		}
		for(var i = 0 ; i < laddertail.length ; i ++)
		{
			if(pos == laddertail[i])
			{
				pos = ladderface[i];
			}
		}
		
		
               $("#"+pos).html("<img src='<?php echo SITE_URL;?>/images/grl.png' height='30' width='30'/>");
               return;
          }
         
         setTimeout('animateRoll(' + (times + 1) + ')', 200);
     }

     function generateRoll()
     {
         return [ Math.floor(Math.random()*6) + 1, Math.floor(Math.random()*6) + 1 ];
     }

     function drawRoll(die1, die2)
     {
         document.getElementById('die1').innerHTML = '<img src="<?php echo SITE_URL;?>/images/Dice_' + die1 +'.png" />';
         document.getElementById('die2').innerHTML = '<img src="<?php echo SITE_URL;?>/images/Dice_' + die2 +'.png" />';
     }

     function checkRoll(die1, die2)
     {
         var sum = die1 + die2;
         return sum;
     }  
          
      
  </script>
</head>

<body>

	<div id='container' style="width: 20%; height: 80%; float: left;">
		<div id="Diceroll" style='margin-top: 100%;'>
			<div id='die1'
				style="width: 39%; height: 18%; margin-left: 10%; float: left;"></div>
			<div id='die2' style="width: 39%; height: 18%; margin-left: 51%;"></div>
			<div style='clear: left; width: 100%; margin-top: 20%;'>
				<a href="#" onClick='animateRoll()'>Roll Dice</a>
			</div>
			<div style="margin-top: 20%; height: 10%"></div>
		</div>
	</div>
	<div id='snakeandladder'
		style="width: 70%; height: 100%; margin-left: 21%;">
		<table
			style="width: 100%; height: 100%; text-align: center; white-space: normal;"
			cellspacing="0" cellpadding="0">
<?php

$k = 10;
$m = 9;
for($j = 0; $j < 10; $j ++) {
	
	if ($j % 2 == 0) {
		for($i = 10; $i > 0; $i --) {
			if ($i % 10 == 0) {
				?>			
					<tr>
<?php
			}
			?>
				<td id="<?php echo ($i + ($k * $m)); ?>"></td>
<?php
			if ($i % 10 == 1) {
				?>
					</tr>
<?php
			}
		}
	} else {
		for($i = 0; $i < 10; $i ++) {
			if ($i % 10 == 0) {
				?>
					<tr>
<?php
			}
			?>
					<td id="<?php echo ($i + ($k * $m) +1); ?>"></td>
<?php
			if ($i % 10 == 9) {
				?>
					</tr>
<?php
			}
		}
	}
	$m --;
}

?>


</table>
	</div>
</body>
</html>
