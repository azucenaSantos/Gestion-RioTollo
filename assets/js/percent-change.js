document.addEventListener("DOMContentLoaded", function () {
  const rangeInput = document.getElementById("inputPorcentaje");
  const numberInput = document.getElementById("inputPorcentajeNum");
  const radioFinalizadoNo = document.getElementById("finalizadoNo");
  const radioFinalizadoSi = document.getElementById("finalizadoSi");

  if (rangeInput && numberInput) {
    rangeInput.addEventListener("input", function () {
      numberInput.value = rangeInput.value;
    });
    rangeInput.addEventListener("change", function () {
      if (rangeInput.value == 100 || numberInput.value == 100) {
        if (radioFinalizadoSi && radioFinalizadoNo) {
          radioFinalizadoSi.checked = true;
          radioFinalizadoNo.disabled = true;
        }
      } else {
        if (radioFinalizadoSi && radioFinalizadoNo) {
          radioFinalizadoNo.checked = true;
          radioFinalizadoSi.disabled = true;
        }
      }
    });

    numberInput.addEventListener("input", function () {
      rangeInput.value = numberInput.value;
    });
    numberInput.addEventListener("change", function () {
      if (rangeInput.value == 100 || rangeInput.value == 100) {
        radioFinalizadoSi.checked = true;
        radioFinalizadoNo.disabled = true;
      } else {
        radioFinalizadoNo.checked = true;
        radioFinalizadoSi.disabled = true;
      }
    });
  }
});
