<?php
use gradZagrebWeb2024\lib\core\ACFProvider;

use gradZagrebWeb2024\repositories\ProjectRepository;

global $post;

$repository = new ProjectRepository();
$project    = $repository->get_model( $post );
$provider   = ACFProvider::get_instance();
$modules    = $provider->get_field( 'modules' );
$back       = $provider->get_option_field( 'page_-_project-archive' );

$template_name = 'single-project';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<?php
			get_partial(
				'content/project-single-content',
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
