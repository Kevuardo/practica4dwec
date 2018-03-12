$(document).ready(function() {

    $('#boton-busqueda-ajax').click(function(){

        var marcaSeleccionada = $("#marca-seleccionada").val();
            
        $('#muestraAjax').css('display', 'none');

        if (marcaSeleccionada != "defecto") {
           
            $('#tablaAjax').css('display', 'none');
           
            $.ajax({
                url: '../controller/cargaAjaxController.php',
                type: 'GET', /* Método de envío. */
                dataType: 'json',
                data: 'marcaSeleccionada=' + marcaSeleccionada, /* Parámetros del GET. */
                success: function(resultados) {
                    
                    if (resultados.length > 0) {
                        
                        /* Carga los datos en la tabla y la hace visible. */
                        $('#nombreMarca').html(marcaSeleccionada);

                        $('#tablaAjax').html(
                            "<tr>"
                                + "<th>Marca</th>"
                                + "<th>Modelo</th>"
                                + "<th>Consumo</th>"
                            + "</tr>"
                        );

                        for (var i = 0; i < resultados.length; i++) {
                            $('#tablaAjax').append(
                                "<tr class=\"datosModelo\">"
                                    + "<td>" + marcaSeleccionada +  "</td>"
                                    + "<td>" + resultados[i][0] + "</td>"
                                    + "<td>" + resultados[i][1] + " litros/100km</td>"
                                + "</tr>"
                            );
                        }

                        $('#tablaAjax').css('display', 'block');
                        $('#muestraAjax').css('display', 'block');
                        
                    }
                    
                },
                error: function(data) {
                    console.log("Datos: " + data);
                }
            });
            
        }

    });

});