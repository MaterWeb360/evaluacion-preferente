<?php
// Obtener valores de los campos
$desc = htmlspecialchars(elCampo('ldf-descuento'), ENT_QUOTES, 'UTF-8');
$msn = htmlspecialchars(elCampo('ldf-text'), ENT_QUOTES, 'UTF-8');
$resmsn = htmlspecialchars(elCampo('ldf-res'), ENT_QUOTES, 'UTF-8');
$notas = htmlspecialchars(elCampo('ldf-aclara'), ENT_QUOTES, 'UTF-8');

ob_start();

for ($i = 0; $i <= 8; $i++) {
    echo <<<HTML
    <div class="barra_carousel-item">
        <div class="barra_carousel-num">$desc</div>
        <div>$msn</div>
        <div class="barra_carousel-desc">$resmsn</div>
    </div>
    HTML;
}

$html_barra = ob_get_clean();
?>
<section class="barra">
    <div class="barra_wrp">
        <div data-w-id="62d24fe8-38ba-6411-a8ef-c9129bf4a2f1" class="barra_carrousel">
            <?= $html_barra ?>
        </div>
        <div id="barrita" class="barra_static">
            <div><?= $notas ?></div>
        </div>
    </div>
</section>
