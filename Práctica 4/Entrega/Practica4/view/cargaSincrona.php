<?php

    /* Al cargar la vista, recoge todas las marcas existentes en la BDD para mostrarlas
    en el elemento select del formulario. */
    require_once '../model/gestorVehiculos.php';

    $marcas = recogerMarcas();
    $modelosCorrespondientes = array();
    
    if (isset($_GET['marcaSeleccionada'])) {
        $marcaSeleccionada = $_GET['marcaSeleccionada'];
        if ($marcaSeleccionada === "defecto") {
            /* Muestra un mensaje de error al haber seleccionado la opción por defecto. */
            
        } else {
            $modelosCorrespondientes = recogerModelosPorMarca($marcaSeleccionada);
        }
    }
    
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Carga síncrona - Práctica 4</title>
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    
    <body>
        
        <header>
            <h1>Carga síncrona - Práctica 4</h1>
        </header>
        
        <div class="contenedor">
            
            <div class="fila" id="formularioBusqueda">
                
                <form action="cargaSincrona.php" method="GET">
                    
                    <select name="marcaSeleccionada">
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
                    
                    <input type="submit" class="boton-personalizado btnVerde" value="Mostrar modelos">
                
                </form>
                
            </div>
            
            <?php
                global $modelosCorrespondientes;
                if (count($modelosCorrespondientes) > 0) {
                    global $marcaSeleccionada;
            ?>
            
            <div class="fila" id="muestraBusqueda">

                <h2>Modelos encontrados de <span id="nombreMarca"><?=$marcaSeleccionada?></span></h2>

                <table class="muestraModelos">
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Consumo</th>
                    </tr>
                    <?php
                        global $modelosCorrespondientes;
                        foreach ($modelosCorrespondientes as $modelo) {
                            $modeloDefinitivo = unserialize($modelo);
                    ?>
                    <tr class="datosModelo">
                        <td><?=$modeloDefinitivo->getMarca()?></td>
                        <td><?=$modeloDefinitivo->getModelo()?></td>
                        <td><?=$modeloDefinitivo->getConsumo()?> litros/100km</td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            
            <?php
                }
            ?>
            
            
        </div>
        
        <div class="contenedor">
            
            <button class="boton-personalizado btnRojo"><a href="../index.php"><b>Volver al índice</b></a></button>
            
        </div>
        
    </body>

    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/background-color-change.js"></script>
    
</html>
