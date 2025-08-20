<?php
$titulo = array_map(fn($linea) => htmlspecialchars($linea, ENT_QUOTES, 'UTF-8'), explode('<br />', nl2br(elCampo('ldt-titulo'))));

$lista = elCampo('ldg-lista');

$testimonios_html = "";
foreach ($lista as $key => $item) {
    $item_nombre = htmlspecialchars(elCampo($item, 'nombre'), ENT_QUOTES, 'UTF-8');
    $item_puesto = htmlspecialchars(elCampo($item, 'puesto'), ENT_QUOTES, 'UTF-8');
    $item_testimonio = htmlspecialchars(nl2br(elCampo($item, 'testimo')), ENT_QUOTES, 'UTF-8');
    $item_img = htmlspecialchars(fileCampo($item, 'imagen'), ENT_QUOTES, 'UTF-8');
    $item_yt_url = htmlspecialchars(elCampo($item, 'youtube'), ENT_QUOTES, 'UTF-8');
    $item_yt = get_youtube_embed_code($item_yt_url);

    $tema_img = htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8');

    $json = [
        "url" => $item_yt_url,
        "originalUrl" => $item_yt_url,
        "width" => 940,
        "height" => 528,
        "thumbnailUrl" => "https://i.ytimg.com/vi/n4pp6J7hmNg/hqdefault.jpg",
        "html" => $item_yt,
        "type" => "video"
    ];
    $json_encode = json_encode($json, JSON_UNESCAPED_SLASHES);

    $testimonios_html .= <<<HTML
    <div class="swiper-slide">
        <div class="egresados_tarjet">
            <div class="egresados_tarjet-head">
                <img loading="lazy" src="{$item_img}" alt="Imagen de {$item_nombre}" class="egresados_tarjet-foto">
                <a href="#" class="w-inline-block w-lightbox">
                    <img loading="lazy" src="{$tema_img}/Frame-2643.png" alt="Video de {$item_nombre}" class="egresados_tarjet-vid">
                    <script type="application/json" class="w-json">
                        {
                            "items": [$json_encode],
                            "group": ""
                        }
                    </script>
                </a>
            </div>
            <div class="egresados_tarjet-body">
                <h3 class="egresados_tarjet-title">$item_nombre</h3>
                <div class="egresados_tarjet-subtitle">$item_puesto</div>
                <img loading="lazy" src="{$tema_img}/Your-email-address-w.png" alt="Comillas" class="egresados_tarjet-comilla">
                <div class="text-color-lila">$item_testimonio</div>
                <img loading="lazy" src="{$tema_img}/Frame-597.png" alt="Pie de tarjeta" class="egresados_tarjet-foot">
            </div>
        </div>
    </div>
    HTML;
}
?>

<section class="egresados">
    <div class="padding-global">
        <div class="padding-section-medium">
            <div class="container-extra-large">
                <div class="egresados_wrp">
                    <div class="title-component">
                        <div class="title-component-top">
                            <h2 class="heading-section-orange">
                                <?= $titulo[0] ?>
                            </h2>
                        </div>
                        <h2 class="heading-section is-white">
                            <?= $titulo[1] ?>
                        </h2>
                    </div>
                    <div class="container">
                        <div class="swrper_component">
                            <div class="slider_slider-wrapper-vf">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?= $testimonios_html ?>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next">
                                <svg width="1em" height="1em" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.875 3.75L13.125 10L6.875 16.25" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </div>
                            <div class="swiper-button-prev">
                                <svg width="1em" height="1em" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.125 16.25L6.875 10L13.125 3.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </div>
                            <div class="swiper-pagination">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>