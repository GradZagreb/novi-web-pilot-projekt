<?php
/**
 * @var array $menu
 */
?>

<nav class="c-secondary-menu">
	<div class="c-secondary-menu__inner">
		<ul class="c-secondary-menu__list">
			<?php foreach ( $menu as $item ) : ?>
			<li class="c-secondary-menu__item">
				<a class="c-secondary-menu__item-link u-b3" href="<?php echo esc_url( $item['url'] ); ?>">
					<?php echo esc_html( $item['title'] ); ?>

					<?php if ( ! empty( $item['sub'] ) ) : ?>
					<span class="c-secondary-menu__item-icon">
						<?php echo get_icon( 'chevron-down' ); ?>
					</span>
					<?php endif; ?>
				</a>

				<?php if ( ! empty( $item['sub'] ) ) : ?>
				<ul class="c-secondary-menu__sub-list">
					<?php foreach ( $item['sub'] as $sub_item ) : ?>
					<li class="c-secondary-menu__sub-item">
						<a class="c-secondary-menu__sub-item-link u-b3" href="<?php echo esc_url( $sub_item['url'] ); ?>">
							<?php echo esc_html( $sub_item['title'] ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
		</ul>

		<?php get_partial( 'components/search-trigger' ); ?>
	</div>
</nav>
