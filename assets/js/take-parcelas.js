document.addEventListener('DOMContentLoaded', function () {
    const inputZona = document.getElementById('inputZona');
    const opcionesDisponibles = document.getElementById('opcionesDisponibles');
    const opcionesSeleccionadas = document.getElementById('opcionesSeleccionadas');
    const addParcelaButton = document.getElementById('addParcela');
    const removeParcelaButton = document.getElementById('removeParcela');
    //Funcion para cargar las parcelas
    function cargarParcelas(zonaId, cargarEnSeleccionadas = false) {
        fetch(`getParcelas.php?zonaId=${zonaId}`) // Pasamos al getParcelas.php el id de la zona seleccionada
            .then(response => response.json())
            .then(data => {
                const destino = cargarEnSeleccionadas ? opcionesSeleccionadas : opcionesDisponibles;
                if (destino) {
                    destino.innerHTML = '';

                    if (data.parcelas && data.parcelas.length > 0) {
                        data.parcelas.forEach(parcela => {
                            const option = document.createElement('option');
                            option.value = parcela;
                            option.textContent = parcela;
                            destino.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.textContent = 'No hay parcelas en esta zona';
                        option.disabled = true;
                        destino.appendChild(option);
                    }
                }
            })
            .catch(error => console.error('Error al obtener las parcelas:', error));
    }
    //Controlar el contenido de parcelas seleccionadas
    if (inputZona && inputZona.value) {
        cargarParcelas(inputZona.value, true); //carga en seleccionadas
    }
    if (inputZona) {
        inputZona.addEventListener('change', function () {
            opcionesSeleccionadas.innerHTML = ''; //Limpiar las seleccionadas al cambiar de zona
            cargarParcelas(this.value, false); //carga en disponibles
        });
    }

    //Funcion para mover opciones entre selects
    function moverOpciones(origen, destino) {
        const opcionesSeleccionadas = Array.from(origen.selectedOptions);
        opcionesSeleccionadas.forEach(opcion => {
            destino.appendChild(opcion);
        });
    }
    if (addParcelaButton && removeParcelaButton) {
        //Controlar los botones de añadir y quitar parcelas
        addParcelaButton.addEventListener('click', function () {
            moverOpciones(opcionesDisponibles, opcionesSeleccionadas);
        });
        removeParcelaButton.addEventListener('click', function () {
            moverOpciones(opcionesSeleccionadas, opcionesDisponibles);
        });
    }



});