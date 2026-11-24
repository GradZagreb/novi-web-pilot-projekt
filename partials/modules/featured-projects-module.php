<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $projects
 */
?>

<section class="o-section">
	<div class="o-container">
		<div class="c-featured-projects-module">
			<header>
				<h2 class="u-a3"><?php echo $title; ?></h2>
				<?php if ( ! empty( $link ) && is_array( $link ) ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
				<?php endif; ?>
			</header>
			<div class="c-featured-projects-module__list">
				<?php echo $projects; ?>
			</div>
		</div>
	</div>
</section>
