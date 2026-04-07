<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'astra-theme-css','astra-menu-animation','woocommerce-layout','woocommerce-smallscreen','woocommerce-general' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION


function archivos_necesarios() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1', 'all');
}

add_action('wp_enqueue_scripts', 'archivos_necesarios');

 
/*ocultar el boton añadir a mi tienda*/
function ocultar_elemento_con_css_para_shop_manager() {
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_roles = get_userdata($user_id)->roles;

       // print_r($user_roles);

        if (in_array('shop_manager', $user_roles) || in_array('wcfm_vendor', $user_roles)) {
            ?>
            <style type="text/css">
                .single-product a.wcfm_product_multivendor {
                    display: none !important;
                }
            </style>
            <?php
        }
    }


    ?>
    <style>
        .leaflet-routing-container.leaflet-bar.leaflet-control {
            display: none !important;
        }
    </style>
    <?php

}
add_action('wp_head', 'ocultar_elemento_con_css_para_shop_manager');
/*ocultar el boton añadir a mi tienda*/

function cargar_openstreetmap() {
    // Estilo de Leaflet
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');

    wp_enqueue_style('leaflet-search-css', 'https://unpkg.com/leaflet-search@2.8.0/dist/leaflet-search.min.css');

    wp_enqueue_style('leaflet-geocoder-css', 'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css');

    // Librería de Leaflet
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js');

    // Librería de Leaflet Control Geocoder
    wp_enqueue_script('leaflet-geocoder-js', 'https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js');

    wp_enqueue_script('leaflet-search-js', 'https://unpkg.com/leaflet-search@2.8.0/dist/leaflet-search.min.js');

    // Librería de Leaflet Routing Machine
    wp_enqueue_script('leaflet-routing-machine-js', 'https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js');

    wp_enqueue_script('leaflet-routing-machine-js', 'https://cdn.jsdelivr.net/npm/leaflet-curve@1.0.0/leaflet.curve.min.js');


    // Estilo de Leaflet Control Geocoder
    
}

add_action('wp_enqueue_scripts', 'cargar_openstreetmap');



/** cambiar el texto del option **/
function cambiar_texto_option_con_jquery() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            if ($('#wcfm_products_manage_form_general_expander select#product_type').length > 0) {

                var iconoPDF = $('<i>', {
                    class: 'far fa-file-pdf'
                });

                // Crear el enlace con el ícono y el texto
                var linkPDF = $('<a>', {
                    href: 'https://alquilacosas.com/tutorial.html', // Reemplaza 'tu_enlace_pdf' con la URL deseada
                    text: 'Descargar PDF',
                    class: 'linkPDF',
                    target: '_blank', // Abre el enlace en una nueva ventana/tab
                    html: [iconoPDF, ' Tutorial'] // Agregar el ícono al enlace
                });

                // Insertar el enlace antes del select
                $('#wcfm_products_manage_form_general_expander select#product_type').before(linkPDF);

    

                var optionToChange = $('#wcfm_products_manage_form_general_expander select#product_type option[value="redq_rental"]');

                if (optionToChange.length > 0) {
                    optionToChange.text('Alquiler de Producto o Venta');
                }
            }


            /*enviar formulario hardcode*/
            $(document).on('click', '.actions ul li.proceedOnModal a', function(e) {

                if ($('.actions ul li.proceedOnModal').length > 0 ) {
                    // Obtener el texto del enlace en el tercer elemento
                    var buttonText = $('.actions ul li.proceedOnModal:eq(2) a').text();

                    // Crear el HTML del botón
                    var buttonHTML = '<button type="submit" role="menuitem">' + buttonText + '</button>';

                    // Reemplazar el enlace con el botón en el tercer elemento
                    $('.actions ul li.proceedOnModal:eq(2) a').replaceWith(buttonHTML);

                    if ($('.actions ul li.proceedOnModal:eq(1)').hasClass('disabled')) {
                        // Agregar estilos al tercer elemento si el segundo tiene la clase "disabled"
                        $('.actions ul li.proceedOnModal:eq(2)').css('display', 'block');
                    }
                }
            });
            /*enviar formulario hardcode*/

        });


/**mapa */



