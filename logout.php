<?php
session_start();
if(session_destroy()) // Destruye todas las sesiones
{
header("Location: sesion.php"); // Redireccionando a la pagina index.php
}
?>
