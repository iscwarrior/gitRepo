<?php
$error=''; // Variable para almacenar el mensaje de error

if (isset($_POST['submit'])) 
	{
	if (empty($_POST['usuario']) || empty($_POST['contrasena'])) 
		{ 
		//$error = "Usuario o Contraseña invalido"; 
		}
		else {
			// Define $username y $password
			$username=$_POST['usuario'];
			$password=$_POST['contrasena'];

			include ("Aut_AD/src/adLDAP.php");
			
			if (!function_exists('ldap_connect')) { die('Your server does not support LDAP');}
			
			try { $adldap = new adLDAP(); } catch (adLDAPException $e) { echo $e; exit(); }
				if ($adldap->authenticate($username, $password))
					{
					session_start(); 
					$_SESSION['login_user_sys'] = $username;
      				$con = mysqli_connect("localhost", "root", "root", "dbr3p0r19"); 
      				if (!$con) { die("La conexión ha fallado: " . mysqli_connect_error());}

					$Login 	   		   	  = "SELECT nombre, perfil FROM user WHERE nombre='$_SESSION[login_user_sys]'";
					
					$queryLogin 	   	  = mysqli_query($con, $Login) or die(mysql_error());
					$row_queryLogin 	  = mysqli_fetch_assoc($queryLogin);
					
					if($row_queryLogin=='')
						{ 
						$error = "Usuario existenten en el Active Directory, pero no tiene permiso para acceder al sistema";
						return $error;
						$redir = "Location: http://" . $_SERVER['HTTP_HOST'] . "/reporcovid19/sesion.php?"; 

						return session_destroy();
						header($redir);
						}
					
					$totalRows_queryLogin = mysqli_num_rows($queryLogin) or die(mysql_error());
											
						if($totalRows_queryLogin==1)
							{
							$_SESSION["MM_UserGroup"] = $row_queryLogin["perfil"];
							if($_SESSION["MM_UserGroup"]==1)
								{
								$redir = "Location: http://" . $_SERVER['HTTP_HOST'] . "/reporcovid/index.php";	
								}
								header($redir);
								mysql_free_result($queryLogin); 
							} else
								{
								$redir = "Location: http://" . $_SERVER['HTTP_HOST'] . "/reporcovid19/sesion.php?";
								header($redir);
								mysql_free_result($queryLogin);	
								} 		exit; 			
					}//fIN_ldap
			} //Fin_else 
	$error = "El usuario o la contraseña no es correcta.";
	} // Fin_isset
?>