<?php
/**
 * Plugin Name: Custom Card List Widget
 * Description: An Elementor widget to display a list of cards with customizable image, title, and subtitle.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Custom_Card_List_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom-card-list-widget';
    }

    public function get_title() {
        return __('Custom Card List', 'text-domain');
    }

    public function get_icon() {
        return 'fa fa-id-card'; // You can change the icon.
    }

    public function get_categories() {
        return ['basic']; // Choose a category for your widget.
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Card List', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Card Title', 'text-domain'),
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Card Subtitle', 'text-domain'),
            ]
        );

        $this->add_control(
            'card_list',
            [
                'label' => __('Cards', 'text-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $card_list = $settings['card_list'];

        if (!empty($card_list)) {
            echo '<div class="custom-card-list">';
            foreach ($card_list as $card) {
                echo '<div class="custom-card">';
                echo '<img src="' . esc_url($card['image']['url']) . '" alt="' . esc_attr($card['title']) . '">';
                echo '<h2>' . esc_html($card['title']) . '</h2>';
                echo '<p>' . esc_html($card['subtitle']) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}


