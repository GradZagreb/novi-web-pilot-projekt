<?php
use gradZagrebWeb2024\lib\core\ACFProvider;

use gradZagrebWeb2024\repositories\CapitalProjectRepository;

global $post;

$repository = new CapitalProjectRepository();
$project    = $repository->get_model( $post );
$provider   = ACFProvider::get_instance();
$modules    = $provider->get_field( 'modules' );
$back       = $provider->get_option_field( 'page_-_capital-project-archive' );

$project['image'] = get_responsive_image(
	array(
		'image'           => $project['image'],
		'sizes'           => array(
			'widescreen'        => 'image_1920',
			'widescreen_retina' => 'image_2880',
			'desktop'           => 'image_1200',
			'desktop_retina'    => 'image_1440',
			'tablet'            => 'image_800',
			'tablet_retina'     => 'image_900',
			'mobile'            => 'image_600',
			'mobile_retina'     => 'image_700',
		),
		'alt'             => 'Image',
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
	)
);

$template_name = 'single-capital-project';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<?php
			get_partial(
				'content/capital-project-single-content',
				array(
					...$project,
					'back' => $back,
				)
			);
			?>

			<?php get_modules_partial( $modules ?? array() ); ?>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
