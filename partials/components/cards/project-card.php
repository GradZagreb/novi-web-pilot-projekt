<?php
/**
 * @var array $offices
 * @var object $status
 * @var string $link
 * @var string $title
 * @var array $themes
 */
?>

<div class="c-project-card">
	<div class="c-project-card__meta">
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

    <div class="c-project-card__content">
        <?php foreach ( $offices as $office ) : ?>
        <p class="u-b0"><?php echo $office->name; ?></p>
        <?php endforeach; ?>

        <h3 class="u-a3">
            <a href="<?php echo esc_url( $link ); ?>">
                <?php echo $title; ?>
            </a>
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
