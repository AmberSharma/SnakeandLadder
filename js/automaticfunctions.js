var name = new Array() ;
var userpositions = new Array("0") ;
var useravatar = new Array() ;
var previousposition = new Array();
var attempt = 0;
var temp = 0;
var turntemp = 0;
var pos = 0;
var Timer1;
var user;
var turn;
var avatar;
var opponent;
var method;
var dicecount;
var message1 = "Ok Let's Start the Game!!!";
var message2 = "Waiting for Compatible Opponents to turn Up!!!";
var message3 = "Please Roll The dice Again!!!";
var message4 = "Oh Its a Snake!!!";
var message5 = "Hurray!!! Its a Ladder!!!";
var message6 = "Sorry!!! It total is Over hundred!!!";
var message7 = "Hurray!!! You Have Won!!!";
var message8 = "Sorry!!! You Have Lost!!!";
var message9 = "Hard Luck!!! The Sum is Over 100!!!";
var message10 = "Hurray!!! You Have Won!!! for Other Player Have left the game";
var pos = 0;
var firstturn = 0;
var printed = 0;
var previous = 0;
var Timer4;
var inside = 1;
var snakeface = new Array(17,54,62,64,87,93,95,98 );
var snakepath = {17: [5,6,7], 54:[53,48,47,34], 62:[58,42,43,38,22,23,18,19], 64:[63,58,59,60], 87:[74,67,55,45,36,24], 93:[88,89,72,73], 95:[96,85,86,75], 98:[82,83,78,79]};
var snaketail = new Array(7,34,19,60,24,73,75,79 );
var laddertail = new Array(1,4,9,21,28,51,71,80 );
var ladderface = new Array(38,14,31,42,84,67,91,100);
var ladderpath = {1:[19,22,38], 4:[5,15,14], 9:[12,30,31], 21:[39,42], 28:[34,47,55,65,76,84], 51:[52,68,67], 71:[90,91], 80:[81,100]};
var last;

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to assign a random number to a fetch group of users. 
	 It is called from either automatic.php or manual.php page after the required number of opponents are available and finalized.
   ------------------------------------------------------------------------------------------------------------------------------------
*/

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

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to fetch the user who is having the turn to roll the dice.
	 It is called from either automatic.php or manual.php page at regular interval.
   ------------------------------------------------------------------------------------------------------------------------------------
*/

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
				if(resp == null)
				{
					if (confirm(message10)) 
					{
						window.location.href="bendrules.php?name="+user;
					}
				}
				if(resp == user)
				{
					$("#die1").show();
					$("#die2").show();
					$("#dicerollbutton").show();
					$("#turn"+resp).html("<img src='../images/greenlight.png' height='20' width='20'/>");
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> It is Your Turn!!!</span>");
					$("#message").fadeOut(4000);
				}
				else
				{
					$("#turn"+resp).html("<img src='../images/greenlight.png' height='20' width='20'/>");
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> It is "+ resp +"'s Turn!!!</span>");
					$("#message").fadeOut(4000);
				}
				if(attempt == 0)
				{
					Timer3 = setInterval(getPosition, 4000);
					attempt = 1;
				}
			}
		}
		
	});
}

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to fetch the positions of all the opponents. 
	 It is called from either automatic.php or manual.php page at a regular time interval.
   ------------------------------------------------------------------------------------------------------------------------------------
*/

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


/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to set the turn for the first time to start the game. 
	 It is called from either automatic.php or manual.php page once the required opponents are available.
   ------------------------------------------------------------------------------------------------------------------------------------
*/
function setChance()
{
	$.ajax
	({
		type: "POST",
		url: '../controller/controller.php?method=setChance&users='+name,				
	});
}

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function call on roll dice anchor tag click. 
	 It is called 11 times with a counter increment each time.
	 Each time it calls another function generateroll which randomly fetches the dice generating a random number each time.
	 All the calculation about the game are performed in this function.
	 It assigns a position upto which a player has to move automatically.  
   ------------------------------------------------------------------------------------------------------------------------------------
*/

