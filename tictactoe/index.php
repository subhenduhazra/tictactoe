<?php 
///////////////////////////////////////////////////////////////
///Remember Computer is always player 2/////////////////////////
///////////////////////////////////////////////////////////////
session_start();

if(isset($_SESSION['play']['tictactoe']['player']) && !empty($_SESSION['play']['tictactoe']['player'])){
	if(isset($_SESSION['play']['tictactoe']['player_name']) && !empty($_SESSION['play']['tictactoe']['player_name'])){
		/**********************************************************************************************************************/
		if(isset($_SESSION['play']['tictactoe']['play_success']) && !empty($_SESSION['play']['tictactoe']['play_success'])){
			if(strtolower($_SESSION['play']['tictactoe']['play_success'])=="success"){
				header("location:newgame.php");
			}else{
				
			}
		}else{
			header("location:newgame.php");
		}
		/**********************************************************************************************************************/

		
		if(isset($_SESSION['play']['tictactoe']['sign']) && !empty($_SESSION['play']['tictactoe']['sign'])){
			
			
		}else{
			header("location:set_sign.php");
		}
	}else{
		header("location:set_player_name.php");
	}

}else{
	header("location:set_player.php");
}


?>

<body>
<?php include "header.php"; ?>
<style>
html{
	position: relative;
    min-height: 100%;
}
#main{
    min-width:200px;
    width:60%;
    margin:20px auto;
    /*border:1px solid red;*/
    height:60%;
}
#main_container{
    width:100%;
    height:80%;
    text-align:center;
    /*border:1px solid blue;*/
   
    
}
#main_container #inner_main_container{
	padding:20px;
	width:100%;
	
}
#main_container  [id*=dv_r]{
   
   display:block;
}
#main_container .ipt{
   
    /*min-width:50px;
    min-height:50px;*/
    width:30%;
    height:30%;
    margin:0px;
    padding:0px;

}
#main_container .ipt_inner{
	font-size:40px;
	padding:14px;
}
#main_container .r1,#main_container .r2,#main_container .r3{
    display:inline-block;
    float:left;
}
#main #turn_indicator{
	font-size:25px;
	font-weight:bold;
	color:red;
}
#main .match_header{
	display:inline-block;
	font-size:17px;
	padding:0px 20px 0px 20px;
}
</style>
   
    <div id="main">
    	<div class="match_header">
			<?php
				if($_SESSION['play']['tictactoe']['player']=="pvc"){
					echo $_SESSION['play']['tictactoe']['player_name']." Vs ".$_SESSION['play']['computer']['name'];
				}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
					echo $_SESSION['play']['tictactoe']['player_name']." Vs ".$_SESSION['play']['tictactoe']['player2_name'];
				}else{
					echo "-";
				}
			?>
		</div>
    	<div  class="match_header">
			<?php 
				if($_SESSION['play']['tictactoe']['player']=="pvc"){
					echo $_SESSION['play']['tictactoe']['player_name']." : ".$_SESSION['play']['tictactoe']['sign'];
					echo " | ";
					echo $_SESSION['play']['computer']['name']." : ".$_SESSION['play']['tictactoe']['sign2'];
					
				}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
					echo $_SESSION['play']['tictactoe']['player_name']." : ".$_SESSION['play']['tictactoe']['sign'];
					echo " | ";
					echo $_SESSION['play']['tictactoe']['player2_name']." : ".$_SESSION['play']['tictactoe']['sign2'];
				}else{
					echo "-";
				}
			?>
		</div>
		
		<div class="match_header">
			Play: <?php echo $_SESSION['play']['tictactoe']['how_many_times']; ?>
		</div>
		
		<div id="turn_indicator">
			<?php 
				if($_SESSION['play']['tictactoe']['player']=="pvc"){
					if($_SESSION['play']['tictactoe']['first_turn']=="p1"){
						echo $_SESSION['play']['tictactoe']['player_name'];
					}else{
						echo $_SESSION['play']['computer']['name'];
					}
				}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
					if($_SESSION['play']['tictactoe']['first_turn']=="p1"){
						echo $_SESSION['play']['tictactoe']['player_name'];
					}else{
						echo $_SESSION['play']['tictactoe']['player2_name'];
					}
				}else{
					
				}
				
			?>'s turn
		</div>
		
		<div>
			
		</div>
        <div id="main_container">
        <div id="inner_main_container">
            <div id="dv_r1">
				
                <div id="input_1" class="ipt r1" onclick="turnGiven(this)" style="border-right:2px solid black;border-bottom:2px solid black;">
				<div class="ipt_inner">
                	&nbsp;
                </div>
				</div>
                
                <div id="input_2" class="ipt r1" onclick="turnGiven(this)" style="border-right:2px solid black;border-bottom:2px solid black;border-left:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
                <div id="input_3" class="ipt r1" onclick="turnGiven(this)" style="border-bottom:2px solid black;border-left:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
            </div>
            
            
            <div id="dv_r2">
            
                <div id="input_4" class="ipt r2" onclick="turnGiven(this)" style="border-right:2px solid black;border-bottom:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
                <div id="input_5" class="ipt r2" onclick="turnGiven(this)" style="border-right:2px solid black;border-bottom:2px solid black;border-left:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
                <div id="input_6" class="ipt r2" onclick="turnGiven(this)" style="border-bottom:2px solid black;border-left:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
            </div>
            
            
            <div  id="dv_r3">
            
                <div id="input_7" class="ipt r3" onclick="turnGiven(this)" style="border-right:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
                <div id="input_8" class="ipt r3" onclick="turnGiven(this)" style="border-right:2px solid black;border-left:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
                <div id="input_9" class="ipt r3" onclick="turnGiven(this)" style="border-left:2px solid black;border-top:2px solid black;">
                <div class="ipt_inner">
                	&nbsp;
                </div>
                </div>
                
            </div>
        </div>
        </div>
		
    </div>
    
    <script>
	<?php
		if(strtolower($_SESSION['play']['tictactoe']['play_success'])=="playing"){
			for($i=1;$i<=9;$i++){
				if(isset($_SESSION['play']['tictactoe']['table'][$i])){
					
					echo 'document.querySelector("#input_'.$i.' .ipt_inner").innerText="'.$_SESSION['play']['tictactoe']['table'][$i].'";';
				}
			}
		}
	
		if($_SESSION['play']['tictactoe']['player']=="pvc" && $_SESSION['play']['tictactoe']['current_turn']=="p2"){
			echo "
				window.addEventListener('load',take_comp_turn,false);
				
			";
		}
	?>
	
	<?php 
	
	if($_SESSION['play']['tictactoe']['player']=="pvp"){
	?>
    	function turnGiven(obj){
    		request=new XMLHttpRequest();
			request.open("GET","game.php?sel="+obj.id.substr(6,1),true);
			request.onreadystatechange=getResponse;
			request.send();
			//document.querySelector("#turn_indicator").innerText="Loading ...";
    	}
		function finallyWin(){
			document.querySelector("#main_container").innerHTML="<div><div style='font-size:35px;color:green;'>"+request.responseText.substr(10)+"</div><a href='newgame.php'>New Game</a></div>";
		}
    	function getResponse(){
    		if(request.status==200 && request.readyState==4){
				//alert(request.responseText);
				if(request.responseText.substr(0,3)=="WIN"){
					document.querySelector("#input_"+request.responseText.substr(4,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(5,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(6,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(8,1)+" .ipt_inner").innerText=request.responseText.substr(9,1);
					document.querySelector("#turn_indicator").innerText=request.responseText.substr(10);
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					
					setTimeout(finallyWin,1500);
				}else if(request.responseText.substr(0,5)=="NOWIN"){
					//alert(request.responseText.substr(6));
					document.querySelector("#input_"+request.responseText.substr(7,1)+" .ipt_inner").innerText=request.responseText.substr(8,1);
					document.querySelector("#turn_indicator").innerText=request.responseText.substr(9);
					
				}else if(request.responseText.substr(0,4)=="DRAW"){
					document.querySelector("#input_"+request.responseText.substr(6,1)+" .ipt_inner").innerText=request.responseText.substr(7,1);
					//alert(request.responseText.substr(6,1));
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					document.querySelector("#turn_indicator").innerText="Match Draw";
				}else{
					
				}
			}
    	}
		
	<?php
	}  ///////////////////////////end of pvp/////////////////////////////////
	?>
	
	<?php
	if($_SESSION['play']['tictactoe']['player']=="pvc"){
	?>
		function turnGiven(obj){
    		request=new XMLHttpRequest();
			request.open("GET","game.php?sel="+obj.id.substr(6,1),true);
			request.onreadystatechange=getResponse;
			request.send();
			//document.querySelector("#turn_indicator").innerText="Loading ...";
    	}
		function finallyWin(){
			document.querySelector("#main_container").innerHTML="<div><div style='font-size:35px;color:green;'>"+wintext+"</div><a href='newgame.php'>New Game</a></div>";
		}
		function getResponse(){
			if(request.status==200 && request.readyState==4){
				//alert(request.responseText);
				if(request.responseText.substr(0,3)=="WIN"){
					document.querySelector("#input_"+request.responseText.substr(4,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(5,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(6,1)).style.background="pink";
					document.querySelector("#input_"+request.responseText.substr(8,1)+" .ipt_inner").innerText=request.responseText.substr(9,1);
					document.querySelector("#turn_indicator").innerText=request.responseText.substr(10);
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					
					wintext=request.responseText.substr(10);
					setTimeout(finallyWin,1500);
				}else if(request.responseText.substr(0,5)=="NOWIN"){
					//alert(request.responseText.substr(6));
					document.querySelector("#input_"+request.responseText.substr(7,1)+" .ipt_inner").innerText=request.responseText.substr(8,1);
					if(request.responseText.substr(9,7)=="LETCOMP"){
						document.querySelector("#turn_indicator").innerText=request.responseText.substr(16);
						take_comp_turn();
					}else{
						document.querySelector("#turn_indicator").innerText=request.responseText.substr(9);
					}
					
					
				}else if(request.responseText.substr(0,4)=="DRAW"){
					document.querySelector("#input_"+request.responseText.substr(6,1)+" .ipt_inner").innerText=request.responseText.substr(7,1);
					//alert(request.responseText.substr(6,1));
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					document.querySelector("#turn_indicator").innerText="Match Draw";
				}else{
					
				}
			}
		}
		function take_comp_turn(){
			setTimeout(sendRequestForComputer,1000);
			
		}
		function sendRequestForComputer(){
			
			playRequest=new XMLHttpRequest()
			playRequest.open("GET","game.php?pfc=1",true);
			playRequest.onreadystatechange=getPlayRequestResponse;
			playRequest.send();
			//document.querySelector("#turn_indicator").innerText="Computer is taking turn ...";
		}
		function getPlayRequestResponse(){
			if(playRequest.status==200 && playRequest.readyState==4){
				//alert(playRequest.responseText);
				if(playRequest.responseText.substr(0,3)=="WIN"){
					document.querySelector("#input_"+playRequest.responseText.substr(4,1)).style.background="pink";
					document.querySelector("#input_"+playRequest.responseText.substr(5,1)).style.background="pink";
					document.querySelector("#input_"+playRequest.responseText.substr(6,1)).style.background="pink";
					document.querySelector("#input_"+playRequest.responseText.substr(8,1)+" .ipt_inner").innerText=playRequest.responseText.substr(9,1);
					document.querySelector("#turn_indicator").innerText=playRequest.responseText.substr(10);
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					
					wintext=playRequest.responseText.substr(10);
					setTimeout(finallyWin,1500);
				}else if(playRequest.responseText.substr(0,5)=="NOWIN"){
					//alert(playRequest.responseText.substr(6));
					document.querySelector("#input_"+playRequest.responseText.substr(7,1)+" .ipt_inner").innerText=playRequest.responseText.substr(8,1);
					document.querySelector("#turn_indicator").innerText=playRequest.responseText.substr(9);
					
					
				}else if(playRequest.responseText.substr(0,4)=="DRAW"){
					document.querySelector("#input_"+playRequest.responseText.substr(6,1)+" .ipt_inner").innerText=playRequest.responseText.substr(7,1);
					//alert(playRequest.responseText.substr(6,1));
					document.querySelector("#ng58 div").innerText="New game";
					document.querySelector("#ng58").href="newgame.php";
					document.querySelector("#turn_indicator").innerText="Match Draw";
				}else{
					
				}
			}
		}
	<?php
	}
	?>
    </script>
	
	
<div id="footer_blank_0032">&nbsp;</div>
<?php
///////////////////////////////////////////////include footer/////////////////////////////////////////////////////
include  "footer.php";
?>
<style>

#hb_game_footer{
	position:absolute;
	bottom:0px;
	z-index:80;
}
</style>
<script>
document.getElementById("footer_blank_0032").style.height=(document.getElementById("hb_game_footer").getBoundingClientRect().height+25)+"px";
</script>	
</body>
