<?php

get_header(); ?>

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

<script src="../../../../dist/2.7.3/Chart.bundle.js"></script>
    <script src="../../utils.js"></script>
    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>


<div style="width:75%;">
    <canvas id="canvas"></canvas>
</div>

<script>
        var config = {
            type: 'line',
            data: {
                labels: ['01/12', '02/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12', '03/12'],
                datasets: [{
                    label: 'Seconds to generate static site',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [
                        0.03,
                        0.02,
                        0.12,
                        0.12,
                        0.12,
                        0.12,
                        0.12,
                        0.07,
                        0.08,
                        0.08,
                        0.08,
                        0.08,
                        0.08,
                        0.04,
                        0.01,
                        0.01,
                    ],
                    fill: false,
                }, 
              ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Export durations with each build'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                          reverse: true
                        },
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Export duration'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };
    </script>

<div id="test_content_wrapper">

    <hr>

    <h3>Test: relative link to relative image</h3>

    <a href="/relative_link_to_img.jpg">
        <img src="/relative_link_to_img.jpg" />
    </a>

    <hr>

    <h3>Test: full link to full path image</h3>

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
