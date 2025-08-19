<?php

namespace App\Support;

use Walker_Nav_Menu;

/**
 * Custom Walker for Off-canvas Menu
 * Provides custom styling and structure for the mobile navigation menu
 */
class OffCanvasMenuWalker extends Walker_Nav_Menu
{
    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"submenu ml-4 mt-2 space-y-1\">\n";
    }

    /**
     * Ends the list after the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Add current page/menu item classes
        if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
            $classes[] = 'current';
        }

        // Add parent class if item has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-children';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        // Build link classes based on depth
        $link_classes = [];

        if ($depth === 0) {
            $link_classes[] = 'block py-4 px-6 text-white text-lg font-medium transition-all duration-300';

            // Add current page styling
            if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
                $link_classes[] = 'text-secondary-dark';
            }
        } else {
            $link_classes[] = 'block py-2 px-4 text-sm text-gray-300 hover:text-white transition-colors ml-4';

            // Add current page styling for submenu
            if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
                $link_classes[] = 'text-secondary-dark';
            }
        }

        $link_class_attr = ' class="' . implode(' ', $link_classes) . '"';

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . $link_class_attr . '>';
        
        // Add icon for parent items
        if (in_array('menu-item-has-children', $classes) && $depth === 0) {
            $item_output .= '<span class="flex items-center justify-between">';
            $item_output .= '<span>' . (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '') . '</span>';
            $item_output .= '<i class="fa-light fa-chevron-down text-sm transition-transform duration-300"></i>';
            $item_output .= '</span>';
        } else {
            $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
