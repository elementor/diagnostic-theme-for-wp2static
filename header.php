<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

    <style>
        #inline_css_background_image {
            background: url("<?php echo get_template_directory_uri() . '/assets/images/icon-256x256.jpg'; ?>");
            background-size: 'contain';
            background-size: contain;
            background-repeat: no-repeat;
            display: block;
        }
    </style>
</head>

<body <?php body_class(); ?>>
