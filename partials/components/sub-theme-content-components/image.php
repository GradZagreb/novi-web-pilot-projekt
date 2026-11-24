<?php
/**
 * @var integer $image
 */
$args = array(
	'image'           => $image,
	'sizes'           => array(
		'widescreen'        => 'image_1440',
		'widescreen_retina' => 'image_1920',
		'desktop'           => 'image_800',
		'desktop_retina'    => 'image_1440',
		'tablet'            => 'image_800',
		'tablet_retina'     => 'image_1440',
		'mobile'            => 'image_480',
		'mobile_retina'     => 'image_800',
	),
	'alt'             => '',
	'aspect_ratio'    => '4-3',
	'object_fit'      => 'cover',
	'object_position' => 'center',
	'is_background'   => false,
	'lazy'            => true,
	'native_lazy'     => false,
	'priority'        => false,
	'animate'         => true,
	'width'           => '',
	'height'          => '',
	'loader_bg'       => '',
	'modifier_class'  => '',
);
?>

<div class="c-sub-theme-content-image">
	<?php echo get_responsive_image( $args ); ?>
</div>
