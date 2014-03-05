<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template Gallery
 * 
 * Access original fields: $mod_settings
 * @author Themify
 */

$fields_default = array(
	'mod_title_gallery' => '',
	'shortcode_gallery' => '',
	'thumb_w_gallery' => '',
	'thumb_h_gallery' => '',
	'appearance_gallery' => '',
	'css_gallery' => '',
	'gallery_images' => array(),
	'link_opt' => '',
	'rands' => ''
);

if ( isset( $mod_settings['appearance_gallery'] ) ) 
	$mod_settings['appearance_gallery'] = $this->get_checkbox_data( $mod_settings['appearance_gallery'] );

if ( isset( $mod_settings['thumb_w_gallery'] ) && ! empty( $mod_settings['thumb_w_gallery']) ) 
	$mod_settings['thumb_w_gallery'] = $mod_settings['thumb_w_gallery'] . 'px';

if ( isset( $mod_settings['thumb_h_gallery'] ) && ! empty( $mod_settings['thumb_h_gallery']) ) 
	$mod_settings['thumb_h_gallery'] = $mod_settings['thumb_h_gallery'] . 'px';

if ( isset( $mod_settings['shortcode_gallery'] ) ) {
	$mod_settings['gallery_images'] = $this->get_images_from_gallery_shortcode( $mod_settings['shortcode_gallery'] );
	$mod_settings['link_opt'] = $this->get_gallery_param_option( $mod_settings['shortcode_gallery'] );
}

$fields_args = wp_parse_args( $mod_settings, $fields_default );
extract( $fields_args, EXTR_SKIP );

$columns = ( $shortcode_gallery != '' ) ? $this->get_gallery_param_option( $shortcode_gallery, 'columns' ) : '';
$columns = ( $columns == '' ) ? 3 : $columns;
$class = $css_gallery . ' ' . $appearance_gallery . ' gallery gallery-columns-' . $columns . ' module-' . $mod_name;
$columns = intval( $columns );
?>
<!-- module gallery -->
<div id="<?php echo $module_ID; ?>" class="module <?php echo esc_attr( $class ); ?>">

	<?php if ( $mod_title_gallery != '' ): ?>
	<h3 class="module-title"><?php echo $mod_title_gallery; ?></h3>
	<?php endif; ?>

	<?php
	$i = 0;
	foreach ( $gallery_images as $image ):
	?>
		<dl class="gallery-item">
			<dt class="gallery-icon">
				<?php
				if ( $link_opt == 'file' ) {
					$link = wp_get_attachment_url( $image->ID );
				} else{
					$link = get_attachment_link( $image->ID );
				}
				$img_preset = 'thumbnail';
				?>
				<a title="<?php echo $image->post_title; ?>" href="<?php echo $link; ?>">
					<?php
						echo wp_get_attachment_image( $image->ID, $img_preset );
					?>
				</a>
			</dt>

			<?php if ( $image->post_excerpt ): ?>
			<dd class="wp-caption-text gallery-caption">
				<?php echo $image->post_excerpt; ?>
			</dd>
			<?php endif; ?>

		</dl>

		<?php if ( $columns > 0 && ++$i % $columns == 0 ): ?>
		<br style="clear: both" />
		<?php endif; ?>

	<?php endforeach; // end loop ?>
	<br style="clear: both" />
	<?php if ( $thumb_w_gallery != '' || $thumb_h_gallery != '' ): ?>
	<style type="text/css">
		#<?php echo $module_ID; ?> img {
			width: <?php echo $thumb_w_gallery; ?>;
			height: <?php echo $thumb_h_gallery; ?>;
		}
	</style>
	<?php endif; ?>
</div>
<!-- /module gallery -->