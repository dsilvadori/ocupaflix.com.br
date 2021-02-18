<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fastvideo
 */


?>

<aside id="secondary" class="widget-area site-column sidebar">
	<?php if ( !is_user_logged_in() ) { ?>
		<div class="promo">
			<a target="_blank" href="https://www.freshthemes.com/themes/fastvideo">Upgrade to PRO version</a>
		</div>
	<?php } ?>
		
	<?php if ( ! is_active_sidebar( 'sidebar-1' ) ) { ?>
		<div class="widget sidebar-notice">
			<p><?php echo __('There is no content here', 'fastvideo'); ?></p>
			<p><?php echo __('Please put some widgets to the <strong>Sidebar</strong>', 'fastvideo'); ?></p>
			<div class="btn">
				<a href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now', 'fastvideo'); ?></a>
			</div>
		</div>
	<?php } ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
