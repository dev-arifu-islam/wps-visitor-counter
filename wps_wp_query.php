<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get and validate nonce from POST.
 *
 * @param string $action Nonce action.
 * @return bool True if nonce exists and is valid, false otherwise.
 */
function wps_vc_verify_post_nonce( $action ) {
	if ( ! isset( $_POST['_wpnonce'] ) ) {
		return false;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) );
	return (bool) wp_verify_nonce( $nonce, $action );
}

// phpcs:disable WordPress.Security.NonceVerification.Missing -- Nonce verification happens via wps_vc_verify_post_nonce() function.
if (isset($_POST['reset_wpsvc'])) {
	if (!current_user_can('manage_options')) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wps-visitor-counter' ) );
	}
	if ( wps_vc_verify_post_nonce( 'wps_table_reset' ) ) {
		wps_visitor_counter_truncate();
	}
	
}
if (isset($_POST['style_setting'])) {
	if (!current_user_can('manage_options')) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wps-visitor-counter' ) );
	}
	if ( wps_vc_verify_post_nonce( 'wps_my_front_end_style' ) ) {
		$image_styel="";
		$powerd_by= 0 ;
		if (isset($_POST['wps_visitor_counter_style'])) {
			$image_styel = sanitize_text_field( wp_unslash( $_POST['wps_visitor_counter_style'] ) );
		}
		if (isset($_POST['wps_visitor_counter_attribution'])) {
			$powerd_by= 1;
		}
		$id = 1;
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table name cannot be a placeholder.
		$prepared_sql = $wpdb->prepare( "UPDATE `" . WPS_VC_OPTIONS_TABLE_NAME . "` SET `show_powered_by` = %d, `style` = %s WHERE `id` = %d;", $powerd_by, $image_styel, $id );
		wps_update_query( $prepared_sql );
	}
}
if (isset($_POST['wps_view_setting'])) {
	if (!current_user_can('manage_options')) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wps-visitor-counter' ) );
	}
	if ( wps_vc_verify_post_nonce( 'wps_my_front_end_setting' ) ) {
	

		$wps_visitor_title="";
		if (isset($_POST['wps_visitor_title'])) {
			$wps_visitor_title = sanitize_text_field( wp_unslash( $_POST['wps_visitor_title'] ) );
		}
		$wps_visitor_font_color= "#ffffff" ;
		if (isset($_POST['wps_visitor_font_color'])) {
			$wps_visitor_font_color = sanitize_hex_color( wp_unslash( $_POST['wps_visitor_font_color'] ) );
		}
		if (isset($_POST['wps_visitor_user_start']) && $_POST['wps_visitor_user_start'] != "") {
			$wps_visitor_user_start=intval($_POST['wps_visitor_user_start']);
		}else{
			$wps_visitor_user_start= 1 ;
		}
		
		if (isset($_POST['wps_visitor_views_start']) && $_POST['wps_visitor_views_start'] != "") {
			$wps_visitor_views_start=intval($_POST['wps_visitor_views_start']);
		}else{
			$wps_visitor_views_start = 1;
		}
	    

	    $wps_display_field_setting="";

		$wps_visitor_today_user= "" ;
		if (isset($_POST['wps_visitor_today_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'today_user';
		}
		$wps_visitor_yesterday_user= "" ;
		if (isset($_POST['wps_visitor_yesterday_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'yesterday_user';
		}
		$wps_visitor_last7_day_user= "" ;
		if (isset($_POST['wps_visitor_last7_day_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'last7_day_user';
		}

		$wps_visitor_last30_day_user= "" ;
		if (isset($_POST['wps_visitor_last30_day_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'last30_day_user';
		}

		$wps_visitor_month_user= "" ;
		if (isset($_POST['wps_visitor_month_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'month_user';
		}
		$wps_visitor_year_user= "" ;
		if (isset($_POST['wps_visitor_year_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'year_user';
		}
		$wps_visitor_total_user= "" ;
		if (isset($_POST['wps_visitor_total_user'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'total_user';
		}
		$wps_visitor_today_view= "" ;
		if (isset($_POST['wps_visitor_today_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'today_view';
		}
		$wps_visitor_yesterday_view= "" ;
		if (isset($_POST['wps_visitor_yesterday_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'yesterday_view';
		}
		$wps_visitor_last7_day_view= "" ;
		if (isset($_POST['wps_visitor_last7_day_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'last7_day_view';
		}
		$wps_visitor_last30_day_view= "" ;
		if (isset($_POST['wps_visitor_last30_day_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'last30_day_view';
		}
		$wps_visitor_month_view= "" ;
		if (isset($_POST['wps_visitor_month_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'month_view';
		}
		$wps_visitor_year_view= "" ;
		if (isset($_POST['wps_visitor_year_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'year_view';
		}
		$wps_visitor_total_view= "" ;
		if (isset($_POST['wps_visitor_total_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'total_view';
		}
		$wps_visitor_online_view= "" ;
		if (isset($_POST['wps_visitor_online_view'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'online_view';
		}
		$wps_visitor_ip_display= "" ;
		if (isset($_POST['wps_visitor_ip_display'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'ip_display';
		}
		$wps_visitor_server_time= "" ;
		if (isset($_POST['wps_visitor_server_time'])) {
			$wps_display_field_setting= $wps_display_field_setting.','.'server_time';
		}


		$wps_visitor_wpsvc_align= "wps_visitor_wpsvc_align" ;
		if (isset($_POST['wps_visitor_wpsvc_align'])) {
			$wps_visitor_wpsvc_align = sanitize_text_field( wp_unslash( $_POST['wps_visitor_wpsvc_align'] ) );
		}
		$id = 1;
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table name cannot be a placeholder.
		$prepared_sql = $wpdb->prepare(
			"UPDATE `" . WPS_VC_OPTIONS_TABLE_NAME . "` SET `visitor_title` = %s, `font_color` = %s, `user_start` = %d, `views_start` = %d, `display_field` = %s, `visitor_wpsvc_align` = %s WHERE `id` = %d;", // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
			$wps_visitor_title,
			$wps_visitor_font_color,
			$wps_visitor_user_start,
			$wps_visitor_views_start,
			$wps_display_field_setting,
			$wps_visitor_wpsvc_align,
			$id
		);
		wps_update_query( $prepared_sql );
		
	}
}
// phpcs:enable WordPress.Security.NonceVerification.Missing



function wps_update_query($sql){
	global $wpdb;
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching,PluginCheck.Security.DirectDB.UnescapedDBParameter -- $sql is prepared by the caller.
	$wpdb->query( $sql );
	return true;
}
function wps_visitor_counter_truncate() {
	global $wpdb;
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Table name is a constant; direct query needed for table operations.
	if ( $wpdb->get_var( 'SHOW TABLES LIKE "' . WPS_VC_TABLE_NAME . '"' ) == WPS_VC_TABLE_NAME ) {
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Table name is a constant; TRUNCATE requires direct query.
		$wpdb->query( "TRUNCATE `" . WPS_VC_TABLE_NAME . "`;" );
	}
}

function wps_visitor_option_data($id){
	 		global $wpdb;
		  // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table name cannot be a placeholder.
		  $prepared_sql = $wpdb->prepare( "SELECT * FROM `" . WPS_VC_OPTIONS_TABLE_NAME . "` WHERE `id` = %d", $id );
		  // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- $prepared_sql is prepared above; caching not needed for options data.
		  $result = $wpdb->get_results( $prepared_sql, ARRAY_A );
		  return $result[0];
}
function wps_visitor_counter_activation_hook(){
	global $wpdb;
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Table name is a constant; direct query needed for table existence check during activation.
	if ( $wpdb->get_var( 'SHOW TABLES LIKE "' . WPS_VC_TABLE_NAME . '"' ) != WPS_VC_TABLE_NAME ) {
		$sql = "";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS `". WPS_VC_TABLE_NAME . "` (";
		$sql .= "`ip` varchar(45) NOT NULL default '',";
		$sql .= "`date` date NOT NULL,";
		$sql .= "`views` int(10) UNSIGNED NOT NULL default '1',";
		$sql .= "`online` varchar(255) NOT NULL,";
		$sql .= "PRIMARY KEY  (`ip`,`date`)";
		$sql .= ") ENGINE=InnoDB $charset_collate;";
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching,PluginCheck.Security.DirectDB.UnescapedDBParameter -- Table creation during activation requires direct query.
	$wpdb->query( $sql );
	}
	// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching -- Table name is a constant; direct query needed for table existence check during activation.
	if ( $wpdb->get_var( 'SHOW TABLES LIKE "' . WPS_VC_OPTIONS_TABLE_NAME . '"' ) != WPS_VC_OPTIONS_TABLE_NAME ) {
		$sql = "";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS `". WPS_VC_OPTIONS_TABLE_NAME . "` (";
		$sql .= "`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,";
		$sql .= "`display_field` VARCHAR(600) NOT NULL default ',today_user,yesterday_user,last7_day_user,last30_day_user,month_user,year_user,total_user,today_view,yesterday_view,last7_day_view,last30_day_view,month_view,year_view,total_view,online_view,ip_display,server_time',";
		$sql .= "`show_powered_by` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',";
		$sql .= "`font_color` VARCHAR(7) NOT NULL DEFAULT '#000000',";
		$sql .= "`style` VARCHAR(25) NOT NULL DEFAULT 'text/effect-white',";
		$sql .= "`visitor_title` VARCHAR(255) NOT NULL default 'Our Visitor',";
		$sql .= "`user_start` INT(10) UNSIGNED NOT NULL DEFAULT '1',";
		$sql .= "`views_start` INT(10) UNSIGNED NOT NULL DEFAULT '1',";
		$sql .= "`visitor_wpsvc_align` VARCHAR(25) NOT NULL DEFAULT 'center',";
		$sql .= "PRIMARY KEY (`id`)";
		$sql .= ") ENGINE=InnoDB $charset_collate;";
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching,PluginCheck.Security.DirectDB.UnescapedDBParameter -- Table creation during activation requires direct query.
	$wpdb->query( $sql );

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table name cannot be a placeholder.
		$prepared_sql = $wpdb->prepare( "INSERT INTO `" . WPS_VC_OPTIONS_TABLE_NAME . "`(`id`) VALUES (%d)", 1 );
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching,PluginCheck.Security.DirectDB.UnescapedDBParameter -- $prepared_sql is prepared above; direct query needed for initial data insertion during activation.
		$wpdb->query( $prepared_sql );
		
	}
}
?>