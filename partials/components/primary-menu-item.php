<?php
/**
 * @var array $item
 */
use gradZagrebWeb2024\lib\core\ACFProvider;

$acf_provider = ACFProvider::get_instance();

$has_icon     = ! empty( $item['icon'] );
$has_url      = ! empty( $item['url'] ) && $item['url'] !== '#';
$has_subitems = ! empty( $item['sub'] );
$columns      = $item['columns'] ?? 1;
?>

<li class="c-primary-menu__item <?php echo esc_attr( $has_icon ? 'c-primary-menu__item--has-icon' : '' ); ?> <?php echo esc_attr( $has_url ? 'c-primary-menu__item--has-url' : '' ); ?> <?php echo esc_attr( $has_subitems ? 'c-primary-menu__item--has-subitems' : '' ); ?> <?php echo esc_attr( 'c-primary-menu__item--columns-' . $columns ); ?>">

	<?php if ( $has_url ) : ?>
	<a href="<?php echo esc_url( $item['url'] ); ?>" class="c-primary-menu__link">
	<?php else : ?>
	<span class="c-primary-menu__link">
	<?php endif; ?>

		<?php if ( ! empty( $item['icon'] ) ) : ?>
			<span class="c-primary-menu__icon">
				<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="c-primary-menu__icon-image" />
			</span>
		<?php endif; ?>

		<span class="c-primary-menu__label u-b3"><?php echo esc_html( $item['title'] ); ?></span>

	<?php if ( $has_url ) : ?>
	</a>
	<?php else : ?>
	</span>
	<?php endif; ?>

	<?php if ( $has_subitems ) : ?>
	<ul class="c-primary-menu__sublist">
		<?php foreach ( $item['sub'] as $subitem ) : ?>
		<li class="c-primary-menu__subitem">
			<a href="<?php echo esc_url( $subitem['url'] ); ?>" class="c-primary-menu__sublink u-b4">
				<?php echo esc_html( $subitem['title'] ); ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

</li>
