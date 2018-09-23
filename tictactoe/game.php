<?php
session_start();
if(isset($_SESSION['play']['tictactoe']['player']) && !empty($_SESSION['play']['tictactoe']['player'])){
	if(isset($_SESSION['play']['tictactoe']['player_name']) && !empty($_SESSION['play']['tictactoe']['player_name'])){
		if(isset($_SESSION['play']['tictactoe']['sign']) && !empty($_SESSION['play']['tictactoe']['sign'])){
			if(isset($_GET['pfc']) && $_GET['pfc']==1){
				//////////////////indicating that computer is taking turn/////////////////
				
				if(check_all_empty()){   
				//////check for first turn///////////////
					$turn12p=firstPick();
					$_SESSION['play']['tictactoe']['table'][$turn12p]=$_SESSION['play']['tictactoe']['sign2'];
					echo "NOWIN-";
					echo "G".$turn12p.$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player_name']."'s turn";
					alter_player();
				}else{
					
	////=============================================================================================================================///				
					//////////actual play//////////////
	/////=========================================================================================================================////
					
						////**************check own match (for win)/////////////////////////////
						if(check_opnents_match($_SESSION['play']['tictactoe']['sign2'])){
							$compPick=$_SESSION['play']['tictactoe']['oponents_match_cover'];
							$es="own_pick for win".$compPick;
							
						}else{
							////////check opponent's match then (defensive) /////////
							if(check_opnents_match($_SESSION['play']['tictactoe']['sign'])){
								$compPick=$_SESSION['play']['tictactoe']['oponents_match_cover'];
								$es="oponents match compick=".$compPick;
							}else{
								$compPick=pick_easy();
								$es="pick easy".$compPick;
							}
							
						}
						
						
						if(check_valid_selection($compPick)){
							
						}else{
							echo "Error:".$compPick."Contact to HB es=".$es." -> ";
							print_r($_SESSION['play']['tictactoe']['table']);
							
							die();
						}
							
					
										
					
						$_SESSION['play']['tictactoe']['table'][$compPick]=$_SESSION['play']['tictactoe']['sign2'];
							
						
						//////////////////////////////check for final match////////////////////////
						if(check_for_final_match()){
							echo "WIN-";
							echo $_SESSION['play']['tictactoe']['winpath'];
							
							echo "G".$compPick.$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player2_name']." winner";
							
							$_SESSION['play']['tictactoe']['play_success']="Success";
						}else{
							/////////////////check all fill up?//////////////////////
							if(check_all_fill_up()){
								echo "DRAW-";								
								echo "G".$compPick.$_SESSION['play']['tictactoe']['sign2'];
								$_SESSION['play']['tictactoe']['play_success']="Success";
							}else{
								///////////////send response/////////////////////////////
								echo "NOWIN-";
								echo "G".$compPick.$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player_name']."'s turn";
									
								
								$_SESSION['play']['tictactoe']['play_success']="Playing";
								////////////////////alter current turn////////////////
								alter_player();
							}
							

						}
					
					
					/*$_SESSION['play']['tictactoe']['table'][$tmp78k]=$_SESSION['play']['tictactoe']['sign2'];
					
					
					echo "COMPRESP-";
					echo "G".$tmp78k.$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player_name']."'s turn";
					alter_player();*/
					
				}
				////check for oponents match
				////check for 
				//
			}else{
				if(isset($_GET['sel']) && (int)$_GET['sel']>=1 && (int)$_GET['sel']<=9){
					
				}else{
					die("Dismiss1");
				}
			}
			
		}else{
			header("location:index.php");
		}
	}else{
		header("location:index.php");
	}
}else{
	header("location:index.php");
}
///////////////////start the game//////////////////////////