window.onload = function (event) {
  var originInput = document.getElementById('rnb-origin-autocomplete');
  var destinationInput = document.getElementById('rnb-destination-autocomplete');
  var map = L.map('rnb-map').setView([-17.783229, -63.182128], 10);//ubicacion inicial (Santa cruz, Bolivia)

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

    /*fix mapa para redimiencionan la pantalla*/
    function adjustMapSize() {
        console.log('reajusta 2');
        map.invalidateSize();
    }
    
    //map.on('load', adjustMapSize); // fix al cargar
    window.addEventListener('resize', adjustMapSize);
    /*fix mapa para redimiencionan la pantalla*/

    /*ajustar el mapa para que funcione cuando esta en un div hidden*/
    var visibilityCheckInterval = setInterval(function () {
        var container = document.getElementById('rnbSmartwizard-p-1');
        
        if (container && getComputedStyle(container).display !== 'none') {
            clearInterval(visibilityCheckInterval); // Detener el intervalo una vez que el contenedor esté visible
            adjustMapSize(); // Llamar a adjustMapSize cuando el contenedor esté visible
        }
    }, 100);
    /*ajustar el mapa para que funcione cuando esta en un div hidden*/

    var originMarker = null;
    var destinationMarker = null;

    

    /*DRAG FUNCION*/
    if (originMarker && destinationMarker) {
        // Configuración del arrastre para el marcador de origen
        originMarker.dragging.enable();
        originMarker.on('drag', function (event) {

            var latlng = event.target.getLatLng();

            console('latlng.lat, latlng.lng');
            console(latlng.lat, latlng.lng);
            // Obtener la ubicación a partir de la latitud y longitud
            reverseGeocode(latlng.lat, latlng.lng, function (location) {
                originInput.value = location.display_name;
                handlePlaceSelection(location, originInput, originMarker);
            });

            
        });

        // Configuración del arrastre para el marcador de destino
        destinationMarker.dragging.enable();
        destinationMarker.on('drag', function (event) {
           
            var latlng = event.target.getLatLng();

            console('latlng.lat, latlng.lng');
            console(latlng.lat, latlng.lng);
            // Obtener la ubicación a partir de la latitud y longitud
            reverseGeocode(latlng.lat, latlng.lng, function (location) {
                destinationInput.value = location.display_name;
                handlePlaceSelection(location, destinationInput, destinationMarker);
            });

            
        });
    }



    
    /*DRAG FUNCION*/

    const limitesGeograficos = {
        latitud: { min: -90, max: 90 },
        longitud: { min: -180, max: 180 }
    };

    function performSearch(input, callback) {
        var apiUrl = 'https://nominatim.openstreetmap.org/search?format=json&limit=10&q=' + encodeURIComponent(input.value);

        fetch(apiUrl)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                // Verificar si las coordenadas están dentro de los límites geográficos antes de continuar
                const primerResultado = data[0]; // Obtén el primer resultado como ejemplo
                if (esCoordenadaValida(primerResultado)) {
                    callback(data);
                } else {
                    console.warn('Las coordenadas están fuera de los límites geográficos permitidos.');
                }
            })
            .catch(function (error) {
                console.error('Error fetching search results:', error);
            });
    }

    function esCoordenadaValida(resultado) {
        if (resultado && resultado.lat && resultado.lon) {
            const lat = parseFloat(resultado.lat);
            const lon = parseFloat(resultado.lon);
            const latValida = lat >= limitesGeograficos.latitud.min && lat <= limitesGeograficos.latitud.max;
            const lonValida = lon >= limitesGeograficos.longitud.min && lon <= limitesGeograficos.longitud.max;
            return latValida && lonValida;
        }
        return false;
    }

    // Función para manejar la selección de un lugar de búsqueda
    /** */
    function handlePlaceSelection(place, input, marker) {

        if (input.classList.contains('current-search')) {
            if (marker) {
                map.removeLayer(marker);
            }
        }

        if (marker) {
            map.removeLayer(marker);
        }

        var lat = parseFloat(place.lat);
        var lon = parseFloat(place.lon);

        input.value = place.display_name;

        if (marker) {
            marker.setLatLng([lat, lon], { draggable: true });
        } else {
            marker = L.marker([lat, lon], { draggable: true }).addTo(map);
        }

        // Actualizar marcadores según el campo de entrada modificado
        if (input === originInput) {
            // Campo de origen modificado
            originMarker = marker;
            console.log('originMarker')
            console.log(originMarker)

        } else if (input === destinationInput) {
            // Campo de destino modificado
            destinationMarker = marker;
            console.log('destinationMarker')
            console.log(destinationMarker)
        }

        // Verificar si ambos marcadores existen
        if (originMarker && destinationMarker) {
            // Calcular límites que contienen ambos marcadores
            var bounds = L.latLngBounds([originMarker.getLatLng(), destinationMarker.getLatLng()]);

            // Ajustar el zoom y centrar el mapa para que se vean ambos marcadores
            console.log('2 markeres')
            map.fitBounds(bounds);
        } else {
            console.log('solo un marker')
            // Si solo hay un marcador, centrar el mapa en ese marcador con zoom 10
            map.setView([lat, lon], 10);
        }

        // Si existen ambos marcadores, trazar la ruta entre ellos
        if (originMarker && destinationMarker) {
            displayRoute(originMarker.getLatLng(), destinationMarker.getLatLng(), map);
        }
    }




    function displayRoute(originLatLng, destinationLatLng, map) {

        var directLine;

        // Crear un control de enrutamiento si no existe
        if (!L.Routing) {
            console.error('Leaflet Routing Machine no está cargado.');
            return;
        }

        // Crear un control de enrutamiento si no existe
        
        if (!map.routingControl) {

            map.routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(originLatLng),
                    L.latLng(destinationLatLng)
                ]

            }).addTo(map).on('routingerror', function (error) {

                var errorUrl = error.error.url;
                console.log(errorUrl);
                var match = errorUrl.match(/\/driving\/(.+?)\?/);
                console.log(match);

                if (match) {
                    var coordinates = match[1].split(';');
                    var coordinatesArray = coordinates.map(coord => coord.split(','));
                    
                    console.log('coordinatesArray')
                    console.log(coordinatesArray)

                    console.log('Primera coordenada:', coordinatesArray[0]); // Longitud
                    console.log('Segunda coordenada:', coordinatesArray[1]);

                    // Invertir el orden de las coordenadas (latitud, longitud)
                    var invertedCoordinates = coordinatesArray.map(coord => [coord[1], coord[0]]);

                    console.log('Inverted Coordinates:');
                    console.log(invertedCoordinates);

                    console.log(invertedCoordinates[0][0], invertedCoordinates[0][1])

                    console.log('-----------');

                    console.log(invertedCoordinates[1][0], invertedCoordinates[1][1])

                    // Verificar si la capa directLine existe antes de intentar quitarla
                    if (directLine) {
                        // Si hay un error y ya existe una línea, quitar la línea anterior
                        map.removeLayer(directLine);
                    }

                    /**/

                    // Función para realizar la inversión geográfica (reverse geocoding)
                    function reverseGeocodeError(lat, lon, callback) {
                        var apiUrl = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lon;

                        fetch(apiUrl)
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (data) {
                                if (data.display_name) {
                                    callback(data);
                                } else {
                                    console.warn('No se pudo obtener la información de ubicación inversa.');
                                }
                            })
                            .catch(function (error) {
                                console.error('Error fetching reverse geocoding results:', error);
                            });
                    }
                    // Realizar búsqueda inversa para las coordenadas invertidas
                    reverseGeocodeError(invertedCoordinates[0][0], invertedCoordinates[0][1], function (originLocation) {
                        console.log('originLocation')
                        console.log(originLocation)
                        console.log(originLocation.display_name)
                        if (originInput.value.indexOf(originLocation.display_name) === -1) {
                            originInput.value = originLocation.display_name;
                            // Llamar a handlePlaceSelection si es necesario
                            //handlePlaceSelection(originLocation, originInput, originMarker);
                        }
                    });

                    // Realizar búsqueda inversa para las coordenadas invertidas del destino
                    reverseGeocodeError(invertedCoordinates[1][0], invertedCoordinates[1][1], function (destinationLocation) {
                        console.log('destinationLocation')
                        console.log(destinationLocation)
                        console.log(destinationLocation.display_name)
                        if (destinationInput.value.indexOf(destinationLocation.display_name) === -1) {
                            destinationInput.value = destinationLocation.display_name;
                            // Llamar a handlePlaceSelection si es necesario
                            // handlePlaceSelection(destinationLocation, destinationInput, destinationMarker);
                        }
                    });
                    /**/

                    // Crear una nueva línea recta entre los dos puntos actualizados
                    directLine = L.polyline(invertedCoordinates, { color: 'gray', dashArray: '5, 5' }).addTo(map);
                }

                
            }).on('routesfound', function (event) {
                console.log('routesfound')
                console.log(event)
                // Verificar si la capa directLine existe antes de intentar quitarla
                if (directLine) {
                    // Si se encontró una ruta, quitar la línea trazada
                    map.removeLayer(directLine);
                }

                /*RUTAS ENCONTRADAS*/
                var waypoints = event.waypoints;
                console.log('waypoints')
                console.log(waypoints)

                // Verificar si hay al menos dos waypoints
                if (waypoints.length >= 2) {
                    // Obtener las coordenadas de los waypoints
                    var originLatLng = waypoints[0].latLng;
                    var destinationLatLng = waypoints[waypoints.length - 1].latLng;

                    // Función para realizar la inversión geográfica (reverse geocoding)
                    function reverseGeocode(lat, lon, callback) {
                        var apiUrl = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lon;

                        fetch(apiUrl)
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (data) {
                                if (data.display_name) {
                                    callback(data);
                                } else {
                                    console.warn('No se pudo obtener la información de ubicación inversa.');
                                }
                            })
                            .catch(function (error) {
                                console.error('Error fetching reverse geocoding results:', error);
                            });
                    }

                    // Realizar búsqueda inversa para el origen
                    reverseGeocode(originLatLng.lat, originLatLng.lng, function (originLocation) {
                        console.log('originLocation')
                        console.log(originLocation)
                        console.log(originLocation.display_name)
                        if (originInput.value.indexOf(originLocation.display_name) === -1) {
                            originInput.value = originLocation.display_name;
                            // Llamar a handlePlaceSelection si es necesario
                            //handlePlaceSelection(originLocation, originInput, originMarker);
                        }
                    });

                    // Realizar búsqueda inversa para el destino
                    reverseGeocode(destinationLatLng.lat, destinationLatLng.lng, function (destinationLocation) {
                        console.log('destinationLocation')
                        console.log(destinationLocation)
                        console.log(destinationLocation.display_name)
                        if (destinationInput.value.indexOf(destinationLocation.display_name) === -1) {
                            destinationInput.value = destinationLocation.display_name;
                            // Llamar a handlePlaceSelection si es necesario
                           // handlePlaceSelection(destinationLocation, destinationInput, destinationMarker);
                        }
                    });
                }
                

                /*RUTAS ENCONTRADAS*/

            }).on('routingstart', function (event) {

                if (originMarker ) {
                    map.removeLayer(originMarker);
                }

                if (destinationMarker ) {
                    map.removeLayer(destinationMarker);
                }

                console.log('routingstart')
                console.log(event)
                // Limpiar la capa directLine al iniciar una nueva búsqueda de ruta
                if (directLine) {
                    map.removeLayer(directLine);
                }
            });
            console.log('map.routingControl no hay')
            console.log(map.routingControl)
        } else {

            if (directLine) {
                    // Si se encontró una ruta, quitar la línea trazada
                map.removeLayer(directLine);
            }

            // Actualizar waypoints si el control ya existe
            map.routingControl.setWaypoints([
                L.latLng(originLatLng),
                L.latLng(destinationLatLng)
            ]);

            console.log('map.routingControl ACTUALIZA')
            console.log(map.routingControl)
        }
    }



  /** */

  // Función para crear y mostrar la lista desplegable de resultados
    function showResultsDropdown(results, input, marker) {
        var dropdownContainer = input.parentNode.querySelector('.search-results-dropdown');
        if (dropdownContainer) {
        dropdownContainer.remove();
        }

        dropdownContainer = document.createElement('div');
        dropdownContainer.className = 'search-results-dropdown';

        // Agregar la búsqueda actual al principio de los resultados
        var currentSearchItem = document.createElement('div');
        currentSearchItem.className = 'search-result-item current-search';
        currentSearchItem.textContent = input.value;

        currentSearchItem.addEventListener('click', function () {
            // Manejar la búsqueda actual como un nuevo lugar (puedes ajustar esto según tus necesidades)
            performSearch(input, function (results) {
                if (results && results.length > 0) {
                    handlePlaceSelection(results[0], input, marker);
                }
            });

            dropdownContainer.remove();
        });

        dropdownContainer.appendChild(currentSearchItem);
        

        results.forEach(function (result) {
        var resultItem = document.createElement('div');
        resultItem.className = 'search-result-item';
        resultItem.textContent = result.display_name;

        resultItem.addEventListener('click', function () {
            handlePlaceSelection(result, input, marker);
            dropdownContainer.remove();
        });

        dropdownContainer.appendChild(resultItem);
        });

        var inputRect = input.getBoundingClientRect();
        dropdownContainer.style.position = 'relative';
        dropdownContainer.style.width = '100%';

        input.parentNode.appendChild(dropdownContainer);
    }

    // Manejar la entrada de texto en el campo de origen
    originInput.addEventListener('input', function () {
        var input = this;
        performSearch(input, function (results) {
        showResultsDropdown(results, input, originMarker);
        });
    });

    // Manejar la entrada de texto en el campo de destino
    destinationInput.addEventListener('input', function () {
        var input = this;
        performSearch(input, function (results) {
        showResultsDropdown(results, input, destinationMarker);
        });
    });

    // Cerrar la lista desplegable al hacer clic fuera de ella
    document.addEventListener('click', function (event) {
        var dropdownContainers = document.querySelectorAll('.search-results-dropdown');
        dropdownContainers.forEach(function (dropdownContainer) {
        if (!dropdownContainer.contains(event.target)) {
            dropdownContainer.remove();
        }
        });
    });
};







