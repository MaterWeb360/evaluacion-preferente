<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'ld-header', 'Cabecera')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('textarea', 'ld-titulo', 'Titulo de cabecera'),
        Field::make('image', 'ld-fondo', 'Imagen de fondo')
            ->set_width(50)
            ->help_text('Tamaño de imagen recomendado: 500 × 283 px'),
        Field::make('image', 'ld-pj', 'Imagen persona')
            ->set_width(50)
            ->help_text('Tamaño de imagen recomendado: 	448 × 599 px'),
    ]);

Container::make('post_meta', 'front_form', __('Formulario'))
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([

        Field::make('text', 'ld-form-txt', 'Titulo de formulario')
            ->set_width(50),
        Field::make('date', 'ld-form-fecha', 'Fecha de formulario')
            ->set_width(50),
        Field::make('complex', 'front_form_modulos', __('Modulos'))
            ->set_classes('modulos-class1')
            ->setup_labels(['plural_name' => 'Modulos', 'singular_name' => 'Modulo'])
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('checkbox', 'ocultar', 'Ocultar modulo')
                    ->set_option_value('yes'),
                Field::make('checkbox', 'ocultar-horario', 'Ocultar horarios')
                    ->set_option_value('yes'),
                Field::make('text', 'titulo', __('Titulo de modulo')),
                Field::make('text', 'codigo_modulo', __('Codigo de modulo')),
                Field::make('text', 'lista-modalidad-titulo', 'Titulo inicial de horarios'),
                Field::make('text', 'lista-modalidad-titulo-carrera', 'Titulo inicial de carreras'),
                Field::make('complex', 'lista-modalidad', 'Horarios')
                    ->set_classes('modulos-class2')
                    ->set_width(50)
                    ->setup_labels(['plural_name' => 'Horarios', 'singular_name' => 'Horario'])
                    ->add_fields([
                        // Field::make('checkbox', 'ocultar-horario', 'Ocultar el select "horario" en el formulario')
                        //     ->set_option_value('yes'),
                       
                        Field::make('text', 'modalidad_nombre', __('Nombre de Horario')),
                        Field::make('text', 'modalidad_codigo', __('Código de Horario')),
                        Field::make('text', 'lista-carrera-titulo', __('Titulo de carrera')),
                        Field::make('complex', 'lista-carreras', 'Carreras')
                            ->set_classes('modulos-class3')
                            ->set_width(50)
                            ->setup_labels(['plural_name' => 'Carreras', 'singular_name' => 'Carrera'])
                            ->set_layout('tabbed-vertical')
                            ->add_fields([
                                Field::make('text', 'carrera_nombre', __('Nombre de carrera')),
                                Field::make('text', 'carrera_codigo', __('Código de carrera')),
                            ])
                            ->set_header_template('<%- carrera_nombre %>'),
                    ])
                    ->set_header_template('<%- modalidad_nombre %>')
                    ->set_conditional_logic([
                        [
                            'field' => 'ocultar-horario',
                            'value' => false,
                        ]
                    ]),
                // Field::make('text', 'mensaje', 'Mensaje'),
                Field::make('complex', 'lista-carreras-alter', 'Carreras')
                    ->set_classes('modulos-class3')
                    ->set_width(50)
                    ->setup_labels(['plural_name' => 'Carreras', 'singular_name' => 'Carrera'])
                    ->set_layout('tabbed-vertical')
                    ->add_fields([
                        Field::make('multiselect', 'modalidad_sede', 'Sedes')
                            ->set_options(array(
                                'lima_norte' => 'Lima Norte (Puente Piedra)',
                                'lima_sur' => 'Lima Sur'
                            ))
                            ->set_width(100),
                        Field::make('text', 'carrera_nombre', __('Nombre de carrera')),
                        Field::make('text', 'carrera_codigo', __('Código de carrera')),
                    ])
                    ->set_header_template('<%- carrera_nombre %>')
                    ->set_conditional_logic([
                        [
                            'field' => 'ocultar-horario',
                            'value' => true,
                        ]
                    ]),
            ))
            ->set_header_template('Modulo: <%- titulo %>'),
    ]);