if($_SESSION['play']['tictactoe']['player']=="pvp"){
	if(check_valid_selection($_GET['sel'])){
		if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
			$_SESSION['play']['tictactoe']['table'][$_GET['sel']]=$_SESSION['play']['tictactoe']['sign'];
			
		}elseif($_SESSION['play']['tictactoe']['current_turn']=="p2"){
			$_SESSION['play']['tictactoe']['table'][$_GET['sel']]=$_SESSION['play']['tictactoe']['sign2'];
			
		}else{
			echo "Dismiss2";
		}
		//////////////////////////////check for final match////////////////////////
		if(check_for_final_match()){
			echo "WIN-";
			echo $_SESSION['play']['tictactoe']['winpath'];
			if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
				echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign'].$_SESSION['play']['tictactoe']['player_name']." winner";
			}elseif($_SESSION['play']['tictactoe']['current_turn']=="p2"){
				echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player2_name']." winner";
			}
			$_SESSION['play']['tictactoe']['play_success']="Success";
		}else{
			/////////////////check all fill up?//////////////////////
			if(check_all_fill_up()){
				echo "DRAW-";
				if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
					echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign'];
					
				}elseif($_SESSION['play']['tictactoe']['current_turn']=="p2"){
					echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign2'];
					
				}
				$_SESSION['play']['tictactoe']['play_success']="Success";
			}else{
				///////////////send response/////////////////////////////
				echo "NOWIN-";
				if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
					echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign'].$_SESSION['play']['tictactoe']['player2_name']."'s turn";
					
				}elseif($_SESSION['play']['tictactoe']['current_turn']=="p2"){
					echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign2'].$_SESSION['play']['tictactoe']['player_name']."'s turn";
					
				}
				$_SESSION['play']['tictactoe']['play_success']="Playing";
				////////////////////alter current turn////////////////
				alter_player();
				
			}
			

		}
		//$_SESSION['play']['tictactoe']['table'][$_GET['sel']]="6";
	}else{
		echo "Dismiss3";
	}
}elseif($_SESSION['play']['tictactoe']['player']=="pvc"){
	if(isset($_GET['pfc'])){
		
	}else{
		/////************************************************************************************************************//
		/////////////////////////space for human turn form PVC///////////////////
		/////************************************************************************************************************//
		if(check_valid_selection($_GET['sel'])){
			if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
				$_SESSION['play']['tictactoe']['table'][$_GET['sel']]=$_SESSION['play']['tictactoe']['sign'];
				
			}else{
				echo "Dismiss4";
			}
			//////////////////////////////check for final match////////////////////////
			if(check_for_final_match()){
				echo "WIN-";
				echo $_SESSION['play']['tictactoe']['winpath'];
				if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
					echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign'].$_SESSION['play']['tictactoe']['player_name']." winner";
				}
				$_SESSION['play']['tictactoe']['play_success']="Success";
			}else{
				/////////////////check all fill up?//////////////////////
				if(check_all_fill_up()){
					echo "DRAW-";
					if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
						echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign'];
						
					}
					$_SESSION['play']['tictactoe']['play_success']="Success";
				}else{
					///////////////send response/////////////////////////////
					echo "NOWIN-";
					if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
						echo "G".$_GET['sel'].$_SESSION['play']['tictactoe']['sign']."LETCOMP".$_SESSION['play']['tictactoe']['player2_name']."'s turn";
						
					}
					$_SESSION['play']['tictactoe']['play_success']="Playing";
					////////////////////alter current turn////////////////
					alter_player();
				}
				

			}
		}else{
			echo "Dismiss5";
		}
	}
	
}else{
	die("Dismiss6");
}
function alter_player(){
	if($_SESSION['play']['tictactoe']['current_turn']=="p1"){
		$_SESSION['play']['tictactoe']['current_turn']="p2";
		
	}elseif($_SESSION['play']['tictactoe']['current_turn']=="p2"){
		$_SESSION['play']['tictactoe']['current_turn']="p1";
		
	}
	
}

