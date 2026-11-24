<?php
/**
 * @var string $date
 * @var array $themes
 * @var string $title
 * @var string $back
 * @var string $content
 */
?>

<header class="o-header">
	<div class="o-container o-container--thin">
		<div class="c-news-single-header">
			<a class="c-news-single-header__back-link u-b3" href="<?php echo $back; ?>">
				<?php
				echo get_icon( 'chevron-left' );
				_e( 'Sve novosti', TEXT_DOMAIN );
				?>
			</a>

			<div class="c-news-single-header__meta">
				<?php
				get_partial(
					'components/tag',
					array(
						'label'   => $date,
						'classes' => 'c-tag--light-gray',
					)
				);

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

			<h1 class="c-news-single-header__heading u-a5"><?php echo $title; ?></h1>
		</div>
	</div>
</header>

<section class="o-section">
	<div class="o-container o-container--thin">
		<div class="c-news-single-content rte">
			<?php echo $content; ?>
		</div>
	</div>
</section>
