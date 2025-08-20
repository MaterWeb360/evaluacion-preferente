<?php
$favicon = globalCampo('g-favicon');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="66cf3dcb409b247bdc299573" data-wf-site="66cf3dcb409b247bdc299526">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]
            }
        });
    </script>
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>
    <style>
        .w-webflow-badge {
            display: none !important;
        }
        #botonHomeInitEscritorio, #botonHomeInitMobile{
            cursor: no-drop;
            background-color: rgb(252 136 5 / 54%);
            display: block;
        }
        #submitEscritorio, #submitMobile{
            display: none;
        }
    </style>

    <?php if ($favicon) { ?>
        <link href="<?= $favicon ?>" rel="shortcut icon" type="image/x-icon" />
        <link href="<?= $favicon ?>" rel="apple-touch-icon" />
    <?php }

    wp_head();
    ?>

</head>

<body class="body">
    <div class="page-wrapper">
        <div class="global-styles w-embed">
            <style>
                /* Make text look crisper and more legible in all browsers */
                body {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                    font-smoothing: antialiased;
                    text-rendering: optimizeLegibility;
                }

                /* Focus state style for keyboard navigation for the focusable elements */
                *[tabindex]:focus-visible,
                input[type="file"]:focus-visible {
                    outline: 0.125rem solid #4d65ff;
                    outline-offset: 0.125rem;
                }

                /* Get rid of top margin on first element in any rich text element */
                .w-richtext> :not(div):first-child,
                .w-richtext>div:first-child> :first-child {
                    margin-top: 0 !important;
                }

                /* Get rid of bottom margin on last element in any rich text element */
                .w-richtext>:last-child,
                .w-richtext ol li:last-child,
                .w-richtext ul li:last-child {
                    margin-bottom: 0 !important;
                }

                /* Prevent all click and hover interaction with an element */
                .pointer-events-off {
                    pointer-events: none;
                }

                /* Enables all click and hover interaction with an element */
                .pointer-events-on {
                    pointer-events: auto;
                }

                /* Create a class of .div-square which maintains a 1:1 dimension of a div */
                .div-square::after {
                    content: "";
                    display: block;
                    padding-bottom: 100%;
                }

                /* Make sure containers never lose their center alignment */
                .container-medium,
                .container-small,
                .container-large {
                    margin-right: auto !important;
                    margin-left: auto !important;
                }

                /* 
                Make the following elements inherit typography styles from the parent and not have hardcoded values. 
                Important: You will not be able to style for example "All Links" in Designer with this CSS applied.
                Uncomment this CSS to use it in the project. Leave this message for future hand-off.
                */
                /*
                a,
                .w-input,
                .w-select,
                .w-tab-link,
                .w-nav-link,
                .w-dropdown-btn,
                .w-dropdown-toggle,
                .w-dropdown-link {
                color: inherit;
                text-decoration: inherit;
                font-size: inherit;
                }
                */
                /* Apply "..." after 3 lines of text */
                .text-style-3lines {
                    display: -webkit-box;
                    overflow: hidden;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;
                }

                /* Apply "..." after 2 lines of text */
                .text-style-2lines {
                    display: -webkit-box;
                    overflow: hidden;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }

                /* Adds inline flex display */
                .display-inlineflex {
                    display: inline-flex;
                }

                /* These classes are never overwritten */
                .hide {
                    display: none !important;
                }

                @media screen and (max-width: 991px) {

                    .hide,
                    .hide-tablet {
                        display: none !important;
                    }
                }

                @media screen and (max-width: 767px) {
                    .hide-mobile-landscape {
                        display: none !important;
                    }
                }

                @media screen and (max-width: 479px) {
                    .hide-mobile {
                        display: none !important;
                    }
                }

                .margin-0 {
                    margin: 0rem !important;
                }

                .padding-0 {
                    padding: 0rem !important;
                }

                .spacing-clean {
                    padding: 0rem !important;
                    margin: 0rem !important;
                }

                .margin-top {
                    margin-right: 0rem !important;
                    margin-bottom: 0rem !important;
                    margin-left: 0rem !important;
                }

                .padding-top {
                    padding-right: 0rem !important;
                    padding-bottom: 0rem !important;
                    padding-left: 0rem !important;
                }

                .margin-right {
                    margin-top: 0rem !important;
                    margin-bottom: 0rem !important;
                    margin-left: 0rem !important;
                }

                .padding-right {
                    padding-top: 0rem !important;
                    padding-bottom: 0rem !important;
                    padding-left: 0rem !important;
                }

                .margin-bottom {
                    margin-top: 0rem !important;
                    margin-right: 0rem !important;
                    margin-left: 0rem !important;
                }

                .padding-bottom {
                    padding-top: 0rem !important;
                    padding-right: 0rem !important;
                    padding-left: 0rem !important;
                }

                .margin-left {
                    margin-top: 0rem !important;
                    margin-right: 0rem !important;
                    margin-bottom: 0rem !important;
                }

                .padding-left {
                    padding-top: 0rem !important;
                    padding-right: 0rem !important;
                    padding-bottom: 0rem !important;
                }

                .margin-horizontal {
                    margin-top: 0rem !important;
                    margin-bottom: 0rem !important;
                }

                .padding-horizontal {
                    padding-top: 0rem !important;
                    padding-bottom: 0rem !important;
                }

                .margin-vertical {
                    margin-right: 0rem !important;
                    margin-left: 0rem !important;
                }

                .padding-vertical {
                    padding-right: 0rem !important;
                    padding-left: 0rem !important;
                }


                .swiper-slide {
                    overflow: hidden;
                    transform: scale(0.92) !important;
                }

                .swiper-slide-active {
                    opacity: 1;
                    z-index: 1;
                    transform: scale(1) !important;
                }

                .swiper-slide-active .egresados_tarjet {
                    opacity: 100%;
                }

                .swiper-slide-active .slider-text {
                    opacity: 1;
                }

                .swiper-pagination-bullet {
                    display: inline-block;
                    width: 7px;
                    height: 7px;
                    background: #F1F1F1;
                    margin: 0 5px;
                    border-radius: 50%;
                }

                .swiper-pagination-bullet.swiper-pagination-bullet-active {
                    background: #88F452;
                }

                .nohorario{
                    display: none;
                }
            </style>
        </div>
        <main class="main-wrapper">