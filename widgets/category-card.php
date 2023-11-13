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
			$option_values[$key] = $value['slug'];
		}
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Omar Category Card', 'elementor-list-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		// Add title control
		// Add link control
		$this->add_control(
			'link',
			[
				'label' => __('Link', 'elementor-custom-card-widget'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'elementor-custom-card-widget'),
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		global $tws_product_categories;
		$settings = $this->get_settings();

		// Output the card with the specified controls
		echo '<a href="' . esc_url($settings['link']['url']) . '" target="' . esc_attr($settings['link']['is_external'] ? '_blank' : '_self') . '">';

		echo '<div class="custom-card">';

		if (!empty($settings['image']['url'])) {
//			echo '<img src="' . esc_url($settings['image']['url']) . '" alt="' . esc_attr($settings['title']) . '">';
			echo '<img loading="lazy" style="height: 220px; width:100%; object-fit: contain;" src="' . esc_attr($settings['image']['url'])  . '" alt="' . esc_attr($settings['title']) . ' Image">';
		}

		echo '<h2 style="text-align:center;">' . esc_html($tws_product_categories[$settings['select_option']]['name']) . ' (' . esc_html($tws_product_categories[$settings['select_option']]['count']) . ')</h2>';

		echo '</div>';

		echo '</a>';
	}
}
