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

require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'admin/fields.php';
require_once plugin_dir_path(__FILE__) . 'admin/register-settings.php';
require_once plugin_dir_path(__FILE__) . 'admin/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'includes/render-button.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'admin/footer-message.php';
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';


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
