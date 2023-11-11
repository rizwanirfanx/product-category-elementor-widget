<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Select_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom-select-widget';
    }

    public function get_title() {
        return __('Custom Select Widget', 'text-domain');
    }

    public function get_icon() {
        return 'fa fa-list'; // You can change the icon.
    }

    public function get_categories() {
        return ['basic']; // Choose a category for your widget.
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Select Control', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_value',
            [
                'label' => __('Select Value', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => __('Option 1', 'text-domain'),
                    '2' => __('Option 2', 'text-domain'),
                    '3' => __('Option 3', 'text-domain'),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $selected_value = $settings['select_value'];

        echo '<div class="custom-select-widget">';
        echo '<p>Selected Value: ' . esc_html($selected_value) . '</p>';
        echo '</div>';
    }
}


