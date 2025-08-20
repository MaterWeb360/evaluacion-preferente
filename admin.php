<?php
/**
 * Iniciador de los campos del tema
 */

 function fields_aedon()
 {
     // Configuración del tema
     require TEMA_ADMIN . '/fields/global.php';
 
     //  Página: Home. (ld-)
     require TEMA_ADMIN . '/fields/home.php';
 }
 add_action('carbon_fields_register_fields', 'fields_aedon');
 
 function crb_load()
 {
     require_once get_template_directory() . '/vendor/autoload.php';
     \Carbon_Fields\Carbon_Fields::boot();
 }
 add_action('after_setup_theme', 'crb_load');
 
 /* *
  *
  * Llamadas abreviadas
  * */
 function elCampo($campo, $item = null)
 {
     if (is_array($campo)) {
         return $campo[$item];
     } else {
         return carbon_get_post_meta(get_the_ID(), $campo);
     }
 }
 
 function tinyCampo($campo, $item = null)
 {
     if (is_array($campo)) {
         return apply_filters('the_content', $campo[$item]);
     } else {
         return apply_filters('the_content', carbon_get_post_meta(get_the_ID(), $campo));
     }
 }
 
 function fileCampo($campo, $item = null)
 {
     if (is_array($campo)) {
         return wp_get_attachment_url($campo[$item]);
     } else {
         return wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), $campo));
     }
 }
 
 function globalCampo($campo)
 {
     return carbon_get_theme_option($campo);
 }

//  ===============================================================================================

/* *
 *  Lista de enqueue scripts, actions y hooks ADMIN
 * */
function tema_enqueue_scripts_admin()
{
    wp_enqueue_style(
        'tema-admin-style',
        TEMA_ADMIN_URI . '/assets/admin.css',
        [],
        '1.0',
        'all'
    );
    wp_enqueue_script(
        'tema-admin-script',
        TEMA_ADMIN_URI . '/assets/admin.js',
        ['jquery'],
        '1.0',
        true
    );
}
add_action('admin_enqueue_scripts', 'tema_enqueue_scripts_admin');

/* *
 *  Curar svg 
 * */
function add_svg_mime_type($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_svg_mime_type');

/* *
 *  Establecer la página de inicio como página de portada estática
 * */
function establecer_pagina_inicio()
{
    $args = array(
        'post_type' => 'page',
        'title' => 'Inicio',
        'posts_per_page' => 1
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $pagina_inicio = $query->posts[0];
        $pagina_id = $pagina_inicio->ID;

        // Actualiza la configuración de WordPress
        update_option('show_on_front', 'page');
        update_option('page_on_front', $pagina_id);
    }

    wp_reset_postdata();
}

// Agrega acción para ejecutar la función al activar el tema
add_action('after_switch_theme', 'establecer_pagina_inicio');
