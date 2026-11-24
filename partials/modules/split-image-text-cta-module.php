<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $text
 * @var string $link
 * @var array $links
 * @var string $image
 */
?>

<section class="o-section <?php echo $settings['highlighted'] ? 'o-section--light-gray' : ''; ?>">
	<div class="o-container">
		<div class="c-split-image-text-cta-module <?php echo $settings['flipped'] ? 'c-split-image-text-cta-module--flipped' : ''; ?>">
			<div class="c-split-image-text-cta-module__content">

				<div class="c-split-image-text-cta-module__text u-b0">
					<h2 class="u-a4 c-split-image-text-cta-module__heading"><?php echo $title; ?></h2>
					<?php echo $text; ?>
				</div>

				<?php if ( ! empty( $links ) && is_array( $links ) ) : ?>
				<ul class="c-split-image-text-cta-module__list u-b0">
					<?php foreach ( $links as $link_item ) : ?>
					<?php if ( ! empty( $link_item['link'] ) && is_array( $link_item['link'] ) ) : ?>
					<li>
						<a href="<?php echo esc_url( $link_item['link']['url'] ); ?>" target="<?php echo esc_attr( $link_item['link']['target'] ); ?>">
							<?php echo esc_html( $link_item['link']['title'] ); ?>
						</a>
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<div class="c-split-image-text-cta-module__actions">
					<?php if ( ! empty( $link ) ) : ?>
						<?php echo $link; ?>
					<?php endif; ?>
				</div>
			</div>

			<div class="c-split-image-text-cta-module__image">
				<?php echo $image; ?>
			</div>
		</div>
	</div>
</section>
