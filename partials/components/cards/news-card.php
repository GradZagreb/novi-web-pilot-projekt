<?php
/**
 * @var string $image
 * @var string $date
 * @var array $offices
 * @var array $themes
 * @var string $title
 * @var array $link
 */
?>

<div class="c-news-card">
	<div class="c-news-card__image">
		<?php echo $image; ?>
	</div>

	<div class="c-news-card__content">
		<div class="c-news-card__meta">
			<?php echo $date; ?>

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
		</div>

		<h3 class="u-a2">
			<a href="<?php echo esc_url( $url ); ?>">
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
