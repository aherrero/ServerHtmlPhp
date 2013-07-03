<?php

session_start();

if (isset($_SESSION["dni"])) {

    print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
    require('headeradmin.php');

    if ($_SESSION["permiso"] == "admin") {

        $direccion = $_POST['direccion'];
        $municipio = $_POST['municipio'];
        $provincia = $_POST['provincia'];
        $codigopostal = $_POST['codigopostal'];
        $pais = $_POST['pais'];

        $dnicliente = $_SESSION["dni_cliente"];


        require_once 'funciones_bd.php';
        $db = new funciones_BD();



        if ($db->addhouse($direccion, $municipio, $provincia, $codigopostal, $pais)) {
            echo(" Los datos de vivienda fueron agregados a la Base de Datos correctamente.<br>");
            //Obtenemos el ID de la vivienda introducida actual
            $id = $db->getIdVivienda($direccion);
            //Y añadimos este ID al usuario.
            if ($db->addusertohouse($id['iddireccion'], $dnicliente)) {
                print("Identifiacion de la casa introducida al usuario correctamente.<br>");
                print("Introduce otro usuario <A HREF='adduserview.php'>Aqui</A>");
            }
        } else {
            echo(" Ha ocurrido un error con datos de vivienda.");
        }
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




