<?php
namespace gradZagrebWeb2024\postTypes\taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BaseTaxonomy;
use gradZagrebWeb2024\lib\postTypes\CustomTaxonomiesInterface;
use gradZagrebWeb2024\postTypes\types\DirectoryPostType;

class DirectoryCategoryTaxonomy extends BaseTaxonomy implements CustomTaxonomiesInterface {
	public const LABEL = 'Kategorija kontakta';
	public const SLUG  = 'directory-category';

	public function get_post_types(): array {
		return array(
			DirectoryPostType::SLUG,
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
