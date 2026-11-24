<?php
/**
 * @var array $offices
 * @var object $status
 * @var string $year
 * @var string $exteral_link
 * @var string $title
 * @var array $themes
 * @var string $back
 */
?>

<header class="o-header">
	<div class="o-container o-container--thin">
		<div class="c-project-single-header">
			<a class="c-project-single-header__back-link u-b3" href="<?php echo $back; ?>">
				<?php
				echo get_icon( 'chevron-left' );
				_e( 'Svi projekti' );
				?>
			</a>

			<div class="c-project-single-header__meta">
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

			<h1 class="c-project-single-header__heading u-a5"><?php echo $title; ?></h1>

			<div class="c-project-single-header__extra">
				<p class="u-b3">
						<?php
						?>
						<?php
						?>
					<?php if ( ! empty( $year ) ) : ?>
					<span>
						<?php
						_e( 'Godina:', TEXT_DOMAIN );
						echo ' ' . $year;
						?>
					</span>
					<?php endif; ?>

					<?php if ( ! empty( $external_link ) ) : ?>
					<span>
						<a href="<?php echo $external_link; ?>" target="_blank">
							<?php
							_e( 'Vanjska poveznica na projekt', TEXT_DOMAIN );
							?>
						</a>
					</span>
					<?php endif; ?>
				</p>
			</div>

			<?php if ( ! empty( $image ) ) : ?>
			<div class="c-project-single-header__image">
				<?php
				$args = array(
					'image'           => $image,
					'sizes'           => array(
						'widescreen'        => 'image_1440',
						'widescreen_retina' => 'image_1920',
						'desktop'           => 'image_800',
						'desktop_retina'    => 'image_1440',
						'tablet'            => 'image_800',
						'tablet_retina'     => 'image_1440',
						'mobile'            => 'image_480',
						'mobile_retina'     => 'image_800',
					),
					'alt'             => '',
					'aspect_ratio'    => '5-3',
					'object_fit'      => 'cover',
					'object_position' => 'center',
					'is_background'   => false,
					'lazy'            => false,
					'native_lazy'     => false,
					'priority'        => true,
					'animate'         => false,
					'width'           => '',
					'height'          => '',
					'loader_bg'       => '',
					'modifier_class'  => '',
				);

				echo get_responsive_image( $args );
				?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</header>

<section class="o-section">
	<div class="o-container o-container--thin">
		<div class="c-project-single-content rte">
			<?php echo $content; ?>
		</div>
	</div>
</section>
