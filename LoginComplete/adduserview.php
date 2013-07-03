<?php
session_start();
//echo "<script type=\"text/javascript\">alert(\"Introduce dni,pass,name\");</script>"; 
$error= $_GET['dato'];
?>

<html>
<LINK REL='stylesheet' TYPE='text/css' HREF='Css/estilo.css'>
<body> 

<?php require('headeradmin.php');?>

Agregue un nuevo Usuario:<br>
(Campos obligatorios * )<br>
<br>
<?php if($error) print("<table border=1><tr><td>Introduce DNI, Clave y Nombre Obligatorio!</td></tr></table><br>");?>

<form method="post" action="addusercontrol.php" >
    
DNI *:
<br>
<input type="Text" name="dni" >
<br>
<br>

Password *:
<br>
<input type="password" name="pass" >
<br>
<br>

Nombre *:
<br>
<input type="Text" name="nombre" >
<br>
<br>

Primer apellido:
<br>
<input type="Text" name="apellido1" >
<br>
<br>

Segundo apellido:
<br>
<input type="Text" name="apellido2" >
<br>
<br>

Telefono:
<br>
<input type="Text" name="telefono" >
<br>
<br>

e-mail:
<br>
<input type="Text" name="email" >
<br>
<br>

Fecha de nacimiento: (dd/mm/aaaa)
<br>
<input type="Text" name="edad" >
<br>
<br>

Permiso:
<SELECT NAME="tipopermiso">
   <OPTION VALUE="admin" SELECTED>Administrador
   <OPTION VALUE="user">Usuario
   <OPTION VALUE="userlimit">Usuario limitado
</SELECT>

<input type="Submit" name="enviar" value="Agregar">
</form>

</body>
</html>
