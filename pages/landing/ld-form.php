<?php
$fondo = htmlspecialchars(fileCampo('ld-fondo'), ENT_QUOTES, 'UTF-8');
$personaje = htmlspecialchars(fileCampo('ld-pj'), ENT_QUOTES, 'UTF-8');

$mostrar_horario = elCampo('ld-form-horario');

$titulo = explode('<br />', nl2br(elCampo('ld-titulo')));
$titulo_html = implode('<br>', array_map(function ($linea, $key) {
    $class = $key == 0 ? 'title-white' : 'title-orange';
    return '<span class="' . $class . '">' . htmlspecialchars($linea, ENT_QUOTES, 'UTF-8') . '</span>';
}, $titulo, array_keys($titulo)));

$titulo_form = htmlspecialchars(elCampo('ld-form-txt'), ENT_QUOTES, 'UTF-8');
$fecha_form = explode('-', nl2br(elCampo('ld-form-fecha')));
$fecha_form_html = implode('<br>', array_map(fn($linea) => htmlspecialchars($linea, ENT_QUOTES, 'UTF-8'), $fecha_form));

$form_modulos = elCampo('front_form_modulos');
$form_horario_t = htmlspecialchars(elCampo('lista-modalidad-titulo'), ENT_QUOTES, 'UTF-8');
$form_carrera_t = htmlspecialchars(elCampo('lista-carrera-titulo'), ENT_QUOTES, 'UTF-8');

$modulos_html = "";
$modulos_horarios_html = "";
$modulos_carreras_html = "";

foreach ($form_modulos as $key => $modulo) {
    if ($modulo['ocultar'] === false) {
        $mod_titulo = htmlspecialchars(elCampo($modulo, 'titulo'), ENT_QUOTES, 'UTF-8');
        $mod_cod = htmlspecialchars(elCampo($modulo, 'codigo_modulo'), ENT_QUOTES, 'UTF-8');

        $titulo_lista_carreras = htmlspecialchars(elCampo($modulo, 'lista-modalidad-titulo-carrera'), ENT_QUOTES, 'UTF-8');
        
        $modulos_horarios = elCampo($modulo, 'lista-modalidad');
        $carreras_alter = elCampo($modulo, 'lista-carreras-alter');

        $first_modulo = ($key == 0) ? 'w--redirected-checked' : '';
        $checked = ($key == 0) ? 'checked' : '';
        $alter = elCampo($modulo, 'ocultar-horario') === true ? 'true' : 'false';

        $modulos_html .= <<<HTML
        <label class="radio-button w-radio">
            <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-button-icon w-radio-input {$first_modulo}"></div>
            <input type="radio" name="tipo" class="tipo" id="modulo{$key}" data-name="tipo" required="" data-modulo='modulo{$key}' data-cod='{$mod_cod}' data-alter="{$alter}" style="opacity:0;position:absolute;z-index:-1" value="modulo{$key}" {$checked}>
            <span class="radio-button-label w-form-label" for="modulo{$key}">$mod_titulo</span>
        </label>
        HTML;
        
        if ($alter === 'false') {
            foreach ($modulos_horarios as $key_b => $horario) {
                $modalidad_nombre = htmlspecialchars(elCampo($horario, 'modalidad_nombre'), ENT_QUOTES, 'UTF-8');
                $modalidad_codigo = htmlspecialchars(elCampo($horario, 'modalidad_codigo'), ENT_QUOTES, 'UTF-8');
                $modulos_carreras = elCampo($horario, 'lista-carreras');
                
                $modulos_horarios_html .= "<option value='{$modalidad_codigo}' data-original-value='{$modalidad_codigo}' data-modulo='modulo{$key}' data-horario='horario{$key}-{$key_b}'>{$modalidad_nombre}</option>";


                foreach ($modulos_carreras as $key_c => $carrera) {
                    $carrera_nombre = htmlspecialchars(elCampo($carrera, 'carrera_nombre'), ENT_QUOTES, 'UTF-8');
                    $carrera_codigo = htmlspecialchars(elCampo($carrera, 'carrera_codigo'), ENT_QUOTES, 'UTF-8');

                    $modulos_carreras_html .= $key_c === 0 ? "<option value='titulo{$key}-{$key_b}-{$key_c}' data-original-value='titulo{$key}-{$key_b}-{$key_c}' data-modulo='modulo{$key}' data-horario='horario{$key}-{$key_b}' selected disabled >$titulo_lista_carreras</option>" : null;
                    $modulos_carreras_html .= "<option value='{$carrera_codigo}' data-original-value='{$carrera_codigo}' data-modulo='modulo{$key}' data-horario='horario{$key}-{$key_b}'>{$carrera_nombre}</option>";
                }
            }
        } else {
            $modulos_horarios_html .= "<option data-modulo='modulo{$key}' data-horario='horario-alter{$key}' value=''></option>";

            foreach ($carreras_alter as $key_ba => $carrera_alter) {
                $carrera_nombre = htmlspecialchars(elCampo($carrera_alter, 'carrera_nombre'), ENT_QUOTES, 'UTF-8');
                $carrera_codigo = htmlspecialchars(elCampo($carrera_alter, 'carrera_codigo'), ENT_QUOTES, 'UTF-8');
                
                $modulos_carreras_html .= $key_ba === 0 ? "<option value='titulo{$key}-{$key_ba}' data-original-value='titulo{$key}-{$key_ba}' data-modulo='modulo{$key}' data-horario='horario-alter{$key}' selected disabled >$titulo_lista_carreras</option>" : null;
                $modulos_carreras_html .= "<option value='{$carrera_codigo}' data-original-value='{$carrera_codigo}' data-modulo='modulo{$key}' data-horario='horario-alter{$key}'>{$carrera_nombre}</option>";
            }
        }
    }
}