Container::make('post_meta', 'ld-franja', 'Franja')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('text', 'ldf-descuento', 'Descuento')
            ->set_width(33),
        Field::make('text', 'ldf-text', 'Mensaje')
            ->set_width(33),
        Field::make('text', 'ldf-res', 'Mensaje resaltado')
            ->set_width(34),
        Field::make('text', 'ldf-aclara', 'Notas finales')
    ]);

Container::make('post_meta', 'ld-porque', 'Sección: Por qué estudiar en Autónoma')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('textarea', 'ldp-titulo', 'Título de sección')
            ->set_classes('limit-2'),
        Field::make('image', 'ldp-img', 'Imagen lateral'),
        Field::make('complex', 'ldp-beneficios', 'Beneficios')
            ->set_max(3)
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('image', 'icono', 'Icono'),
                Field::make('text', 'titulo', 'Titulo'),
                Field::make('textarea', 'texto', 'Texto'),
                Field::make('text', 'nota', 'Nota')
            ])
    ]);

Container::make('post_meta', 'ld-carreras', 'Sección: Carreras')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('image', 'ldc-img', 'Imagen lateral'),
        Field::make('text', 'ldc-msn', 'Mensaje superior')
            ->set_help_text('Mensaje antes del titulo'),
        Field::make('text', 'ldc-titulo', 'Titulo de sección'),
        Field::make('complex', 'ldp-carreras', 'Carreras')
            ->set_max(3)
            ->add_fields([
                Field::make('text', 'numcarreras', 'Cantidad de carreras profesionales'),
                Field::make('text', 'grupo', 'Nombre de Modalidad'),
                Field::make('complex', 'carreras', 'Lista de carrera')
                    ->set_layout('tabbed-vertical')
                    ->add_fields([

                        Field::make('multiselect', 'carreras_sede', 'Sedes')
                            ->set_options(array(
                                'lima_norte' => 'Lima Norte (Puente Piedra)',
                                'lima_sur' => 'Lima Sur'
                            ))
                            ->set_width(100),

                        Field::make('text', 'nombre', 'Nombre de carrera'),

                        Field::make('color', 'colorpin', 'Color de barra')
                            ->set_help_text('Al lado del icono')
                            ->set_width(50),
                        Field::make('image', 'icon', 'Icono')
                            ->set_width(50),

                        Field::make('color', 'colormodal', 'Color de modal'),
                        Field::make('textarea', 'descripcion', 'Descripción'),
                        Field::make('file', 'brochure', 'Brochure'),
                        Field::make('image', 'imagen', 'Imagen')
                    ])
                    ->set_header_template('<%- nombre %>')
            ])
            ->set_header_template('<%- grupo %>')
    ]);

Container::make('post_meta', 'ld-xq', 'Sección: Banner')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('text', 'linea1', 'titulo: linea 1'),
        Field::make('text', 'linea2', 'titulo: linea 2')
    ]);

Container::make('post_meta', 'ld-testimonios', 'Sección: Testimonios')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('textarea', 'ldt-titulo', 'Titulo')
            ->set_classes('limit-2'),
        Field::make('complex', 'ldg-lista', 'Testimonios')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('text', 'nombre', 'Nombre'),
                Field::make('text', 'puesto', 'Puesto'),
                Field::make('textarea', 'testimo', 'Testimonio'),
                Field::make('image', 'imagen', 'Foto'),
                Field::make('text', 'youtube', 'Video Youtube')
            ])
    ]);

Container::make('post_meta', 'ld-convenios', 'Sección: Convenios')
    ->where('post_id', '=', get_option('page_on_front'))
    ->add_fields([
        Field::make('textarea', 'ldco-titulo', 'Titulo'),
        Field::make('complex', 'ldco-lista', 'Lista de convenios')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('image', 'imagen', 'Logo'),
                Field::make('text', 'texto', 'Nombre')
            ])
    ]);
