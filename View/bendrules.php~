<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php"; ?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/bendrules.css">
<html>
<head>
<style>

</style>
<script>
$(document).ready(function() {

var valid = 1;
var cur = 1;
var max = $(".box-wrapper div").length;


$("#sright").click(function(){
    if (cur == 1 && cur < max)
        return false;
	
       cur--;
     $(".block").animate({"left": "+=72px"}, "slow");
	
	$("#avatar").attr("value" , "avatar"+cur+".png");

});

$("#sleft").click(function(){
  if (cur+1 > max) 
      return false;
	
    cur++; 
   $(".block").animate({"left": "-=72px"}, "slow");
	
	$("#avatar").val("avatar"+cur+".png");
});
});

function uniqueUser(name)
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=uniqueUser&user='+name,
		success: function(data)
		{
			if($.trim(data) == "0")
			{
				valid = 0;
				$("#valid").val(valid);
				$("#name").html("<img src='../images/wrong.png' height='20' width='20'/>");
			}
			else
			{
				valid = 1;
				$("#valid").val(valid);
				$("#name").html("<img src='../images/tick.png' height='20' width='20'/>");
			}
		}
		
	});
}
</script>
</head>
<body>
<?php
if(isset($_REQUEST['name']))
{
?>
<script>

    deleteuser();

function deleteuser()
{
	var user = <?php echo "'" . $_REQUEST['name'] . "'" ;?>;
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=deleteUser&user='+user,				
	});
}
</script>
<?php
}
?>
<div id="container">
	<div style="margin-left:25%;">
		<img src="<?php echo SITE_URL ?>/images/logo.png" height='90' width='450'/>
	</div>
		<form method="post" action="<?php echo SITE_URL ?>/View/pageredirect.php">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td >
					<label>Your Name:</label><br /><input type="text" name="name" onkeyup="uniqueUser(this.value)" ></input>
					<label id="name"></label>
				</td>
			</tr>
			
			<tr>
				<td>
					<label>No. of Opponents:</label><br /><input type="text" name="opponent" ></input>
				</td>
			</tr>
			<tr>
				<td>
					<label>Win an Extra Chance on rolling a six!</label><br />
					<input type="radio" name="turn" value="Yes">Yes</input>
					<input type="radio" name="turn" Value="No">No</input>
				</td>
			</tr>
			<tr>
				<td>
					<label>Method of the Player Move!</label><br />
					<input type="radio" name="method" value="Automatic">Automatic</input>
					<input type="radio" name="method" value="Manual">Manual</input>
				</td>
			</tr>
			<tr>
				<td>
					<label>Number Of Dice</label><br />
					<select  name="dicecount">
					    <option  value="-1" selected=selected>---Choose---</option>
					    <option  value="1">1</option>
					    <option  value="2">2</option>
					</select>
				</td>
			</tr>
			
				</table>	
					<div style="margin-left:30%;width:60%;">
					<label>Choose Your Avatar!</label>
					<div class="total">
						<div class="slidepanel">
							<center><a id="sleft">&laquo;</a> <a id="sright">&raquo;</a></center>
								<div class="box-wrapper">
									<div class="block" id ="block1"><img src="<?php echo SITE_URL ?>/images/avatar1.png" height='70' width='70'/></div>
									<div class="block" id ="block2"><img src="<?php echo SITE_URL ?>/images/avatar2.png" height='70' width='70'/></div>
									<div class="block" id ="block3"><img src="<?php echo SITE_URL ?>/images/avatar3.png" height='70' width='70'/></div>
									<div class="block" id ="block4"><img src="<?php echo SITE_URL ?>/images/avatar4.png" height='70' width='70'/></div>
									<div class="block" id ="block5"><img src="<?php echo SITE_URL ?>/images/avatar5.png" height='70' width='70'/></div>
									<div class="block" id ="block6"><img src="<?php echo SITE_URL ?>/images/avatar6.png" height='70' width='70'/></div>
									<div class="block" id ="block7"><img src="<?php echo SITE_URL ?>/images/avatar7.png" height='70' width='70'/></div>
									<div class="block" id ="block8"><img src="<?php echo SITE_URL ?>/images/avatar8.png" height='70' width='70'/></div>
									<div class="block" id ="block9"><img src="<?php echo SITE_URL ?>/images/avatar9.png" height='70' width='70'/></div>
									<div class="block" id ="block10"><img src="<?php echo SITE_URL ?>/images/avatar10.png" height='70' width='70'/></div>
									<div class="block" id ="block11"><img src="<?php echo SITE_URL ?>/images/avatar11.png" height='70' width='70'/></div>
									<div class="block" id ="block12"><img src="<?php echo SITE_URL ?>/images/avatar12.png" height='70' width='70'/></div>
									<div class="block" id ="block13"><img src="<?php echo SITE_URL ?>/images/avatar13.png" height='70' width='70'/></div>
									<div class="block" id ="block14"><img src="<?php echo SITE_URL ?>/images/avatar14.png" height='70' width='70'/></div>
									<div class="block" id ="block15"><img src="<?php echo SITE_URL ?>/images/avatar15.png" height='70' width='70'/></div>
									<div class="block" id ="block16"><img src="<?php echo SITE_URL ?>/images/avatar16.png" height='70' width='70'/></div>
									<div class="block" id ="block17"><img src="<?php echo SITE_URL ?>/images/avatar17.png" height='70' width='70'/></div>
									<div class="block" id ="block18"><img src="<?php echo SITE_URL ?>/images/avatar18.png" height='70' width='70'/></div>
									<div class="block" id ="block19"><img src="<?php echo SITE_URL ?>/images/avatar19.png" height='70' width='70'/></div>
									<div class="block" id ="block20"><img src="<?php echo SITE_URL ?>/images/avatar20.png" height='70' width='70'/></div>								
							</div>
						</div>
					</div>
					
				<input type="hidden" name="avatar" id="avatar"></input>
				<input type="hidden" name="valid" id="valid"></input>
					<input type="submit" value="ok start"></input>
				
		</div>
		</form>
	</div>

</body>
</html>
