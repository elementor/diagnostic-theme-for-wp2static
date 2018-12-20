<?php

get_header();

 
$fail_icon = get_template_directory_uri() . '/assets/images/fail-icon.png';

?>



<h1>WP2Static diagnostics results</h1>
<?php
/*
        WsLog::l( 'STARTING EXPORT: OS VERSION ' . php_uname() );
        WsLog::l( 'STARTING EXPORT: WP URL ' . get_bloginfo( 'url' ) );
        WsLog::l( 'STARTING EXPORT: WP SITEURL ' . get_option( 'siteurl' ) );
        WsLog::l( 'STARTING EXPORT: PLUGIN VERSION ' . $this::VERSION );
*/
?>
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
        <td>
            Site description:
        </td>
        <td>
            <?php echo get_bloginfo( 'description' ); ?>
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
                <?php echo phpversion(); ?>
        </td>
    </tr>
   <tr>
        <td>
            Time to generate static site:
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

    <h3>Test: escaped URL</h3>

    <a href="/full_link_to_img.jpg">
        <img src="/full_link_to_img.jpg" />
    </a>

</div>



<div class="wrap">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
	</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;


			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
