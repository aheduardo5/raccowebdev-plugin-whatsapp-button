<?php
/**
 * register-settings.php
 *
 * Define y registra las configuraciones del plugin en el panel de administración.
 * Incluye:
 * - Registro de opciones con `register_setting`
 * - Secciones organizadas con `add_settings_section`
 * - Campos individuales con `add_settings_field`
 *
 * @package RaccoWebDev_WhatsApp_Button
 */

function whatsapp_button_register_settings()
{
  // Registrar opciones
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_number');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_message');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_enabled');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_size');
  register_setting('whatsapp_button_settings_group', 'whatsapp_icon_size');
  register_setting('whatsapp_button_settings_group', 'whatsapp_button_clickid');

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

  // Agregar seccion de clickId
  add_settings_section(
    'whatsapp_button_clickid_section',
    'Configuración de Click ID',
    function () {
      echo '<p>Personaliza el identificador de click para los fines de analitica o tracking.</p>';
    },
    'whatsapp_button_clickid'
  );

  add_settings_field(
    'whatsapp_button_clickid',
    'Click ID (Versión Gratuita)',
    'whatsapp_button_clickid_callback',
    'whatsapp_button_clickid',
    'whatsapp_button_clickid_section'
  );

}
add_action('admin_init', 'whatsapp_button_register_settings');
