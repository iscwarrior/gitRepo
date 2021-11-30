<?php  
session_start();
	$mysqli = new mysqli("localhost", "root", "root", "bdr3p0r");
 		if ($mysqli->connect_errno) { echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; } 

 		//dataString

 		$folio  =(string)strip_tags($_POST['folio']);
 		$data = (string)strip_tags ($_POST['value']);
		$field = (string)strip_tags($_POST['field']);

		$update = 'UPDATE primarios SET '.$field.' = "'.$data.'" WHERE folio='.$folio.' ';
		$mysqli ->query($update);

 		//header("Location:status.php?ok");


		// $data = (string)strip_tags($_POST['value']);
		// $field = (string)strip_tags($_POST['field']);

		// $update = 'UPDATE users3 SET '.$field.' = "'.$data.'" WHERE id_user=1';
		// $connexion->query($update);
	  //echo $update;
		echo $data;
?>

