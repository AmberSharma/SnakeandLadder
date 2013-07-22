var name = new Array() ;
var userpositions = new Array("0") ;
var useravatar = new Array() ;
var previousposition;
var attempt = 0;
var temp = 0;
var turntemp = 0;
var dicecount;
var Timer1;
var user;
var turn;
var avatar;
var opponent;
var method;
var message1 = "Ok Let's Start the Game!!!";
var message2 = "Waiting for Compatible Opponents to turn Up!!!";
var message3 = "Please Roll The dice Again!!!";
var message4 = "Oh Its a Snake!!!";
var message5 = "Hurray!!! Its a Ladder!!!";
var message6 = "Sorry!!! It total is Over hundred!!!";
var message7 = "Hurray!!! You Have Won!!!";
var message8 = "Sorry!!! You Have Lost!!!";
var message9 = "Hard Luck!!! The Sum is Over 100!!!";
var message10 = "Just drop your player to 100 Position";
var pos = 0;
var place = 0;
var firstturn = 0;
var userpositions = new Array("0") ;
var useravatar = new Array() ;
var previousposition = new Array();
var snakeface = new Array(17,54,62,64,87,93,95,98 );
var snaketail = new Array(7,34,19,60,24,73,75,79 );
var laddertail = new Array(1,4,9,21,28,51,71,80 );
var ladderface = new Array(38,14,31,42,84,67,91,100 );
var dice2overhundred = 1;


