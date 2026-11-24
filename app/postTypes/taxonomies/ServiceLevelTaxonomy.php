<?php
namespace gradZagrebWeb2024\postTypes\taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BaseTaxonomy;
use gradZagrebWeb2024\lib\postTypes\CustomTaxonomiesInterface;
use gradZagrebWeb2024\postTypes\types\ServicePostType;

class ServiceLevelTaxonomy extends BaseTaxonomy implements CustomTaxonomiesInterface {
	public const LABEL = 'Pordučna razina';
	public const SLUG  = 'service-level';

	public function get_post_types(): array {
		return array(
			ServicePostType::SLUG,
		);
	}

	public function get_taxonomy_slug(): string {
		return self::SLUG;
	}

	public function get_labels(): array {
		return $this->get_default_labels( self::LABEL );
	}

	public function get_args(): array {
        $args = $this->get_default_args( $this->get_labels() );
        $args['rewrite'] = array(
            'slug'       => 'razina-usluge',
            'with_front' => false,
        );

        return $args;
	}
}