function animateRoll(times)
     {
        times = times || 1;
        
        var roll = generateRoll(dicecount);
        drawRoll(roll);
         
         if (times > 10)
         {
		var sum = checkRoll(roll);
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
				if(pos)
				{
					$(".player").html(" ");
				}
				
				if(firstturn)
				{
					if(dicecount == 1)
					{
						if((sum + pos + firstturn) <= 100)
						{
						
							Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
							last = (pos + sum + firstturn); 
							pos += (sum + firstturn);
						}
						else
						{
							firstturn = 0;
							Timer4 = setTimeout('func(' + (pos) + ')', 1000);
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message9 + " </span>");
							$("#message").fadeOut(8000);
							return;
						}
					}
					else
					{
							Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
							last = (pos + sum + firstturn); 
							pos += (sum + firstturn);
					}
					
				}
				else
				{
					if(dicecount == 1)
					{
						if((sum + pos) <= 100)
						{
							Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
							last = (pos + sum); 
							pos += sum;
						}
						else
						{
							Timer4 = setTimeout('func(' + (pos) + ')', 1000);
							$("#message").fadeIn();
							$("#message").html("<span class='bubble'>" + message9 + " </span>");
							$("#message").fadeOut(8000);
							return;
						}
					}
					else
					{
						Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
						last = (pos + sum); 
						pos += sum;
					}
					
				}
				for(var i = 0 ; i < snakeface.length ; i ++)
				{
					
					if(pos == snakeface[i])
					{
						
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message4 + " </span>");
						$("#message").fadeOut(8000);
						//previous = pos;
       						//setTimeout('func1('+ pos + ')', 1000);
    						pos = snaketail[i]; 
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can come down to " + pos + " position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				for(var i = 0 ; i < laddertail.length ; i ++)
				{
					if(pos == laddertail[i])
					{
						
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'>" + message5 + " </span>");
						$("#message").fadeOut(8000);
						//previous = pos;
       						//setTimeout('func2('+ pos + ')', 1000);
						pos = ladderface[i];
						$("#message").fadeIn();
						$("#message").html("<span class='bubble'> You can Move up to" + pos + "position</span>");
						$("#message").fadeOut(8000);
						turntemp = 1;
					}
				}
				if(turntemp == 0 )
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
				return;
			}
		}
		else
		{
			if(pos)
			{
				$(".player").html(" ");
			}
			if(dicecount == 1)
			{
				if((sum + pos) <= 100)
				{
					Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
					last = (pos + sum); 
					pos += sum;
				}
				else
				{
					Timer4 = setTimeout('func(' + (pos) + ')', 1000);
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>" + message9 + " </span>");
					$("#message").fadeOut(8000);
					return;
				}
			}
			else
			{
				Timer4 = setTimeout('func(' + (pos + 1) + ')', 1000);
				last = (pos + sum + firstturn); 
				pos += (sum + firstturn);
			}
			for(var i = 0 ; i < snakeface.length ; i ++)
			{
				
				if(pos == snakeface[i])
				{
					
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>" + message4 + " </span>");
					$("#message").fadeOut(8000);
					//previous = pos;
					//setTimeout('func1('+ pos + ')', 1000);
					pos = snaketail[i]; 
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> You can come down to " + pos + " position</span>");
					$("#message").fadeOut(8000);
					turntemp = 1;
				}
			}
			for(var i = 0 ; i < laddertail.length ; i ++)
			{
				if(pos == laddertail[i])
				{
					
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'>" + message5 + " </span>");
					$("#message").fadeOut(8000);
					//previous = pos;
					//setTimeout('func2('+ pos + ')', 1000);
					pos = ladderface[i];
					$("#message").fadeIn();
					$("#message").html("<span class='bubble'> You can Move up to" + pos + "position</span>");
					$("#message").fadeOut(8000);
					turntemp = 1;
				}
			}
			if(turntemp == 0 )
			{
				$("#message").fadeIn();
				$("#message").html("<span class='bubble'>Please Move " + sum + " positions Forward </span>");
				$("#message").fadeOut(8000);
				
			}
			return;
		}
               
          }
         
         setTimeout('animateRoll(' + (times + 1) + ')', 200);
     }

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to move the player one position at a time untill the final position is reached.  
	 It hide the player at previous position every time it moves forward. 
   ------------------------------------------------------------------------------------------------------------------------------------