function animateRoll(times)
{
	times = times || 1;
         var roll = generateRoll(dicecount);
        drawRoll(roll);
        if (times > 10)
        {
		var sum = checkRoll(roll);
		$("#"+place).removeClass("droppable ui-droppable ui-state-highlight").addClass("draggable");
		if(turn == 'Yes')
		{
			if(sum == 6)
			{
				firstturn += sum ; 
				$("#message").fadeIn();
				$("#message").html("<span class='bubble'>" + message3 + " </span>");
				$("#message").fadeOut(8000);
				return ;
			}
			else
			{
				if(firstturn)
				{
					if(dicecount == 1)
					{
						if((sum + place + firstturn) <= 100)
						{
							last = (place + sum + firstturn); 
							place = place +  (sum + firstturn);
						}
						else
						{
							firstturn = 0;
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message9 + " </span>");
							$("#message").fadeOut(8000);
							updateUser();
							return;
						}
					}
					else
					{
						if((sum + place + firstturn) > 100)
						{
							last = 100;
							place = 100;
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message10 + " </span>");
							$("#message").fadeOut(8000);
							dice2overhundred = 0;
							
						}
						else
						{
							last = (place + sum + firstturn); 
							place = place +  (sum + firstturn);
						}
						
						
					}
				}
				else
				{
					if(dicecount == 1)
					{
						if((place + sum) <= 100)
						{
							last = (place + sum); 
							place = place + sum;
						}
						else
						{
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message9 + " </span>");
							$("#message").fadeOut(8000);
							updateUser();
							return;
						}
					}
					else
					{
						if((sum + place) > 100)
						{
							last = 100;
							place = 100;
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message10 + " </span>");
							$("#message").fadeOut(8000);
							dice2overhundred = 0;
							
						}
						else
						{
							last = (place + sum + firstturn); 
							place = place +  (sum + firstturn);
						}
					}
					
				}
				
				for(var i = 0 ; i < snakeface.length ; i ++)
				{
					if(place == snakeface[i])
					{
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message4 + " </span>");
						$("#message").fadeOut(8000);
						place = snaketail[i];
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can come down to " + place + " position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				for(var i = 0 ; i < laddertail.length ; i ++)
				{
					if(place == laddertail[i])
					{
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message5 + " </span>");
						$("#message").fadeOut(8000);
						place = ladderface[i];
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can Move up to" + place + "position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				if(turntemp == 0  && dice2overhundred != 0)
				{
					$("#message").fadeIn();
					if(firstturn)
					{
						$("#message").html("<span class='bubble'>Please Move " + (firstturn + sum) + " positions Forward </span>");
					}
					else
					{
						$("#message").html("<span class='bubble'>Please Move " + sum + " positions Forward </span>");
					}
					$("#message").fadeOut(8000);
				}
				firstturn = 0;
				dice2overhundred = 1;
				$("#"+place).attr("class" , "droppable");
				$( ".draggable" ).draggable({ revert: "valid" });
				$( ".draggable2" ).draggable({ revert: "invalid" });
				$( ".droppable" ).droppable
				({
					activeClass: "ui-state-hover",
					hoverClass: "ui-state-active",
					drop: function( event, ui ) 
					{
						$( this ).addClass( "ui-state-highlight" )
						var position = this.id;
						$.ajax
						({
							type: "POST",
							url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+position,				
							success:function(data)
							{
								if($.trim(data) == "1")
								{
									
									$("#die1").hide();
									$("#die2").hide();
									$("#dicerollbutton").hide();
								}
							}				
						});
						if(position >= 100)
						{
							if (confirm(message7)) 
							{
								window.location.href="bendrules.php?name="+user;
							}
						}
		
					}
				});
			        return;
			}
		}
		else
		{
			if(dicecount == 1)
			{
				if((sum + place) <= 100)
				{
					last = (place + sum); 
					place = place + sum;
				}
				else
				{
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>" + message9 + " </span>");
					$("#message").fadeOut(8000);
					updateUser();
					return;
				}
			}
			else
			{
				if((sum + place) > 100)
				{
					last = 100;
					place = 100;
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>" + message10 + " </span>");
					$("#message").fadeOut(8000);
					dice2overhundred = 0;
					
				}
				else
				{
					last = (place + sum + firstturn); 
					place = place +  (sum + firstturn);
				}
				
				
			}
			
			if(place <= 100)
			{
				for(var i = 0 ; i < snakeface.length ; i ++)
				{
					if(place == snakeface[i])
					{
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message4 + " </span>");
						$("#message").fadeOut(8000);
						place = snaketail[i];
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can come down to " + place + " position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				for(var i = 0 ; i < laddertail.length ; i ++)
				{
					if(place == laddertail[i])
					{
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message5 + " </span>");
						$("#message").fadeOut(8000);
						place = ladderface[i];
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can Move up to" + place + "position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				if(turntemp == 0  && dice2overhundred != 0)
				{
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>Please Move " + sum + " positions Forward </span>");
					$("#message").fadeOut(8000);
				}
				dice2overhundred = 1;
				$("#"+place).attr("class" , "droppable");
				$( ".draggable" ).draggable({ revert: "valid" });
				$( ".draggable2" ).draggable({ revert: "invalid" });
				$( ".droppable" ).droppable
				({
					activeClass: "ui-state-hover",
					hoverClass: "ui-state-active",
					drop: function( event, ui ) 
					{
						var position = this.id;
						
						$.ajax
						({
							type: "POST",
							url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+position,				
							success:function(data)
							{
								if($.trim(data) == "1")
								{
									$("#die1").hide();
									$("#die2").hide();
									$("#dicerollbutton").hide();
								}
							}				
						});
						if(position >= 100)
						{
							if(confirm(message7))
							{
								window.location.href= "bendrules.php?name="+user;
							}
						}
	
					}
				});
				return;
			}
			
		}
	}
	setTimeout('animateRoll(' + (times + 1) + ')', 200);
}

function generateRoll(dice)
{
var arr = new Array();
 <!-- return [ Math.floor(Math.random()*6) + 1, Math.floor(Math.random()*6) + 1 ]; -->
for(var i = 0 ; i < dice ; i ++)
{
	arr[i] = Math.floor(Math.random()*6) + 1 ; 
}	
return arr;
}

function drawRoll(die)
{
for(var i = 0 ; i < die.length ; i ++)
{
	var j = i + 1;
	document.getElementById('die'+(j)).innerHTML = '<img src="../images/Dice_' + die[i] +'.png" />';
}
 
 <!-- document.getElementById('die2').innerHTML = '<img src="../images/Dice_' + die2 +'.png" />'; -->
}

function checkRoll(die)
{
var sum = 0;
for(var i = 0 ; i < die.length ; i ++)
{
	sum += 	die[i];
}
 return sum;
}    


