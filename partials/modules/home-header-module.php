<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $image
 */
?>

<header class="o-header o-header--light-gray">
	<div class="o-container">
		<div class="c-home-header-module">
			<div class="c-home-header-module__text">
				<h1 class="u-a6"><?php echo $title; ?></h1>

				<?php
				get_partial(
					'components/search-form',
				);
				?>

			</div>

			<div class="c-home-header-module__image">
				<?php echo $image; ?>
			</div>
		</div>
	</div>
</header>
