<?php 
 	try { 
 		$connection = new 
        PDO('mysql:host=localhost;dbname=carat_craft','root',''); 
        echo "";
	} 
	catch (PDOException $e) { 
 		echo $e->getMessage(); 
	} 
?>
