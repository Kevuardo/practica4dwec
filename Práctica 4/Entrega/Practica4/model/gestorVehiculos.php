<?php

    require_once 'gestorConexiones.php';
    require_once 'Vehiculos.php';

    function recogerMarcas (){
        
        $marcas = array();
        $conexion = crearConexion();
        
        $consulta = "select marca from marcas";
        $resultado=$conexion->query($consulta);
        
        if ($conexion->errno!=0){
            throw new Exception("Error de SQL");
        }
        
        while ($marca = $resultado->fetch_row()){
            $marcas[] = $marca[0];
        }
        
        cerrarConexion($conexion);
        return $marcas;
    }
    
    function recogerModelosPorMarca($marcaSeleccionada) {
        
        $modelos = array();
        $conexion = crearConexion();
        
        $consulta = "select modelo, consumo from modelos where id_marca = "
            . "(select id from marcas where marca = '" . $marcaSeleccionada . "') limit 25";
        $resultado=$conexion->query($consulta);
        
        if ($conexion->errno!=0){
            throw new Exception("Error de SQL");
        }
        
        while ($modelo = $resultado->fetch_row()){
            $nuevoVehiculo = new Vehiculo($marcaSeleccionada, $modelo[0], $modelo[1]);
            $modelos[] = serialize($nuevoVehiculo);
        }
        
        cerrarConexion($conexion);
        return $modelos;
        
    }
    
    function recogerModelosPorMarcaAjax($marcaSeleccionada) {
        
        $modelos = array();
        $conexion = crearConexion();
        
        $consulta = "select modelo, consumo from modelos where id_marca = "
            . "(select id from marcas where marca = '" . $marcaSeleccionada . "')";
        $resultado=$conexion->query($consulta);
        
        if ($conexion->errno!=0){
            throw new Exception("Error de SQL");
        }
        
        while ($modelo = $resultado->fetch_row()){
            $modelos[] = $modelo;
        }
        
        cerrarConexion($conexion);
        
        echo json_encode($modelos);
        
    }

?>