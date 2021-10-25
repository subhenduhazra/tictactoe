<?php
session_start();
if(isset($_SESSION['play']['tictactoe']['player']) && !empty($_SESSION['play']['tictactoe']['player'])){
	header("location:index.php");
}else{
	if(isset($_GET['pvp'])){
	 	$_SESSION['play']['tictactoe']['player']="pvp";
	 	header("location:index.php");	
	}elseif(isset($_GET['pvc'])){
		$_SESSION['play']['tictactoe']['player']="pvc";
		header("location:index.php");		
	}else{
	
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
   
    text-align:center;
}
form{
	text-align:center;

}
form .player_btn{
	border:none;
	display:block;
	width:100%;
	margin:20px 0px 20px 0px;
	padding:20px;
	background:#038ba6;
	color:white;
	transition:box-shadow 0.3s,background 0.3s;
	border-radius:50px;
	font-size:15px;
}
form .player_btn:hover{
	background:#024259;
	box-shadow:rgba(0,0,0,0.4) 0px 0px 5px 2px;
}
</style>

<div id="main">
	<h1>
		Select Player
	</h1>
	<div>
		<form action="set_player.php" method="get">
			<button name="pvp" value="1" class="player_btn">Player Vs Player</button>
			<button name="pvc" value="1" class="player_btn">Player Vs Computer (<?php echo $_SESSION['play']['computer']['name']; ?>)</button>
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