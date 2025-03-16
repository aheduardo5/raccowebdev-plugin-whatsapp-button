document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    let whatsappButton = document.getElementById("whatsapp_button");
    if (whatsappButton) {
      whatsappButton.style.opacity = "1";
      whatsappButton.style.transform = "translateY(0)";
    }
  }, 2000);
});

document.addEventListener("DOMContentLoaded", function () {
  let saveButton = document.querySelector(
    "#whatsapp-button-admin .button-primary"
  );
  if (saveButton) {
    saveButton.style.backgroundColor = "#25d366";
    saveButton.style.color = "white";
    saveButton.style.padding = "12px 25px";
    saveButton.style.border = "none";
    saveButton.style.borderRadius = "5px";
    saveButton.style.fontSize = "16px";
    saveButton.style.cursor = "pointer";
  }
});
