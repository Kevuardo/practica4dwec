<?php

    function crearConexion(){
        $conexion = new mysqli(
            "127.0.0.1",
            "pepito",
            "pepito",
            "bbdd_gestmotor",
            3306);
        
        if ($conexion->connect_errno) {
            throw new Exception("Error de conexión a la base de datos");
        }
        
        return $conexion;
    }

    function cerrarConexion($conexion){
        $conexion->close();
    }
    
?>