<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function wps_enqueue_scripts() {
		if ( !is_admin() ) {
			wp_enqueue_script( 'wps-visitor-counter', plugin_dir_url( __FILE__ ) . 'styles/js/custom.js', array( 'jquery' ), '1.4.9', false );
			$params = array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'ajax_nonce' => wp_create_nonce('wps-nonce'),
			);
			wp_localize_script( 'wps-visitor-counter', 'wpspagevisit', $params );
		}

		wp_enqueue_style( 'wps-visitor-style', plugin_dir_url( __FILE__ ) . 'styles/css/default.css', array(), '1.4.9' );
	}

	
add_action( 'wp_enqueue_scripts', 'wps_enqueue_scripts',100 );
add_action( 'admin_enqueue_scripts', 'wps_enqueue_scripts',100 );



add_action('wp_ajax_wps_count_page_visit', 'wps_count_page_visit');
add_action('wp_ajax_nopriv_wps_count_page_visit', 'wps_count_page_visit');
function wps_count_page_visit() {
	check_ajax_referer( 'wps-nonce', 'nonce' );

	if (!wp_doing_ajax()) {
		wp_die('Invalid request');
	}

	global $wpdb;
	$ip = wps_getRealIpAddr(); // Getting the user's computer IP
	$date = current_time('Y-m-d'); // Getting the current date in WordPress timezone
	$waktu = current_time('timestamp'); // Getting current timestamp

	// Use proper table name with prepare
	$table_name = WPS_VC_TABLE_NAME;
	$sql = $wpdb->prepare(
		"INSERT INTO `{$table_name}` (`ip`, `date`, `views`, `online`) VALUES (%s, %s, 1, %s) ON DUPLICATE KEY UPDATE `views` = `views` + 1, `online` = %s",
		$ip,
		$date,
		$waktu,
		$waktu
	);

	$wpdb->query($sql);
	wp_die();
}
?>