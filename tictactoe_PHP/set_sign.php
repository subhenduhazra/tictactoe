<?php
session_start();
if(isset($_SESSION['play']['tictactoe']['sign']) && !empty($_SESSION['play']['tictactoe']['sign'])){
	header("location:index.php");
}else{
	if(isset($_SESSION['play']['tictactoe']['player']) && isset($_SESSION['play']['tictactoe']['player_name'])){
		if(isset($_GET['submit'])){
		
			if($_SESSION['play']['tictactoe']['player']=="pvc"){
				if(isset($_GET['sign']) && !empty($_GET['sign'])){
					if(trim($_GET['sign'])=="O"){
						$_SESSION['play']['tictactoe']['sign']="O";
						$_SESSION['play']['tictactoe']['sign2']="X";
					}elseif(trim($_GET['sign'])=="X"){
						$_SESSION['play']['tictactoe']['sign']="X";
						$_SESSION['play']['tictactoe']['sign2']="O";
					}else{
						
					}
					header("location:index.php");
				}else{
					
				}
			}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
				if(isset($_GET['sign']) && !empty($_GET['sign'])){
					if(trim($_GET['sign'])=="O"){
						$_SESSION['play']['tictactoe']['sign']="O";
						$_SESSION['play']['tictactoe']['sign2']="X";
					}elseif(trim($_GET['sign'])=="X"){
						$_SESSION['play']['tictactoe']['sign']="X";
						$_SESSION['play']['tictactoe']['sign2']="O";
					}else{
						
					}
					
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
		Set the Sign
	</h1>
	<div>
		<form action="set_sign.php" method="get">
		<?php
			if($_SESSION['play']['tictactoe']['player']=="pvc"){
				
			?>
				For <?php echo $_SESSION['play']['tictactoe']['player_name']." : "; ?>
				<br>
				<input type="radio" name="sign" value="O"> O
				<br>
				<input type="radio" name="sign" value="X"> X
				<br>
				<input type="submit" class="player_btn" name="submit" value="Set">	
			<?php
			}elseif($_SESSION['play']['tictactoe']['player']=="pvp"){
			?>
				For <?php echo $_SESSION['play']['tictactoe']['player_name']." : "; ?>
				<br>
				<input type="radio" name="sign" value="O"> O
				<br>
				<input type="radio" name="sign" value="X"> X
				<br>
				
					
				<input type="submit" name="submit" class="player_btn" value="Set">	
				<br>
				For <?php echo $_SESSION['play']['tictactoe']['player2_name']." : "; ?>
				Opposite sign of <?php echo $_SESSION['play']['tictactoe']['player_name']; ?> will be selected automatically.
				
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