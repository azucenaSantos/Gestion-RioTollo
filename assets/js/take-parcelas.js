document.addEventListener('DOMContentLoaded', function () {
    //Funcion plugin select multiple
    new SideBySideMultiselect({
        labels: {
            selected: 'Elementos seleccionados: ',
            filter: 'Buscar ...'
        }
    });

    const selectMultiple = document.getElementById("selectMultipleParcelas");
    const inputZona = document.getElementById("inputZona");

    //Funcion para cargar las parcelas
    function cargarParcelas(zonaId) {
        fetch(`?c=Jefe&a=getParcelas&zonaId=${zonaId}`) // Pasamos al getParcelas.php el id de la zona seleccionada
            .then(response => response.json())
            .then(data => {
                if (data.parcelas && data.parcelas.length > 0) {
                    // console.log(data.parcelas);
                    data.parcelas.forEach(parcela => {
                        const option = document.createElement('option');
                        option.value = parcela.id;
                        option.textContent = parcela.num_parcela;
                        selectMultiple.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.textContent = 'No hay parcelas en esta zona';
                    option.disabled = true;
                    selectMultiple.appendChild(option);
                }
                const creacionPlugin = document.querySelector('.side-by-side-multiselectfilter');
                const creacionPlugin2 = document.querySelector('.side-by-side-multiselect');
                creacionPlugin.remove();
                creacionPlugin2.remove();
                new SideBySideMultiselect({
                    labels: {
                        selected: 'Elementos seleccionados: ',
                        filter: 'Buscar...'
                    }
                });
            })
            .catch(error => console.error('Error al obtener las parcelas:', error));
    }

    if (inputZona) {
        //Llamar a la funcion cuando se cambie el select de zonas
        inputZona.addEventListener('change', function () {
            selectMultiple.innerHTML = ''; //Vaciar el select
            cargarParcelas(this.value);
        });
        // //Si hay una zona seleccionada al cargar la página, carga las parcelas de esa zona
        // if (inputZona.value) {
        //     cargarParcelas(inputZona.value);
        // }
    }


});