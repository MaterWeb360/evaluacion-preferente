<?php
$wsp = globalCampo('g-btn-flotante-wsp');
$dir = globalCampo('g-fod-dir');
$tel = globalCampo('g-fod-tel');
$email = globalCampo('g-fod-email');
?>

<section class="footer">
    <div class="padding-global">
        <div class="padding-section-medium">
            <div class="container-extra-large">
                <div class="footer_wrp">
                    <div class="items-footer">
                        <div class="items-centrador-footer">
                            <div class="item-footer">
                                <img alt="" src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/marcador-de-mapa-2-1.png" class="icon-footer">
                                <div class="text-footer"><?= $dir ?></div>
                            </div>
                            <div class="item-footer">
                                <img alt="" src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/llamada-telefonica-14-1.png" class="icon-footer">
                                <div class="text-footer"><?= $tel ?></div>
                            </div>
                            <div class="item-footer last">
                                <img alt="" src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/sobre-17-1.png" class="icon-footer">
                                <div class="text-footer"><?= $email ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-legal">
                    <div class="firma-perfom">©Autónoma Todos los derechos reservados</div>
                    <div class="firma-perfom">
                        <a href="https://www.performlab.pe/?utm_source=landingTPOAutonoma&amp;utm_medium=referer" target="_blank" class="link-perform">Desarrollando por PerformLab</a>
                    </div>
                    <a href="https://www.performlab.pe/?utm_source=landingTPOAutonoma&amp;utm_medium=referer" target="_blank" class="perfomlab w-inline-block">
                        <img alt="" src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/logo-performlab.svg" class="logo-perfom">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if(!empty($wsp)){
?>
<div class="fixedbuttons">
    <div class="messagebuttons">
        <a href="<?= $wsp ?>" target="_blank" class="linkmessage w-inline-block">
            <img loading="lazy" src="<?= htmlspecialchars(TEMA_IMG, ENT_QUOTES, 'UTF-8') ?>/Group-40128.png" alt="" class="iconmessage">
        </a>
    </div>
    <a href="#formoovil" class="button-2 color-2 fixbtn w-button">INSCRÍBETE</a>
</div>
<?php } ?>