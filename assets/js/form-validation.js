document.addEventListener("DOMContentLoaded", function () {
    //Formularios á validar
    const formGrupo = document.getElementById("formGrupo");
    const formTrabajo = document.getElementById("formTrabajo");

    //Funcion de validacion de campos vacios
    function validarCampo(campo) {
        if (campo.value.trim() === "") {
            campo.classList.add("is-invalid");
            campo.classList.remove("is-valid");
            return false;
        } else {
            campo.classList.remove("is-invalid");
            campo.classList.add("is-valid");
            return true;
        }
    }

    //Funcion validar formularioGrupo
    function validarFormularioGrupo(event) {
        const nombreGrupo = document.getElementById("inputGrupo");
        const coordinador = document.getElementById("inputCoordinador");
        const integrantes = document.getElementById("selectMultiple");
        const integrantesSeleccionados = Array.from(integrantes.selectedOptions).map(option => option.value);
        const errorGrupo = document.getElementById("errorGrupo");
        const errorCoordi = document.getElementById("errorCoordinador");
        const errorIntegrantes = document.getElementById("errorIntegrantes");

        let isValid = true;
        //Nombre
        if (!validarCampo(nombreGrupo)) {
            isValid = false;
            nombreGrupo.classList.add("input-error");
            errorGrupo.classList.add("alert", "alert-danger");
            errorGrupo.textContent = "El nombre del grupo no puede estar vacío.";
        } else {
            nombreGrupo.classList.remove("input-error");
            errorGrupo.classList.remove("alert", "alert-danger");
            errorGrupo.textContent = "";
        }
        //Coordinador
        if (coordinador.value == "noSeleccion") {
            isValid = false;
            coordinador.classList.add("input-error");
            errorCoordi.classList.add("alert", "alert-danger");
            errorCoordi.textContent = "Debes seleccionar un coordinador.";
        } else {
            coordinador.classList.remove("input-error");
            errorCoordi.classList.remove("alert", "alert-danger");
            errorCoordi.textContent = "";
        }
        //Integrantes
        if (integrantesSeleccionados.length === 0) {
            isValid = false;
            errorIntegrantes.classList.add("alert", "alert-danger");
            errorIntegrantes.textContent = "Debes seleccionar al menos un integrante.";
        } else {
            errorIntegrantes.textContent = "";
            errorIntegrantes.classList.remove("alert", "alert-danger");

        }

        if (!isValid) {
            console.log("Formulario no válido. Evitando envío.");
            event.preventDefault(); //Evitar envio del formulario
        }

    }

    //Funcion validar formularioTrabajo
    function validarFormularioTrabajo(event) {
        const nombreTrabajo = document.getElementById("inputTrabajo");
        const zonaTrabajo = document.getElementById("inputZona");
        const parcelas = document.getElementById("selectMultipleParcelas");
        const finalizadoSi = document.getElementById("finalizadoSi");
        const finalizadoNo = document.getElementById("finalizadoNo");
        const horarioInicio = document.getElementById("horaIni");
        const horarioFin = document.getElementById("horaFin");
        const fecha = document.getElementById("inputFecha");
        const grupo = document.getElementById("inputGrupo");
        //anotaciones y porcentaje son opcionales
        const errorTrabajo = document.getElementById("errorTrabajo");
        const errorZona = document.getElementById("errorZona");
        const errorParcelas = document.getElementById("errorParcelas");
        const errorFinalizado = document.getElementById("errorFinalizado");
        const errorHorario = document.getElementById("errorHorario");
        const errorFecha = document.getElementById("errorFecha");
        const errorGrupo = document.getElementById("errorGrupoTrabajo");

        let isValid = true;
        //Nombre
        if (!validarCampo(nombreTrabajo)) {
            isValid = false;
            nombreTrabajo.classList.add("input-error");
            errorTrabajo.classList.add("alert", "alert-danger");
            errorTrabajo.textContent = "El nombre del trabajo no puede estar vacío.";
        } else {
            nombreTrabajo.classList.remove("input-error");
            errorTrabajo.classList.remove("alert", "alert-danger");
            errorTrabajo.textContent = "";
        }
        //Zona
        console.log(zonaTrabajo.value);
        if (zonaTrabajo.value == "noSeleccion") {
            isValid = false;
            zonaTrabajo.classList.add("input-error");
            errorZona.classList.add("alert", "alert-danger");
            errorZona.textContent = "Debes seleccionar una zona de trabajo.";
        } else {
            zonaTrabajo.classList.remove("input-error");
            errorZona.classList.remove("alert", "alert-danger");
            errorZona.textContent = "";
        }
        //Parcelas
        const parcelasSeleccionadas = Array.from(parcelas.selectedOptions).map(option => option.value); 
        if (parcelasSeleccionadas.length === 0) {
            isValid = false;
            errorParcelas.classList.add("alert", "alert-danger");
            errorParcelas.textContent = "Debes seleccionar al menos una parcela.";
        } else {
            errorParcelas.textContent = "";
            errorParcelas.classList.remove("alert", "alert-danger");

        }
        //Finalizado
        if (!finalizadoSi.checked && !finalizadoNo.checked) {
            isValid = false;
            errorFinalizado.classList.add("alert", "alert-danger");
            errorFinalizado.textContent = "Debes seleccionar si el trabajo está finalizado o no.";
        } else {
            errorFinalizado.textContent = "";
            errorFinalizado.classList.remove("alert", "alert-danger");

        }
        //Horario   
        if (horarioInicio.value === "" || horarioFin.value === "") {
            isValid = false;
            errorHorario.classList.add("alert", "alert-danger");
            errorHorario.textContent = "Debes seleccionar un horario de inicio y fin.";
        } else {
            errorHorario.textContent = "";
            errorHorario.classList.remove("alert", "alert-danger");

        }
        //Fecha
        if (fecha.value === "") {
            isValid = false;
            errorFecha.classList.add("alert", "alert-danger");
            errorFecha.textContent = "Debes seleccionar una fecha.";
        } else {
            errorFecha.textContent = "";
            errorFecha.classList.remove("alert", "alert-danger");

        }   
        //Grupo
        if (grupo.value == "noSeleccion") {
            isValid = false;
            grupo.classList.add("input-error");
            errorGrupo.classList.add("alert", "alert-danger");
            errorGrupo.textContent = "Debes seleccionar un grupo.";
        } else {
            grupo.classList.remove("input-error");
            errorGrupo.classList.remove("alert", "alert-danger");
            errorGrupo.textContent = "";
        }        
        if (!isValid) {
            console.log("Formulario no válido. Evitando envío.");
            event.preventDefault(); //Evitar envio del formulario
        }

    }

    //Añadir las funciones de validacion a cada formulario cuando se envíen
    if (formGrupo) {
        formGrupo.addEventListener("submit", validarFormularioGrupo);
    }
    if (formTrabajo) {
        formTrabajo.addEventListener("submit", validarFormularioTrabajo);
    }

});