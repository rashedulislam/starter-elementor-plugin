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

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'text_domain' ),
			]
		);

		

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>


		<?php
	}

	protected function _content_template() { ?>

    
		<?php
	}
}
