</main>
</div>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=66cf3dcb409b247bdc299526" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<?php
wp_footer();
?>
<script src="https://parsleyjs.org/dist/parsley.js"></script>

<script>
    Parsley.addMessages("es", {
        defaultMessage: "Este valor parece ser inválido.",
        type: {
            email: "Este valor debe ser un correo válido.",
            url: "Este valor debe ser una URL válida.",
            number: "Este valor debe ser un número válido.",
            integer: "Este valor debe ser un número válido.",
            digits: "Este valor debe ser un dígito válido.",
            alphanum: "Este valor debe ser alfanumérico.",
        },
        notblank: "Este valor no debe estar en blanco.",
        required: "Este valor es requerido.",
        pattern: "Este valor es incorrecto.",
        min: "Este valor no debe ser menor que %s.",
        max: "Este valor no debe ser mayor que %s.",
        range: "Este valor debe estar entre %s y %s.",
        minlength: "Este valor es muy corto. La longitud mínima es de %s caracteres.",
        maxlength: "Este valor es muy largo. La longitud máxima es de %s caracteres.",
        length: "La longitud de este valor debe estar entre %s y %s caracteres.",
        mincheck: "Debe seleccionar al menos %s opciones.",
        maxcheck: "Debe seleccionar %s opciones o menos.",
        check: "Debe seleccionar entre %s y %s opciones.",
        equalto: "Este valor debe ser idéntico.",
    });
    Parsley.setLocale("es");
</script>

<?php
$page = get_page_by_path('gracias');
$page_url = '';
if ($page) {
    $page_url = get_permalink($page->ID);
}
?>

<script>
    var typ = "<?= $page_url ?>";
    var api = "https://virtual.autonoma.edu.pe/Externa/UA_movil.aspx/wsObtenerDatosLandingPreCPT";
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiperMulti = new Swiper('.swiper-container', {
        centeredSlides: true,
        loop: true,
        speed: 800,
        spaceBetween: 25,
        autoplay: {
            delay: 2000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20
            },
        }
    });
</script>

<script src="<?= TEMA_JS . '/tabs.js' ?>"></script>
<script src="<?= TEMA_JS . '/selects.js' ?>"></script>
<script src="<?= TEMA_JS . '/validator.js' ?>"></script>
<script src="<?= TEMA_JS . '/envio.js' ?>"></script>

</body>

</html>