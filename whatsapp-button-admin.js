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
  }, 1000);
});
