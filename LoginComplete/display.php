<?php

session_start();

if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];

    require_once 'funciones_bd.php';

    $db = new funciones_BD();
    $permiso = $db->permis($dni);

    $_SESSION["permiso"] = $permiso;

    if ($permiso == "admin")
        header("Location: displayadmin.php");
    else
        header("Location: displayuser.php");
}
// Intento de entrada fallido
else if (isset($dni)) {
    print ("<BR><BR>\n");
    print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
    print ("<P ALIGN='CENTER'>[ <A HREF='index.html'>Conectar</A> ]</P>\n");
}

// Sesión no iniciada
else {
    print ("<P ALIGN='CENTER'>Sesion no iniciada</P>\n");
    print("<A HREF='index.html'>Conectar</A>");
}
?>
