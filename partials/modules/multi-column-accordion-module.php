<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $items
 */
$columns = 2;
if ( ! is_array( $items ) || empty( $items ) ) {
	$split_accordions = array();
} else {
	$split_accordions = array_chunk( $items, ceil( count( $items ) / $columns ) );
}
?>

<section class="o-section o-section--dark-blue">
	<div class="o-container">
		<div class="c-multi-column-accordion-module">
			<div class="c-multi-column-accordion-module__title">
				<h2 class="u-a4"><?php echo $title; ?></h2>
			</div>

			<div class="c-multi-column-accordion-module__accordions">

				<?php foreach ( $split_accordions as $accordion ) : if ( ! is_array( $accordion ) ) { continue; } ?>
				<div class="c-multi-column-accordion-module__accordion js-accordion">

					<?php foreach ( $accordion as $item ) : ?>
					<div class="c-multi-column-accordion-module__accordion-single js-accordion-single">
						<div class="c-multi-column-accordion-module__accordion-header js-accordion-header">
							<h3 class="u-a1">
								<?php echo $item['title']; ?>
							</h3>
							<?php echo get_icon( 'chevron-down' ); ?>
						</div>

						<div class="c-multi-column-accordion-module__accordion-panel js-accordion-panel">
							<ul class="u-b1">
								<?php if ( ! empty( $item['links'] ) && is_array( $item['links'] ) ) : foreach ( $item['links'] as $link ) : ?>
								<li>
									<?php if ( ! empty( $link['link'] ) ) : ?>
									<a href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>">
										<?php echo $link['link']['title']; ?>
										<?php
										if ( $link['link']['target'] === '_blank' ) {
											echo get_icon( 'arrow-top-right' );
										} else {
											echo get_icon( 'arrow-right' );
										}
										?>
									</a>
									<?php endif; ?>
								</li>
								<?php endforeach; endif; ?>
							</ul>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
</section>
