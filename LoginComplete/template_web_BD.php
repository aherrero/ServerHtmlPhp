<?php

session_start();

//Si existe la cookie, la sesion esta iniciada
if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];

    //Imprime cabezera (Es la cabecera headeradmin!)
    print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
    require('headeradmin.php');

    //El permiso puede ser admin,user,userlimit
    if ($_SESSION["permiso"] == "admin") {

        //Requiere las funciones de la base de datos, y crea un objeto para llamar a metodos
        require_once 'funciones_bd.php';
        $db = new funciones_BD();

        //CODIGO DE CONSULTAS ,EDICION Y MOSTRAR RESULTADOS
    } else {
        //No permisos de root
        print("No permisos de root");
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

