<?php
$imagen = fileCampo('ldc-img');
$sup = elCampo('ldc-msn');
$titulo = elCampo('ldc-titulo');

$grupos_carreras = elCampo('ldp-carreras');

// Array de sedes disponibles
$sedes_disponibles = [
    'lima_norte' => 'Lima Norte (Puente Piedra)',
    'lima_sur' => 'Lima Sur'
];

// Generar HTML para el selector de sede
$selector_sede_html = "<select name='filtro_sede' id='filtro-sede-carreras' class='w-select form__input-select-wrapper sede-filter' style='height: 50px;'>";
$selector_sede_html .= "<option value='todas' selected>Todas las sedes</option>";
foreach ($sedes_disponibles as $valor => $texto) {
    $selector_sede_html .= "<option value='{$valor}'>{$texto}</option>";
}
$selector_sede_html .= "</select>";

$html_tabs = '';
$html_groups = '';
$numcarreras = [];

foreach ($grupos_carreras as $key => $modalidad) {
    $numcarreras[] = elCampo($modalidad, 'numcarreras');
    $nombre_grupo = elCampo($modalidad, 'grupo');
    $carreras = elCampo($modalidad, 'carreras');
    $activate = $key == 0 ? 'w--current' : '';
    $activate_g = $key == 0 ? 'w--tab-active' : '';

    $html_tabs .= <<<HTML
    <a data-w-tab="Tab {$key}" data-pos="{$key}" id="prepre" class="estudia_tab-link w-inline-block w-tab-link {$activate}">
        <div>$nombre_grupo</div>
    </a>
    HTML;

    $html_carreras = '';
    $con = 0;
    foreach ($carreras as $key_b => $carrera) {
        $colorpin = elCampo($carrera, 'colorpin');
        $colormodal = elCampo($carrera, 'colormodal');
        $nombre = elCampo($carrera, 'nombre');
        $descripcion = nl2br(elCampo($carrera, 'descripcion'));
        $brochure = fileCampo($carrera, 'brochure');
        $img = fileCampo($carrera, 'imagen');
        $icon = fileCampo($carrera, 'icon');
        $sedes_carrera = elCampo($carrera, 'carreras_sede'); // Array de sedes de esta carrera
        $data_sedes = is_array($sedes_carrera) ? implode(',', $sedes_carrera) : '';
        
        $tm_img = TEMA_IMG;
        $con += 1;
        $html_carreras .= <<<HTML
        <div class="estudia_tab-item" data-sedes="{$data_sedes}">
            <div class="line-carrera is-blue" style="background-color: {$colorpin}"></div>
            <img loading="lazy" src="{$icon}" alt="" class="estudia_tab-icon">
            <div>$nombre</div>
            <div class="estudia_tab-modal">
                <div class="is-hide w-embed">
                    <img src="{$tm_img}/Group-40229.png" loading="lazy" data-w-id="3c2b77af-a791-4795-0355-2db255d478ea" alt="" class="estudia_tab-modal-close" onclick="openModalProducto()">
                </div>
                <img data-w-id="90892548-1d28-a042-d9a7-e0a55f740477" loading="lazy" alt="" src="{$tm_img}/Group-40229.png" class="estudia_tab-modal-close" id="btn-close-modal_{$key}_{$con}">
                <div class="estudia_tab-modal-cont">
                    <div class="estudia_tab-modal-info">
                        <div class="estudia_tab-modal-head bloue" style="background-color:{$colormodal}">
                            <div id="w-node-_65928ca4-b82d-c529-37bf-5a0bea05b10d-dc299573" class="estudia_tab-modal-titulo">
                                <img loading="lazy" src="{$tm_img}/image-20.png" alt="" class="estudia_tab-modal-arrow">
                                <div class="estudia_tab-modal-title">$nombre</div>
                            </div>
                            <img id="w-node-_05e7208b-f755-3f0a-bc94-861f7111b33b-dc299573" loading="lazy" alt="" src="{$img}" class="estudia_tab-modal-person">
                        </div>
                        <div class="estudia_tab-modal-body">
                            <div id="w-node-_2f52b8b8-8f8d-98ff-d353-4d02df426370-dc299573" class="estudia_tab-modal-col">
                                <div class="estudia_tab-modal-col-title">Estudia la carrera profesional de <span class="bloue">$nombre</span>
                                </div>
                                <div>$descripcion</div>
                            </div>
                            <div id="w-node-bc294b83-fa63-34c7-a2ca-9778293b9696-dc299573" class="estudia_tab-modal-col">
                                <a href="#" class="w-inline-block w-lightbox">
                                    <img loading="lazy" src="images/Group-40238.png" alt="" class="egresados_tarjet-vid-modal">
                                      <script type="application/json" class="w-json">{
                                            "items": [
                                                {
                                                "url": "https://www.youtube.com/watch?v=mf3mRw-ycxY",
                                                "originalUrl": "https://www.youtube.com/watch?v=mf3mRw-ycxY",
                                                "width": 940,
                                                "height": 528,
                                                "thumbnailUrl": "https://i.ytimg.com/vi/mf3mRw-ycxY/hqdefault.jpg",
                                                "html": "<iframe class=\"embedly-embed\" src=\"//cdn.embedly.com/widgets/media.html?src=https%3A%2F%2Fwww.youtube.com%2Fembed%2Fmf3mRw-ycxY%3Ffeature%3Doembed&display_name=YouTube&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dmf3mRw-ycxY&image=https%3A%2F%2Fi.ytimg.com%2Fvi%2Fmf3mRw-ycxY%2Fhqdefault.jpg&key=96f1f04c5f4143bcb0f2e68c87d65feb&type=text%2Fhtml&schema=youtube\" width=\"940\" height=\"528\" scrolling=\"no\" title=\"YouTube embed\" frameborder=\"0\" allow=\"autoplay; fullscreen; encrypted-media; picture-in-picture;\" allowfullscreen=\"true\"></iframe>",
                                                "type": "video"
                                                }
                                            ],
                                            "group": ""
                                            }
                                        </script>
                                </a>
                                <div style="display:flex;gap: 10px;flex-wrap: wrap;align-items: center;justify-content: center;">
                                    <a href="javascript:void(0)" class="button modal w-button" id="btn-inscribete-full_{$key}_{$con}">Inscríbete</a>
                                    <a href="{$brochure}" target="_blank" class="button modal w-button">Ver brochure</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const button = document.querySelector("#btn-inscribete-full_{$key}_{$con}");
                button.addEventListener("click", (event) => {
                     const modal = document.querySelector('#btn-close-modal_{$key}_{$con}')
                     modal.click();
                    
                    event.preventDefault();
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500);
                });
            });
        </script>
        HTML;

    }

    $html_groups .= <<<HTML
    <div data-w-tab="Tab {$key}" class="estudia_tab-mask w-tab-pane {$activate_g}">
        <div class="estudia_tab-info">
            $html_carreras
        </div>
    </div>
    HTML;
}

