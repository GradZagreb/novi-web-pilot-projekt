<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $link
 * @var string $projects
 */
?>

<section class="o-section o-section--light-gray">
	<div class="o-container">
		<div class="c-featured-capital-projects-module">
			<header>
				<h2 class="u-a4"><?php echo $title; ?></h2>
				<?php
				if ( ! empty( $link ) ) {
					echo $link;
				}
				?>
			</header>
			<div class="c-featured-capital-projects-module__list">
				<?php echo $projects; ?>
			</div>
		</div>
	</div>
</section>
