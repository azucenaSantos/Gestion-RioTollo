//Archivo para asignar la contraseña por defecto a un usuario que se haya olvidado
//o no la haya recibido
document.addEventListener('DOMContentLoaded', function () {
    const btnUpdatePassword = document.getElementById('updatePasswordButton');

    //Funcion para asignar la contraseña por defecto a un usuario
    function asignarContrasena(trabajadorId) {
        const nombre = document.getElementById('inputNombre').value;
        const apellidos = document.getElementById('inputApellidos').value;
        fetch(`?c=Rrhh&a=asignarContrasena&usuarioId=${trabajadorId}&nombre=${nombre}&apellidos=${apellidos}`)
            .then(response => {
                if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    const currentUrl = window.location.href; //url actual
                    //Redirigir a la pagina de gestion indicada segun donde se haya hecho el click en el boton
                    if (currentUrl.includes('editarTrabajador')) {
                        window.location.href = '?c=Rrhh&a=gestionTrabajadores';
                    } else {
                        window.location.href = '?c=Rrhh&a=gestionJefes';
                    }
                } else {
                    alert(`Error: ${data.message}`);
                }
            })
            .catch(error => console.error('Error en fetch:', error));
    }

    //Asociamos el evento de click al boton de asignar la contraseña
    if (btnUpdatePassword) {
        btnUpdatePassword.addEventListener('click', function () {
            const trabajadorId = document.getElementById('idTrabajador').value;
            asignarContrasena(trabajadorId);
        });
    }

});