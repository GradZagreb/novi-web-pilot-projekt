<?php
/**
 * @var array $offices
 * @var array $themes
 * @var object $status
 * @var string $external_link
 * @var string $title
 */
?>

<div class="c-career-card">
	<div class="c-career-card__content">

		<div class="c-career-card__meta">
			<?php
			foreach ( $status as $stat ) {
				get_partial(
					'components/tag',
					array(
						'label'   => $stat->name,
						'classes' => 'c-tag--light-gray-blue',
					),
				);
			}
			?>
		</div>

		<?php foreach ( $offices as $office ) : ?>
		<p class="u-b0"><?php echo $office->name; ?></p>
		<?php endforeach; ?>

        <h3 class="c-career-card__heading u-a2">
            <a href="<?php echo esc_url( $external_link ); ?>" target="_blank">
                <?php echo $title; ?>
            </a>
        </h3>

		<?php
		get_partial(
			'components/circle',
			array(
				'icon'    => 'arrow-top-right',
				'classes' => 'c-circle--small c-circle--blue',
			),
		);
		?>
	</div>
</div>
