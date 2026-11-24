<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $content
 */
?>

<section class="o-section">
	<div class="o-container">
		<div class="c-sub-theme-content-module">
			<h1 class="c-sub-theme-content__heading u-a3">
				<?php echo esc_html( $title ); ?>
			</h1>

			<div class="c-sub-theme-content-module__content">
				<?php
				if ( ! empty( $content ) && is_array( $content ) ) {
					foreach ( $content as $component ) {
						if ( ! empty( $component['acf_fc_layout'] ) && locate_template( 'partials/components/sub-theme-content-components/' . $component['acf_fc_layout'] . '.php' ) ) {
							get_partial( 'components/sub-theme-content-components/' . $component['acf_fc_layout'], $component );
						}
					}
				}
				?>
			</div>
		</div>
	</div>
</section>
