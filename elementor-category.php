<?php

/**
 * Plugin Name: Category Card (Elementor Widget)
 * Description: This Plugin adds Category Card Elementor Widget that also displays the count of item in each category. Image, link is configurable
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      The Web Shark
 * Author URI:  https://thewebshark.io
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function register_oembed_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/index.php');

	$widgets_manager->register(new \Custom_Card_Widget());
	$widgets_manager->register(new \Quantity_In_Category());
}
add_action('elementor/widgets/register', 'register_oembed_widget');


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

add_action('init', 'tws_product_categories_function');
