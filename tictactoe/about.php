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
#main #about_msg{
	font-size:17px;
	text-align:left;
}
</style>

<div id="main">
	<hgroup>
		<h1>Tic Tac Toe</h1>
		<h4>Version <?php echo $_SESSION['play']['tictactoe']['version']="1.2"; ?></h4>
	</hgroup>
	<div id="about_msg">
		Tic Tac Toe is a simple but popular game.
		It is a try of us in game domain.
		We have tried to make a game which is simple and easy to play for testing purpose. 
		It is not the final version and we are improving it day by day.
		We shall be happy if you try this and enjoy.
		If you really enjoy, share among your circle. 
		<!--Every suggestion for us will be welcomed. 
		Leave us a <a href="feedback.php">feedback</a>.-->
		<div>
		<div style="float:right;">- Team Hazra Brothers</div>
		</div>
		<div style="font:1px;clear:both;">&nbsp;</div>
	</div>
	
</div>

	<br><br><br>
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
