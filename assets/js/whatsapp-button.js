document.addEventListener("DOMContentLoaded", function () {
  // Hacer que funcione tooltip de Bootstrap
  const tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });

  const whatsappButton = document.querySelector("#whatsapp_button");
  const whatsappLink = document.querySelector(
    "#whatsapp_button .whatsapp_link"
  );

  if (!whatsappButton || !whatsappLink) return;

  // Obtener las animaciones desde los atributos del elemento (cargadas desde PHP)
  const animationLoad =
    whatsappButton.dataset.animationLoad || "animate__fadeIn";
  const animationHover =
    whatsappButton.dataset.animationHover || "animate__pulse";

  // Aplicar la animación de carga
  whatsappButton.classList.add("animate__animated", animationLoad);

  // Aplicar la animación de hover solo cuando el usuario pase el mouse
  whatsappLink.addEventListener("mouseenter", function () {
    whatsappLink.classList.add("animate__animated", animationHover);
  });

  whatsappLink.addEventListener("mouseleave", function () {
    whatsappLink.classList.remove("animate__animated", animationHover);
  });
});
