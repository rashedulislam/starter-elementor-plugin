<?php

namespace PluginNamespace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_Name extends Widget_Base {

	public function get_name() {
		return 'widget-name';
	}

	public function get_title() {
		return __( 'Widget Name', 'text_domain' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_script_depends() {
		return [ 'text_domain' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'text_domain' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'text_domain' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'text_domain' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'text_domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'text_domain' ),
					'uppercase' => __( 'UPPERCASE', 'text_domain' ),
					'lowercase' => __( 'lowercase', 'text_domain' ),
					'capitalize' => __( 'Capitalize', 'text_domain' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="title">';
		echo $settings['title'];
		echo '</div>';
	}

	protected function _content_template() { ?>

		<div class="title">
			{{{ settings.title }}}
		</div>
    
		<?php
	}
}
