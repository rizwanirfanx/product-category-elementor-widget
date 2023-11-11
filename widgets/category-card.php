<?php

/**
 * Plugin Name: Custom Category Cards Widget
 * Description: An Elementor widget to render all categories within configurable cards.
 * Version: 1.0
 * Author: The Web Shark
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


class My_Custom_Elementor_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'my_custom_widget';
	}

	public function get_title()
	{
		return 'My Custom Widget';
	}

	public function get_icon()
	{
		return 'fa fa-code';
	}

	public function get_categories()
	{
		return ['general'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('List Content', 'elementor-list-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Retrieve product categories
		$categories =  get_categories(array('taxonomy' => 'product_cat'));
		$list_items = [];
		$category_drop_down_items = array();
		foreach ($categories as $prod_cat) {
			$category_drop_down_items[$prod_cat->slug] = $prod_cat->name;
			array_push($list_items, array(
				'text' => esc_html__($prod_cat->slug, 'elementor-list-widget'),
				'link' => '',
			));
		}
		$this->add_control(
			'select_option',
			[
				'label' => esc_html__('Select Parent Category', 'elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $category_drop_down_items,
				'default' => 'option1', // Set the default value
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'elementor-list-widget'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('List Item', 'elementor-list-widget'),
				'default' => esc_html__('List Item', 'elementor-list-widget'),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'elementor-list-widget'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'elementor-list-widget'),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		/* End repeater */

		$this->add_control(
			'list_items',
			[
				'label' => esc_html__('List Items', 'elementor-list-widget'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),           /* Use our repeater */
				'default' => $list_items,
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();




		// Create a repeater control for each product category
	}

	protected function render()
	{
		$categories =  get_categories(array('taxonomy' => 'product_cat'));
		var_dump($categories);
		$settings = $this->get_settings_for_display();
		$categories = $settings['list_items'];
		foreach ($categories as $category) {
			var_dump($category);
			echo '<img src="' . $category['image']['url'] . '"/>';
		}
	}
}
