<?php
/**
 * enqueue.php
 *
 * Carga los estilos y scripts necesarios para el botón de WhatsApp en el frontend del sitio.
 * - Estilos: animate.css, FontAwesome, CSS del plugin
 * - Scripts: JS del botón
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

// Enqueue de los estilos y scripts
function whatsapp_button_enqueue_scripts(){
  // Obtener la URL del plugin
  $plugin_url = plugin_dir_url(dirname(__FILE__));

  // Cargar animation.style
  wp_enqueue_style('animation_style', 'https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css', array(), null);
  // Enqueue CSS del plugin
  wp_enqueue_style('whatsapp_button_css', $plugin_url . 'assets/css/whatsapp-button.css', array(), '1.0', 'all');
  // Enqueue FontAwesome (CDN)
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
  // Enqueue JS del plugin
  wp_enqueue_script('whatsapp_button_js', $plugin_url . 'assets/js/whatsapp-button.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'whatsapp_button_enqueue_scripts');
