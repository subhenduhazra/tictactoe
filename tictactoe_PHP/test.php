<?php
function firstPick(){
	$tmp="ccccccccccccccccccccmmmmmmmsss";
	$j=substr(str_shuffle($tmp),0,1);
	echo $j;
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
echo firstPick();
?>