<?php


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


class Custom_Card_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'custom_card_widget';
	}

	public function get_title()
	{
		return __('Custom Card Widget', 'elementor-custom-card-widget');
	}

	public function get_icon()
	{
		return 'eicon-gallery';
	}

	public function get_categories()
	{
		return ['basic'];
	}

	protected function _register_controls()
	{
		global $tws_product_categories;

		$option_values = array();
		foreach ($tws_product_categories as $key => $value) {
			$option_values[$key] = $value['name'];
		}
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Omar Category Card', 'elementor-list-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Custom Title Control
		$this->add_control(
			'custom_text',
			[
				'label' => __('Custom Name for Category', 'your-text-domain'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Custom Category Title', 'elementor-custom-card-widget'),
			]
		);


		$this->add_control(
			'select_option',
			[
				'label' => __('Select Option', 'elementor-custom-select-widget'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'option_1', // Set the default value
				'options' => $option_values,
			]
		);
		// Add image control
		$this->add_control(
			'image',
			[
				'label' => __('Image', 'elementor-custom-card-widget'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'link',
			[
				//				'url' => 
				'label' => __('Custom Product Category Link', 'elementor-custom-card-widget'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-custom-product-cat-link.com', 'elementor-custom-card-widget'),
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings();
		global $tws_product_categories;
		global $tws_product_cats_id_and_slug;
		$product_cat_link = $settings['link']['url'];
		$current_category_parent_slug = '';
		$current_category_slug = $settings['select_option'];
		$current_category_parent_id = $tws_product_categories[$current_category_slug]['parent_id'];
		$current_category_display_name = empty($settings['custom_text']) ? $tws_product_categories[$settings['select_option']]['name'] : $settings['custom_text'];

		if (empty($settings['link']['url'])) {
			$product_cat_link = '/shop/?product_cat=';
			if ($current_category_parent_id != 0) {
				$current_category_parent_slug = $tws_product_cats_id_and_slug[$current_category_parent_id]['slug'];
				$product_cat_link .= $current_category_parent_slug;
				$product_cat_link .= "+";
			}
			$product_cat_link .= $current_category_slug;
		}


		// Output the card with the specified controls
		echo '<a href="' . esc_url($product_cat_link) . '" target="' . esc_attr($settings['link']['is_external'] ? '_blank' : '_self') . '">';

		echo '<div class="custom-card">';

		if (!empty($settings['image']['url'])) {
			echo '<img loading="lazy" style="height: 220px; width:100%; object-fit: cover;" src="' . esc_attr($settings['image']['url'])  . '" alt="' . esc_attr($settings['title']) . ' Image">';
		}

		

		echo '<p style="text-align:center; font-size: 18px; margin-top:20px">' . esc_html($current_category_display_name) . ' (' . esc_html($tws_product_categories[$settings['select_option']]['count']) . ')</p>';

		echo '</div>';

		echo '</a>';
	}
}
