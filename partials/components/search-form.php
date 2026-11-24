<?php

use gradZagrebWeb2024\lib\core\ACFProvider;
$frequent_searches = ACFProvider::get_instance()->get_option_field( 'search_-_frequent_searches' );

if ( ! $frequent_searches || ! is_array( $frequent_searches ) ) {
	$frequent_searches = array();
}
?>

<div class="c-search-form">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-form" role="search" method="get">
		<div class="c-form__search-wrapper">
			<input type="search" class="c-form__input c-form__input--search" placeholder="<?php _e( 'Što vas zanima?', TEXT_DOMAIN ); ?>" name="s" />
			<div class="c-form__search-actions">
				<button type="submit" class="c-form__search-submit">
					<?php
					get_partial(
						'components/circle',
						array(
							'icon'    => 'arrow-right',
							'classes' => 'c-circle--small c-circle--white',
						),
					)
					?>
				</button>
			</div>
		</div>
	</form>

	<div class="c-search-form__recent-searches">
		<?php foreach ( $frequent_searches as $search ) : ?>
			<?php if ( ! empty( $search['term'] ) ) : ?>
				<a href="<?php echo get_home_url( '/' ) . '?s=' . $search['term']; ?>" class="c-tag c-tag--dark-blue">
					<span class="u-b4"><?php echo $search['term']; ?></span>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
