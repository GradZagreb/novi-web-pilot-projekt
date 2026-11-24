<?php

namespace gradZagrebWeb2024\core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\options\RoleManagement;
use gradZagrebWeb2024\options\WordpressHooks;
use gradZagrebWeb2024\options\WordpressHooksAdmin;
use gradZagrebWeb2024\options\CF7Hooks;
use gradZagrebWeb2024\adminMenus\CustomMenus;
use gradZagrebWeb2024\rest\CustomRoutes;
use gradZagrebWeb2024\postTypes\CustomPostTypes;
use gradZagrebWeb2024\postTypes\CustomTaxonomies;
use gradZagrebWeb2024\blocks\Blocks;
use gradZagrebWeb2024\optimization\WPDefaults;
use gradZagrebWeb2024\optimization\WPPlugins;
use gradZagrebWeb2024\acf\ACFDefaults;
use gradZagrebWeb2024\lib\optimization\wpPlugins\CF7Options;
use gradZagrebWeb2024\addons\ScheduleUnpublish;

	final class Core {
	public function init(): void {
		$this->init_admin_classes();
		$this->init_classes();
	}

	private function init_admin_classes(): void {
		$wordpress_hooks_admin = new WordpressHooksAdmin();
		$wordpress_hooks_admin->init();

		$cf7_options = new CF7Options();
		$cf7_options->deactivate( array( 'remove_autop' => true ) );

		$schedule_unpublish = new ScheduleUnpublish();
		$schedule_unpublish->init();
	}

	private function init_classes(): void {
		$custom_post_types = new CustomPostTypes();
		$custom_post_types->register();

		$custom_taxonomies = new CustomTaxonomies();
		$custom_taxonomies->register();

		$custom_menus = new CustomMenus();
		$custom_menus->register();

		$wordpress_hooks = new WordpressHooks();
		$wordpress_hooks->init();

		$cf7_hooks = new CF7Hooks();
		$cf7_hooks->init();

		$role_management = new RoleManagement();
		$role_management->init();

		$custom_routes = new CustomRoutes();
		$custom_routes->register();

		$blocks = new Blocks();
		$blocks->init();

		$wp_defaults = new WPDefaults();
		$wp_defaults->init();

		$wp_plugins = new WPPlugins();
		$wp_plugins->init();

		$acf_defaults = new ACFDefaults();
		$acf_defaults->init();
	}
}
