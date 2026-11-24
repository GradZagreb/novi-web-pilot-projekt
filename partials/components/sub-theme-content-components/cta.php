<?php
/**
 * @var string $title
 * @var string $subtitle
 * @var array $link
 */
?>

<div class="c-sub-theme-content-cta">
	<h2 class="u-a2"><?php echo $title; ?></h2>
	<p class="u-b0"><?php echo $subtitle; ?></p>
	<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo $link['target']; ?>">
		<?php echo $link['title']; ?>
	</a>
</div>
