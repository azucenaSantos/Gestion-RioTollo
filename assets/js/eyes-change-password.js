 // Nueva contraseña
 const toggleNewPassword = document.querySelector('#toggleNewPassword');
 const newPasswordInput = document.querySelector('#newPassword');

 if (toggleNewPassword && newPasswordInput) {
     toggleNewPassword.addEventListener('click', function () {
         const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
         newPasswordInput.setAttribute('type', type);

         const icon = this.querySelector('i');
         icon.classList.toggle('la-eye');
         icon.classList.toggle('la-eye-slash');
     });
 }

 // Confirmar contraseña
 const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
 const confirmPasswordInput = document.querySelector('#confirmPassword');

 if (toggleConfirmPassword && confirmPasswordInput) {
     toggleConfirmPassword.addEventListener('click', function () {
         const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
         confirmPasswordInput.setAttribute('type', type);

         const icon = this.querySelector('i');
         icon.classList.toggle('la-eye');
         icon.classList.toggle('la-eye-slash');
     });
 }