*/

function func(attempt)
{
	if(attempt <= last)
	{
		$("#"+(attempt-1)).html("");
		$("#"+attempt).html("<img src='../images/"+avatar+"' height='30' width='30'/>");
		Timer4 = setTimeout('func(' + (attempt + 1) + ')', 500);
	}
	else
	{

		for(var i = 0 ; i < snakeface.length ; i ++)
		{
			if(last == snakeface[i])
			{
				$("#"+last).html("");	
				func1(last);
				inside = 0 ;
				break;	
				
			}
		}

		for(var i = 0 ; i < laddertail.length ; i ++)
		{
			if(last == laddertail[i])
			{
				$("#"+(last)).html("");		
				func2(last);
				inside = 0 ;
				break;
				
			}
		}
		if(inside == 1)
		{
			$.ajax
			({
				type: "POST",
				url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+last,				
				success:function(data)
				{
					if($.trim(data) == 1)
					{
						$("#die1").hide();
						$("#die2").hide();
						$("#dicerollbutton").hide();
					}
				}				
			});
			if(last >= 100)
			{
				if (confirm(message7)) 
				{
					window.location.href="bendrules.php?name="+user;
				}
			}
			setChance();
		}
		inside = 1;
	}
}

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to move player through the snake path from head to tail.
   ------------------------------------------------------------------------------------------------------------------------------------
*/
function func1(pos)
{
	snake = snakepath[pos];
	if(printed != snake.length)
	{
		$("#"+previous).html("");
		$("#"+snake[printed]).html("<img src='../images/"+avatar+"' height='30' width='30'/>");
		previous = snake[printed] ;
		printed ++ ;
		setTimeout('func1(' + pos + ')', 500);
	}
	else
	{
		last = snake[printed -  1] ;
		
		$.ajax
		({
			
			type: "POST",
			url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+last,				
			success:function(data)
			{
				if($.trim(data) == 1)
				{
					$("#die1").hide();
					$("#die2").hide();
					$("#dicerollbutton").hide();
				}
			}				
		});
		setChance();
		if(last >= 100)
		{
			if (confirm(message7)) 
			{
				window.location.href="bendrules.php?name="+user;
			}
		}
		printed = 0;
	}
}

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to move player through the ladder path from tail to head.
   ------------------------------------------------------------------------------------------------------------------------------------
*/
function func2(pos)
{
	ladder = ladderpath[pos];
	if(printed != ladder.length)
	{
		$("#"+previous).html("");
		$("#"+ladder[printed]).html("<img src='../images/"+avatar+"' height='30' width='30'/>");
		previous = ladder[printed] ;
		printed ++ ;
		setTimeout('func2(' + pos + ')', 500);
	}
	else
	{
		last = ladder[printed - 1] ; 
		
		$.ajax
			({
				type: "POST",
				url: '../controller/controller.php?method=updateUserPosition&users='+name+"&user="+user+"&pos="+last,				
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
			setChance();
			if(last >= 100)
			{
				if (confirm(message7)) 
				{
					window.location.href="bendrules.php?name="+user;
				}
			}
			printed = 0;
	}
	
}

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to generate random number for the specified number of dice.. 
	 It returns an array for counting to the number of dices. 
   ------------------------------------------------------------------------------------------------------------------------------------
*/
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

/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to show the dice image for each random number. 
	 It show the specified dice image for every array index.
   ------------------------------------------------------------------------------------------------------------------------------------
*/

     function drawRoll(die)
     {
	for(var i = 0 ; i < die.length ; i ++)
	{
		var j = i + 1;
		document.getElementById('die'+(j)).innerHTML = '<img src="../images/Dice_' + die[i] +'.png" />';
	}
         
         <!-- document.getElementById('die2').innerHTML = '<img src="../images/Dice_' + die2 +'.png" />'; -->
     }


/* 
   ------------------------------------------------------------------------------------------------------------------------------------
         Function to calculate the sum of all the dices. 
   ------------------------------------------------------------------------------------------------------------------------------------
*/
     function checkRoll(die)
     {
	var sum = 0;
	for(var i = 0 ; i < die.length ; i ++)
	{
		sum += 	die[i];
	}
         return sum;
     }  
