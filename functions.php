<?php
/*
    Enable testing full paths in style.css by
    rewriting placeholder with site's URL
*/
function rewrite_URLs_in_CSS() {
    $css_file = get_template_directory() . '/style.css';

    $css_contents = file_get_contents( $css_file );

    $rewritten_CSS = str_replace(
        'FULL_PATH_TO_THEME_DIR',
        get_template_directory_uri(),
        $css_contents
    );

    file_put_contents( $css_file, $rewritten_CSS );
}

rewrite_URLs_in_CSS();



function wp2static_diagnostics_script_loader() {
    wp_enqueue_style(
        'wp2static-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_script(
        'wp2static-diagnostics',
        get_template_directory_uri() . '/js/run_diagnostics.js',
        array( 'jquery' ),
        false, // will append current WP version
        false
    );

    wp_enqueue_script(
        'wp2static-chart-bundle',
        // https://www.chartjs.org/samples/latest/charts/line/basic.html
        get_template_directory_uri() . '/js/Chart.bundle.js',
        array (),
        false, // will append current WP version
        false
    );

    wp_enqueue_script(
        'wp2static-chart-utils',
        // https://www.chartjs.org/samples/latest/charts/line/basic.html
        get_template_directory_uri() . '/js/utils.js',
        array (),
        false, // will append current WP version
        false
    );

    $uploads_info = wp_upload_dir();

    $server_vars = array(
        'wp_uploads_URL' => $uploads_info['baseurl'],
        'wp_URL' => get_bloginfo('url'),
    );

    wp_localize_script(
        'wp2static-diagnostics',
        'server_vars',
        $server_vars
    );
}

add_action( 'wp_enqueue_scripts', 'wp2static_diagnostics_script_loader' );
