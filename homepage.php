<?php require_once "/var/www/SnakeandLadder/trunk/libraries/constant.php"; ?>
<script src="<?php echo SITE_URL;?>/js/jquery.tools.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/homepage.css">
<html>
<head>

<style>
/* the overlayed element */

</style>
</head>
<body>
<div id="container">
<div style="width:10%"><a href="<?php echo SITE_URL ?>/View/bendrules.php" style="margin-left:20%;"><img src="images/bendrules.jpg" height='150' width='50'/></a></div>
<table cellspacing="0">
<tr>
<td>
<a href="<?php echo SITE_URL ?>/View/bendrules.php"><img src="images/startgame.jpg" height='60' width='220'/></a>
</td>

</tr>
<tr>
<td>
<a href="#" ><img src="images/gamerules.jpg" rel="#mies1" height='60' width='220'/></a>
</td>

</tr>
</table>
</div>
<div class="simple_overlay" id="mies1">
<img src="images/therules.jpg" width='400' height='500'/>
<div class="details">
<pre>
<br />
<br />
<br />
Step 1: The chits are thrown and all 4 people have
to pick one chit each.
Lets say the 4 people are A,B,C,D.
All 4 pick up one chit each. 
Step 2: They have to keep it secret that which chit
they picked.
Assume:
A picks Raja
B picks Mantri
C picks Sipahi
D picks chor
Step 3: A says mera mantra kaun? 
Step 4: B says Mein sarkar 
Step 5: A says chor sipahi ka pata lagao 
Step 6: At this point,
B has to guess who between C and D is chor and who
is sipahi by doing some sort of face reading but mainly
its all guess and luck work.
Step 7: Lets say B guesses it wrong.
Step 8: In this case the thief gets 500 points and 
assistant (mantri) will get 0 points.
</pre>
  </div>
</div>
</body>
</html>
<script>
  $("img[rel]").overlay();
</script>
