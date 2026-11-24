<?php
/**
 * @var int $id
 * @var string $title
 * @var array $link
 * @var string $date
 * @var array $themes
 */
?>

<div class="c-notification u-b1">
	<span><?php echo $date; ?></span>
	<h3><?php echo $title; ?></h3>
	<a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
</div>
