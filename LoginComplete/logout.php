<?PHP
session_start();
?>
<HTML LANG="es">
    <HEAD>
        <TITLE>Desconectar</TITLE>
        <LINK REL="stylesheet" TYPE="text/css" HREF="Css/estilo.css">

    </HEAD>
    <BODY>

        <?PHP
        if (isset($_SESSION["dni"])) {
            unset($_SESSION["dni"]);
            session_destroy();
            print ("<BR><BR><P ALIGN='CENTER'>Conexion finalizada</P>\n");
            print ("<P ALIGN='CENTER'>[ <A HREF='index.html'>Conectar</A> ]</P>\n");
        } else {
            print ("<BR><BR>\n");
            print ("<P ALIGN='CENTER'>No existe una conexion activa</P>\n");
            print ("<P ALIGN='CENTER'>[ <A HREF='index.html'>Conectar</A> ]</P>\n");
        }
        ?>

        <!--Anuncio lejos:-->
        <br style="line-height:600px" />

    </BODY>
</HTML>
