<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $text
 * @var string $link
 * @var string $services
 */
?>

<section class="o-section o-section--dark-blue">
	<div class="o-container">
		<div class="c-featured-services-catalog-module">

			<header class="c-featured-services-catalog-module__header">
				<h2 class="c-featured-services-catalog-module__title u-a4">
					<?php echo $title; ?>
				</h2>

				<div class="c-featured-services-catalog-module__text">
					<p class="u-a3">
						<?php echo $text; ?>
					</p>

					<div class="c-featured-services-catalog-module__link">
						<?php echo $link; ?>
					</div>
				</div>
			</header>

			<div class="c-featured-services-catalog-module__services-list">
				<?php echo $services; ?>
			</div>

		</div>
	</div>
</section>
