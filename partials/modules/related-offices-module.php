<?php
/**
 * @var array $settings
 * @var string $title
 * @var array $offices
 */
?>

<section class="o-section o-section--light-gray">
	<div class="o-container">
		<div class="c-related-offices-module">
			<header class="c-related-offices-module__header">
				<h2 class="u-a4"><?php echo $title; ?></h2>
			</header>
			<div class="c-related-offices-module__slider">
				<div class="js-slider">
                    <div class="swiper js-slider-swiper"
                        data-slides-per-view="3"
                        data-slides-per-view-tablet="2"
                        datta-slides-per-view-mobile="1"
                        data-space-between="30"
                        data-space-between-tablet="30"
                        data-space-between-mobile="30"
                        data-navigation="true"
                        data-slides-per-group="1"
                        data-slides-per-group-tablet="1"
                        data-slides-per-group-mobile="1"
                    >
						<div class="swiper-wrapper">
							<?php foreach ( $offices as $office ) : ?>
							<div class="swiper-slide js-slider-single">
								<?php
								get_partial( 'components/cards/office-card', $office );
								?>
							</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="c-related-offices-module__navigation js-slider-navigation">
						<?php
						get_partial(
							'components/button',
							array(
								'type'    => 'button',
								'title'   => '',
								'url'     => '#',
								'classes' => 'c-button--white-square-icon js-slider-prev',
								'dataset' => '',
								'icon'    => get_partial(
									'components/circle',
									array(
										'icon'    => 'arrow-left',
										'classes' => 'c-circle--small c-circle--blue',
									),
									true
								),
							)
						);

						get_partial(
							'components/button',
							array(
								'type'    => 'button',
								'title'   => '',
								'url'     => '#',
								'classes' => 'c-button--white-square-icon js-slider-next',
								'dataset' => '',
								'icon'    => get_partial(
									'components/circle',
									array(
										'icon'    => 'arrow-right',
										'classes' => 'c-circle--small c-circle--blue',
									),
									true
								),
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
