<?php
// Sanitizar los datos de entrada
$l1 = nl2br(htmlspecialchars(elCampo('linea1'), ENT_QUOTES, 'UTF-8'));
$l2 = nl2br(htmlspecialchars(elCampo('linea2'), ENT_QUOTES, 'UTF-8'));
?>
<section class="decide">
    <div class="padding-global">
        <div class="padding-section-medium">
            <div class="container-extra-large">
                <div class="decide_wrp">
                    <div id="w-node-_7e4ceca1-d7be-d9c4-5e6a-9232bb4b6148-dc299573" class="title-component is-left is-center">
                        <div class="title-component-top">
                            <h2 class="heading-section-white is-medium"><?= $l1 ?></h2>
                            <img src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/Frame-1.png" loading="lazy" alt="Icono" class="title-component-icon">
                        </div>
                        <h2 class="heading-section is-white"><?= $l2 ?></h2>
                    </div>
                    <a id="w-node-dd3eb592-d685-5015-a89f-241bf4b570fb-dc299573" href="#bann" class="button is-white is-extra-large w-button">Registrarme</a>
                </div>
            </div>
        </div>
    </div>
</section>
