document.querySelector("form").addEventListener("submit", function (e) {
  // Mostrar el loader
  document.getElementById("loader").style.display = "block";

  // Deshabilitar el botón para evitar múltiples envíos
  const btn = document.querySelector("button[type=submit]");
  btn.disabled = true;
  btn.innerText = "Instalando...";

  const mensajeInstalar = document.getElementById("msj-instalar");
  setTimeout(() => {
    mensajeInstalar.innerHTML =
      "Instalación completada. <strong>Redirigiendo...</strong>";
  }, 4000);
});
