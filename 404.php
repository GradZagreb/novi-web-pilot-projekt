<?php
use gradZagrebWeb2024\lib\core\ACFProvider;

$template_name = 'error';
get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--light-gray o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">
			<section class="o-section">
				<div class="o-container">
					<div class="c-404 u-text-center">

						<h1 class="u-a5"><?php _e( '404 – Stranica nije pronađena', TEXT_DOMAIN ); ?></h1>
						<p><?php _e( 'Možda ste kliknuli na staru poveznicu ili unijeli pogrešan URL. Ne brinite, imamo još puno korisnih informacija na našoj početnoj stranici.', TEXT_DOMAIN ); ?></p>
						<?php
						get_partial(
							'components/button',
							array(
								'type'    => 'link',
								'title'   => __('Povratak na početnu stranicu', TEXT_DOMAIN ),
								'url'     => home_url( '/' ),
								'classes' => 'c-button--primary',
								'dataset' => '',
								'icon'    => '',
							)
						);
						?>

					</div>
				</div>
			</section>

			<?php
			get_partial(
				'modules/pre-footer-links-module',
				array(
					'links' => ACFProvider::get_instance()->get_option_field( 'pre-footer-links' ),
				)
			);
			?>
		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
