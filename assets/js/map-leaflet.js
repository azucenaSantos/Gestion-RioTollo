let mapa = (document.getElementById('map'))

if (mapa) {
    var map = L.map('map').setView([41.94143972277272, -8.777393281038458], 17); // Coordenada inicial

    //Capa satélite gratuita
    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.esri.com/">Esri</a> - Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community'
    }).addTo(map);

    //Objeto para guardar capas de zonas
    var zonasLayers = {};

    //Cargar las zonas de la base de datos
    function cargarZonas() {
        fetch('?c=Jefe&a=getZonas')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    alert('Error: ' + data.error);
                } else {
                    data.forEach(zona => {
                        try {
                            const limites = typeof zona.limites === 'string' ? JSON.parse(zona.limites) : zona.limites;
                            const porcentajeZona = zona.porcentaje_total || 0;

                            //Añadir la capa GeoJSON al mapa
                            const geoJsonLayer = L.geoJSON(limites, {
                                style: {
                                    color: getColor(porcentajeZona),
                                    weight: 3,
                                    opacity: 0.6
                                }
                            }).addTo(map);

                            //Construir contenido del popup con parcelas y porcentaje
                            let popupHtml = `<b>Zona:</b> ${zona.nombre}<br><b>Parcelas:</b><ul>`;
                            if (zona.parcelas && zona.parcelas.length > 0) {
                                zona.parcelas.forEach(parcela => {
                                    // popupHtml += `<li>Parcela ${parcela.num_parcela}: ${parcela.descripcion} - Trabajos completados: ${parcela.porcentaje_total}%</li>`;
                                    popupHtml += `<li>Parcela ${parcela.num_parcela}: Trabajos completados: ${parcela.porcentaje_total}%</li>`;

                                });
                                popupHtml += `<li><a href=""> Más información </a></li>`;
                            } else {
                                popupHtml += '<li>No hay parcelas asociadas a la zona</li>';
                            }
                            popupHtml += '</ul>';

                            geoJsonLayer.bindPopup(popupHtml);

                            // Guardar la capa con el id de la zona
                            zonasLayers[zona.id] = geoJsonLayer;

                        } catch (e) {
                            console.error('Error al cargar zona:', e);
                        }
                    });
                }
            })
            .catch(error => console.error('Error al cargar zonas:', error));
    }

    //Ejecutar función de cargar zonas
    cargarZonas();

    //Select de zonas y zoom a la zona
    document.getElementById('selectorZonas').addEventListener('change', function () {
        const idZona = this.value;
        if (idZona && zonasLayers[idZona]) {
            const layer = zonasLayers[idZona];
            map.fitBounds(layer.getBounds());
            layer.openPopup();
        }
    });

    //Funcion para los colores de las zonas
    function getColor(porcentaje) {
        if (porcentaje >= 80) return '#1a9850';
        if (porcentaje >= 50) return '#66bd63';
        if (porcentaje >= 20) return '#fee08b';
        if (porcentaje > 0) return '#fdae61';
        return '#d73027';
    }

}
