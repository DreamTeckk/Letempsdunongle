<?php 
	
	try{
		$pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','',$pdo_option);
	}catch(Exception $e){
		die('Error : '.$e->getMessage());
	}
	
?>