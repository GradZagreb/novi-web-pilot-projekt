<?php
/**
 * @var string $icon
 * @var string $title
 * @var array $link
 */
?>

<div class="c-featured-link-primary-card">
	<?php if ( ! empty( $icon ) ) : ?>
	<div class="c-featured-link-primary-card__icon">
		<img src="<?php echo $icon; ?>" alt="<?php echo $title; ?>">
	</div>
	<?php endif; ?>
	<div class="c-featured-link-primary-card__content">
		<h3><?php echo $title; ?></h3>
		<?php
		if ( ! empty( $link['url'] ) ) {
			get_partial(
				'components/button',
				array(
					'type'    => 'link',
					'title'   => '',
					'url'     => $link['url'],
					'classes' => 'c-button--square-icon',
					'dataset' => '',
					'icon'    => get_partial(
						'components/circle',
						array(
							'icon'    => 'arrow-right',
							'classes' => 'c-circle--small c-circle--white',
						),
						true
					),
				)
			);
		}
		?>
	</div>
</div>
