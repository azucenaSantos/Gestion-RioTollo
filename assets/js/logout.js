document.addEventListener("DOMContentLoaded", function () {
    const buttonLogout = document.querySelector(".buttonLogout");

    //Crear elemento dinámico para texto de hover
    const hoverText = document.createElement("div");
    hoverText.textContent = "Cerrar sesión";
    hoverText.style.position = "absolute";
    hoverText.style.backgroundColor = "#333333";
    hoverText.style.color = "#FFFFFF";
    hoverText.style.padding = "10px 10px";
    hoverText.style.borderRadius = "5px";
    hoverText.style.fontSize = "12px";
    hoverText.style.display = "none"; //no se ve por defecto
    document.body.appendChild(hoverText);

    //Mostrar texto
    buttonLogout.addEventListener("mouseover", function (event) {
        hoverText.style.display = "block";
        hoverText.style.top = `${event.pageY + 10}px`; // Posición debajo del cursor
        hoverText.style.left = `${event.pageX}px`;
    });

    //Ocultar texto
    buttonLogout.addEventListener("mouseout", function () {
        hoverText.style.display = "none";
    });

    //Movimiento del texto con el cursor
    buttonLogout.addEventListener("mousemove", function (event) {
        hoverText.style.top = `${event.pageY + 10}px`;
        hoverText.style.left = `${event.pageX}px`;
    });


    //Mostrar modal de cierre de sesion
    buttonLogout.addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
        modal.show();
    });


});