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

<div class="c-capital-project-card">
	<div class="c-capital-project-card__image">
		<?php echo $image; ?>
	</div>

	<div class="c-capital-project-card__content">

		<div class="c-capital-project-card__meta">
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

		<h3 class="u-a3">
			<a href="<?php echo esc_url( $link ); ?>">
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
