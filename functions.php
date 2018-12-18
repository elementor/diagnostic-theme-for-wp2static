<?php

function wp2static_diagnostics_script_loader() {
    wp_enqueue_script(
        'wp2static-diagnostics',
        get_template_directory_uri() . '/js/run_diagnostics.js',
        array (),
        false, // will append current WP version
        false
    );
}

add_action( 'wp_enqueue_scripts', 'wp2static_diagnostics_script_loader' );