$html_tabs = "<div class='estudia_tab-main w-tab-menu'>$html_tabs</div>";
$html_groups = "<div class='estudia_tab-content w-tab-content'>$html_groups</div>";
?>

<script>let numCarreras = <?php echo json_encode($numcarreras); ?>; </script>

<section class="estudia">
    <div class="padding-global">
        <div class="container-extra-large">
            <div class="estudia_wrp">
                <img src="<?= $imagen ?>" loading="lazy" id="w-node-ce2c4984-1b74-0bc0-74e3-4a8a25bae83c-dc299573" alt="" class="estudia_wrp-img">
                <div class="estudia_text">
                    <div class="title-component is-left">
                        <div class="title-component-top">
                            <h2 class="heading-section-white"><?= $sup ?></h2>
                            <img src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/Frame-1.png" loading="lazy" alt="" class="title-component-icon">
                        </div>
                        <h2 class="heading-section title-color-black">
                            <span id="numcarreras"><?= $numcarreras[0] ?></span> <?= $titulo ?>
                        </h2>
                    </div>
                    
                    <!-- Selector de sede para filtrar -->
                    <div style="width: auto; max-width:300px;">
                        <?= $selector_sede_html ?>
                    </div>
                    
                    <div data-current="Tab 1" data-easing="ease" data-duration-in="300" data-duration-out="100" class="estudia_tab w-tabs">
                        <?= $html_tabs ?>
                        <?= $html_groups ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>