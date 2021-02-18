<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fastvideo
 */

?>

	<?php if ( is_page() || is_404() ) { ?>
		</div><!-- .inner-wrap -->
	<?php } ?>

	</div><!-- #content .site-content -->

	<footer id="colophon" class="site-footer clear">

		<?php if ( ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) && get_theme_mod('footer-widgets-on', true) ) { ?>

			<div class="footer-columns clear">

				<div class="inner-wrap clear">

					<div class="footer-column footer-column-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>

					<div class="footer-column footer-column-2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>

					<div class="footer-column footer-column-3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>

					<div class="footer-column footer-column-4">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>												

				</div><!-- .container -->

			</div><!-- .footer-columns -->

		<?php } ?>

		<div id="site-bottom">

			<div class="inner-wrap clear">

				<div class="site-info">

					<?php
						$theme_uri = 'https://www.freshthemes.com/themes/fastvideo';
						$author_uri = 'https://www.freshthemes.com/themes/fastvideo';
					?>

					<?php echo date("o"); ?> - OcupaFlix - Streaming da Quebrada

				</div><!-- .site-info -->

				<div class="footer-nav">
					<?php 
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-nav' ) );
						}
					?>		
				</div><!-- .footer-nav -->

			</div><!-- .container -->	

		</div>
		<!-- #site-bottom -->
							
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
