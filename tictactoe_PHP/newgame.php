<?php 
session_start();
echo $_SESSION['play']['tictactoe']['player'];
echo $_SESSION['play']['tictactoe']['player_name'];
if(isset($_SESSION['play']['tictactoe']['player']) && isset($_SESSION['play']['tictactoe']['player_name'])){
	
	//////////////////delete table datas//////////////	
	unset($_SESSION['play']['tictactoe']['table']);
	
	//////////////////change play////////////
	if(isset($_SESSION['play']['tictactoe']['how_many_times']) && $_SESSION['play']['tictactoe']['how_many_times']>0){
		$_SESSION['play']['tictactoe']['how_many_times']+=1;
		//////unset sign/////////////////////////////////
		unset($_SESSION['play']['tictactoe']['sign']);
	
	}else{
		$_SESSION['play']['tictactoe']['how_many_times']=1;
	}
	
	//////////////////////set first turn////////////////////////
	if(isset($_SESSION['play']['tictactoe']['first_turn']) && $_SESSION['play']['tictactoe']['first_turn']=="p1"){
		$_SESSION['play']['tictactoe']['first_turn']="p2";
	}elseif(isset($_SESSION['play']['tictactoe']['first_turn']) && $_SESSION['play']['tictactoe']['first_turn']="p2"){
		$_SESSION['play']['tictactoe']['first_turn']="p1";
	}else{
		if(substr(str_shuffle("PC"),0,1)=="P"){
			$_SESSION['play']['tictactoe']['first_turn']="p1";
			
		}else{
			$_SESSION['play']['tictactoe']['first_turn']="p2";
			
		}
	}
	$_SESSION['play']['tictactoe']['current_turn']=$_SESSION['play']['tictactoe']['first_turn'];
	
	$_SESSION['play']['tictactoe']['play_success']="Playing";
	
	////////////redirect////////////////////
	header("location:index.php");
}else{
	
	header("location:restart.php");
}
?>