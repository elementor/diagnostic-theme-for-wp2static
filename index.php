<?php

get_header();

 
$fail_icon = get_template_directory_uri() . '/assets/images/fail-icon.png';

?>

<h1>WP2Static diagnostics and benchmarking</h1>

<table id="results">
    <tr>
        <td colspan="2">
            <b>Setting</b>
        </td>
    </tr>
   <tr>
        <td>
            Site name:
        </td>
        <td>
            <?php echo get_bloginfo( 'name' ); ?>
        </td>
    </tr>
   <tr>
        <td colspan="2">
           <b>Settings on the server used for export</b> 
        </td>
    </tr>
   <tr>
        <td>
            WordPress Home:
        </td>
        <td>
            <?php echo get_bloginfo( 'url' ); ?>
        </td>
    </tr>
   <tr>
        <td>
            WordPress Site URL:
        </td>
        <td>
            <?php echo get_bloginfo( 'wpurl' ); ?>
        </td>
    </tr>
   <tr>
        <td>
            WordPress version:
        </td>
        <td>
            <?php echo get_bloginfo( 'version' ); ?>
        </td>
    </tr>
   <tr>
        <td>
            PHP version:
        </td>
        <td>
                <?php echo phpversion(); ?>
        </td>
    </tr>
   <tr>
        <td>
            Operating System:
        </td>
        <td>
                <?php echo php_uname(); ?>
        </td>
    </tr>
   <tr>
        <td>
            Latest generation:
        </td>
        <td>
            <span id="last_site_generation_duration"></span>
        </td>
    </tr>
</table>

<style>
canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>


<div class="chart-container">
    <canvas id="chart"></canvas>
</div>

<div id="test_content_wrapper">

    <?php
        /* 
            function to write the original URL out in a way
            that it won't be rewritten by the plugin
        */

        function preventRewritingURL( $url ) {
            // surround dots with spaces
            $url = str_replace( '.', ' . ', $url ); 

            // surround slashes with spaces
            $url = str_replace( '/', ' / ', $url ); 

            return $url;
        }
    ?>

    <hr>

    <h3>Test: relative link to relative image</h3>

    <?php 
        // get theme asset path without site URL
        $asset_URL = get_template_directory_uri() . '/assets/images/icon-256x256.jpg';
        $site_URL = get_bloginfo('url');

        $relative_link_to_img = str_replace(
            $site_URL,
            '',
            $asset_URL
        );     

    ?>

    <a href="<?php echo $relative_link_to_img; ?>">
        <img src="<?php echo $relative_link_to_img; ?>" style="height:30px;" />
    </a>

    <p>
        <code>
            Original URL: <?php echo preventRewritingURL( $relative_link_to_img ); ?>
        </code>
    </p>

    <hr>

    <h3>Test: full link to full path image</h3>

    <?php

        $full_link_to_img = get_template_directory_uri() . '/assets/images/icon-256x256.jpg';

    ?>

    <a href="<?php echo $full_link_to_img; ?>">
        <img src="<?php echo $full_link_to_img; ?>" style="height:30px;" />
    </a>

    <p>
        <code>
            Original URL: <?php echo preventRewritingURL( $full_link_to_img ); ?>
        </code>
    </p>

    <hr>

    <h3>Test: URL in custom attribute</h3>

    <div id="div-with-link-in-custom-attr" custom-attr-in-div="<?php echo $full_link_to_img; ?>">
        <img id="img-to-get-src-from-custom-attr" src="<?php echo $fail_icon; ?>" style="height:30px;" />
    </a>

    <p>
        <code>
            Original URL: <?php echo preventRewritingURL( $full_link_to_img ); ?>
        </code>
    </p>

    <hr>

    <?php

        $escaped_full_link_to_img = addcslashes(
            $full_link_to_img,
            '/'
        );
    ?>

    <h3>Test: escaped full link to image URL</h3>

    <a href="<?php echo $escaped_full_link_to_img; ?>">
        <img src="<?php echo $escaped_full_link_to_img; ?>" style="height:30px;" />
    </a>

    <p>
        <code>
            Original URL: <?php echo preventRewritingURL( $escaped_full_link_to_img ); ?>
        </code>
    </p>

    <hr>

    <h3>Test: link and image code block from YooTheme</h3>

<a class="uk-navbar-item uk-logo" href="<?php echo get_bloginfo('url'); ?>">Link to site root should be rewritten</a>
       <div class="tm-page">

           <div class="tm-header-mobile uk-hidden@s">
           

   <nav class="uk-navbar-container" uk-navbar=""><div class="uk-navbar-center">
           <a class="uk-navbar-item uk-logo" href="<?php echo get_bloginfo('url'); ?>">
<img src="<?php echo $full_link_to_img; ?>" alt="Some alt text" style="height:30px;"></a>
        </div>
        
                <div class="uk-navbar-right">

            
                        <a class="uk-navbar-toggle" href="#tm-mobile" uk-toggle="">
                                <div uk-navbar-toggle-icon=""></div>
            </a>
            
            
        </div>
        
    </nav></div></div>

    <hr>

    <h3>Test: full image path in &lt;HEAD&gt; defined CSS</h3>


    <a href="<?php echo get_template_directory_uri() . '/style.css'; ?>" target="_blank">View #inline_css_background_image in CSS</a>

    <a href="<?php echo $full_link_to_img; ?>">
        <img id="inline_css_background_image" style="height:30px;" />
    </a>

    <hr>

    <h3>Test: full image path defined in linked CSS</h3>

    <a href="<?php echo get_template_directory_uri() . '/style.css'; ?>" target="_blank">View #linked_css_background_image in CSS</a>

    <a href="<?php echo $full_link_to_img; ?>">
        <img id="linked_css_background_image" style="height:30px;" />
    </a>

    <hr>

    <h3>Test: relative image path defined in linked CSS</h3>

    <a href="<?php echo get_template_directory_uri() . '/style.css'; ?>" target="_blank">View #relative_linked_css_background_image in CSS</a>

    <a href='<?php echo get_template_directory_uri(); ?>/assets/images/icon-256x256.jpg'>
        <img id="relative_linked_css_background_image" style="height:30px;" />
    </a>

    <p>
        <code>
            Original URL: <?php echo preventRewritingURL( "background: url('assets/images/icon-256x256.jpg');" ); ?>
        </code>
    </p>

    <hr>
</div>



	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
	</header>
	<?php endif; ?>

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;


			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

<?php get_sidebar(); ?>

<?php get_footer();
