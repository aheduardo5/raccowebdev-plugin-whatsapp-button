<?php
/**
 * render-button.php
 *
 * Inserta automáticamente el botón de WhatsApp en el sitio usando `wp_footer`.
 * La visualización depende de las opciones configuradas:
 * - Si el botón está habilitado
 * - Número de WhatsApp
 * - Mensaje personalizado
 * - Animaciones seleccionadas
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

// Funcion para agregar el boton de whatsapp automaticamente
function whatsapp_button_display(){
  // Mostrar solamente si esta habilitado
  $enabled = get_option('whatsapp_button_enabled', '1');
  if($enabled != '1'){
    return;
  }

  // Evitar mostrarlo en el admin
  if(is_admin()){
    return;
  }

  // Obtetener valores desde la configuracion.
  $numero= get_option('whatsapp_button_number','');
  $mensaje = get_option('whatsapp_button_message');
  if(empty(trim($mensaje))){
    $mensaje = 'Hola!, Me  gustaria saber mas sobre sus servicios.';
  }

  // Obtener animaciones desde la configuracion
  $animation_load = get_option('whatsapp_button_animation_load', 'animate__fadeIn');
  $animation_hover = get_option('whatsapp_button_animation_hover', 'animate__pulse');
    echo '
    <div id="whatsapp_button" class="animate__animated ' . esc_attr($animation_load) . '"
      data-animation-load="' . esc_attr($animation_load) . '"
      data-animation-hover="' . esc_attr($animation_hover) . '">
      <a href="https://wa.me/' . esc_attr($numero) . '?text=' . urlencode($mensaje) . '" target="_blank" class="whatsapp_link">
        <i class="fa-brands fa-whatsapp"></i>
      </a>
    </div>
  ';
}add_action('wp_footer', 'whatsapp_button_display');
