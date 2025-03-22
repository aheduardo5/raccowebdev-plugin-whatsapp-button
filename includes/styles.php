<?php
/**
 * styles.php
 *
 * Inyecta estilos personalizados al frontend del sitio.
 * Se usa para definir variables CSS dinámicas como el tamaño del botón e ícono de WhatsApp.
 *
 * Estas variables pueden ser utilizadas tanto en el render automático como en el shortcode.
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

 function whatsapp_button_custom_styles(){
  $button_size = get_option('whatsapp_button_size', '80');
  $icon_size = get_option('whatsapp_icon_size', '50');

  echo "
    <style>
      :root{
        --whatsapp-button-size: {$button_size}px;
        --whatsapp-icon-size: {$icon_size}px;
      }
    </style>
  ";
}
add_action('wp_head', 'whatsapp_button_custom_styles');

