<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\postTypes\taxonomies\CitizenshipTaxonomy;
use gradZagrebWeb2024\postTypes\types\ServicePostType;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceLevelTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceUserTaxonomy;

class ServiceRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return ServicePostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'                        => $post->ID,
			'title'                     => get_the_title( $post->ID ),
			'excerpt'                   => get_the_excerpt( $post->ID ),
			'link'                      => get_permalink( $post->ID ),
			'themes'                    => wp_get_post_terms( $post->ID, ThemeTaxonomy::SLUG ),
			'offices'                   => wp_get_post_terms( $post->ID, OfficeTaxonomy::SLUG ),
			'levels'                    => wp_get_post_terms( $post->ID, ServiceLevelTaxonomy::SLUG ),
			'citizenships'              => wp_get_post_terms( $post->ID, CitizenshipTaxonomy::SLUG ),
			'users'                     => wp_get_post_terms( $post->ID, ServiceUserTaxonomy::SLUG ),
			'responsible_party'         => $this->acf_provider->get_field( 'responsible_party', $post->ID ),
			'description'               => $this->acf_provider->get_field( 'description', $post->ID ),
			'documentation'             => $this->acf_provider->get_field( 'documentation', $post->ID ),
			'request'                   => $this->acf_provider->get_field( 'request', $post->ID ),
			'request_submission'        => $this->acf_provider->get_field( 'request_submission', $post->ID ),
			'contacts'                  => $this->acf_provider->get_field( 'contacts', $post->ID ),
			'administrative_fee'        => $this->acf_provider->get_field( 'administrative_fee', $post->ID ),
			'administrative_fee_amount' => $this->acf_provider->get_field( 'administrative_fee_amount', $post->ID ),
			'prerequisite'              => $this->acf_provider->get_field( 'prerequisite', $post->ID ),
			'procedure'                 => $this->acf_provider->get_field( 'procedure', $post->ID ),
			'legal_framework'           => $this->acf_provider->get_field( 'legal_framework', $post->ID ),
			'e_service'                 => $this->acf_provider->get_field( 'e_service', $post->ID ),
			'appeal'                    => $this->acf_provider->get_field( 'appeal', $post->ID ),
		);
	}

	public function find_services_filtered( array $filters ): array {
		$args = array(
			'post_type'      => array( $this->get_post_type() ),
			'posts_per_page' => $filters['posts_per_page'],
			'paged'          => $filters['page'],
			'post_status'    => 'publish',
		);

		if ( $filters['orderby'] === 'oldest' ) {
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
		} else {
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		}

		$tax_queries = [];
		$service_level_terms = [];
		if ( ! empty( $filters['selected-levels'] ) ) {
			$service_level_terms = $filters['selected-levels'];
		} elseif ( ! empty( $filters['current-term'] ) ) {
			$service_level_terms = array( $filters['current-term'] );
		}
		if ( ! empty( $service_level_terms ) ) {
			$tax_queries[] = array(
				'taxonomy' => ServiceLevelTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $service_level_terms ),
				'operator' => 'IN',
				'include_children' => true,
			);
		}

		if ( ! empty( $filters['service-user'] ) ) {
			$tax_queries[] = array(
				'taxonomy' => ServiceUserTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $filters['service-user'] ),
				'operator' => 'IN',
				'include_children' => false,
			);
		}

		if ( ! empty( $filters['office-taxonomy'] ) ) {
			$tax_queries[] = array(
				'taxonomy' => OfficeTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $filters['office-taxonomy'] ),
				'operator' => 'IN',
				'include_children' => false,
			);
		}

		if ( ! empty( $tax_queries ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
			);
			$args['tax_query'] = array_merge( $args['tax_query'], $tax_queries );
		}

		if ( $filters['e-service'] === true ) {
			$args['meta_query'] = array(
				array(
					'key'     => 'e_service',
					'value'   => '1',
					'compare' => '='
				)
			);
		}

		$query = new \WP_Query( $args );

		return array(
			'posts' => $this->to_model( $query->posts ),
			'current_page' => $filters['page'],
			'max_pages' => $query->max_num_pages,
			'total_posts' => $query->found_posts
		);
	}
}
