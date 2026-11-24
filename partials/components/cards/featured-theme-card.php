<?php
/**
 * @var string $image
 * @var string $title
 * @var aray $link
 */
?>

<div class="c-featured-theme-card">
	<div class="c-featured-theme-card__image">
		<?php echo $image; ?>
	</div>

	<div class="c-featured-theme-card__content">
		<h3 class="u-a1">
			<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
				<?php echo $title; ?>
			</a>
		</h3>

		<?php
		get_partial(
			'components/circle',
			array(
				'icon'    => 'arrow-right',
				'classes' => 'c-circle--small c-circle--blue',
			),
		);
		?>
	</div>
</div>
