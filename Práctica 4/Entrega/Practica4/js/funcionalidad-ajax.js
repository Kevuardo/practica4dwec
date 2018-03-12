var marcaSeleccionada; /* La marca seleccionada por el usuario en el componente select. */
var modelosRecogidos; /* Variable global para guardar los modelos sin necesidad de buscarlos de nuevo. */
var bandera = 0; /* Variable que almacena la posición del último modleo mostrado en cada paginación.*/
var modelosPorPagina = 25; /* Hace las veces de constante para marcar cuántos modelos mostrará por página. */

$(document).ready(function() {
    
    $('.btnAnterior').on('click', function() {
        mostrarResultados(modelosRecogidos, "atras");
    });
    
    $('.btnSiguiente').on('click', function() {
        mostrarResultados(modelosRecogidos, "adelante");
    });

    $('#boton-busqueda-ajax').on('click', function(){

        marcaSeleccionada = $("#marca-seleccionada").val();
            
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
                        
                        modelosRecogidos = resultados;
                        
                        mostrarResultados(modelosRecogidos, "inicial");
                        
                    }
                    
                },
                error: function(data) {
                    console.log("Datos: " + data);
                }
            });
            
        }

    });

});

/* Esta función recorre los elementos recogidos por la consulta AJAX y los muestra en la tabla,
 * pero con paginación de elementos para no saturar la vista. */
function mostrarResultados(resultados, navegacion) {
    
    if (navegacion == "atras") {
        
        /* Carga los datos en la tabla y la hace visible. */
        $('#nombreMarca').html(marcaSeleccionada);

        $('#tablaAjax').html(
            "<tr>"
                + "<th>Marca</th>"
                + "<th>Modelo</th>"
                + "<th>Consumo</th>"
            + "</tr>"
        );

        for (var i = (modelosPorPagina); 0 < i; i--) {
            console.log("Bajada " + (bandera - i));
            $('#tablaAjax').append(
                "<tr class=\"datosModelo\">"
                    + "<td>" + marcaSeleccionada +  "</td>"
                    + "<td>" + resultados[bandera - i][0] + "</td>"
                    + "<td>" + resultados[bandera - i][1] + " litros/100km</td>"
                + "</tr>"
            );
        }

        $('#tablaAjax').css('display', 'block');
        $('#muestraAjax').css('display', 'block');
        
        /* Cambios de botones de navegación y bandera. */
        if ((bandera - modelosPorPagina) >= modelosPorPagina) {
            bandera -= modelosPorPagina;
        } else if ((bandera - modelosPorPagina) <= modelosPorPagina) {
            bandera = 0;
            $('.btnAnterior').css('display', 'none');
        }
        
    } else if (navegacion == "adelante" || navegacion == "inicial") {
        
        /* Carga los datos en la tabla y la hace visible. */
        $('#nombreMarca').html(marcaSeleccionada);

        $('#tablaAjax').html(
            "<tr>"
                + "<th>Marca</th>"
                + "<th>Modelo</th>"
                + "<th>Consumo</th>"
            + "</tr>"
        );

        for (var i = 0; i < modelosPorPagina; i++) {
            console.log("Subida " + (i + bandera));
            $('#tablaAjax').append(
                "<tr class=\"datosModelo\">"
                    + "<td>" + marcaSeleccionada +  "</td>"
                    + "<td>" + resultados[i + bandera][0] + "</td>"
                    + "<td>" + resultados[i + bandera][1] + " litros/100km</td>"
                + "</tr>"
            );
        }
        
        $('#tablaAjax').css('display', 'block');
        $('#muestraAjax').css('display', 'block');
        
        /* Cambios de botones de navegación y bandera. */
        if (bandera == 0) {
            bandera += modelosPorPagina;
            $('.btnSiguiente').css('display', 'block');
        } else if ((bandera - modelosPorPagina) < resultados.length) {
            bandera += modelosPorPagina;
        } else if ((bandera - modelosPorPagina) >= resultados.length) {
            bandera = resultados.length();
            $('.btnSiguiente').css('display', 'none');
        }
        
        if (bandera >= (modelosPorPagina + 1)) {
            $('.btnAnterior').css('display', 'block');
        } else {
            $('.btnAnterior').css('display', 'none');
        }
        
    }
    
}