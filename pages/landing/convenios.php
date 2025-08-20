<?php
$titulo = nl2br(htmlspecialchars(elCampo('ldco-titulo'), ENT_QUOTES, 'UTF-8'));

$lista = elCampo('ldco-lista');
$chunks = array_chunk($lista, 9);

$html_chunks = "";
foreach ($chunks as $grupo) {
    $html_grupos = '';
    foreach ($grupo as $item) {
        $logo = htmlspecialchars(fileCampo($item, 'imagen'), ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars(elCampo($item, 'texto'), ENT_QUOTES, 'UTF-8');
        $html_grupos .= <<<HTML
        <div id="w-node-b5449ee6-7586-7463-ba9d-165afb7dc4a5-dc299573" class="convenios_item">
            <img src="{$logo}" loading="lazy" alt="" class="convenios_item-logo">
            <div>$nombre</div>
        </div>
        HTML;
    }
    $html_chunks .= <<<HTML
    <div class='convenios_slider-slide w-slide'>
        <div id='w-node-b5449ee6-7586-7463-ba9d-165afb7dc4a4-dc299573' class='convenios_grid'>
            $html_grupos
        </div>
    </div>
    HTML;
}
?>

<section class="convenios">
    <div class="padding-global">
        <div class="padding-section-medium">
            <div class="container-extra-large">
                <div class="convenios_wrp">
                    <div id="w-node-bcb17958-ccfa-de4e-b14d-5587d2de7d88-dc299573" class="title-component is-left mrtop convenios">
                        <h2 class="heading-section is-orange"><?= $titulo ?></h2>
                    </div>
                    <div data-delay="4000" data-animation="slide" class="convenios_slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true" id="w-node-ae55f297-8ccd-56cb-1ad5-743c206e9e75-dc299573">
                        <div class="convenios_slider-mask w-slider-mask">
                           <?= $html_chunks ?>
                        </div>
                        <div class="convenios_arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left">
                            </div>
                        </div>
                        <div class="convenios_arrow w-slider-arrow-right">
                            <div class="w-icon-slider-right">
                            </div>
                        </div>
                        <div class="convenios_nav w-slider-nav w-slider-nav-invert w-round">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>