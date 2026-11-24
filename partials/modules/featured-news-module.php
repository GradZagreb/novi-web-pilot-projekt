<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $news
 */
?>

<section class="o-section <?php echo $settings['highlighted'] ? 'o-section--light-gray' : ''; ?>">
	<div class="o-container">
		<div class="c-featured-news-module">
			<header>
				<h2 class="u-a4"><?php echo $title; ?></h2>
				<?php if ( ! empty( $link ) && is_array( $link ) ) : ?>
				<a class="u-b1" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
				<?php endif; ?>
			</header>

			<div class="c-featured-news-module__list">
				<?php echo $news; ?>
			</div>
		</div>
	</div>
</section>
