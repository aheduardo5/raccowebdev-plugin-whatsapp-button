<?php
/**
 * enqueue.php
 *
 * Carga todos los scripts y estilos necesarios para el panel de administración del plugin WhatsApp Button.
 * Esto incluye:
 * - Bootstrap 5 (CSS y JS bundle)
 * - Animate.css para animaciones
 * - FontAwesome para íconos
 * - Estilos y scripts propios del plugin
 *
 * Se asegura que solo se cargue en la página del plugin (`toplevel_page_whatsapp_button`) para evitar conflictos con el admin global de WordPress.
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

function whatsapp_button_admin_styles($hook) {
  $plugin_url = plugin_dir_url(dirname(__FILE__));
  // Verifica si estamos en la página del plugin
  if ($hook != 'toplevel_page_whatsapp_button') {
      return;
  }

  wp_enqueue_script(
    'whatsapp_button_admin_js',
    $plugin_url . 'assets/js/whatsapp-button-admin.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_style(
      'whatsapp_button_admin_css',
      $plugin_url . 'assets/css/whatsapp-button-admin.css',
      array(),
      '1.0',
      'all'
  );
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);

  wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

  // agregar bootstrap
  wp_enqueue_style(
    'bootstrap_admin_plugin',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
    array(),
    '5.3.2',
    'all'
  );
  wp_enqueue_script(
    'bootstrap_admin_plugin',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    array(),
    '5.3.2',
    true
  );
}
add_action('admin_enqueue_scripts', 'whatsapp_button_admin_styles');
