<?php

session_start();

if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];
    if ($_SESSION["permiso"] == "admin") {

        require_once 'funciones_bd.php';

        print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
        require('headeradmin.php');

        $db = new funciones_BD();

        print("<form method='post' action='adduserview.php'>");
        print("<input type='Submit' name='enviar' value='Nuevo usuario'>");
        print("</form>");

        print("<form method='post' action='displayalluser.php'>");
        print("<input type='Submit' name='enviar' value='Mostrar todos clientes'>");
        print("</form>");

        print("<form method='post' action='searchuser.php'>");
        print("Buscar por DNI de Cliente: <br>");
        print("<INPUT TYPE='text' NAME='clientebuscar' VALUE='00000000X' SIZE='20'>");
        print("<input type='Submit' name='enviar' value='Mostrar busqueda'>");
        print("</form>");
    } else {
        //No permisos de root
    }
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
