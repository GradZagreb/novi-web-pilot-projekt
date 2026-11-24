<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class CapitalProjectPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Kapitalni projekt';
	public const LABEL_PLURAL = 'Kapitalni projekti';
	public const SLUG         = 'capital-project';

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
		$args['supports']           = array( 'title', 'thumbnail', 'excerpt', 'editor' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTIuMDA0OSAyMi4wMDI3QzYuNDgyMDQgMjIuMDAyNyAyLjAwNDg4IDE3LjUyNTYgMi4wMDQ4OCAxMi4wMDI3QzIuMDA0ODggNi40Nzk5IDYuNDgyMDQgMi4wMDI3NSAxMi4wMDQ5IDIuMDAyNzVDMTcuNTI3NyAyLjAwMjc1IDIyLjAwNDkgNi40Nzk5IDIyLjAwNDkgMTIuMDAyN0MyMi4wMDQ5IDE3LjUyNTYgMTcuNTI3NyAyMi4wMDI3IDEyLjAwNDkgMjIuMDAyN1pNMTAuMDU0OSAxMS4wMDI3QzEwLjI4NjUgOS44NjE2MyAxMS4yOTU0IDkuMDAyNzUgMTIuNTA0OSA5LjAwMjc1QzEzLjEyMDEgOS4wMDI3NSAxMy42ODM0IDkuMjI0OTYgMTQuMTE4OSA5LjU5MzUxTDE1LjgxOTggOC40NTk1MUMxNC45OTczIDcuNTY0MDIgMTMuODE2NiA3LjAwMjc1IDEyLjUwNDkgNy4wMDI3NUMxMC4xODg2IDcuMDAyNzUgOC4yODEwNyA4Ljc1Mjc3IDguMDMyMzUgMTEuMDAyN0g3LjAwNDg4VjEzLjAwMjdIOC4wMzIzNUM4LjI4MTA3IDE1LjI1MjcgMTAuMTg4NiAxNy4wMDI3IDEyLjUwNDkgMTcuMDAyN0MxMy44MTY2IDE3LjAwMjcgMTQuOTk3MyAxNi40NDE1IDE1LjgxOTggMTUuNTQ2TDE0LjExODggMTQuNDEyQzEzLjY4MzMgMTQuNzgwNiAxMy4xMjAxIDE1LjAwMjcgMTIuNTA0OSAxNS4wMDI3QzExLjI5NTQgMTUuMDAyNyAxMC4yODY1IDE0LjE0MzkgMTAuMDU0OSAxMy4wMDI3SDE1LjAwNDlWMTEuMDAyN0gxMC4wNTQ5WiI+PC9wYXRoPjwvc3ZnPg==';
        $args['rewrite']           = array(
            'slug'       => 'kapitalni-projekt',
            'with_front' => false,
        );

		return $args;
	}
}
