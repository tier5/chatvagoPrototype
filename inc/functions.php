<?php

function mres($conDB, $var){
	if (get_magic_quotes_gpc()){
		$var = stripslashes($var);
	}
	return mysqli_real_escape_string($conDB, trim($var));
}

function confirm_query($conDB, $result_set) {
	if (!$result_set) {
		 die("Database query failed: " . mysqli_error($conDB));
	} else {
		return true;	
	}
}

function redirect($conDB, $locaiont, $delay = 0){
	echo "<meta http-equiv='REFRESH' content='".$delay."; url=".$locaiont."'>";
	exit;
}

function display_error($conDB){
	global $error;
	$br = '<br>';
	if (count($error) == 1) $br = '';
	if (!empty($error)){ 
		echo "<div class='error'>";
			foreach($error as $er):
				echo $er . $br;
			endforeach;
		echo "</div>";
	}
}

?>