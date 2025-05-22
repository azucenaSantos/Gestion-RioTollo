//Archivo js para rellenar el formulario de reporte segun el valor del select seleccionado por el coordinador
document.addEventListener("DOMContentLoaded", () => {
  const select = document.getElementById("selectorTrabajos");
  const modalBody = document.getElementById("modalBody");

  if (select) {
    cargarTrabajos(select.value); //Carga por defecto del select seleccionado por defecto al cargar la pagina
    actualizarModal(select);
  }
  //Asignamos el change solo si existe el select
  if (select) {
    select.addEventListener("change", () => {
      //Se cargan los trabajos segun la zona seleccionada
      cargarTrabajos(select.value);
      actualizarModal(select);
    });
  }

  //Funcion para cargar los trabajos
  function cargarTrabajos(idTrabajo) {
    //Recogemos los campos del formulario
    const inputGrupo = document.getElementById("inputGrupo");
    const inputHoraInicio = document.getElementById("horaIni");
    const inputHoraFin = document.getElementById("horaFin");
    const inputFecha = document.getElementById("inputFecha");
    // const inputTrabajo = document.getElementById("inputTrabajo");
    const inputPorcentaje = document.getElementById("inputPorcentaje");
    const inputPorcentajeNum = document.getElementById("inputPorcentajeNum");
    const hiddenIdGrupo = document.getElementById("idGrupo");

    fetch(`?c=Coordinador&a=getInfoTrabajos&idTrabajo=${idTrabajo}`)
      .then((response) => response.json())
      .then((data) => {
        // console.log(data);
        if (data.trabajos && data.trabajos.length > 0) {
          inputGrupo.value = data.trabajos[0].nombre_grupo;
          inputHoraInicio.value = data.trabajos[0].hora_inicio;
          inputHoraFin.value = data.trabajos[0].hora_fin;
          inputFecha.value = data.trabajos[0].fecha;
          hiddenIdGrupo.value = data.trabajos[0].id_grupo;
          // inputTrabajo.value = data.trabajos[0].nombre;
          inputPorcentaje.value = data.trabajos[0].porcentaje;
          inputPorcentajeNum.value = data.trabajos[0].porcentaje;
        } else {
          const option = document.createElement("option");
          option.textContent = "No tiene trabajos asociados";
          option.selected = true;
          option.disabled = true;
          select.appendChild(option);
        }
      })
      .catch((error) => console.error("Error al obtener los trabajos:", error));
  }

  function actualizarModal(selectElemento) {
    const opcionSeleccionada =
      selectElemento.options[selectElemento.selectedIndex];
    const trabajoNombre = opcionSeleccionada.textContent;

    if (modalBody) {
      modalBody.textContent = `Se está reportando: "${trabajoNombre}"`;
    }
  }
});
