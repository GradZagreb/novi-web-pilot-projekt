<?php
/**
 * @var array $settings
 * @var array $links
 */
?>

<section class="o-section o-section--blue">
	<div class="o-container">
		<div class="c-pre-footer-links-module">
			<div class="c-pre-footer-links-module__title">
				<h2 class="u-a2">
				<?php _e( 'Moglo bi vam biti korisno:', TEXT_DOMAIN ); ?>
			</div>

			<?php if ( ! empty( $links ) && is_array( $links ) ) : ?>
			<ul class="c-pre-footer-links-module__links">
				<?php foreach ( $links as $item ) : ?>
                <?php if ( ! empty( $item['link'] ) && is_array( $item['link'] ) ) : ?>
				<li>
					<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="c-pre-footer-links-module__link u-b3" target="<?php echo esc_attr( $item['link']['target'] ); ?>">
						<span><?php echo esc_html( $item['link']['title'] ); ?></span>

						<?php if ( $item['link']['target'] === '_blank' ) : ?>

							<?php echo get_icon( 'arrow-top-right' ); ?>

						<?php else : ?>

							<?php echo get_icon( 'arrow-right' ); ?>

						<?php endif; ?>
					</a>
				</li>
                <?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</section>
