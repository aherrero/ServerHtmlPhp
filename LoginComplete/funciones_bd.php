<?php

class funciones_BD {

    private $db;

    // constructor

    function __construct() {
        require_once 'connectbd.php';
        // connecting to database

        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * agregar nuevo usuario
     */
    public function adduser($dni, $pass, $nombre, $apellido1, $apellido2, $telefono, $email, $edad, $tipopermiso) {

        $result = mysql_query("INSERT INTO cliente(dni,pass,nombre,apellido1,apellido2,telefono,email,edad,permiso) VALUES('$dni', '$pass','$nombre','$apellido1','$apellido2','$telefono','$email','$edad','$tipopermiso')");

        // check for successful store

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addhouse($direccion, $municipio, $provincia, $codigopostal, $pais) {

        $result2 = mysql_query("INSERT INTO vivienda(direccion,municipio,provincia,codigopostal,pais) VALUES('$direccion','$municipio','$provincia','$codigopostal','$pais')");
        // check for successful store

        if ($result2) {
            return true;
        } else {
            return false;
        }
    }

    public function addusertohouse($iddireccion, $dni) {

        $result2 = mysql_query("UPDATE cliente SET idvivienda='$iddireccion' WHERE dni='$dni'");
        // check for successful store

        if ($result2) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateuser($dni,$pass,$nombre,$apellido1,$apellido2,$telefono,$email,$edad) {

        $result2 = mysql_query("UPDATE cliente SET pass='$pass', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', telefono='$telefono', email='$email', edad='$edad' WHERE dni='$dni'");
        // check for successful store

        if ($result2) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatehome($iddireccion,$direccion,$municipio,$provincia,$codigopostal,$pais) {

        $result2 = mysql_query("UPDATE vivienda SET direccion='$direccion',municipio='$municipio',provincia='$provincia',codigopostal='$codigopostal',pais='$pais' WHERE iddireccion='$iddireccion'");
        // check for successful store

        if ($result2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verificar si el usuario ya existe por el username
     */
    public function isuserexist($dni) {

        $result = mysql_query("SELECT dni FROM cliente WHERE dni = '$dni'");

        $num_rows = mysql_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) {

            // el usuario existe 

            return true;
        } else {
            // no existe
            return false;
        }
    }

    public function permis($dni) {

        $result = mysql_query("SELECT permiso FROM cliente WHERE dni = '$dni'");

        $datostabla = array();
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }

        foreach ($datostabla as $fila) {
            //Solo hay un usuario con ese dni
            $tipopermiso = $fila;
        }
        if ($tipopermiso['permiso'] == "admin")
            return "admin";
        else if ($tipopermiso['permiso'] == "userlimit")
            return "userlimit";
        else
            return "user";
    }

    public function login($dni, $pass) {

        $result = mysql_query("SELECT dni FROM cliente WHERE dni='$dni' AND pass='$pass' ");
        $count = mysql_fetch_row($result);

        /* como el usuario debe ser unico cuenta el numero de ocurrencias con esos datos */


        if ($count > 0) {
            //usuario NO coincide con bbdd
            return false;
        } else {
            //usuario coincide con bbdd
            return true;
        }
    }

    public function getIdVivienda($direccion) {

        $result = mysql_query("SELECT iddireccion FROM vivienda WHERE direccion='$direccion'");

        $datostabla = array();
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }
        return $datostabla[0];
    }

    public function getUser($dni) {

        $result = mysql_query("SELECT * FROM cliente WHERE dni='$dni'");

        $datostabla = array();
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }
        return $datostabla[0];
    }

    public function getData($dni, $tabla) {

        $result = mysql_query("SELECT * FROM $tabla WHERE dni='$dni' ");

        $datostabla = array();
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }
        return $datostabla;
    }

    public function getAllData($tabla) {

        $result = mysql_query("SELECT * FROM $tabla");

        $datostabla = array();
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }
        return $datostabla;
    }

    public function getDataVivienda($id) {

        $datostabla = array();

        $result = mysql_query("SELECT * FROM vivienda WHERE iddireccion='$id' ");
        while ($fila = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $datostabla[] = $fila;
        }
        //Solo un resultado con ese ID
        return $datostabla[0];
    }

}

?>
