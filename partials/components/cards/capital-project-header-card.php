<?php
/**
 * @var string $image
 * @var array $offices
 * @var array $themes
 * @var array #status
 * @var string $title
 * @var array $link
 */
?>

<div class="c-capital-project-header-card">
	<div class='c-capital-project-header-card__image'>
		<?php
		echo $image;
		get_partial(
			'components/media-overlay',
			array(
				'opacity'        => 1,
				'modifier_class' => 'c-media-overlay--dark-gradient',
			)
		);
		?>
	</div>

	<div class="c-capital-project-header-card__content">
		<div class="c-capital-project-header-card__meta">
			<?php
			foreach ( $themes as $theme ) {
				get_partial(
					'components/tag',
					array(
						'label'   => $theme->name,
						'classes' => 'c-tag--dark-blue',
					),
				);
			}
			?>

			<?php
			foreach ( $status as $stat ) {
				get_partial(
					'components/tag',
					array(
						'label'   => $stat->name,
						'classes' => 'c-tag--light-gray',
					),
				);
			}
			?>
		</div>

		<?php foreach ( $offices as $office ) : ?>
		<p class="u-b0"><?php echo $office->name; ?></p>
		<?php endforeach; ?>

		<h3 class="c-capital-project-header-card__heading u-a3">
			<a href="<?php echo $link; ?>">
				<?php echo $title; ?>
			</a>
		</h3>

	</div>

</div>
