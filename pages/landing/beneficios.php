<?php
$titulo = array_map(fn($linea) => htmlspecialchars($linea, ENT_QUOTES, 'UTF-8'), explode('<br />', nl2br(elCampo('ldp-titulo'))));
$img = htmlspecialchars(fileCampo('ldp-img'), ENT_QUOTES, 'UTF-8');
$lista = elCampo('ldp-beneficios');

$lista_html = '';
foreach ($lista as $key => $item) {
    $item_icon = htmlspecialchars(fileCampo($item, 'icono'), ENT_QUOTES, 'UTF-8');
    $item_titulo = htmlspecialchars(elCampo($item, 'titulo'), ENT_QUOTES, 'UTF-8');
    $item_txt = nl2br(htmlspecialchars(elCampo($item, 'texto'), ENT_QUOTES, 'UTF-8'));
    $item_nota = htmlspecialchars(elCampo($item, 'nota'), ENT_QUOTES, 'UTF-8');

    $lista_html .= <<<HTML
    <div class="porque_item">
        <img src="{$item_icon}" loading="lazy" alt="" class="porque_item-img">
        <div class="porque_item-txt">
            <h3 class="heading-porque">$item_titulo</h3>
            <div>$item_txt</div>
            <div class="text-size-tiny text-color-grey">$item_nota</div>
        </div>
    </div>
    HTML;
}

?>

<section class="porque">
    <div class="padding-global">
        <div class="padding-section-medium">
            <div class="container-extra-large">
                <div class="porque_wrp">
                    <div class="title-component">
                        <div class="title-component-top">
                            <img src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/Frame.png" loading="lazy" alt="" class="title-component-icon">
                            <h2 class="heading-section-orange"><?= $titulo[0] ?></h2>
                        </div>
                        <h2 class="heading-section"><?= $titulo[1] ?></h2>
                    </div>
                    <div class="porque_info">
                        <div data-delay="4000" data-animation="slide" class="porque_slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="true" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true" id="w-node-_1afefa2c-14d2-2344-5f03-5fa340750d54-dc299573">
                            <div class="porque_mask w-slider-mask">
                                <div class="porque_slide w-slide">
                                    <div class="porque_slide-cont">
                                        <?= $lista_html ?>
                                    </div>
                                </div>
                            </div>
                            <div class="w-slider-arrow-left">
                                <div class="w-icon-slider-left">
                                </div>
                            </div>
                            <div class="w-slider-arrow-right">
                                <div class="w-icon-slider-right">
                                </div>
                            </div>
                            <div class="porque_slider-main w-slider-nav w-slider-nav-invert w-round">
                            </div>
                        </div>
                        <div id="w-node-_617cc1d6-aa03-964b-2cd2-e7ae1044dbd0-dc299573" class="porque_img-cont">
                            <img src="<?= $img ?>" loading="lazy" id="w-node-_2a0f6525-404f-6f9c-5e83-5147c2db3ded-dc299573" alt="" class="porque_img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>