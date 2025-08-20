<?php
/**
 * Constantes tema
 **/
define('TEMA', get_template_directory() );
define('TEMA_ADMIN_URI', get_template_directory_uri() . '/admin' );
define('TEMA_ADMIN', get_template_directory() . '/admin' );
define('TEMA_CSS', get_template_directory_uri() . '/assets/css');
define('TEMA_JS', get_template_directory_uri() . '/assets/js');
define('TEMA_HELPERS', get_template_directory() . '/helpers');
define('TEMA_IMG', get_template_directory_uri() . '/assets/images');

// ================================================================================
/**
 * Admin
 **/
require_once TEMA . '/admin.php';

/**
 * Helpers
 **/
require_once TEMA . '/helpers.php';

/**
 * Public
 **/
require_once TEMA . '/public.php';
