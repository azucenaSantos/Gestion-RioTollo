document.addEventListener("DOMContentLoaded", function () {
  //Formularios á validar
  const formGrupo = document.getElementById("formGrupo");
  const formTrabajo = document.getElementById("formTrabajo");
  const formTrabajador = document.getElementById("formTrabajador");
  const errorCliente = document.getElementById("erroresCliente");

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
  //Funcion para validar campo solo letras
  function validarCampoLetras(campo) {
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (campo.value.trim() === "" || !regex.test(campo.value)) {
      campo.classList.add("is-invalid");
      campo.classList.remove("is-valid");
      return false;
    } else {
      campo.classList.remove("is-invalid");
      campo.classList.add("is-valid");
      return true;
    }
  }

  //Funcion para validar campo letras y numeros
  function validarCampoLetrasNumeros(campo) {
    const regex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/;
    if (campo.value.trim() === "" || !regex.test(campo.value)) {
      campo.classList.add("is-invalid");
      campo.classList.remove("is-valid");
      return false;
    } else {
      campo.classList.remove("is-invalid");
      campo.classList.add("is-valid");
      return true;
    }
  }

  //Funcion para validar una fecha válida
  function validarFecha(fecha) {
    const regex = /^\d{4}-\d{2}-\d{2}$/;
    if (!regex.test(fecha)) {
      return false;
    }
    const fechaObj = new Date(fecha);
    return fechaObj instanceof Date && !isNaN(fechaObj);
  }

  //Funcion validar formularioGrupo
  function validarFormularioGrupo(event) {
    const nombreGrupo = document.getElementById("inputGrupo");
    const coordinador = document.getElementById("inputCoordinador");
    const integrantes = document.getElementById("selectMultiple");
    //Convertimos a array el select multiple para comprobar su longitud
    const integrantesSeleccionados = Array.from(
      integrantes.selectedOptions
    ).map((option) => option.value);
    const errorGrupo = document.getElementById("errorGrupo");
    const errorCoordi = document.getElementById("errorCoordinador");
    const errorIntegrantes = document.getElementById("errorIntegrantes");

    let isValid = true;
    //Nombre
    if (!validarCampo(nombreGrupo)) {
      isValid = false;
      nombreGrupo.classList.add("input-error");
      errorGrupo.classList.add("alert", "alert-danger");
      errorGrupo.innerHTML =
        "El&nbsp <strong>nombre del grupo</strong> &nbspno puede estar vacío.";
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
      errorCoordi.innerHTML =
        "Debes seleccionar&nbsp<strong>un coordinador(a)</strong>.";
    } else {
      coordinador.classList.remove("input-error");
      errorCoordi.classList.remove("alert", "alert-danger");
      errorCoordi.textContent = "";
    }
    //Integrantes
    const boxesIntegrantes = document.querySelectorAll(
      ".side-by-side-multiselect__inner"
    );
    if (integrantesSeleccionados.length === 0) {
      isValid = false;
      boxesIntegrantes.forEach((box) => {
        box.classList.add("input-error");
      });
      errorIntegrantes.classList.add("alert", "alert-danger");
      errorIntegrantes.innerHTML =
        "Debes seleccionar&nbsp<strong>al menos un integrante</strong>.";
    } else {
      boxesIntegrantes.forEach((box) => {
        box.classList.remove("input-error");
      });
      errorIntegrantes.textContent = "";
      errorIntegrantes.classList.remove("alert", "alert-danger");
    }

    if (!isValid) {
      errorCliente.innerHTML = "<h2>Revise los errores del formulario.</h2>";
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
      errorTrabajo.innerHTML =
        "El&nbsp <strong>nombre del trabajo</strong> &nbspno puede estar vacío.";
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
      errorZona.innerHTML =
        "Debes seleccionar una&nbsp<strong>zona de trabajo</strong>.";
    } else {
      zonaTrabajo.classList.remove("input-error");
      errorZona.classList.remove("alert", "alert-danger");
      errorZona.textContent = "";
    }
    //Parcelas
    //Convertimos a Array el select multiple y comprobamos su longitud
    const parcelasSeleccionadas = Array.from(parcelas.selectedOptions).map(
      (option) => option.value
    );
    //Parcelas y añadir clase de error
    const boxesParcelas = document.querySelectorAll(
      ".side-by-side-multiselect__inner"
    );
    if (parcelasSeleccionadas.length === 0) {
      isValid = false;
      boxesParcelas.forEach((box) => {
        box.classList.add("input-error");
      });
      errorParcelas.classList.add("alert", "alert-danger");
      errorParcelas.innerHTML =
        "Debes seleccionar &nbsp<strong>al menos una parcela</strong>.";
    } else {
      boxesParcelas.forEach((box) => {
        box.classList.remove("input-error");
      });
      errorParcelas.textContent = "";
      errorParcelas.classList.remove("alert", "alert-danger");
    }
    //Finalizado
    if (!finalizadoSi.checked && !finalizadoNo.checked) {
      isValid = false;
      errorFinalizado.classList.add("alert", "alert-danger");
      errorFinalizado.innerHTML =
        "Debes seleccionar si el trabajo está &nbsp<strong>finalizado o no</strong>.";
    } else {
      errorFinalizado.textContent = "";
      errorFinalizado.classList.remove("alert", "alert-danger");
    }
    //Horario

    if (horarioInicio.value === "" || horarioFin.value === "") {
      isValid = false;
      horarioInicio.classList.add("input-error");
      horarioFin.classList.add("input-error");
      errorHorario.classList.add("alert", "alert-danger");
      errorHorario.innerHTML =
        "Debes seleccionar &nbsp<strong>un horario</strong>&nbspde inicio y fin.";
    } else {
      horarioInicio.classList.remove("input-error");
      horarioFin.classList.remove("input-error");
      errorHorario.textContent = "";
      errorHorario.classList.remove("alert", "alert-danger");
    }
    //Fecha
    if (fecha.value === "") {
      isValid = false;
      fecha.classList.add("input-error");
      errorFecha.classList.add("alert", "alert-danger");
      errorFecha.innerHTML =
        "Debes seleccionar &nbsp<strong>una fecha</strong>.";
    } else {
      fecha.classList.remove("input-error");
      errorFecha.textContent = "";
      errorFecha.classList.remove("alert", "alert-danger");
    }

    if (!validarFecha(fecha.value)) {
      isValid = false;
      errorFecha.classList.add("alert", "alert-danger");
      errorFecha.innerHTML = "Fecha &nbsp<strong>inválida</strong>.";
    } else {
      errorFecha.textContent = "";
      errorFecha.classList.remove("alert", "alert-danger");
    }

    //Grupo
    if (grupo.value == "noSeleccion") {
      isValid = false;
      grupo.classList.add("input-error");
      errorGrupo.classList.add("alert", "alert-danger");
      errorGrupo.innerHTML =
        "Debes seleccionar &nbsp<strong>un grupo</strong>.";
    } else {
      grupo.classList.remove("input-error");
      errorGrupo.classList.remove("alert", "alert-danger");
      errorGrupo.textContent = "";
    }
    if (!isValid) {
      errorCliente.innerHTML = "<h2>Revise los errores del formulario.</h2>";
      event.preventDefault(); //Evitar envio del formulario
    }
  }

  //Funcion validar formularioTrabajador + formularioJefe (son iguales)
  function validarFormularioTrabajador(event) {
    const nombreTrabajador = document.getElementById("inputNombre");
    const apellidosTrabajador = document.getElementById("inputApellidos");
    const nombreUsuario = document.getElementById("inputUsuario");
    const rol = document.getElementById("inputRol");
    const errorTrabajador = document.getElementById("errorNombre");
    const errorApellidos = document.getElementById("errorApellidos");
    const errorUsuario = document.getElementById("errorUsuario");
    const errorRol = document.getElementById("errorRol");

    let isValid = true;
    //Nombre
    if (!validarCampo(nombreTrabajador)) {
      isValid = false;
      nombreTrabajador.classList.add("input-error");
      errorTrabajador.classList.add("alert", "alert-danger");
      errorTrabajador.innerHTML =
        "El&nbsp<strong>nombre del trabajador</strong>&nbspno puede estar&nbsp<strong>vacío</strong>.";
    } else if (!validarCampoLetras(nombreTrabajador)) {
      isValid = false;
      nombreTrabajador.classList.add("input-error");
      errorTrabajador.classList.add("alert", "alert-danger");
      errorTrabajador.innerHTML =
        "El&nbsp<strong>nombre del trabajador</strong>&nbspsólo puede contener&nbsp<strong>letras</strong>.";
    } else {
      nombreTrabajador.classList.remove("input-error");
      errorTrabajador.classList.remove("alert", "alert-danger");
      errorTrabajador.textContent = "";
    }

    //Apellidos
    if (!validarCampo(apellidosTrabajador)) {
      isValid = false;
      apellidosTrabajador.classList.add("input-error");
      errorApellidos.classList.add("alert", "alert-danger");
      errorApellidos.innerHTML =
        "Los&nbsp<strong>apellidos del trabajador</strong>&nbspno puede estar&nbsp<strong>vacíos</strong>.";
    } else if (!validarCampoLetras(apellidosTrabajador)) {
      isValid = false;
      apellidosTrabajador.classList.add("input-error");
      errorApellidos.classList.add("alert", "alert-danger");
      errorApellidos.innerHTML =
        "Los&nbsp<strong>apellidos del trabajador</strong>&nbspsólo pueden contener&nbsp<strong>letras</strong>.";
    } else {
      apellidosTrabajador.classList.remove("input-error");
      errorApellidos.classList.remove("alert", "alert-danger");
      errorApellidos.textContent = "";
    }

    //Nombre de usuario
    if (!validarCampo(nombreUsuario)) {
      isValid = false;
      nombreUsuario.classList.add("input-error");
      errorUsuario.classList.add("alert", "alert-danger");
      errorUsuario.innerHTML =
        "El&nbsp<strong>nombre de usuario</strong>&nbspno puede estar&nbsp<strong>vacío</strong>.";
    } else if (!validarCampoLetrasNumeros(nombreUsuario)) {
      isValid = false;
      nombreUsuario.classList.add("input-error");
      errorUsuario.classList.add("alert", "alert-danger");
      errorUsuario.innerHTML =
        "El&nbsp<strong>nombre de usuario</strong>&nbspsólo puede contener&nbsp<strong>letras y números</strong>.";
    } else {
      nombreUsuario.classList.remove("input-error");
      errorUsuario.classList.remove("alert", "alert-danger");
      errorUsuario.textContent = "";
    }

    //Rol
    if (rol.value == "noSeleccion") {
      isValid = false;
      rol.classList.add("input-error");
      errorRol.classList.add("alert", "alert-danger");
      errorRol.innerHTML = "Debes seleccionar un&nbsp<strong>rol</strong>.";
    } else {
      rol.classList.remove("input-error");
      errorRol.classList.remove("alert", "alert-danger");
      errorRol.textContent = "";
    }

    if (!isValid) {
      errorCliente.innerHTML = "<h2>Revise los errores del formulario.</h2>";
      event.preventDefault();
    }
  }

  //Añadir las funciones de validacion a cada formulario cuando se envíen
  if (formGrupo) {
    formGrupo.addEventListener("submit", validarFormularioGrupo);
  }
  if (formTrabajo) {
    formTrabajo.addEventListener("submit", validarFormularioTrabajo);
  }
  if (formTrabajador) {
    formTrabajador.addEventListener("submit", validarFormularioTrabajador);
  }
});
