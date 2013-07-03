<?php

session_start();

if (isset($_SESSION["dni"])) {
    $dni = $_SESSION["dni"];

    $dniedit = $_POST ['dniedit'];   //Recogemos del formulario anterior

    print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
    require('headeradmin.php');

    if ($_SESSION["permiso"] == "admin") {

        require_once 'funciones_bd.php';
        $db = new funciones_BD();

        $user = $db->getUser($dniedit);
        $viviendauser = $db->getDataVivienda($user['idvivienda']);

        $dnicliente = $user['dni'];
        $iddireccion = $viviendauser['iddireccion'];

        //Datos del formulario para edición    
        $xpass = $_POST['xpass'];
        $xnombre = $_POST['xnombre'];
        $xapellido1 = $_POST['xapellido1'];
        $xapellido2 = $_POST['xapellido2'];
        $xtelefono = $_POST['xtelefono'];
        $xemail = $_POST['xemail'];
        $xedad = $_POST['xedad'];

        $xdireccion = $_POST['xdireccion'];
        $xmunicipio = $_POST['xmunicipio'];
        $xprovincia = $_POST['xprovincia'];
        $xcodigopostal = $_POST['xcodigopostal'];
        $xpais = $_POST['xpais'];

        //Si no hay valores nuevos, poner el de la base de datos
        if (!isset($xpass))
            $xpass = $user['pass'];
        if (!isset($xnombre))
            $xnombre = $user['nombre'];
        if (!isset($xapellido1))
            $xapellido1 = $user['apellido1'];
        if (!isset($xapellido2))
            $xapellido2 = $user['apellido2'];
        if (!isset($xtelefono))
            $xtelefono = $user['telefono'];
        if (!isset($xemail))
            $xemail = $user['email'];
        if (!isset($xedad))
            $xedad = $user['edad'];

        if (!isset($xdireccion))
            $xdireccion = $viviendauser['direccion'];
        if (!isset($xmunicipio))
            $xmunicipio = $viviendauser['municipio'];
        if (!isset($xprovincia))
            $xprovincia = $viviendauser['provincia'];
        if (!isset($xcodigopostal))
            $xcodigopostal = $viviendauser['codigopostal'];
        if (!isset($xpais))
            $xpais = $viviendauser['pais'];


        $db->updateuser($dnicliente, $xpass, $xnombre, $xapellido1, $xapellido2, $xtelefono, $xemail, $xedad);
        $db->updatehome($iddireccion, $xdireccion, $xmunicipio, $xprovincia, $xcodigopostal, $xpais);

        $user = $db->getUser($dnicliente);
        $viviendauser = $db->getDataVivienda($iddireccion);

        //Formulario con valores de la bbdd por defecto.
        print("<FORM ACTION='editperfil.php' METHOD='POST' ENCTYPE='multipart/form-data'>");

        print("<table>");
        print("<col style='width: 200px' />");
        print("<col style='width: 300px' span='1' />");

        print("<tr>");
        print("<th scope='row'>DNI</th>");
        print ("<TD>$dnicliente</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Pass</th>");
        print ("<TD><INPUT TYPE='password' NAME='xpass'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Nombre</th>");
        print("<TD><INPUT TYPE='text' NAME='xnombre' VALUE='" . $user['nombre'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Primer apellido</th>");
        print ("<TD><INPUT TYPE='text' NAME='xapellido1' VALUE='" . $user['apellido1'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Segundo apellido</th>");
        print ("<TD><INPUT TYPE='text' NAME='xapellido2' VALUE='" . $user['apellido2'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Telefono</th>");
        print ("<TD><INPUT TYPE='text' NAME='xtelefono' VALUE='" . $user['telefono'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Email</th>");
        print ("<TD><INPUT TYPE='text' NAME='xemail' VALUE='" . $user['email'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Edad [DD-MM-AAAA]</th>");
        print("<TD><INPUT TYPE='text' NAME='xedad' VALUE='" . $user['edad'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        //vivienda
        print("<tr>");
        print("<th scope='row'>Direccion</th>");
        print("<TD><INPUT TYPE='text' NAME='xdireccion' VALUE='" . $viviendauser['direccion'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Municipio</th>");
        print("<TD><INPUT TYPE='text' NAME='xmunicipio' VALUE='" . $viviendauser['municipio'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Provincia</th>");
        print("<TD><INPUT TYPE='text' NAME='xprovincia' VALUE='" . $viviendauser['provincia'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Codigo postal</th>");
        print("<TD><INPUT TYPE='text' NAME='xcodigopostal' VALUE='" . $viviendauser['codigopostal'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("<tr>");
        print("<th scope='row'>Pais</th>");
        print("<TD><INPUT TYPE='text' NAME='xpais' VALUE='" . $viviendauser['pais'] . "'SIZE='20'</TD>\n");
        print("</tr>");

        print("</table>");

        //Este ultimo hidden, por guardar el dniedit al cargar de nuevo con Actualizar
        print("<INPUT TYPE='hidden' NAME='dniedit' VALUE='$dniedit'>\n");
        print("<P><INPUT TYPE='SUBMIT' NAME='editar' VALUE='Actualizar'></P>");
        print("</form>");
        
        print("<form method='post' action='displayalluser.php'>");
        print("<input type='Submit' name='enviar' value='Volver a todos los usuarios'>");
        print("</form>");
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

