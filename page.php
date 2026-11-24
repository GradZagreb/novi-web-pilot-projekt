<?php
use gradZagrebWeb2024\lib\core\ACFProvider;

global $post;

$provider = ACFProvider::get_instance();
$modules  = $provider->get_field( 'modules' );

$template_name = 'page';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<?php
			get_partial(
				'content/page-single-content',
				array(
					'title'   => get_the_title(),
					'content' => bf_content(),
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
