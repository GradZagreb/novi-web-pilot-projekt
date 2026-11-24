<?php

use gradZagrebWeb2024\lib\core\ACFProvider;

$search_page = ACFProvider::get_instance()->get_option_field( 'page_-_search' );
?>

<div class="c-search-trigger">
    <a href="<?php echo $search_page; ?>" class="c-search-trigger__button js-search-trigger" type="button">
		<?php echo get_icon( 'search' ); ?>
	</a>
</div>
