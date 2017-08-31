<?php 
	
	try{
		$pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=91.216.107.164;dbname=letem874753','letem874753','nlcrl69ydz',$pdo_option);
	}catch(Exception $e){
		die('Error : '.$e->getMessage());
	}
	
?>