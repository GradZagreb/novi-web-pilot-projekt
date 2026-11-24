<?php
/**
 * @var array $gallery
 */
?>

<div class="c-gallery-slider-block js-slider">
	<div class="swiper js-slider-swiper" data-pagination-type="fraction">
		<div class="swiper-wrapper">
			<?php echo $gallery; ?>
		</div>

        <div class="c-gallery-slider-block__footer">
            <div class="c-gallery-slider-block__pagination js-slider-pagination"></div>

            <div class="c-gallery-slider-block__navigation js-slider-navigation">
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
