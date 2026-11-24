<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class EmployeePostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Zaposlenik';
	public const LABEL_PLURAL = 'Ljudi';
	public const SLUG         = 'employee';

	public function get_post_type_slug(): string {
		return self::SLUG;
	}

	public function get_labels(): array {
		return $this->get_default_labels( self::LABEL, self::LABEL_PLURAL );
	}

	public function get_args(): array {
		$args = $this->get_default_args( $this->get_labels() );
		$args['has_archive']        = false;
		$args['acfe_admin_archive'] = false;
		$args['publicly_queryable'] = false;
		$args['supports']           = array( 'title', 'thumbnail' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTIgMTBDMTQuMjA5MSAxMCAxNiA4LjIwOTE0IDE2IDYgMTYgMy43OTA4NiAxNC4yMDkxIDIgMTIgMiA5Ljc5MDg2IDIgOCAzLjc5MDg2IDggNiA4IDguMjA5MTQgOS43OTA4NiAxMCAxMiAxMFpNNS41IDEzQzYuODgwNzEgMTMgOCAxMS44ODA3IDggMTAuNSA4IDkuMTE5MjkgNi44ODA3MSA4IDUuNSA4IDQuMTE5MjkgOCAzIDkuMTE5MjkgMyAxMC41IDMgMTEuODgwNyA0LjExOTI5IDEzIDUuNSAxM1pNMjEgMTAuNUMyMSAxMS44ODA3IDE5Ljg4MDcgMTMgMTguNSAxMyAxNy4xMTkzIDEzIDE2IDExLjg4MDcgMTYgMTAuNSAxNiA5LjExOTI5IDE3LjExOTMgOCAxOC41IDggMTkuODgwNyA4IDIxIDkuMTE5MjkgMjEgMTAuNVpNMTIgMTFDMTQuNzYxNCAxMSAxNyAxMy4yMzg2IDE3IDE2VjIySDdWMTZDNyAxMy4yMzg2IDkuMjM4NTggMTEgMTIgMTFaTTUgMTUuOTk5OUM1IDE1LjMwNyA1LjEwMDY3IDE0LjYzNzYgNS4yODgxOCAxNC4wMDU2TDUuMTE4NjQgMTQuMDIwNEMzLjM2NTAzIDE0LjIxMDQgMiAxNS42OTU4IDIgMTcuNDk5OVYyMS45OTk5SDVWMTUuOTk5OVpNMjIgMjEuOTk5OVYxNy40OTk5QzIyIDE1LjYzNzggMjAuNTQ1OSAxNC4xMTUzIDE4LjcxMTggMTQuMDA1NiAxOC44OTkzIDE0LjYzNzYgMTkgMTUuMzA3IDE5IDE1Ljk5OTlWMjEuOTk5OUgyMloiPjwvcGF0aD48L3N2Zz4=';

		return $args;
	}
}
