<?php
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\controllers\ServicesHubController;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceLevelTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceUserTaxonomy;
use gradZagrebWeb2024\adapters\FilterDropdownAdapter;

$template_name = 'service-level';

$acf_provider = ACFProvider::get_instance();

$queried_object = get_queried_object();
$query_term = $queried_object->term_id;

$level_filter_terms = get_terms(
	array(
		'taxonomy'   => ServiceLevelTaxonomy::SLUG,
		'hide_empty' => false,
		'parent'     => $queried_object->term_id,
	)
);

$user_filter_terms = get_terms(
	array(
		'taxonomy'   => ServiceUserTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

$office_filter_terms = get_terms(
	array(
		'taxonomy'   => OfficeTaxonomy::SLUG,
		'hide_empty' => false,
	)
);

$current_page = get_query_var('page') ?: 1;
$selected_service_levels = $_GET['selected-levels'] ?? [];
$selected_service_users = $_GET['service-user'] ?? [];
$selected_offices = $_GET['office-taxonomy'] ?? [];
$selected_e_service = $_GET['e-service'] ?? false;
$orderby = $_GET['orderby'] ?? 'newest';

if (!is_array($selected_service_levels)) {
    $selected_service_levels = !empty($selected_service_levels) ? [$selected_service_levels] : [];
}
if (!is_array($selected_service_users)) {
    $selected_service_users = !empty($selected_service_users) ? [$selected_service_users] : [];
}
if (!is_array($selected_offices)) {
    $selected_offices = !empty($selected_offices) ? [$selected_offices] : [];
}

$controller    = new ServicesHubController();

$has_additional_filters = !empty($selected_service_levels) || !empty($selected_service_users) || !empty($selected_offices) || $selected_e_service || $orderby !== 'newest' || $current_page > 1;

$filters = array(
    'page' => $current_page,
    'selected-levels' => $selected_service_levels,
    'service-user' => $selected_service_users,
    'office-taxonomy' => $selected_offices,
    'e-service' => $selected_e_service,
    'orderby' => $orderby,
    'posts_per_page' => 12,
);

if (empty($selected_service_levels)) {
    $filters['current-term'] = $query_term;
}

$services_data = $controller->get_filtered_services($filters);

$services = $services_data['html'];
$pagination_data = array(
    'current_page' => $services_data['current_page'],
    'max_pages' => $services_data['max_pages'],
);

get_header();

get_partial( 'layout/loader' );
get_partial( 'layout/navigation' );

?>
<div id="<?php echo esc_attr( $template_name ); ?>" class="o-page o-page--light-gray o-page--<?php echo esc_attr( $template_name ); ?>">
	<div class="o-page__inner o-page__inner--<?php echo $template_name; ?>">

		<?php
		get_partial(
			'components/headers/services-header',
			array(
				'back'  => $acf_provider->get_option_field( 'page_-_services' ),
				'title' => single_term_title( '', false ),
			),
		);
		?>

		<section id="js-services-list-scroll-to" class="o-section">
			<div class="o-container">

				<form action="#" class="c-filter-form js-services-filter-form" data-current-term="<?php echo esc_attr( $query_term ); ?>">
					<div class="c-filter-form__filters">
						<?php
						get_partial(
							'components/filters/filter-dropdown',
							array(
								'label'          => __( 'Područje druge razine', TEXT_DOMAIN ),
								'slug'           => 'selected-levels',
								'values'         => FilterDropdownAdapter::terms_to_filter_array( $level_filter_terms ),
								'is_multiselect' => true,
                                'selected'       => $selected_service_levels,
							)
						);

						get_partial(
							'components/filters/filter-dropdown',
							array(
								'label'          => __( 'Korisnik usluge', TEXT_DOMAIN ),
								'slug'           => ServiceUserTaxonomy::SLUG,
								'values'         => FilterDropdownAdapter::terms_to_filter_array( $user_filter_terms ),
                                'is_multiselect' => true,
                                'selected'       => $selected_service_users,
							)
						);

						get_partial(
							'components/filters/filter-dropdown',
							array(
								'label'          => __( 'Nadležnost', TEXT_DOMAIN ),
								'slug'           => OfficeTaxonomy::SLUG,
								'values'         => FilterDropdownAdapter::terms_to_filter_array( $office_filter_terms ),
								'is_multiselect' => true,
                                'selected'       => $selected_offices,
							)
						);

						get_partial(
							'components/filters/filter-switch',
							array(
								'label' => __( 'e-Usluge', TEXT_DOMAIN ),
                                'slug'  => 'e-service',
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
				<div class="c-services-list">
					<div class="c-services-list__content js-filter-content">
						<?php echo $services; ?>
					</div>
					<div class="c-services-list__pagination">
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

		<?php get_modules_partial( $acf_provider->get_field( 'modules' ) ?? array() ); ?>

	</div>
	<?php
	get_partial( 'layout/footer' );
	?>
</div>

<div class="ss-content-location"></div>
<?php
get_footer();
