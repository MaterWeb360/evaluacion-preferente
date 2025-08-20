<?php

/**
 * Lista de enqueue scripts, actions y hooks FRONT
 **/
function tema_enqueue_scripts()
{
    wp_enqueue_style(
        'normalize',
        TEMA_CSS . '/normalize.css',
        [],
        '',
        'all'
    );

    wp_enqueue_style(
        'webflow',
        TEMA_CSS . '/webflow.css',
        [],
        '',
        'all'
    );

    wp_enqueue_style(
        'theme',
        TEMA_CSS . '/theme.css',
        [],
        '',
        'all'
    );

    wp_enqueue_script(
        'tema-scripts',
        TEMA_JS . '/webflow.js',
        ['jquery'],
        '1.0',
        true
    );


    add_filter('style_loader_tag', __NAMESPACE__ . '\enqueue_crossorigin_integrity', 10, 2);
    add_filter('script_loader_tag', __NAMESPACE__ . '\enqueue_crossorigin_integrity', 10, 2);
}
add_action('wp_enqueue_scripts', 'tema_enqueue_scripts');

/**
 * crossorigin and integrity
 **/
function enqueue_crossorigin_integrity($html, $handle): string
{
    switch ($handle) {
        case 'jquery-cloudfront':
            $html = str_replace('></script>', ' integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>', $html);
            break;
        case 'google-fonts':
            $html = str_replace('>', ' rel="preconnect">', $html);
            break;
        case 'google-fonts-static':
            $html = str_replace('>', ' rel="preconnect" crossorigin>', $html);
            break;
        case 'google-fonts-fontstyle':
            $html = str_replace('>', ' rel="stylesheet">', $html);
            break;
    }
    return $html;
}

function get_youtube_embed_code($url)
{
    $patterns = array(
        '/[?&]v=([a-zA-Z0-9_-]+)/', // Formato largo "https://www.youtube.com/watch?v=VIDEO_ID"
        '/youtu.be\/([a-zA-Z0-9_-]+)/', // Formato corto "https://youtu.be/VIDEO_ID"
        '/[?&]v=([a-zA-Z0-9_-]+)[&]?ab_channel=([a-zA-Z0-9_-]+)/' // Formato largo con "ab_channel"
    );

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            $video_id = $matches[1];
            if (!empty($video_id)) {
                $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                $youtube = '<iframe width="560" height="315" src="' . $embed_url . '" frameborder="0" allowfullscreen></iframe>';
                return $youtube;
            }
        }
    }

    return 'URL de YouTube no válida o no se pudo encontrar el ID del video.';
}
