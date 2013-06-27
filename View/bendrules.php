<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php"; ?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<html>
<head>
<script>
$(document).ready(function() {

var cur = 1;
var max = $(".box-wrapper div").length;


$("#sright").click(function(){
    if (cur == 1 && cur < max)
        return false;
	
       cur--;
     $(".block").animate({"left": "+=24.9%"}, "slow");
	
	$("#avatar").attr("value" , "avatar"+cur+".png");

});

$("#sleft").click(function(){
  if (cur+1 > max) 
      return false;
	
    cur++; 
   $(".block").animate({"left": "-=24.9%"}, "slow");
	
	$("#avatar").val("avatar"+cur+".png");
});
});
</script>

<style>
label
{
	color:#FFFFFF;
	font-size:11px;
}
table td
{
color:#FFFFFF;
font-size:11px;
}
.total
{
height:30%;
width:60%;
margin-left:15%;
margin-right:auto;
}
.slidepanel
{
width:100%;
height:100%;
overflow-x: hidden;
overflow-y: hidden;
border:1px solid blue;
}
.box-wrapper 
{
width: 400%;
height: 100%;
overflow: hidden;

}

.block
{
width:24.9%;
height:90%;
float:left;
position:relative;
left:0px;
}
a
{
text-decoration:none;
}
table
{
margin-top:1%;
margin-left:26%;
width:500px;
height:50px;

}
table td
{
	border:1px solid red;
}

#container
{
	border:1px solid green;
	background-image:url(<?php echo SITE_URL .'/images/bg.jpg' ?>);
	background-repeat:no-repeat;
	background-size:668px 475px;
	background-color: transparent;
  	box-shadow: 40px 40px 100px 40px #000;
	margin-top:10%;
	margin-left:25%;
	height:475px;
	width:670px;
}
html { 
    background: url(<?php echo SITE_URL .'/images/backgroundimage.jpg' ?>) no-repeat center center fixed #000; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
center
{
	border:1px solid blue;
}
</style>

</head>
<body>
<?php
if(isset($_REQUEST['user']))
{
?>
<script>

    deleteuser();

function deleteuser()
{
	var user = <?php echo "'" . $_REQUEST['user'] . "'" ;?>;
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
				<td>
					<label>Your Name:</label><br /><input type="text" name="name" ></input>
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
			
				</table>	
					<div style="margin-left:26%;width:60%;">
					<label>Choose Your Avatar!</label>
					<div class="total">
						<div class="slidepanel">
							<center><a id="sleft">&laquo;</a> <a id="sright">&raquo;</a></center>
								<div class="box-wrapper">
									<div class="block" id ="block1"><img src="<?php echo SITE_URL ?>/images/avatar1.png" height='100' width='100'/></div>
									<div class="block" id ="block2"><img src="<?php echo SITE_URL ?>/images/avatar2.png" height='100' width='100'/></div>
									<div class="block" id ="block3"><img src="<?php echo SITE_URL ?>/images/avatar3.png" height='100' width='100'/></div>
									<div class="block" id ="block4"><img src="<?php echo SITE_URL ?>/images/avatar4.png" height='100' width='100'/></div>
									<div class="block" id ="block5"><img src="<?php echo SITE_URL ?>/images/avatar5.png" height='100' width='100'/></div>
									<div class="block" id ="block6"><img src="<?php echo SITE_URL ?>/images/avatar6.png" height='100' width='100'/></div>
									<div class="block" id ="block7"><img src="<?php echo SITE_URL ?>/images/avatar7.png" height='100' width='100'/></div>
									<div class="block" id ="block8"><img src="<?php echo SITE_URL ?>/images/avatar8.png" height='100' width='100'/></div>
									<div class="block" id ="block9"><img src="<?php echo SITE_URL ?>/images/avatar9.png" height='100' width='100'/></div>
									<div class="block" id ="block10"><img src="<?php echo SITE_URL ?>/images/avatar10.png" height='100' width='100'/></div>
									<div class="block" id ="block11"><img src="<?php echo SITE_URL ?>/images/avatar11.png" height='100' width='100'/></div>
									<div class="block" id ="block12"><img src="<?php echo SITE_URL ?>/images/avatar12.png" height='100' width='100'/></div>
									<div class="block" id ="block13"><img src="<?php echo SITE_URL ?>/images/avatar13.png" height='100' width='100'/></div>
									<div class="block" id ="block14"><img src="<?php echo SITE_URL ?>/images/avatar14.png" height='100' width='100'/></div>
									<div class="block" id ="block15"><img src="<?php echo SITE_URL ?>/images/avatar15.png" height='100' width='100'/></div>
								</div>
						</div>
					</div>
					
				<input type="hidden" name="avatar" id="avatar"></input>
					<input type="submit" value="ok start"></input>
				
		</div>
		</form>
	</div>

</body>
</html>
