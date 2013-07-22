<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php"; ?>

<html>
<head>
<title>Snake and ladder</title>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery-1.9.1.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery.ui.core.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery.ui.widget.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery.ui.mouse.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery.ui.draggable.js"></script>
<script src="<?php echo SITE_URL;?>/js/jquery.ui.droppable.js"></script>
<script src="<?php echo SITE_URL;?>/js/manualfunctions.js"></script>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/automatic.css">
</head>
<script>



$(document).ready(function()
{
	<?php 
	if(!empty($_REQUEST['name']) && !empty($_REQUEST['turn'])) 
	{
	?>
		$("#die1").hide();
		$("#die2").hide();
		$("#dicerollbutton").hide();
		user = <?php echo "'".$_REQUEST['name']."'";?>;
		turn = <?php echo "'" .$_REQUEST['turn']."'";?>;
		avatar = <?php echo "'" .$_REQUEST['avatar']."'" ;?>;
		opponent = <?php echo $_REQUEST['opponent'] ; ?>;
		dicecount = <?php echo $_REQUEST['dicecount'] ; ?>;
		method = <?php echo "'" . $_REQUEST['method'] . "'" ; ?>;
		$.ajax
		({
			type: "POST",
			url: '../controller/controller.php?method=insertUser&user='+user+"&turn="+turn+"&avatar="+avatar+"&method1="+method+"&dice="+dicecount,
			success: function(data)
			{
				if($.trim(data) == "1")
				{
					$(".player").attr("id",user);
					$("#"+user).html("<img src='<?php echo SITE_URL;?>/images/"+ avatar + "' height='50' width='50' class='draggable2'/>");
					Timer1 = setInterval(fetchUser, 5000);
				}
			}
			
		});		
	<?php
	}
	else
	{
		header('Location: bendrules.php');
	}
	?>
});




</script>
<body>
<div id="left" class="container" >
	<div style="margin-top: 70%; height: 10%;" class="player"></div>
	<div id="Diceroll" >
		<div id='die1' style="width: 39%; height: 18%; margin-left: 10%; float: left;"></div>
		<div id='die2' style="width: 39%; height: 18%; margin-left: 51%;"></div>
		<div style='clear: left; width: 100%; margin-top: 20%;' id = "dicerollbutton">
			<a href="javascript:void(0)" onClick='animateRoll()' style="margin-left:9%;"><img src="<?php echo SITE_URL ?>/images/rolldice.jpg" height='60' width='220'/></a>
		</div>
	</div>

</div>
<div id="center" class="snakeandladder">
<table style="width: 100%; height: 100%; text-align: center; white-space: normal;" cellspacing="0" cellpadding="0">
<?php
$k = 10;
$m = 9;
for($j = 0; $j < 10; $j ++) 
{
	if ($j % 2 == 0) 
	{
		for($i = 10; $i > 0; $i --) 
		{
			if ($i % 10 == 0) 
			{
?>			
				<tr>
<?php
			}
?>
				<td id="<?php echo ($i + ($k * $m)); ?>"></td>
<?php
			if ($i % 10 == 1) 
			{
?>
					</tr>
<?php
			}
		}
	}
	else 
	{
		for($i = 0; $i < 10; $i ++) 
		{
			if ($i % 10 == 0) 
			{
?>
				<tr>
<?php
			}
?>
				<td id="<?php echo ($i + ($k * $m) +1); ?>"></td>
<?php
			if ($i % 10 == 9) 
			{
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
<div id ="right">
<div id="users"></div>
<div id="message"></div>

</div>
<div class="bottom">Copyright © July 2013, by Amber Sharma(OSSCube Solutions Pvt. Ltd.). All rights reserved.</div>
</div>
</body>
</html>
