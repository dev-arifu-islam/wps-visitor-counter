<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class wps_visitor_counter extends WP_Widget{

	public function __construct(){
		$widget_ops = array(
			'classname' => 'wps_visitor_counter',
			'description' => __('Display Visitor Counter and Statistics Traffic in shortcode and widget', 'wps-visitor-counter'),
		);
		parent::__construct('wps_visitor_counter', __('WPS - Visitor Counter', 'wps-visitor-counter'), $widget_ops);
	}
	
	public function widget($args, $instance){
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Function returns escaped HTML.
		echo wps_add_visitor_counter();
	}
}