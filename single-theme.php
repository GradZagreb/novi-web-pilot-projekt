<?php
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\helpers\BreadcrumbsHelper;

global $post;

$breadcrumbs_helper = new BreadcrumbsHelper( $post );

$template_name = 'single-theme';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<?php echo $breadcrumbs_helper->get_theme_breadcrumbs(); ?>
			<?php get_modules_partial( ACFProvider::get_instance()->get_field( 'modules' ) ?? array() ); ?>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
