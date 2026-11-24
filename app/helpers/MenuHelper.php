<?php

namespace gradZagrebWeb2024\helpers;

use gradZagrebWeb2024\lib\core\ACFProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MenuHelper
{
    private $grouped_menu_items = array();
    private $current_menu_items = array();

    public function get_nav_menu_items_by_location( $location, $args = array() ): ?array
    {

        $locations = get_nav_menu_locations();

        $location = ! empty( $locations[ $location ] ) ? $locations[ $location ] : '';

        $object = wp_get_nav_menu_object( $location );

        if ( false === $object ) {
            return array();
        }

        $menu_items = wp_get_nav_menu_items( $object->name, $args );

        if ( false === $menu_items ) {
            return array();
        }

        return $menu_items;
    }

    public function menu_hierarchy_create( $location ): array
    {

        $menu_locations = get_nav_menu_locations();

        if ( empty( $menu_locations[ $location ] ) ) {
            return array();
        }

        $menu = wp_get_nav_menu_object( $menu_locations[ $location ] );

        $menu_items = wp_get_nav_menu_items( $menu->term_id );

        if ( empty( $menu_items ) ) {
            return array();
        }

        $new_menu_array = array();

        foreach ( (array) $menu_items as $key => $menu_item ) {
            $new_menu_array[ $menu_item->menu_item_parent ][] = $menu_item;
        }

        $new_menu_array1 = array();

        foreach ( (array) $menu_items as $key => $menu_item ) {
            if ( isset( $new_menu_array[ $menu_item->ID ] ) ) {
                $menu_item->sub = $new_menu_array[ $menu_item->ID ];
                if ( 0 === (int) $menu_item->menu_item_parent ) {
                    $new_menu_array1[] = $menu_item;
                }
            }
        }

        return array_splice( $new_menu_array[0], 0, 15, $new_menu_array1 );
    }

    public function get_current_path(): string
    {
        global $wp;
        $url = home_url( $wp->request );

        $arr = parse_url( $url );
        if ( ! empty( $arr['path'] ) ) {
            return rtrim( $arr['path'], '/' );
        }

        return '';
    }

    public function get_menu_item_path( $url )
    {
        $arr = parse_url( $url );
        if ( ! empty( $arr['path'] ) ) {
            return rtrim( $arr['path'], '/' );
        }

        return '';
    }

    public function get_home_path()
    {
        $url = get_home_url();

        $arr = parse_url( $url );
        if ( ! empty( $arr['path'] ) ) {
            return rtrim( $arr['path'], '/' );
        }

        return '';
    }

    public function create_menu_hierarchy_with_current( $location, $args = array() ): array
    {

        $this->grouped_menu_items = array();
        $this->current_menu_items = array();

        $menu_items_arr  = array();
        $menu_items_tree = array();

        $current_path = $this->get_current_path();

        $menu_locations = get_nav_menu_locations();

        if ( empty( $menu_locations[ $location ] ) ) {
            return array();
        }

        $menu = wp_get_nav_menu_object( $menu_locations[ $location ] );

        $menu_items = wp_get_nav_menu_items( $menu->term_id );

        foreach ( (array) $menu_items as $menu_item ) {
            $menu_items_arr[] = $menu_item->to_array();
        }

        foreach ( $menu_items_arr as $menu_item ) {

            $menu_item_path = $this->get_menu_item_path( $menu_item['url'] );

            $menu_item['current'] = false;
            if ( strpos( $menu_item_path, $current_path ) !== false ) {
                $menu_item['current'] = true;
            }

            if ( ! empty( $args['aliases'] ) ) {
                foreach ( $args['aliases'] as $path => $alias ) {
                    if ( $path === $menu_item_path && strpos( $current_path, $alias ) !== false ) {
                        $menu_item['current'] = true;
                    }
                }
            }

            if ( $this->get_home_path() === $current_path ) {
                $menu_item['current'] = false;
            }

            if ( $menu_item['current'] === true ) {
                $this->current_menu_items[ $menu_item['menu_item_parent'] ] = true;
            }

            if ( ! isset( $this->grouped_menu_items[ $menu_item['menu_item_parent'] ] ) ) {
                $this->grouped_menu_items[ $menu_item['menu_item_parent'] ] = array();
            }

            $this->grouped_menu_items[ $menu_item['menu_item_parent'] ][] = $menu_item;
        }

        if ( ! empty( $this->grouped_menu_items[0] ) ) {
            $menu_items_tree = $this->do_submenu_recursion( $this->grouped_menu_items[0] );
        }

        return $menu_items_tree;
    }

    private function do_submenu_recursion( $items = array() ): array
    {
        $arr = array();

        foreach ( $items as $menu_item ) {

            if ( ! empty( $this->current_menu_items[ $menu_item['ID'] ] ) ) {
                $menu_item['current'] = true;
            }

            if ( ! empty( $this->grouped_menu_items[ $menu_item['ID'] ] ) ) {
                $menu_item['sub'] = $this->do_submenu_recursion( $this->grouped_menu_items[ $menu_item['ID'] ] );
            }

            $arr[] = $menu_item;
        }

        return $arr;
    }

    public function get_is_active_class( \WP_Post $item, array $args ): string
    {
        if ( empty( $args['post_type'] ) || empty( $args['page_id'] ) ) {
            return '';
        }
        if ( 'page' === $args['post_type'] && (int) $item->object_id === $args['page_id'] ) {
            return 'is-active';
        }

        if ( $item->object !== 'page' && $args['post_type'] === $item->object ) {
            return 'is-active';
        }

        return '';
    }

    public function get_field( $field, $location ): array
    {
        $menu_locations = get_nav_menu_locations();

        if ( empty( $menu_locations[ $location ] ) ) {
            return array();
        }

        $menu = wp_get_nav_menu_object( $menu_locations[ $location ] );

        return ACFProvider::get_instance()->get_field( $field, 'term_' . $menu->term_id );
    }
}
