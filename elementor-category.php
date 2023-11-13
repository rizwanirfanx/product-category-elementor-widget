<?php

/**
 * Plugin Name: Elementor oEmbed Widget
 * Description: Auto embed any embbedable content from external URLs into Elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-oembed-widget
 *
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_oembed_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/index.php');

	$widgets_manager->register(new \Custom_Card_Widget());
	$widgets_manager->register(new \Quantity_In_Category());
}
add_action('elementor/widgets/register', 'register_oembed_widget');


// Define a global variable within a function
function tws_product_categories_function()
{
	global $tws_product_categories;
	global $tws_counter;
	$categories =  get_categories(array('taxonomy' => 'product_cat'));
	$associative_arr_cats = array();
	foreach ($categories as $category) {
		$associative_arr_cats[$category->slug] = array(
			'name' => $category->name,
			'slug' => $category->slug,
			'count' => $category->count,
		);
	}
	$tws_product_categories = $associative_arr_cats;
}

// Hook the function to the init action
add_action('init', 'tws_product_categories_function');
