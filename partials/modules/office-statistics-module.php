<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $groups
 */
?>

<section class="o-section">
	<div class="o-container">
		<div class="c-office-statistics-module">
			<header>
				<h2 class="u-a4"><?php echo $title; ?></h2>
				<?php if ( ! empty( $link ) ) : ?>
				<a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
				<?php endif; ?>
			</header>
			<div class="c-office-statistics-module__list">
				<?php echo $groups; ?>
			</div>
		</div>
	</div>
</section>
