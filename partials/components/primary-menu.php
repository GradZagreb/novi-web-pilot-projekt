<?php
/**
 * @var array $menu
 */
use gradZagrebWeb2024\lib\core\ACFProvider;

$acf_provider              = ACFProvider::get_instance();
$topbar_cta                = $acf_provider->get_option_field( 'navigation_-_topbar_cta' );
$primary_menu_button_group = $acf_provider->get_option_field( 'navigation_-_primary_menu_button_group' );
?>

<nav class="c-primary-menu js-primary-menu">
	<ul class="c-primary-menu__mobile-actions">
		<li>
			<?php get_partial( 'components/language-switcher' ); ?>
		</li>
		<li>
			<?php
			if ( ! empty( $topbar_cta ) && is_array( $topbar_cta ) ) {
				get_partial(
					'components/button',
					array(
						'type'    => 'link',
						'title'   => $topbar_cta['title'],
						'url'     => $topbar_cta['url'],
						'classes' => 'c-button--primary',
						'target'  => $topbar_cta['target'],
						'dataset' => '',
						'icon'    => '',
					)
				);
			}
			?>
		</li>
		<li>
			<?php get_partial( 'components/search-trigger' ); ?>
		</li>
	</ul>

	<ul class="c-primary-menu__list">
		<?php
		foreach ( $menu as $item ) {
			$item['icon']    = $acf_provider->get_field( 'icon', $item['ID'] );
			$item['columns'] = $acf_provider->get_field( 'columns', $item['ID'] );
			get_partial( 'components/primary-menu-item', array( 'item' => $item ) );
		}
		?>

		<li class="c-primary-menu__button-group">
			<?php
			if ( ! empty( $primary_menu_button_group ) ) {
				foreach ( $primary_menu_button_group as $button ) {
					if ( ! empty( $button['link'] ) && is_array( $button['link'] ) ) {
						get_partial(
							'components/button',
							array(
								'type'    => 'link',
								'title'   => $button['link']['title'],
								'url'     => $button['link']['url'],
								'classes' => 'c-button--primary-outline c-button--full',
								'target'  => $button['link']['target'],
								'dataset' => '',
								'icon'    => $button['link']['target'] === '_blank' ? get_icon( 'arrow-top-right' ) : '',
							)
						);
					}
				}
			}
			?>
		</li>
	</ul>
</nav>
