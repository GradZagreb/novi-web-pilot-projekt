<?php

namespace gradZagrebWeb2024\options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RoleManagement {
	public function init(): void {
		add_action( 'admin_init', array( $this, 'edit_default_editor_role' ) );

		add_action( 'admin_init', array( $this, 'restrict_access_to_roles' ) );

		add_filter( 'acf/settings/show_admin', array( $this, 'acf_options_page' ) );

		add_action( 'admin_init', array( $this, 'remove_default_roles' ) );
	}

	public function edit_default_editor_role(): void {
		$role = get_role( 'editor' );
		$role->add_cap( 'manage_options' );
		$role->add_cap( 'manage_links' );
	}

	public function restrict_access_to_roles(): void {
		$roles_user      = wp_get_current_user()->roles;
		$menus_to_remove = $this->get_menus_to_remove();
		if ( in_array( 'editor', $roles_user ) && ! empty( $menus_to_remove ) ) {
			foreach ( $menus_to_remove as $menu_to_remove ) {
				remove_menu_page( $menu_to_remove );
			}
		}
	}

	public function acf_options_page(): bool {
		$current_user       = wp_get_current_user();
		$current_user_roles = $current_user->roles;

		if ( ! empty( $current_user_roles[0] ) && 'administrator' === $current_user_roles[0] ) {
			return true;
		}

		return false;
	}

	public function remove_default_roles(): void {
		remove_role( 'contributor' );
		remove_role( 'author' );
		remove_role( 'subscriber' );
	}

	public function get_menus_to_remove(): array {
		return array(
			'options-general.php',
			'tools.php',
			'smush',
			'bvbackup',
			'limit-login-attempts',
			'wp-defender'
		);
	}
}
