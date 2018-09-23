<?php 
$_SESSION['play']['computer']['name']="Kitty";
$_SESSION['play']['tictactoe']['version']="1.2";
?>
<style>
body{
	padding:0px;
	margin:0px;
}
#hb{
	float:right;
}
#hb #hb_528{
	background:url("./images/icon.png");
	background-position:center center;
	background-repeat:no-repeat;
	background-size:contain;
	width:40px;
	height:40px;
	margin:20px
}
#hb a{
		text-decoration:none;
}
header #top_bar{
	background:-webkit-linear-gradient(top,#dcfdff 40%,#038e96 50%);
}
header #top_bar hgroup{
	padding:10px;
}
header #top_bar hgroup #game_name{
	color:#fff0c3;
}
header #game_menu{
	border-top:1px solid #dcfdff;
	background:#038e96;
}
header #game_menu a{
	text-decoration:none;
	color:white;
}
header #game_menu .game_menu_element{
	font-size:20px;
	font-weight:bold;
	display:inline-block;
	transition: color 0.3s,background 0.3s;
}
header #game_menu .game_menu_element:hover{
	background: #03cacc;
}
header #game_menu .game_menu_element a div{
	padding:10px;
}
</style>
 <header>
 <div id="top_bar">
	 <div id="hb">
		 <a href="http://hazrabrothers.com">
			<div id="hb_528">
				&nbsp;
			</div>
		 </a>
	 </div>

    <hgroup>
        <h3>Let's play</h3>
        <h1 id="game_name">Tic Tac Toe</h1>
		
    </hgroup>
</div>
 <div id="game_menu">
	<div class="game_menu_element">
		<a href="restart.php" id="ng58">
			<div>Restart the play</div>
		</a>
	</div>
</div>
	
</header>
