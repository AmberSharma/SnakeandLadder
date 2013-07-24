
<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php";

?>
<!--
<?php if($_REQUEST['valid'] != 1 || empty($_REQUEST['valid']))
{
	header("Location: bendrules.php");
}
if(empty($_REQUEST['avatar']))
{
	$_REQUEST['avatar'] = "avatar1.png";
}

?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<script>
$(document).ready(function()
{
	<?php 
		if(!empty($_REQUEST['name']) && !empty($_REQUEST['turn']) && !empty($_REQUEST['method']) && !empty($_REQUEST['opponent']) && !empty($_REQUEST['dicecount'])) 
		{
			if($_REQUEST['method'] == "Automatic")
			{
	?>
			window.location.href= "automatic.php?name="+<?php echo "'".$_REQUEST['name']."'";?>+"&turn="+<?php echo "'" .$_REQUEST['turn']."'";?>+"&avatar="+<?php echo "'" .$_REQUEST['avatar']."'" ;?>+"&opponent="+<?php echo $_REQUEST['opponent'] ; ?>+"&method="+<?php echo "'" .$_REQUEST['method']."'" ;?>+"&dicecount="+<?php echo $_REQUEST['dicecount'] ;?>;
	<?php
			}
			else if($_REQUEST['method'] == "Manual")
			{
	?>
			window.location.href="manual.php?name="+<?php echo "'".$_REQUEST['name']."'";?>+"&turn="+<?php echo "'" .$_REQUEST['turn']."'";?>+"&avatar="+<?php echo "'" .$_REQUEST['avatar']."'" ;?>+"&opponent="+<?php echo $_REQUEST['opponent'] ; ?>+"&method="+<?php echo "'" .$_REQUEST['method']."'" ;?>+"&dicecount="+<?php echo $_REQUEST['dicecount'] ;?>;
	<?php
				
			}
		}
		else
		{
			header("Location: bendrules.php");
		}
	?>
});

</script>

-->
<?php 
if($_REQUEST['valid'] != 1 || empty($_REQUEST['valid']))
{
	header("Location: bendrules.php");
}
if(empty($_REQUEST['avatar']))
{
	$_REQUEST['avatar'] = "avatar1.png";
}
if(!empty($_REQUEST['name']) && !empty($_REQUEST['turn']) && !empty($_REQUEST['method']) && !empty($_REQUEST['opponent']) && !empty($_REQUEST['dicecount'])) 
{
?>
<form action="<?php echo strtolower($_REQUEST['method']).'.php';  ?>" method="post" id="frmid">
<input type="hidden" name="name" value="<?php echo $_REQUEST['name'];  ?>" ></input>
<input type="hidden" name="turn" value="<?php echo $_REQUEST['turn'];  ?>" ></input>
<input type="hidden" name="method" value="<?php echo $_REQUEST['method'];  ?>" ></input>
<input type="hidden" name="opponent" value="<?php echo $_REQUEST['opponent'];  ?>" ></input>
<input type="hidden" name="dicecount" value="<?php echo $_REQUEST['dicecount'];  ?>" ></input>
<input type="hidden" name="avatar" value="<?php echo $_REQUEST['avatar'];  ?>" ></input>
</form>
<?php
}
?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<script>
document.getElementById('frmid').submit();
</script>
