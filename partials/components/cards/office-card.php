<?php
/**
 * @var array $settings
 * @var string $title
 * @var sring $image
 * @var string $link
 */
?>

<div class="c-office-card">
	<div class="c-office-card__content">
		<h3 class="u-a2"><?php echo $title; ?></h3>

		<a href="<?php echo $link; ?>" class="u-b0">
			<?php _e( 'Pogledajte više', TEXT_DOMAIN ); ?>
		</a>
	</div>
</div>
