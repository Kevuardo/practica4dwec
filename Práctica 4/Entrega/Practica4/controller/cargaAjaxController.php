<?php
    require_once '../model/Vehiculos.php';
    require_once '../model/gestorVehiculos.php';

    $marcaBusqueda = $_GET["marcaSeleccionada"];
    
    try {
        $vehiculosCorrespondientes = array();
        $vehiculosCorrespondientes = recogerModelosPorMarcaAjax($marcaBusqueda);
    } catch (Exception $ex) {
        header("Location:../view/error.php?mensaje=".$ex->getMessage());
        exit();
    }
    
?>