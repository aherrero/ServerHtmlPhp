<?php

session_start();

if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];

    if ($_SESSION["permiso"] == "admin") {

        require_once 'funciones_bd.php';

        print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
        require('headeradmin.php');

        $db = new funciones_BD();

        $datostablacliente = $db->getAllData("cliente");



        print ("<TABLE>\n");
        print ("<TR>\n");
        print ("<TH>DNI|   </TH>\n");
        print ("<TH>PERMISO| </TH>\n");
        print ("<TH>Nombre|</TH>\n");
        print ("<TH>Primer Apellido|   </TH>\n");
        print ("<TH>Segundo Apellido |</TH>\n");
        print ("<TH>Telefono|</TH>\n");
        print ("<TH>Email|</TH>\n");
        print ("<TH>Edad    |</TH>\n");
        print ("<TH>Direccion   |</TH>\n");
        print ("<TH>Municipio   |</TH>\n");
        print ("<TH>Provincia   |</TH>\n");
        print ("<TH>Codigo Postal |</TH>\n");
        print ("<TH>Pais</TH>\n");
        print ("</TR>\n");

        foreach ($datostablacliente as $fila) {
            //Solo hay un usuario con ese dni
            $datosuser = $fila;
            $btnedit[] = $datosuser['dni'];



            print ("<TR>\n");
            print ("<TD>" . $datosuser['dni'] . "     </TD>\n");
            print ("<TD>" . $datosuser['permiso'] . "     </TD>\n");
            print ("<TD>" . $datosuser['nombre'] . "     </TD>\n");
            print ("<TD>" . $datosuser['apellido1'] . "     </TD>\n");
            print ("<TD>" . $datosuser['apellido2'] . "     </TD>\n");
            print ("<TD>" . $datosuser['telefono'] . "     </TD>\n");
            print ("<TD>" . $datosuser['email'] . "     </TD>\n");
            print ("<TD>" . $datosuser['edad'] . "     </TD>\n");

            $datosvivienda = $db->getDataVivienda($datosuser['idvivienda']);
            
            print ("<TD>" . $datosvivienda['direccion'] . "     </TD>\n");
            print ("<TD>" . $datosvivienda['municipio'] . "     </TD>\n");
            print ("<TD>" . $datosvivienda['provincia'] . "     </TD>\n");
            print ("<TD>" . $datosvivienda['codigopostal'] . "     </TD>\n");
            print ("<TD>" . $datosvivienda['pais'] . "     </TD>\n");

            print("<form method='post' action='editperfil.php'>");
            $var = $datosuser['dni'];
            print ("<INPUT TYPE='hidden' NAME='dniedit' VALUE='$var'>\n");
            print("<TD> <input type='Submit' name='Editar' value='Editar'></TD>\n");
            print("</form>");

            print ("</TR>\n");
        }
        print ("</TABLE>\n");
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
