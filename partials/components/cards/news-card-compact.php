<?php
/**
 * @var string $title
 * @var array $link
 */
?>

<div class="c-news-card-compact">
	<h3 class="u-b1"><?php echo $title; ?></h3>
	<a class="c-news-card-compact__link u-b3" href="<?php echo $link; ?>">
		<?php _e( 'Pogledajte više', TEXT_DOMAIN ); ?>
	</a>
</div>
