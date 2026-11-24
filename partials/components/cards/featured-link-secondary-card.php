<?php
/**
 * @var string $title
 * @var array $links
 */
?>

<div class="c-featured-link-secondary-card">
	<h3 class="u-a2"><?php echo $title; ?></h3>

	<ul>
	<?php foreach ( $links as $link ) : ?>
		<li>
			<a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?> &gt;</a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
