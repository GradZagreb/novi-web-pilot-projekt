<?php
/** Template Name: Search template */

use gradZagrebWeb2024\lib\core\ACFProvider;

$template_name = 'search';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );
?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

			<header class="o-header">
				<div class="o-container">
					<div class="c-search-header">
						<h1 class="c-search-header__heading u-a5 u-text-center"><?php _e( 'Pretražite stranice Grada Zagreba', TEXT_DOMAIN ); ?></h1>

						<?php
						get_partial(
							'components/search-form',
						);
						?>
					</div>
				</div>
			</header>
			<?php get_modules_partial( ACFProvider::get_instance()->get_field( 'modules' ) ?? array() ); ?>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
