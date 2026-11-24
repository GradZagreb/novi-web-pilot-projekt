<?php
namespace gradZagrebWeb2024\postTypes\taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BaseTaxonomy;
use gradZagrebWeb2024\lib\postTypes\CustomTaxonomiesInterface;
use gradZagrebWeb2024\postTypes\types\CapitalProjectPostType;
use gradZagrebWeb2024\postTypes\types\CareerPostType;
use gradZagrebWeb2024\postTypes\types\NewsPostType;
use gradZagrebWeb2024\postTypes\types\NotificationPostType;
use gradZagrebWeb2024\postTypes\types\OfficePostType;
use gradZagrebWeb2024\postTypes\types\ProjectPostType;
use gradZagrebWeb2024\postTypes\types\ServicePostType;
use gradZagrebWeb2024\postTypes\types\TenderPostType;
use gradZagrebWeb2024\postTypes\types\ThemePostType;

class ThemeTaxonomy extends BaseTaxonomy implements CustomTaxonomiesInterface {
	public const LABEL = 'Tema';
	public const SLUG  = 'theme-taxonomy';

	public function get_post_types(): array {
		return array(
			NewsPostType::SLUG,
			CareerPostType::SLUG,
			TenderPostType::SLUG,
			CapitalProjectPostType::SLUG,
			ProjectPostType::SLUG,
			NotificationPostType::SLUG,
			ServicePostType::SLUG,
			OfficePostType::SLUG,
            ThemePostType::SLUG,
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
