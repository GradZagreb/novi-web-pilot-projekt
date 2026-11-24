<?php
/**
 * @var string $date
 * @var string $title
 * @var string $external_link
 * @var array $categories
 */
?>

<div class="c-tender-card">
	<div class="c-tender-card__meta">
		<?php echo $date; ?>

		<?php
		foreach ( $categories as $category ) {
			get_partial(
				'components/tag',
				array(
					'label'   => $category->name,
					'classes' => 'c-tag--dark-blue',
				),
			);
		}
		?>
	</div>

	<div class="c-tender-card__content">
		<h3 class="u-a2">
			<?php if ( ! empty( $external_link ) ) : ?>
			<a href="<?php echo esc_url( $external_link ); ?>" target="_blank">
				<?php endif; ?>

				<?php echo $title; ?>

				<?php if ( ! empty( $external_link ) ) : ?>
			</a>
			<?php endif; ?>
		</h3>
	</div>

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
