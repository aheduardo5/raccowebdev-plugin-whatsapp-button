<?php
/**
 * footer-message.php
 *
 * Modifica el texto del footer del panel de administración cuando el usuario está en la página del plugin.
 * Muestra un mensaje personalizado con branding de RaccoWebDev.
 *
 * Se aplica únicamente en la pantalla con ID `toplevel_page_whatsapp_button`.
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

// Mensaje personalizado en el footer de la pagina.
function whatsapp_button_custom_admin_footer()
{
  $screen = get_current_screen();

  // Verificar si estamos en la pagina del plugin
  if ($screen->id === 'toplevel_page_whatsapp_button') {
    return 'Gracias por usar <strong>Whatsapp Button</strong>. ¿Necesitas más plugins personalizados? <a href="https://www.raccowebdev.com" target="_blank">Visítanos en Raccowebdev</a>.';
  }
}
add_filter('admin_footer_text', 'whatsapp_button_custom_admin_footer');