///*****************************************************************************/
////most easy algo alg001///////////////
function pick_easy(){
	$i=0;
	do{
		$compPick=rand(1,9);
		
		$i++;
	}
	while(!check_valid_selection($compPick));
	/*for($i=1;$i<=9;$i++){
		
		if(check_if_empty($compPick)){
			break;
		}
						
	}*/
	return $compPick;
					
}
////////end of alg001///////////////
////////**************************************************************************/
function firstPick(){
	$tmp="ccccccccccccccccccccmmmmmmmsss";
	$j=substr(str_shuffle($tmp),0,1);
	switch($j){
		case "c":
				$tmp="1379";
				$j=substr(str_shuffle($tmp),0,1);
				return (int)$j;
			break;
			
		case "m":
			return 5;
			break;
			
		case "s":
				$tmp="2468";
				$j=substr(str_shuffle($tmp),0,1);
				return (int)$j;
			break;
		
		default:
			
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function check_opnents_match($ops){
	
	
	////-------------ROW WISE -----------------////////////////////////
	////////////first row//////////
	if(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][2]) && 
	$_SESSION['play']['tictactoe']['table'][2]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][3])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=3;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][2])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=2;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][2]) &&
	$_SESSION['play']['tictactoe']['table'][2]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][1])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=1;
		return true;
	}
	
	//////////////2nd row/////////////	
	elseif(isset($_SESSION['play']['tictactoe']['table'][4]) &&
	$_SESSION['play']['tictactoe']['table'][4]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][6])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=6;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][4]) &&
	$_SESSION['play']['tictactoe']['table'][4]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][6]) &&
	$_SESSION['play']['tictactoe']['table'][6]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][5])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=5;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][6]) &&
	$_SESSION['play']['tictactoe']['table'][6]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][4])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=4;
		return true;
	}
	
	//////3rd row///////////////
	elseif(isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][8]) &&
	$_SESSION['play']['tictactoe']['table'][8]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][9])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=9;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][8])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=8;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][8]) &&
	$_SESSION['play']['tictactoe']['table'][8]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][7])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=7;
		return true;
	}
	
	///////--------COLUMN WISE-----------------//////////
	//////////1st column//////////////////
	elseif(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][4]) &&
	$_SESSION['play']['tictactoe']['table'][4]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][7])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=7;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][4])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=4;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][4]) &&
	$_SESSION['play']['tictactoe']['table'][4]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][1])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=1;
		return true;
	}
	
	////////////2nd column////////////////////
	elseif(isset($_SESSION['play']['tictactoe']['table'][2]) &&
	$_SESSION['play']['tictactoe']['table'][2]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][8])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=8;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][2]) &&
	$_SESSION['play']['tictactoe']['table'][2]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][8]) &&
	$_SESSION['play']['tictactoe']['table'][8]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][5])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=5;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][8]) &&
	$_SESSION['play']['tictactoe']['table'][8]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][2])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=2;
		return true;
	}
	
	///////////3rd column/////////////////////
	elseif(isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][6]) &&
	$_SESSION['play']['tictactoe']['table'][6]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][9])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=9;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][6])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=6;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][6]) &&
	$_SESSION['play']['tictactoe']['table'][6]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][3])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=3;
		return true;
	}
	
	////////---------cross wise-------////////////
	////////// ""\"" cross /////////////////////////    
	elseif(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][9])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=9;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][1]) &&
	$_SESSION['play']['tictactoe']['table'][1]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][5])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=5;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][9]) &&
	$_SESSION['play']['tictactoe']['table'][9]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][1])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=1;
		return true;
	}
	
	////////---------cross wise-------////////////
	////////// ""/"" cross /////////////////////////
	elseif(isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][7])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=7;
		return true;
	}
	
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][3]) &&
	$_SESSION['play']['tictactoe']['table'][3]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][5])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=5;
		return true;
	}
	
	elseif(isset($_SESSION['play']['tictactoe']['table'][5]) &&
	$_SESSION['play']['tictactoe']['table'][5]==$ops &&
	isset($_SESSION['play']['tictactoe']['table'][7]) &&
	$_SESSION['play']['tictactoe']['table'][7]==$ops && 
	!isset($_SESSION['play']['tictactoe']['table'][3])){
		
		$_SESSION['play']['tictactoe']['oponents_match_cover']=3;
		return true;
		
	}
	
	else{
		return false;
	}
	
	
}

function check_if_empty($val){
	if(isset($_SESSION['play']['tictactoe']['table'][$val])){
		return false;
	}else{
		return true;
	}
}

function check_all_empty(){
	if(
		isset($_SESSION['play']['tictactoe']['table'][1]) || 
		isset($_SESSION['play']['tictactoe']['table'][2]) || 
		isset($_SESSION['play']['tictactoe']['table'][3]) || 
		isset($_SESSION['play']['tictactoe']['table'][4]) || 
		isset($_SESSION['play']['tictactoe']['table'][5]) || 
		isset($_SESSION['play']['tictactoe']['table'][6]) || 
		isset($_SESSION['play']['tictactoe']['table'][7]) || 
		isset($_SESSION['play']['tictactoe']['table'][8]) || 
		isset($_SESSION['play']['tictactoe']['table'][9])
	){
		return false;
	}else{
		return true;
	}
}

function check_all_fill_up(){
	if(
		isset($_SESSION['play']['tictactoe']['table'][1]) && !empty($_SESSION['play']['tictactoe']['table'][1]) &&
		isset($_SESSION['play']['tictactoe']['table'][2]) && !empty($_SESSION['play']['tictactoe']['table'][2]) &&
		isset($_SESSION['play']['tictactoe']['table'][3]) && !empty($_SESSION['play']['tictactoe']['table'][3]) &&
		isset($_SESSION['play']['tictactoe']['table'][4]) && !empty($_SESSION['play']['tictactoe']['table'][4]) &&
		isset($_SESSION['play']['tictactoe']['table'][5]) && !empty($_SESSION['play']['tictactoe']['table'][5]) &&
		isset($_SESSION['play']['tictactoe']['table'][6]) && !empty($_SESSION['play']['tictactoe']['table'][6]) &&
		isset($_SESSION['play']['tictactoe']['table'][7]) && !empty($_SESSION['play']['tictactoe']['table'][7]) &&
		isset($_SESSION['play']['tictactoe']['table'][8]) && !empty($_SESSION['play']['tictactoe']['table'][8]) &&
		isset($_SESSION['play']['tictactoe']['table'][9]) && !empty($_SESSION['play']['tictactoe']['table'][9])
	){
		return true;
	}else{
		return false;
	}
}

