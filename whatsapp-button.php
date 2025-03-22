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

// Funcion para mostrar el boton de whatsapp por shortcode
// [whatsapp_button]
// TODO: Esta seccion se piensa implementar alguna compatibilidad con seguimiento de id con google analytics
function whatsapp_button_render(){
  $numero = get_option('whatsapp_button_number',''); // Numero por defecto
  $mensaje = get_option('whatsapp_button_message','Hola!, Me  gustaria saber mas sobre sus servicios.'); // Mensaje por defecto

  ob_start();?>
  <div id="whatsapp_button">
    <a href="https://wa.me/<?php echo esc_attr($numero); ?>?text=<?php echo urlencode($mensaje);?>" target="_blank" class="whatsapp_link">
      <img src="<?php echo plugin_dir_url(__FILE__); ?>whatsapp-icon.png" alt="Whatsapp">
    </a>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('whatsapp_button', 'whatsapp_button_render');


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

// Enqueue de los estilos y scripts
function whatsapp_button_enqueue_scripts(){
  // Obtener la URL del plugin
  $plugin_url = plugin_dir_url(__FILE__);

  // Cargar animation.style
  wp_enqueue_style('animation_style', 'https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css', array(), null);
  // Enqueue CSS del plugin
  wp_enqueue_style('whatsapp_button_css', $plugin_url . 'whatsapp-button.css', array(), '1.0', 'all');
  // Enqueue FontAwesome (CDN)
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
  // Enqueue JS del plugin
  wp_enqueue_script('whatsapp_button_js', $plugin_url . 'whatsapp-button.js', array('jquery'), null, true);
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
  <div class="wrap container-fluid px-3">
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

function whatsapp_button_register_settings(){
  // Registrar opciones
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_number');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_message');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_enabled');
  register_setting('whatsapp_button_settings_group','whatsapp_button_size');
  register_setting('whatsapp_button_settings_group','whatsapp_icon_size');

  // Animaciones
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_animation_load');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_animation_hover');

  add_settings_section(
    'whatsapp_button_main_section',
    '',
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

  add_settings_field(
    'whatsapp_button_enabled',
    'Activar boton de Whatsapp',
    'whatsapp_button_enabled_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );

  add_settings_field(
    'whatsapp_button_size',
    'Tamaño del boton (px)',
    'whatsapp_button_size_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );

  add_settings_field(
    'whatsapp_icon_size',
    'Tamaño del icono (px)',
    'whatsapp_icon_size_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );

  // Agregar seccion de animaciones
  add_settings_field(
    'whatsapp_button_animation_load',
    'Animacion al cargar',
    'whatsapp_button_animation_load_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
  );

  add_settings_field(
    'whatsapp_button_animation_hover',
    'Animación al pasar el mouse',
    'whatsapp_button_animation_hover_callback',
    'whatsapp_button',
    'whatsapp_button_main_section'
);
}
add_action('admin_init', 'whatsapp_button_register_settings');

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

function whatsapp_button_admin_styles($hook) {
  // Verifica si estamos en la página del plugin
  if ($hook != 'toplevel_page_whatsapp_button') {
      return;
  }

  wp_enqueue_script(
    'whatsapp_button_admin_js',
    plugin_dir_url(__FILE__) . 'whatsapp-button-admin.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_style(
      'whatsapp_button_admin_css',
      plugin_dir_url(__FILE__) . 'whatsapp-button-admin.css',
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

// Mensaje personalizado en el footer de la pagina.
function whatsapp_button_custom_admin_footer(){
  $screen = get_current_screen();

  // Verificar si estamos en la pagina del plugin
  if( $screen->id === 'toplevel_page_whatsapp_button'){
    return 'Gracias por usar <strong>Whatsapp Button</strong>. ¿Necesitas más plugins personalizados? <a href="https://www.raccowebdev.com" target="_blank">Visítanos en Raccowebdev</a>.';
  }
}
add_filter('admin_footer_text', 'whatsapp_button_custom_admin_footer');

function whatsapp_button_enabled_callback(){
  $enabled = get_option('whatsapp_button_enabled', '1');
  echo '<input type="checkbox" name="whatsapp_button_enabled" value="1" ' . checked($enabled, '1', false) . '/>';
}

function whatsapp_button_number_callback(){
  $number = get_option('whatsapp_button_number', '');
  echo '<input type="text" name="whatsapp_button_number" value="' . esc_attr($number) . '">';
}

function whatsapp_button_message_callback() {
  $message = get_option('whatsapp_button_message', '');
  $placeholder = 'Hola! Me gustaría más información.';
  echo '<input type="text" name="whatsapp_button_message" value="' . esc_attr($message) . '" placeholder="' . esc_attr($placeholder) . '" />';

  if(empty(trim($message))){
    echo '<div class="form-text text-muted">Este mensaje se enviará por defecto si el usuario no modifica el mensaje.</div>';
  }
}

function whatsapp_button_size_callback() {
  $size = get_option('whatsapp_button_size', '80');
  echo '<input type="number" name="whatsapp_button_size" value="' . esc_attr($size) . '" min="50" max="120" step="5">';
  echo '<div class="form-text text-muted">
  Valor mínimo: 50px. Máximo: 120px. Esto mantiene accesibilidad y visibilidad.
</div>';
}

function whatsapp_icon_size_callback() {
  $icon_size = get_option('whatsapp_icon_size', '50');
  echo '<input type="number" name="whatsapp_icon_size" value="' . esc_attr($icon_size) . '" min="30" max="100" step="5">';
  echo '<div class="form-text text-muted">
  Valor mínimo: 30px. Máximo: 100px. Esto mantiene accesibilidad y visibilidad.
</div>';
}

// Callback para la animacion al cargar
function whatsapp_button_animation_load_callback(){
  $animation_load = get_option('whatsapp_button_animation_load', 'animate__fadeIn');
  ?>
  <?php $icon_size = get_option('whatsapp_icon_size', '50'); ?>
  <select id="whatsapp_button_animation_load" name="whatsapp_button_animation_load">
      <option value="animate__fadeIn" <?php selected($animation_load, 'animate__fadeIn'); ?>>Fade In</option>
      <option value="animate__slideInUp" <?php selected($animation_load, 'animate__slideInUp'); ?>>Slide In Up</option>
      <option value="animate__zoomIn" <?php selected($animation_load, 'animate__zoomIn'); ?>>Zoom In</option>
      <option value="animate__bounceIn" <?php selected($animation_load, 'animate__bounceIn'); ?>>Bounce In</option>
  </select>

  <button type="button" id="preview_load_animation" class="button">Previsualizar</button>
  <div id="animation_preview_load" class="preview_box" min="50" max="120"><i class="fa-brands fa-whatsapp" style="font-size: <?php echo esc_attr($icon_size)?>px" min="30" max="100"></i></div>
  <?php
}

function whatsapp_button_animation_hover_callback(){
  $animation_hover = get_option('whatsapp_button_animation_hover', 'animate__pulse');
  ?>
  <?php $icon_size = get_option('whatsapp_icon_size', '50'); ?>
  <select id="whatsapp_button_animation_hover" name="whatsapp_button_animation_hover">
      <option value="animate__pulse" <?php selected($animation_hover, 'animate__pulse'); ?>>Pulse</option>
      <option value="animate__shakeX" <?php selected($animation_hover, 'animate__shakeX'); ?>>Shake</option>
      <option value="animate__rubberBand" <?php selected($animation_hover, 'animate__rubberBand'); ?>>Rubber Band</option>
      <option value="animate__tada" <?php selected($animation_hover, 'animate__tada'); ?>>Tada</option>
  </select>

  <button type="button" id="preview_hover_animation" class="button">Previsualizar</button>
  <div id="animation_preview_hover" class="preview_box" min="50" max="120"><i class="fa-brands fa-whatsapp" style="font-size: <?php echo esc_attr($icon_size)?>px" min="30" max="100"></i></div>
  <?php
}
