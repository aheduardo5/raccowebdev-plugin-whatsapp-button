<?php
/**
 * fields.php
 *
 * Define los callbacks de todos los campos del panel de administración del plugin WhatsApp Button.
 * Cada función renderiza el input correspondiente, maneja valores predeterminados y mensajes de ayuda.
 *
 * Campos cubiertos:
 * - Activación del botón
 * - Número de WhatsApp
 * - Mensaje personalizado
 * - Tamaño del botón e ícono
 * - Animaciones de carga y hover con vista previa
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

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
