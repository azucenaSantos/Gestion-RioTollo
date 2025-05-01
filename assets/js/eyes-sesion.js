document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#inputPassword');

   if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            // Cambiar el tipo de input entre 'password' y 'text'
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Cambiar el icono
            const icon = this.querySelector('i');
            icon.classList.toggle('la-eye');
            icon.classList.toggle('la-eye-slash');
        });
    } 

});
