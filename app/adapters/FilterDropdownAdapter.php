<?php
namespace gradZagrebWeb2024\adapters;

class FilterDropdownAdapter {
	public static function terms_to_filter_array( $terms ) {
		foreach ( $terms as $term ) {
			$dropdown_array[] = array(
				'id'   => $term->term_id,
				'name' => $term->name,
				'slug' => $term->slug,
			);
		}

		return $dropdown_array;
	}
}
