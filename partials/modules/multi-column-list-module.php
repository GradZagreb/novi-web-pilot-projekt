<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $items
 */
?>

<section class="o-section o-section--dark-blue">
	<div class="o-container">
		<div class="c-multi-column-list-module">
			<div class="c-multi-column-list-module__title">
				<h2 class="u-a4"><?php echo $title; ?></h2>
			</div>

			<ul class="c-multi-column-list-module__list">
				<?php if ( ! empty( $items ) && is_array( $items ) ) : foreach ( $items as $item ) : ?>
				<li>
					<?php if ( ! empty( $item['is_link'] ) && ! empty( $item['link'] ) && is_array( $item['link'] ) ) : ?>
					<a href="<?php echo esc_url( $item['link']['url'] ); ?>" target="<?php echo esc_attr( $item['link']['target'] ); ?>">
						<?php echo esc_html( $item['link']['title'] ); ?>
						<?php
						if ( $item['link']['target'] === '_blank' ) {
							echo get_icon( 'arrow-top-right' );
						} else {
							echo get_icon( 'arrow-right' );
						}
						?>
					</a>
					<?php else : ?>
					<span>
						<?php echo $item['title']; ?>
					</span>
					<?php endif; ?>
				</li>
				<?php endforeach; endif; ?>
			</ul>
		</div>
	</div>
</section>
