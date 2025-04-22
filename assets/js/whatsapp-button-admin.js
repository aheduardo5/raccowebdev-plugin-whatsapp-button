document.addEventListener("DOMContentLoaded", function () {
  setTimeout(() => {
    function applyAnimationPreview(
      selectElementId,
      previewElementId,
      buttonId
    ) {
      const selectElement = document.getElementById(selectElementId);
      const previewElement = document.getElementById(previewElementId);
      const button = document.getElementById(buttonId);

      if (!selectElement || !previewElement || !button) {
        console.error("Uno o más elementos no se encontraron en el DOM.");
        return;
      }

      button.addEventListener("click", function () {
        // Obtener la animación seleccionada
        const selectedAnimation = selectElement.value;
        // Asegurar que la clase animate__animated esté siempre presente
        previewElement.classList.add("animate__animated");

        // Remover cualquier animación anterior
        previewElement.classList.forEach((className) => {
          if (
            className.startsWith("animate__") &&
            className !== "animate__animated"
          ) {
            previewElement.classList.remove(className);
          }
        });

        // Aplicar la animación seleccionada
        previewElement.classList.add(selectedAnimation);

        // Esperar la duración de la animación antes de removerla
        setTimeout(() => {
          previewElement.classList.remove(selectedAnimation);
        }, 2000);
      });
    }

    applyAnimationPreview(
      "whatsapp_button_animation_load",
      "animation_preview_load",
      "preview_load_animation"
    );

    applyAnimationPreview(
      "whatsapp_button_animation_hover",
      "animation_preview_hover",
      "preview_hover_animation"
    );

    // Actualización dinámica de tamaño de ícono y botón
    const iconSizeInput = document.querySelector(
      'input[name="whatsapp_icon_size"]'
    );
    const buttonSizeInput = document.querySelector(
      'input[name="whatsapp_button_size"]'
    );

    const previewIcons = document.querySelectorAll(".preview_box i");
    const previewBoxes = document.querySelectorAll(".preview_box");

    if (iconSizeInput) {
      iconSizeInput.addEventListener("input", () => {
        let size = parseInt(iconSizeInput.value, 10);
        if (size < 30) size = 30;
        if (size > 100) size = 100;
        iconSizeInput.value = size;
        previewIcons.forEach((icon) => {
          icon.style.fontSize = size + "px";
        });
      });
    }

    if (buttonSizeInput) {
      buttonSizeInput.addEventListener("input", () => {
        let size = parseInt(buttonSizeInput.value, 10);
        if (size < 50) size = 50;
        if (size > 120) size = 120;
        buttonSizeInput.value = size;
        previewBoxes.forEach((box) => {
          box.style.width = size + "px";
          box.style.height = size + "px";
        });
      });
    }
  }, 1000);
});
