<?php

session_start();

if (isset($_SESSION["dni"])) {

    print("<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>");
    require('headeradmin.php');

    if ($_SESSION["permiso"] == "admin") {

        $dnicliente = $_POST['dni'];
        $_SESSION["dni_cliente"] = $dnicliente;
        $pass = $_POST['pass'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $edad = $_POST['edad'];
        $tipopermiso = $_POST['tipopermiso'];

        // Comprobar errores
        $error = false;
        if (isset($dnicliente) && isset($pass) && isset($nombre)) {
            if (trim($dnicliente) == "" || trim($pass) == "" || trim($nombre) == "") {
                $error = true;
            }
        }

        if (isset($dnicliente) && isset($pass) && isset($nombre) && $error == false) {


            require_once 'funciones_bd.php';
            $db = new funciones_BD();

            if ($db->isuserexist($dnicliente, $pass)) {

                echo(" Este usuario ya existe ingrese otro diferente!");
            } else {

                if ($db->adduser($dnicliente, $pass, $nombre, $apellido1, $apellido2, $telefono, $email, $edad, $tipopermiso)) {
                    echo("Los datos del cliente fueron agregados a la Base de Datos correctamente.<br><br>");

                    $db->addusertohouse('1', $dnicliente);


                    print("Cree una nueva vivienda para el cliente con DNI: <table border=1><tr><td> $dnicliente </td></tr></table>");
                    print("<form method='post' action='addhouseview.php'>");
                    print("<input type='Submit' name='enviar' value='Nueva vivienda'>");
                    print("</form>");

                    print("<br>O bien, seleccione una casa ya existente");
                    $datostablavivienda = $db->getAllData("vivienda");

                    print("<form method='post' action='addexistinghouse.php' >");
                    print("<SELECT NAME='viviendas'>");
                    $count = 0;
                    foreach ($datostablavivienda as $fila) {
                        $count++;
                        print("<OPTION VALUE='$count'>" . $fila['direccion']);
                    }
                    print("</SELECT>");
                    print("<input type='Submit' name='enviar' value='Actualizar'>");
                } else {
                    echo(" Ha ocurrido un error.");
                }
            }
        } else {
            //Redirigie para introducir todos los campos 
            header('location: adduserview.php?dato=' . $error);
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