function check_valid_selection($sel){
	if(isset($_SESSION['play']['tictactoe']['table'][$sel])){
		return false;
	}else{
		return true;
	}
}

function check_for_final_match(){
	
		if(
		isset($_SESSION['play']['tictactoe']['table'][1]) && 
		isset($_SESSION['play']['tictactoe']['table'][2]) && 
		isset($_SESSION['play']['tictactoe']['table'][3]) && 
		$_SESSION['play']['tictactoe']['table'][1] == $_SESSION['play']['tictactoe']['table'][2] && 
		$_SESSION['play']['tictactoe']['table'][2] == $_SESSION['play']['tictactoe']['table'][3]		
		){
			$_SESSION['play']['tictactoe']['winpath']="123";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][4]) && 
		isset($_SESSION['play']['tictactoe']['table'][5]) && 
		isset($_SESSION['play']['tictactoe']['table'][6]) && 
		$_SESSION['play']['tictactoe']['table'][4] == $_SESSION['play']['tictactoe']['table'][5] && 
		$_SESSION['play']['tictactoe']['table'][5] == $_SESSION['play']['tictactoe']['table'][6]	
		){
			$_SESSION['play']['tictactoe']['winpath']="456";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][7]) && 
		isset($_SESSION['play']['tictactoe']['table'][8]) && 
		isset($_SESSION['play']['tictactoe']['table'][9]) && 
		$_SESSION['play']['tictactoe']['table'][7] == $_SESSION['play']['tictactoe']['table'][8] && 
		$_SESSION['play']['tictactoe']['table'][8] == $_SESSION['play']['tictactoe']['table'][9]	
		){
			$_SESSION['play']['tictactoe']['winpath']="789";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][1]) && 
		isset($_SESSION['play']['tictactoe']['table'][4]) && 
		isset($_SESSION['play']['tictactoe']['table'][7]) && 
		$_SESSION['play']['tictactoe']['table'][1] == $_SESSION['play']['tictactoe']['table'][4] && 
		$_SESSION['play']['tictactoe']['table'][4] == $_SESSION['play']['tictactoe']['table'][7]	
		){
			$_SESSION['play']['tictactoe']['winpath']="147";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][2]) && 
		isset($_SESSION['play']['tictactoe']['table'][5]) && 
		isset($_SESSION['play']['tictactoe']['table'][8]) && 
		$_SESSION['play']['tictactoe']['table'][2] == $_SESSION['play']['tictactoe']['table'][5] && 
		$_SESSION['play']['tictactoe']['table'][5] == $_SESSION['play']['tictactoe']['table'][8]	
		){
			$_SESSION['play']['tictactoe']['winpath']="258";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][3]) && 
		isset($_SESSION['play']['tictactoe']['table'][6]) && 
		isset($_SESSION['play']['tictactoe']['table'][9]) && 
		$_SESSION['play']['tictactoe']['table'][3] == $_SESSION['play']['tictactoe']['table'][6] && 
		$_SESSION['play']['tictactoe']['table'][6] == $_SESSION['play']['tictactoe']['table'][9]	
		){
			$_SESSION['play']['tictactoe']['winpath']="369";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][1]) && 
		isset($_SESSION['play']['tictactoe']['table'][5]) && 
		isset($_SESSION['play']['tictactoe']['table'][9]) && 
		$_SESSION['play']['tictactoe']['table'][1] == $_SESSION['play']['tictactoe']['table'][5] && 
		$_SESSION['play']['tictactoe']['table'][5] == $_SESSION['play']['tictactoe']['table'][9]	
		){
			$_SESSION['play']['tictactoe']['winpath']="159";
			return true;
		}elseif(
		isset($_SESSION['play']['tictactoe']['table'][3]) && 
		isset($_SESSION['play']['tictactoe']['table'][5]) && 
		isset($_SESSION['play']['tictactoe']['table'][7]) && 
		$_SESSION['play']['tictactoe']['table'][3] == $_SESSION['play']['tictactoe']['table'][5] && 
		$_SESSION['play']['tictactoe']['table'][5] == $_SESSION['play']['tictactoe']['table'][7]	
		){
			$_SESSION['play']['tictactoe']['winpath']="357";
			return true;
		}else{
			
			return false;
		}
	
}
?>