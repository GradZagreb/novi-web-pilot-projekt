<?php
/** Template Name: Projects template */

use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\controllers\ProjectsHubController;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\StatusTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\adapters\FilterDropdownAdapter;

$template_name = 'projects';

$office_terms = get_terms(
	array(
		'taxonomy'   => OfficeTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

$status_terms = get_terms(
	array(
		'taxonomy'   => StatusTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

$theme_terms = get_terms(
	array(
		'taxonomy'   => ThemeTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

$current_page = get_query_var('page') ?: 1;
$selected_offices = $_GET['office-taxonomy'] ?? [];
$selected_status = $_GET['stage'] ?? [];
$selected_themes = $_GET['theme-taxonomy'] ?? [];
$orderby = $_GET['orderby'] ?? 'newest';

if (!is_array($selected_offices)) {
	$selected_offices = !empty($selected_offices) ? [$selected_offices] : [];
}
if (!is_array($selected_status)) {
	$selected_status = !empty($selected_status) ? [$selected_status] : [];
}
if (!is_array($selected_themes)) {
	$selected_themes = !empty($selected_themes) ? [$selected_themes] : [];
}

$controller = new ProjectsHubController();

$projects_data   = $controller->get_filtered_projects(
	array(
		'page'             => $current_page,
		'office-taxonomy'  => $selected_offices,
		'stage'            => $selected_status,
		'theme-taxonomy'   => $selected_themes,
		'orderby'          => $orderby,
		'posts_per_page'   => 12,
	)
);
$projects        = $projects_data['html'];
$pagination_data = array(
	'current_page' => $projects_data['current_page'],
	'max_pages'    => $projects_data['max_pages'],
);

get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );
?>
	<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--<?php echo esc_attr( $template_name ); ?>">
		<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">
			<?php get_partial( 'components/headers/archive-header', array( 'title' => get_the_title() ) ); ?>
            <section id="js-projects-list-scroll-to" class="o-section">
                <div class="o-container">

                    <form action="#" class="c-filter-form js-projects-filter-form">
                        <div class="c-filter-form__filters">
                            <?php
                            get_partial(
                                'components/filters/filter-dropdown',
                                array(
                                    'label'          => __( 'Ured', TEXT_DOMAIN ),
                                    'slug'           => OfficeTaxonomy::SLUG,
                                    'values'         => FilterDropdownAdapter::terms_to_filter_array( $office_terms ),
                                    'is_multiselect' => true,
                                    'selected'       => $selected_offices,
                                )
                            );

                            get_partial(
                                'components/filters/filter-dropdown',
                                array(
                                    'label'          => __( 'Status', TEXT_DOMAIN ),
                                    'slug'           => StatusTaxonomy::SLUG,
                                    'values'         => FilterDropdownAdapter::terms_to_filter_array( $status_terms ),
                                    'is_multiselect' => true,
                                    'selected'       => $selected_status,
                                )
                            );

                            get_partial(
                                'components/filters/filter-dropdown',
                                array(
                                    'label'          => __( 'Tema', TEXT_DOMAIN ),
                                    'slug'           => ThemeTaxonomy::SLUG,
                                    'values'         => FilterDropdownAdapter::terms_to_filter_array( $theme_terms ),
                                    'is_multiselect' => true,
                                    'selected'       => $selected_themes,
                                )
                            );

                            get_partial(
                                'components/filters/filter-dropdown',
                                array(
                                    'label'          => __( 'Poredaj', TEXT_DOMAIN ),
                                    'slug'           => 'orderby',
                                    'values'         => array(
                                        array(
                                            'id'   => 'name',
                                            'slug' => 'newest',
                                            'name' => __( 'Najnovije', TEXT_DOMAIN ),
                                        ),
                                        array(
                                            'id'   => 'date',
                                            'slug' => 'oldest',
                                            'name' => __( 'Najstarije', TEXT_DOMAIN ),
                                        ),
                                    ),
                                    'is_multiselect' => false,
                                    'align'          => 'right',
                                    'selected'       => [$orderby],
                                )
                            );
                            ?>
                        </div>

                        <div class="c-filter-form__active-filters">
                        </div>
                    </form>
                </div>
            </section>

			<section class="o-section">
				<div class="o-container">
					<div class="c-project-list js-filter-container">
						<?php get_partial( 'components/content-loader' ); ?>
						<div class="c-project-list__content js-filter-content">
							<?php echo $projects; ?>
						</div>
						<div class="c-project-list__pagination">
							<?php
							if ($pagination_data['max_pages'] > 1) {
								get_partial(
									'layout/pagination',
									array(
										'base_url'     => '#',
										'page_slug'    => 'page',
										'current_page' => $pagination_data['current_page'],
										'max_pages'    => $pagination_data['max_pages'],
									)
								);
							}
							?>
						</div>
					</div>
				</div>
			</section>
			<?php get_modules_partial( ACFProvider::get_instance()->get_field( 'modules' ) ?? array() ); ?>

		</div>
		<?php
		get_partial( 'layout/footer' );
		?>
	</div>
<?php
get_footer();
