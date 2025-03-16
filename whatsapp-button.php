<?php
/*
Plugin Name: Boton de whatsapp flotante
Plugin URI: https://www.raccowebdev.com
Description: Agrega un boton flotande de Whatsapp a tu sitio de Wordpress.
Version: 1.0
Author: Raccowebdev
License: GPL2
*/

// Evita el acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Funcion para mostrar el boton de whatsapp
function whatsapp_button_render(){
  $numero = get_option('whatsapp_button_number',''); // Numero por defecto
  $mensaje = get_option('whatsapp_button_message','Hola!, Me  gustaria saber mas sobre sus servicios.'); // Mensaje por defecto

  ob_start();?>
  <div id=whatsapp_button>
    <a href="https://wa.me/<?php echo esc_attr($numero); ?>?text=<?php echo urlencode($mensaje);?>" target="_blank" class="whatsapp_link">
      <img src="<?php echo plugin_dir_url(__FILE__); ?>whatsapp-icon.png" alt="Whatsapp">
    </a>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('whatsapp_button', 'whatsapp_button_render');

// Enqueue de los estilos y scripts
function whatsapp_button_enqueue_scripts(){
  wp_enqueue_style('whatsapp_button_css', plugin_dir_url(__FILE__) . 'whatsapp-button.css');
  wp_enqueue_script('whatsapp_button_js', plugin_dir_url(__FILE__) . 'whatsapp-button.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'whatsapp_button_enqueue_scripts');

// Agregar opciones en el panel de administracion
function whatsapp_button_admin_menu(){
  add_menu_page(
    'Configuración Whatsapp',
    'Whatsapp Button',
    'manage_options',
    'whatsapp_button',
    'whatsapp_button_admin_page',
    'dashicons-whatsapp',
    25
  );
}
add_action('admin_menu', 'whatsapp_button_admin_menu');

function whatsapp_button_admin_page(){
  ?>
  <div class="wrap">
    <h1>Configuracion del boton de Whatsapp</h1>
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

function whatsapp_button_register_settings(){
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_number');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_message');

  add_settings_section(
    'whatsapp_button_main_section',
    'Opciones del botón',
    null,
    'whatsapp_button'
  );

  add_settings_field(
    'whatsapp_button_number',
    'Número de Whatsapp',
    'whatsapp_button_number_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );

  add_settings_field(
    'whatsapp_button_message',
    'Mensaje de WhatsApp',
    'whatsapp_button_message_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );
}
add_action('admin_init', 'whatsapp_button_register_settings');

function whatsapp_button_number_callback(){
  $number = get_option('whatsapp_button_number', '');
  echo '<input type="text" name="whatsapp_button_number" value="' . esc_attr($number) . '">';
}

function whatsapp_button_message_callback() {
  $message = get_option('whatsapp_button_message', 'Hola! Me gustaría más información.');
  echo '<input type="text" name="whatsapp_button_message" value="' . esc_attr($message) . '" />';
}
