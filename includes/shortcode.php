<?php
/**
 * shortcode.php
 *
 * Define el shortcode [whatsapp_button] para insertar el botón de WhatsApp manualmente donde se desee.
 * El botón utiliza las mismas opciones configuradas desde el panel de administración.
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

// Funcion para mostrar el boton de whatsapp por shortcode
// [whatsapp_button]
// TODO: Esta seccion se piensa implementar alguna compatibilidad con seguimiento de id con google analytics
function whatsapp_button_render()
{
  $numero = get_option('whatsapp_button_number', ''); // Numero por defecto
  $mensaje = get_option('whatsapp_button_message', 'Hola!, Me  gustaria saber mas sobre sus servicios.'); // Mensaje por defecto

  ob_start(); ?>
  <div id="whatsapp_button">
    <a href="https://wa.me/<?php echo esc_attr($numero); ?>?text=<?php echo urlencode($mensaje); ?>" target="_blank"
      class="whatsapp_link">
      <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>whatsapp-icon.png" alt="Whatsapp">
    </a>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('whatsapp_button', 'whatsapp_button_render');
