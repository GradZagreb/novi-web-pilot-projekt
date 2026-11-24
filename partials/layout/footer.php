<?php
use gradZagrebWeb2024\config\MenuConfig;
use gradZagrebWeb2024\helpers\MenuHelper;
use gradZagrebWeb2024\lib\core\ACFProvider;

$menu_helper  = new MenuHelper();
$footer_menu  = $menu_helper->create_menu_hierarchy_with_current( MenuConfig::FOOTER_MENU_LOCATION );
$acf_provider = ACFProvider::get_instance();
?>
<footer class="o-footer js-footer">
	<div class="o-container">
		<div class="c-footer">
			<div class="c-footer__impressum">
				<div class="c-footer__impressum-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-footer__logo-link">
						<img src="<?php echo $acf_provider->get_option_field( 'logo' ); ?>" alt="Grad Zagreb" />
					</a>
				</div>
				<div class="c-footer__impressum-text">
					<div class="c-footer__impressum-address">
						<h2 class="u-a1">Grad Zagreb</h2>
						<p class="u-b0">
							<?php echo $acf_provider->get_option_field( 'footer_address' ); ?>
						</p>
					</div>
					<div class="c-footer__impressum-info u-b3">
						<?php echo $acf_provider->get_option_field( 'footer_info' ); ?>
					</div>
				</div>
			</div>

			<nav class="c-footer__menu u-b4">
				<ul>
					<?php foreach ( $footer_menu as $item ) : ?>
					<li>
						<a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>">
							<?php echo $item['title']; ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</div>
	</div>

	<div class="c-footer-bottom-bar">
		<div class="o-container c-footer-bottom-bar__container">
			<p class="u-b3">
				Copyright © <?php echo date( 'Y' ); ?>. Grad Zagreb, sva prava pridržana.
			</p>
			<ul>
				<?php foreach ( $acf_provider->get_option_field( 'footer_social_networks' ) as $link ) : ?>
				<li>
					<a href="<?php echo $link['url']; ?>" target="_blank" rel="noopener noreferrer">
						<img src="<?php echo $link['icon']; ?>" />
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</footer>