?>

<div style="display: none;" id="modulos_horarios">
    <?= $modulos_horarios_html ?>
</div>

<div style="display: none;" id="modulos_carreras">
    <?= $modulos_carreras_html ?>
</div>

<section class="banner">
    <div id="bann" class="banner_wrp">
        <div class="banner_info">
            <div id="w-node-e20641d5-80c4-85b3-2569-165db7d57b92-dc299573" class="banner_txt">
                <div class="title-hero">
                    <h1 class="heading">
                        <?= $titulo_html ?>
                    </h1>
                </div>
            </div>
            <div id="w-node-be7d63ac-408b-85c1-338a-85a8e98394f8-dc299573" class="banner_cont-form">
                <div class="form w-form">
                    <form id="formularioAutonoma" name="email-form" data-name="Email Form" method="get" class="form_content" data-wf-page-id="66cf3dcb409b247bdc299573" data-wf-element-id="2ee62d7f-2eaf-5730-0877-9ad45222550a">
                        <div class="form_float">
                            <div>Licenciada por</div>
                            <div class="text-size-large text-weight-bold">SUNEDU</div>
                        </div>
                        <div class="form_header">
                            <div class="form-title"><?= $titulo_form ?></div>
                            <div class="form-line">
                            </div>
                            <div class="form_date">
                                <div><?= $fecha_form[2] ?></div>
                                <div class="form-date-mes">
                                    <div class="text-block"><?= getMonths($fecha_form[1], 'short') ?></div>
                                    <div class="form-line-min">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_body">
                            <div class="form_subtitle">Escoge la modalidad que prefieras</div>
                            <div class="form_botons">
                                <?= $modulos_html ?>
                            </div>
                            <div class="form_campos">
                                <div id="divcodigocampa" class="div_contenedor">
                                    <input type="hidden" name="cCodidoForm" id="cCodidoForm" value="">
                                </div>
                                <div id="boxCodCamp" class="form__input-select-wrapper hide">
                                </div>
                                <div class="form_campos-col">
                                    <input class="form__input-select-wrapper w-input" maxlength="256" name="cNombre" data-name="cNombre" placeholder="Nombres*" type="text" id="cNombre-3" required="">
                                    <input class="form__input-select-wrapper w-node-_7f78262d-584e-c84a-cc74-a63cddc89f16-dc299573 w-input" maxlength="256" name="cApellido" data-name="cApellido" placeholder="Apellidos*" type="text" id="cApellido" required="">
                                </div>
                                <div class="form_campos-col">
                                    <input class="form__input-select-wrapper w-input" maxlength="256" name="cCelular" data-name="cCelular" placeholder="Celular*" type="tel" id="cCelular-3" required="">
                                    <input class="form__input-select-wrapper w-node-e41b8217-7007-4227-0e11-1da7ad034b49-dc299573 w-input" maxlength="256" name="cDni" data-name="cDni" placeholder="DNI*" type="text" id="cDni" style="display:none">
                                    <!-- <input class="form__input-select-wrapper w-node-e41b8217-7007-4227-0e11-1da7ad034b49-dc299573 w-input" maxlength="256" name="cDni" data-name="cDni" placeholder="DNI*" type="text" id="cDni" required=""> -->
                                    <input class="form__input-select-wrapper w-input" maxlength="256" name="cCorreo" data-name="cCorreo" placeholder="ejemplo@gmail.com" type="email" id="cCorreo" required="">
                                </div>
                                <!-- <input class="form__input-select-wrapper w-input" maxlength="256" name="cCorreo" data-name="cCorreo" placeholder="ejemplo@gmail.com" type="email" id="cCorreo" required=""> -->
                                <div id="divhorario" class="div_contenedor ">
                                    <select id="nHorario" name="nHorario" data-name="nHorario" required="" class="w-select form__input-select-wrapper">
                                    </select>
                                </div>
                                <div id="divcarrera" class="div_contenedor">
                                    <select id="nUniOrgCodigo" name="nUniOrgCodigo" data-name="nUniOrgCodigo" required="" class="w-select form__input-select-wrapper">
                                    </select>
                                </div>
                            </div>
                            <div class="form_checkbox">
                                <div class="text-size-small">
                                    <strong>(*) Campos obligatorios</strong>
                                </div>
                                <label class="w-checkbox">
                                    <input type="checkbox" id="checkbox" name="checkbox" data-name="Checkbox" required="" class="w-checkbox-input" required>
                                    <span class="w-form-label ddd" for="checkbox">Declaro expresamente haber leído y aceptado las <a href="https://www.autonoma.pe/politicas-de-privacidad" target="_blank">Políticas de Privacidad</a> </span>
                                </label>
                            </div>
                            <span id="botonHomeInitEscritorio" class="button is-form w-button">Registrarme</span>
                            <input type="submit" data-wait="Please wait..." class="button is-form w-button" id="submitEscritorio" value="Registrarme">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="banner_bg">
        <div class="banner_bg-cont">
            <img src="<?= $fondo ?>" loading="lazy" alt="" class="banner_bg-fondo">
            <img src="<?= $personaje ?>" loading="lazy" alt="" class="banner_bg-person">
        </div>
    </div>
</section>