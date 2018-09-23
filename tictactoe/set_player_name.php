<?php
session_start();
if(isset($_SESSION['play']['tictactoe']['player_name']) && !empty($_SESSION['play']['tictactoe']['player_name'])){
	header("location:index.php");
}else{
	if(isset($_SESSION['play']['tictactoe']['player'])){
		if(isset($_GET['submit'])){
			
			if($_SESSION['play']['tictactoe']['player']=="pvc"){
				if(isset($_GET['player_name']) && !empty($_GET['player_name'])){
					$_SESSION['play']['tictactoe']['player_name']=trim($_GET['player_name']);
					$_SESSION['play']['tictactoe']['player2_name']=$_SESSION['play']['computer']['name'];
					header("location:index.php");
				}else{
					
				}
			}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
				if(isset($_GET['player_name']) && !empty($_GET['player_name']) && isset($_GET['player2_name']) && !empty($_GET['player2_name'])){
					$_SESSION['play']['tictactoe']['player_name']=trim($_GET['player_name']);
					$_SESSION['play']['tictactoe']['player2_name']=trim($_GET['player2_name']);
					header("location:index.php");
				}else{
					
				}	
			}else{
				
			}
				
			
		}else{
			
		}
	}else{
		header("location:index.php");	
	}
	
}
?>
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
    text-align:center;
}
form{
	text-align:center;
	font-size:20px;
}
form .input_text{
	width:100%;
	margin:20px 0px 20px 0px;
	padding:10px;
	font-size:20px;
	outline:none;
	border:2px solid #038ba6;
	border-radius:5px;
}
form .player_btn{
	border:none;
	display:block;
	width:60%;
	margin:20px 20% 20px 20%;
	padding:20px;
	background:#038ba6;
	color:white;
	transition:box-shadow 0.3s,background 0.3s;
	border-radius:50px;
	font-size:15px;
}
</style>

<div id="main">
	<h1>
		Give Your Player Names
	</h1>
	<div>
		<form action="set_player_name.php" method="get">
		<?php
			if($_SESSION['play']['tictactoe']['player']=="pvc"){
			?>
				<input type="text" class="input_text" name="player_name" autofocus>
				<br>
				<input type="submit" class="player_btn" name="submit" value="Set">
			<?php
			}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
			?>
				Player 1 Name: <input type="text" class="input_text" name="player_name" autofocus>
				<br>
				Player 2 Name: <input type="text" class="input_text" name="player2_name">
				<br>
				<input type="submit" name="submit" class="player_btn" value="Set">	
			<?php
			}else{
					
			}
		
		?>
			
		</form>
	</div>
</div>
	
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