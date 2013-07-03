<?php

session_start();
if (isset($_SESSION["dni"])) {

    print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
    require('headeradmin.php');

    if ($_SESSION["permiso"] == "admin") {

        $seleccionvivienda = $_POST['viviendas'];
        $dnicliente = $_SESSION["dni_cliente"];

        require_once 'funciones_bd.php';
        $db = new funciones_BD();

        $datostablavivienda = $db->getAllData("vivienda");

        $count = 0;
        $id = 0;
        foreach ($datostablavivienda as $fila) {
            $count++;
            if ($count == $seleccionvivienda) {
                //Esa es la vivienda elegida
                $id = $db->getIdVivienda($fila['direccion']);
            }
        }
        if ($db->addusertohouse($id['iddireccion'], $dnicliente)) {
            print("Casa de usuario introducida correctamente<br>");
            print("Introduce otro usuario <A HREF='adduserview.php'>Aqui</A>");
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