/**mapa */
        
    </script>
    <?php
}
add_action('wp_footer', 'cambiar_texto_option_con_jquery');
/** cambiar el texto del option **/

add_filter( 'wcfm_is_allow_desktop_notification', '__return_true' );
add_filter( 'wcfm_is_allow_new_message_check', '__return_true' );
add_filter( 'wcfm_orders_is_allow_auto_refresher', '__return_true' );
add_filter( 'wcfm_new_message_check_duration', function($time) {
return 5000; // its in milisecond so 10000 = 10s
} );


function script_solicitar_permisos_y_enviar_notificaciones() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    // Las notificaciones ya están activadas, puedes realizar acciones adicionales si es necesario.
                    console.log('Notificaciones ya están activadas.');
                } else {
                    // Las notificaciones no están activadas, solicitar permisos.
                    Notification.requestPermission().then(function(permission) {
                        if (permission === 'granted') {
                            // Permiso concedido, puedes mostrar notificaciones.
                            var notification = new Notification('¡Notificaciones activadas!', {
                                body: 'Ahora recibirás notificaciones en este dispositivo.'
                            });

                            // Ejemplo de acción al hacer clic en la notificación
                            notification.onclick = function() {
                                console.log('La notificación fue clicada.');
                            };
                        }
                    });
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'script_solicitar_permisos_y_enviar_notificaciones');

/** funciones generales js **/
function js_funciones_generales() {
?>
<script type="text/javascript">

jQuery(document).ready(function($) {
    // Obtener el elemento con el ID "wcfm_products_manage_form_redq_rental_head"

    if($('#wcfm_products_manage_form_redq_rental_head').length>0){
        var $elementToMove = $('#wcfm_products_manage_form_redq_rental_head');
        var $elementToMove2 = $('.wcfm-container.redq_rental.non-variable-subscription');

        // Obtener el contenedor con la clase "wcfm-tabWrap-content"
        var $container = $('.wcfm-tabWrap-content');

        // Mover el elemento al principio del contenedor
        $elementToMove2.prependTo($container);
        $elementToMove.prependTo($container);
        

    }
    
});


</script>
<?php
}
add_action('wp_footer', 'js_funciones_generales');
/** funciones generales js **/
 

