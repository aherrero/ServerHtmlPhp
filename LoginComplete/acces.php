<?php

// Iniciar sesión
session_start();

/* LOGIN */

$dni = $_POST['dni'];
$pass = $_POST['pass'];

require_once 'funciones_bd.php';
$db = new funciones_BD();

if ($db->login($dni, $pass)) {
    print("Usuario o password incorrectos");
} else {
    print("Usuario correcto");
    $_SESSION["dni"] = $dni;
    header("Location: display.php");
}
?>
