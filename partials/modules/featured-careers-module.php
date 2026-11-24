<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $careers
 */
?>

<section class="o-section <?php echo $settings['highlighted'] ? 'o-section--light-gray' : ''; ?>">
	<div class="o-container">
		<div class="c-featured-careers-module">
			<header>
				<h2 class="u-a4"><?php echo $title; ?></h2>
                <?php if ( ! empty( $link ) && is_array( $link ) ) : ?>
                <a href="<?php echo esc_url( $link['url'] ); ?>" class="u-b1" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
                <?php endif; ?>
			</header>

			<div class="c-featured-careers-module__list">
				<?php echo $careers; ?>
			</div>
		</div>
	</div>
</section>
