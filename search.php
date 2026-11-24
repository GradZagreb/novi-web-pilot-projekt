<?php

use gradZagrebWeb2024\helpers\ArchiveHelper;
use gradZagrebWeb2024\helpers\ExcerptHelper;
use gradZagrebWeb2024\lib\core\ACFProvider;

$template_name = 'search';
$acf_provider  = ACFProvider::get_instance();

$excluded_post_types = $acf_provider->get_option_field( 'search_-_excluded_post_types' );
$excluded_posts      = $acf_provider->get_option_field( 'search_-_excluded_posts' );

$search_query = get_search_query();
$current_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	's'              => $search_query,
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged'          => $current_page,
	'post_status'    => 'publish',
	'post__not_in'   => $excluded_posts,
	'post_type'      => array_diff( get_post_types( array( 'public' => true ), 'names' ), $excluded_post_types ),
);

$wp_query = new WP_Query( $args );

$max_pages      = $wp_query->max_num_pages;
$results_number = $wp_query->found_posts;

$archive_helper      = new ArchiveHelper( get_home_url(), '%base_url%/%page_key%/%page_value%/?%s_key%=%s_value%' );
$pagination_base_url = $archive_helper->get_url(
	array(
		's' => $search_query,
		'page'   => '%page_num%',
	)
);

$excerpt_helper = new ExcerptHelper();

get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );
?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--light-gray o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo esc_attr( $template_name ); ?>">

			<header class="o-header">
				<div class="o-container">
					<div class="c-search-results-header">
						<h1 class="c-search-results-header__heading u-a4 u-text-center">
							<?php _e( 'Rezultati pretraživanja za', TEXT_DOMAIN ); ?>:
							"<?php echo esc_html( $search_query ); ?>"
						</h1>
						<p class="u-b0 u-text-center"><?php echo $results_number . ' ' . _n( 'rezultat', 'rezultata', $results_number, TEXT_DOMAIN ); ?></p>
					</div>
				</div>
			</header>

			<section class="o-section">
				<div class="o-container">
					<div class="c-search-results">
						<?php if ( $wp_query->have_posts() ) : ?>
							<ul class="c-search-results__list">
								<?php
								while ( $wp_query->have_posts() ) :
									$wp_query->the_post();
									?>
								<li class="c-search-results__item">
									<?php
									get_partial(
										'components/cards/search-result-card',
										array(
											'link'    => get_permalink(),
											'title'   => get_the_title(),
											'excerpt' => $excerpt_helper->get_the_excerpt( $post->ID, 'sm', '&hellip;' ),
										)
									);
									?>
								</li>
								<?php endwhile; ?>
							</ul>
						<div class="c-search-results__pagination">
							<?php
							get_partial(
								'layout/pagination',
								array(
									'base_url'     => $pagination_base_url,
									'max_pages'    => $max_pages,
									'current_page' => $current_page,
								)
							);
							?>
						</div>

						<?php else : ?>
							<div class="c-search-results__no-results">
								<p class="u-text-center"><?php _e( 'Nema rezultata. Pokušajte s drugim pojmom.', TEXT_DOMAIN ); ?></p>
							</div>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</section>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
