<?php
namespace gradZagrebWeb2024\postTypes\taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BaseTaxonomy;
use gradZagrebWeb2024\lib\postTypes\CustomTaxonomiesInterface;
use gradZagrebWeb2024\postTypes\types\TenderPostType;

class TenderCategoryTaxonomy extends BaseTaxonomy implements CustomTaxonomiesInterface {
	public const LABEL = 'Kategorija natječaja';
	public const SLUG  = 'tender-category';

	public function get_post_types(): array {
		return array(
			TenderPostType::SLUG,
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
        $args['publicly_queryable'] = false;

        return $args;
	}
}
