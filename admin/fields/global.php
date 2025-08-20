<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$basic_options_container = Container::make('theme_options', __('Opciones Generales'))
    ->add_tab(__('Logotipos'), [
        Field::make('separator', 'g-separator_4', __('Logotipos'))
            ->set_classes('separator_theme'),

        Field::make('image', 'g-logotipo', 'Logotipo')
            ->set_type(array('image'))
            ->set_value_type('url')
            ->set_help_text('Tamaño de imagen recomendado: 150 × 47 px'),

        Field::make('separator', 'g-separator_5', __('Favicon'))
            ->set_classes('separator_theme'),
        Field::make('image', 'g-favicon', __('Imagen'))
            ->set_type(array('image'))
            ->set_value_type('url')
            ->set_help_text('Tamaño de imagen recomendado: 150 × 150 px'),
    ])
    ->add_tab('Cabecera', [
        Field::make('header_scripts', 'g-script-header', 'Scripts')
    ])
    ->add_tab('Botones flotantes', [
        Field::make('separator', 'g-btn-flotante-sep1', 'Botones')
            ->set_classes('separator_theme'),
        Field::make('text', 'g-btn-flotante-wsp', 'Whatsapp')
        
    ])
    ->add_tab('Footer', [
        Field::make('separator', 'g-footer-sep1', __('Datos'))
            ->set_classes('separator_theme'),
        Field::make('text', 'g-fod-dir', 'Dirección'),
        Field::make('text', 'g-fod-tel', 'Teléfono'),
        Field::make('text', 'g-fod-email', 'Correo electrónico'),
        Field::make('footer_scripts', 'g-script-footer', 'Scripts')
    ]);
