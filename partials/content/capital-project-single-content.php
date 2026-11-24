<?php
/**
 * @var srtring $image
 * @var string $title
 * @var string $year
 * @var string $date_start
 * @var string $date_end
 * @var string $value
 * @var array $offices
 * @var array $themes
 * @var array $status
 * @var string $content
 */
?>

<header class="o-header">
	<div class="o-container o-container--thin">
		<div class="c-capital-project-single-header">
			<a class="c-capital-project-single-header__back-link u-b3" href="<?php echo $back; ?>">
				<?php
				echo get_icon( 'chevron-left' );
				_e( 'Svi kapitalni projekti' );
				?>
			</a>

			<div class="c-capital-project-single-header__meta">
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

			<h1 class="c-capital-project-single-header__heading u-a5"><?php echo $title; ?></h1>

			<div class="c-capital-project-single-header__extra">
				<p class="u-b3">
					<span>
						<?php
						_e( 'Početak projekta:', TEXT_DOMAIN );
						echo ' ' . $date_start;
						?>
					</span>
					<span>
						<?php
						_e( 'Predviđeni kraj projekta:', TEXT_DOMAIN );
						echo ' ' . $date_end;
						?>
					</span>
					<span>
						<?php
						_e( 'Vrijednost projekta:', TEXT_DOMAIN );
						echo ' ' . $value;
						?>
					</span>
				</p>
			</div>

			<?php if ( ! empty( $image ) ) : ?>
			<div class="c-capital-project-single-header__image">
				<?php echo $image; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</header>

<section class="o-section">
	<div class="o-container o-container--thin">
		<div class="c-capital-project-single-content rte">
			<?php echo $content; ?>
		</div>
	</div>
</section>
