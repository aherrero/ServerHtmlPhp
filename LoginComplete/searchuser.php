<?php

session_start();


if (isset($_SESSION["dni"])) {

    $dnibusqueda = $_POST['clientebuscar'];

    if ($_SESSION["permiso"] == "admin") {

        require_once 'funciones_bd.php';

        print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
        require('headeradmin.php');

        $db = new funciones_BD();

        $datosbusqueda = $db->getUser($dnibusqueda);

        if ($datosbusqueda != "") {
            $datosviviendabusqueda = $db->getDataVivienda($datosbusqueda['idvivienda']);

            print ("<TABLE>\n");
            print ("<TR>\n");
            print ("<TH>DNI|   </TH>\n");
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

            print ("<TR>\n");
            print ("<TD>" . $datosbusqueda['dni'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['nombre'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['apellido1'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['apellido2'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['telefono'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['email'] . "     </TD>\n");
            print ("<TD>" . $datosbusqueda['edad'] . "     </TD>\n");
            print ("<TD>" . $datosviviendabusqueda['direccion'] . "     </TD>\n");
            print ("<TD>" . $datosviviendabusqueda['municipio'] . "     </TD>\n");
            print ("<TD>" . $datosviviendabusqueda['provincia'] . "     </TD>\n");
            print ("<TD>" . $datosviviendabusqueda['codigopostal'] . "     </TD>\n");
            print ("<TD>" . $datosviviendabusqueda['pais'] . "     </TD>\n");


            print ("</TR>\n");

            print ("</TABLE>\n");
        } else {
            print("No hay resultados con la busqueda de $dnibusqueda<br>");
            print("Vuelve <A HREF='displayadmin.php'>atras</A>");
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