<?php

    /* Al cargar la vista, recoge todas las marcas existentes en la BDD para mostrarlas
    en el elemento select del formulario. */
    require_once '../model/gestorVehiculos.php';

    $marcas = recogerMarcas();
    $modelosCorrespondientes = array();
    
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Carga asíncrona - Práctica 4</title>
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    
    <body>
        
        <header>
            <h1>Carga asíncrona - Práctica 4</h1>
        </header>
        
        <div class="contenedor">
            
            <div class="fila" id="formularioBusqueda">
                    
                <select name="marcaSeleccionada" id="marca-seleccionada">
                    <option value="defecto">Selecciona una marca...</option>
                    <?php
                        global $marcas;
                        foreach ($marcas as $marca) {
                    ?>
                    <option value="<?=$marca?>"><?=$marca?></option>
                    <?php
                        }
                    ?>
                </select>

                <button class="boton-personalizado btnVerde" id="boton-busqueda-ajax">Mostrar modelos</button>
                
            </div>
            
            <div class="fila navegacion">
                
                <button class="boton-personalizado btnRojo btnAnterior">Anteriores</button>
                <button class="boton-personalizado btnAzul btnSiguiente">Siguientes</button>
                
            </div>
            
            <div class="fila" id="muestraAjax">

                <h2>Modelos encontrados de <span id="nombreMarca"></span></h2>

                <table class="muestraModelos" id="tablaAjax"></table>
                
            </div>
            
        </div>
        
        <div class="contenedor">
            
            <button class="boton-personalizado btnRojo"><a href="../index.php"><b>Volver al índice</b></a></button>
            
        </div>
        
    </body>

    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/background-color-change.js"></script>
    <script type="text/javascript" src="../js/funcionalidad-ajax.js"></script>
    
</html>