function fetchUser()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=fetchUser&user='+user+"&turn="+turn+"&avatar="+avatar+"&opponent="+opponent+"&method1="+method+"&dice="+dicecount,
		success: function(data)
		{
			if($.trim(data) != "1")
			{
				var resp=jQuery.parseJSON($.trim(data));
				var k = 0 ;  
				$.each(resp, function(key, val) 
				{
					temp = 1;
					if(key % 2 == 0)
					{
						name[k] = val;
						k ++;
					}
					else
					{
						$("#"+user).append("<img src='../images/"+ val + "' height='50' width='50' id='"+ name[key - 1] +"'/>");
					}
				});
			}
			else
			{
				$("#message").fadeIn();
				$("#message").html("<span class='bubble'>"+ message2 +"</span>");
				$("#message").fadeOut(4000);
			}
		},
		complete:function()
		{	
			if(temp == 1)
			{
				$("#message").html("<span class='bubble'>"+ message1 +"</span>");
				$("#message").fadeOut(8000);
				clearInterval(Timer1);
				name[opponent] = user;
				var a = ' ';
				a += "<table border='1'>"; 
				for(var i = 0 ; i < name.length ; i ++)
				{
					var j = i + 1; 
					
					a += "<tr>";
					a += "<td id='turn" + name[i] + "' class='userportion'>";
					a += "</td>";
					a += "<td id='user" + j + "' class='userportion'>";
					a += name[i];
					a += "</td>";
					a += "</tr>";
					
					
				}
				a += "</table>";
				$("#users").append(a);
				$.ajax
				({
					type: "POST",
					url: '../controller/controller.php?method=updateUser&users='+name,
					success:function(data)
					{
						if($.trim(data) == "1")
						{
							setChance();
							Timer2 = setInterval(getChance, 5000);
						}
						if($.trim(data) == "-1")
						{
							Timer2 = setInterval(getChance, 5000);
						}
					}
				});
			}
		}
		
	});
}

function getChance()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=getChance',
		success: function(data)
		{
			for(var i = 0 ; i < name.length ; i ++)
			{
				$("#turn"+name[i]).html("<img src='../images/redlight.png' height='20' width='20'/>");
			}
			if($.trim(data) != "-1")
			{
				
				var resp=jQuery.parseJSON($.trim(data));
				if(resp == user)
				{
					$("#die1").show();
					$("#die2").show();
					$("#dicerollbutton").show();
					$("#turn"+resp).html("<img src='../images/greenlight.png' height='20' width='20'/>");
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> It is Your Turn!!!</span>");
					$("#message").fadeOut(8000);
				}
				else
				{
					$("#turn"+resp).html("<img src='../images/greenlight.png' height='20' width='20'/>");
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> It is "+ resp +"'s Turn!!!</span>");
					$("#message").fadeOut(8000);
				}
				if(attempt == 0)
				{
					Timer3 = setInterval(getPosition, 8000);
					attempt = 1;
				}
			}
		}
		
	});
}

function getPosition()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=getPosition&user='+user,
		success: function(data)
		{
			if($.trim(data) != "-1")
			{
				var usernames = new Array();
				var resp=jQuery.parseJSON($.trim(data));
				var ua = 0;
				var un = 0;
				var up = 0;
				$.each(resp, function(key, val) 
				{
					if(key % 3 == 0)
					{
						usernames[un] = val;
						un ++; 
					}
					else if(key % 3 == 1)
					{
						useravatar[ua] = val;
						ua ++; 
					}
					else
					{
						userpositions[up] = val;
						if(userpositions[up] >=  100)
						{
							if (confirm(message8)) 
							{
								clearInterval(Timer2);
								clearInterval(Timer3);
								window.location.href= "bendrules.php?name="+user;
							}
						}
						if(userpositions[up] != -1)
						{
							if(typeof previousposition[usernames[un - 1]] !== 'undefined')
							$("#"+previousposition[usernames[un - 1]]).html(" ");
						}
						$("#"+ val).html("<img src='../images/"+ useravatar[ua - 1] + "' height='50' width='50' id='"+usernames[un - 1]+"' />");
						previousposition[usernames[un - 1]] = val;
						up ++;
					}
				});
				
			}
		}
		
	});
}
function setChance()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=setChance&users='+name,				
	});
}
function updateUser()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+place,				
		success:function(data)
		{
			if($.trim(data) == "1")
			{
				$("#die1").hide();
				$("#die2").hide();
				$("#dicerollbutton").hide();
			}
		}				
	});
}
