<?php
/**
 * @var array $settings
 * @var string $title
 * @var string $image
 * @var string $text
 * @var string $actions
 */
?>

<header class="o-header o-header--light-gray">
	<div class="o-container">
		<div class="c-theme-header-module">
			<div class="c-theme-header-module__content">
				<h1 class="u-a5"><?php echo $title; ?></h1>
				<div class="c-theme-header-module__text u-a1">
					<?php echo $text; ?>
				</div>

				<?php if ( ! empty( $actions ) ) : ?>
				<div class="c-theme-header-module__actions">
					<?php echo $actions; ?>
				</div>
				<?php endif; ?>

			</div>
			<div class="c-theme-header-module__image">
				<?php echo $image; ?>
			</div>
		</div>
	</div>
</header>
