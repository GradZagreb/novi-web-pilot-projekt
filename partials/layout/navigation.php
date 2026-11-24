<?php

use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\config\MenuConfig;
use gradZagrebWeb2024\helpers\MenuHelper;

$acf_provider   = ACFProvider::get_instance();
$menu_helper    = new MenuHelper();
$primary_menu   = $menu_helper->create_menu_hierarchy_with_current( MenuConfig::HEADER_PRIMARY_MENU_LOCATION );
$secondary_menu = $menu_helper->create_menu_hierarchy_with_current( MenuConfig::HEADER_SECONDARY_MENU_LOCATION );
$topbar_cta     = $acf_provider->get_option_field( 'navigation_-_topbar_cta' );
?>
<nav class="o-navigation js-navigation">
	<div class="c-navigation">

		<div class="c-navigation__topbar js-navigation-topbar">
			<div class="c-navigation__topbar-inner">
				<div class="c-navigation__topbar-left">
					<button class="c-hamburger js-primary-menu-trigger" type="button" aria-label="<?php esc_html_e( 'Izbornik', TEXT_DOMAIN ); ?>">
						<span></span>
						<span></span>
						<span></span>
					</button>

					<span class="u-b3">
						<?php esc_html_e( 'Izbornik', TEXT_DOMAIN ); ?>
					</span>
				</div>

				<div class="c-navigation__topbar-center">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-navigation__logo-link">
						<img src="<?php echo $acf_provider->get_option_field( 'logo' ); ?>" alt="Grad Zagreb" />
					</a>
				</div>

				<div class="c-navigation__topbar-right">
					<?php get_partial( 'components/language-switcher' ); ?>

					<div class="c-navigation__actions">
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
					</div>
				</div>
			</div>
		</div>
		<?php get_partial( 'components/primary-menu', array( 'menu' => $primary_menu ) ); ?>
		<?php get_partial( 'components/secondary-menu', array( 'menu' => $secondary_menu ) ); ?>

	</div>
</nav>
