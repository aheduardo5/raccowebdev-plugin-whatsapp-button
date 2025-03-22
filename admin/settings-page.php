<?php
/**
 * settings-page.php
 *
 * Muestra la página de configuración del plugin WhatsApp Button en el panel de administración.
 * Aquí se renderiza el formulario principal con los campos registrados y el botón de guardar.
 *
 * Estructura:
 * - Contenedor principal con clase personalizada para aplicar Bootstrap sin afectar el admin global.
 * - Carga dinámica de campos y secciones usando las funciones core de WordPress:
 *   - settings_fields()
 *   - do_settings_sections()
 *   - submit_button()
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

function whatsapp_button_admin_page(){
  ?>
  <div class="wrap racco-styles">
    <h1 class="text-center">Configuracion del boton de Whatsapp</h1>
    <form method="post" action="options.php">
      <?php
        settings_fields('whatsapp_button_settings_group');
        do_settings_sections('whatsapp_button');
        submit_button();
      ?>
    </form>
  </div>
  <?php
}
