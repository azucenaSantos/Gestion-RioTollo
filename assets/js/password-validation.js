//Archivo js par a validar la nueva contraseña de un usuario
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('form').addEventListener('submit', function (e) {
        let isValid = true;
        const newPassword = document.querySelector('#newPassword').value;
        const confirmPassword = document.querySelector('#confirmPassword').value;
        const errorDiv = document.getElementById('errorValidation');
        const errorSame = document.getElementById('errorSame');
        errorDiv.textContent = ''; // Limpia errores anteriores
        errorDiv.classList.remove('alert', 'alert-danger', 'mt-2', 'p-3');
        errorSame.textContent = ''; // Limpia errores anteriores
        errorSame.classList.remove('alert', 'alert-danger', 'mt-2', 'p-2');
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{10,}$/;

        // Validar nueva contraseña (debe tener al menos 10 caracteres, mayúsculas, minúsculas, números y caracteres especiales)
        if (!passwordRegex.test(newPassword)) {
            isValid = false;
            errorDiv.classList.add('alert', 'alert-danger', 'mt-2', 'p-3');
            errorDiv.textContent = 'La contraseña debe tener al menos 10 caracteres, incluyendo mayúsculas, minúsculas, números y caracteres especiales.';
        }

        // Validar que las contraseñas coincidan
        if (newPassword !== confirmPassword) {
            isValid = false;
            errorSame.classList.add('alert', 'alert-danger', 'mt-2', 'p-2');
            errorSame.textContent = 'Las contraseñas no coinciden.';
        }

        // Si algún error está presente, evitar el envío del formulario
        if (!isValid) {
            e.preventDefault();
        }
    });

});

document.querySelectorAll('.input-group-text').forEach(toggle => {
    toggle.addEventListener('click', function () {
        const input = this.previousElementSibling; // Selecciona el input asociado
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);

        // Cambiar el icono
        const icon = this.querySelector('i');
        icon.classList.toggle('la-eye');
        icon.classList.toggle('la-eye-slash');
    });
});
