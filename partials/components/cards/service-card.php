<?php
/**
 * @var array $themes
 * @var string $title
 * @var string $description
 * @var string $link
 * @var sring $variant
 */
$variant = ! empty( $variant ) ? $variant : 'light';
?>

<div class="c-service-card c-service-card--<?php echo esc_attr( $variant ); ?>">
	<div class="c-service-card__themes">
		<?php
		foreach ( $themes as $theme ) {
			get_partial(
				'components/tag',
				array(
					'label'   => $theme->name,
					'classes' => 'c-tag--dark-blue',
				)
			);
		}
		?>
	</div>

	<div class="c-service-card__title">
		<h3 class="c-service-card__heading u-b3">
            <a href="<?php echo $link; ?>">
                <?php echo $title; ?>
            </a>
		</h3>
	</div>

	<div class="c-service-card__excerpt">
		<p class="u-b3">
			<?php echo $excerpt; ?>
		</p>
	</div>

	<div class="c-service-card__link">
		<?php
        $classes = $variant === 'light' ? 'c-circle--small c-circle--blue' : 'c-circle--small c-circle--white';

		get_partial(
			'components/circle',
			array(
				'icon'    => 'arrow-right',
				'classes' => $classes,
			),
		);
		?>
	</div>
</div>
