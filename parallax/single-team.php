<?php
/**
 * Template for single team view
 * @package themify
 * @since 1.2.3
 */
?>
<?php get_header(); ?>
<?php
/** Themify Default Variables
 *  @var object */
global $themify;
?>

<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); //hook ?>
	<!-- content -->
	<div id="content" class="list-post">

    	<?php themify_content_start(); //hook ?>
		<?php echo do_shortcode( '[team id='.get_the_ID().' style="list-post" use_original_dimensions="yes"]' ); ?>
		<!-- / .post -->

		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php get_template_part( 'includes/author-box', 'single'); ?>
		
		<?php get_template_part( 'includes/post-nav-team'); ?>
		
        <?php themify_content_end(); //hook ?>

	</div>
	<!-- /content -->

    <?php themify_content_after() //hook; ?>

<?php endwhile; ?>

<?php 
/////////////////////////////////////////////
// Sidebar							
/////////////////////////////////////////////
if ($themify->layout != "sidebar-none"): get_sidebar(); endif; ?>

</div>
<!-- /layout-container -->
	
<?php get_footer(); ?>