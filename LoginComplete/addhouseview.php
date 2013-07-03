<?php
session_start();
?>

<html>
<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>
<body> 

<?php require('headeradmin.php');?>

<br>Agregue una nueva casa al cliente.

<form method="post" action="addhousecontrol.php" >

Direccion:
<br>
<input type="Text" name="direccion" >
<br>
<br>

Municipio:
<br>
<input type="Text" name="municipio" >
<br>
<br>

Provincia:
<br>
<input type="Text" name="provincia" >
<br>
<br>

Codigo postal:
<br>
<input type="Text" name="codigopostal" >
<br>
<br>

Pais:
<br>
<input type="Text" name="pais" >
<br>
<br>

<input type="Submit" name="enviar" value="Agregar">
</form>

</body>
</html>
