<?php


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


class Quantity_In_Category extends \Elementor\Widget_Base
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
		$this->add_control(
			'select_option',
			[
				'label' => esc_html__('Select Parent Category', 'elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $category_drop_down_items,
				'default' => 'option1', // Set the default value
			]
		);

		$this->end_controls_section();




		// Create a repeater control for each product category
	}

	protected function render()
	{
		global $tws_product_categories;
		var_dump($tws_product_categories);
	}
}
