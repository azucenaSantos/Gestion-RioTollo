let mapa = document.getElementById("map");

if (mapa) {
  var map = L.map("map").setView([41.939595, -8.772415], 16); // Coordenada inicial

  //Capa satélite gratuita
  L.tileLayer(
    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
    {
      maxZoom: 19,
      attribution:
        '&copy; <a href="https://www.esri.com/">Esri</a> - Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community',
    }
  ).addTo(map);

  //Objeto para guardar capas de zonas
  var zonasLayers = {};

  //Cargar las zonas de la base de datos
  function cargarZonas() {
    fetch("?c=Jefe&a=getTrabajosZonas")
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          console.error(data.error);
          alert("Error: " + data.error);
        } else {
          console.log("Zonas cargadas:", data);
          data.forEach((zona) => {
            try {
              const limites =
                typeof zona.limites === "string"
                  ? JSON.parse(zona.limites)
                  : zona.limites;
              const porcentajeZona = zona.porcentaje_total || 0;

              //Añadir la capa GeoJSON al mapa
              const geoJsonLayer = L.geoJSON(limites, {
                style: {
                  color: getColor(porcentajeZona),
                  weight: 3,
                  opacity: 0.6,
                },
              }).addTo(map);
              // Construir contenido del popup con trabajos, porcentajes y parcelas asociadas
              let popupHtml = `<b class="zona">${zona.nombre}</b><br>`;
              if (zona.parcelas && Object.keys(zona.parcelas).length > 0) {
                const trabajos = {};
                // Recopilar trabajos, porcentajes y parcelas asociadas
                Object.values(zona.parcelas).forEach((parcela) => {
                  if (parcela.trabajos && parcela.trabajos.length > 0) {
                    parcela.trabajos.forEach((trabajo) => {
                      if (trabajo.trabajo != null) {
                        if (!trabajos[trabajo.trabajo]) {
                          trabajos[trabajo.trabajo] = {
                            porcentaje: trabajo.porcentaje,
                            parcelas: [],
                          };
                        }
                        trabajos[trabajo.trabajo].parcelas.push(
                          parcela.num_parcela
                        );
                      }
                    });
                  }
                });
                //Agregar trabajos, porcentajes y parcelas al popup
                if (Object.keys(trabajos).length > 0) {
                  popupHtml += `<b>Trabajos:</b>`;
                }else{
                  popupHtml += `<b>No hay trabajos registrados</b>`;
                }
                Object.entries(trabajos).forEach(([trabajo, data]) => {
                  popupHtml += `<ul>
                  <li>${trabajo} <b>(${data.porcentaje}%)</b></li>
                  <ul><li class="parcelas-li"> Parcelas: ${data.parcelas.join(
                    ", "
                  )}</li></ul></li></ul>`;
                });
              } else {
                popupHtml += "<li>No hay parcelas asociadas a esta zona</li>";
              }
              popupHtml += "</ul><hr>";
              if (zona.porcentaje_total > 0) {
                popupHtml += `<b>Promedio realizado: ≈ ${zona.porcentaje_total}%</b><br>`;
              }
              popupHtml += `<a href="?c=Jefe&a=gestionTrabajos">Más información</a>`;
              //Añadir el pop up a la capa
              geoJsonLayer.bindPopup(popupHtml);
              //Guardar la capa con el id de la zona
              zonasLayers[zona.id] = geoJsonLayer;
            } catch (e) {
              console.error("Error al cargar zona:", e);
            }
          });
        }
      })
      .catch((error) => console.error("Error al cargar zonas:", error));
  }

  //Ejecutar función de cargar zonas
  cargarZonas();

  //Select de zonas y zoom a la zona
  document
    .getElementById("selectorZonas")
    .addEventListener("change", function () {
      const idZona = this.value;
      if (idZona && zonasLayers[idZona]) {
        const layer = zonasLayers[idZona];
        map.fitBounds(layer.getBounds());
        layer.openPopup();
      }
    });

  //Funcion para los colores de las zonas
  function getColor(porcentaje) {
    if (porcentaje >= 80) return "#1a9850";
    if (porcentaje >= 50) return "#66bd63";
    if (porcentaje >= 20) return "#fee08b";
    if (porcentaje > 0) return "#fdae61";
    return "#d73027";
  }
}
