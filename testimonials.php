<?php 
/*
  Plugin Name: WP Client Testimonials / Quotes
  Plugin URI: http://wp-plugins.staxx.nl/wp-client-testimonials
  Description: Plugin for managing client testimonials and quotes on your website.
  Author: J. Oldenburg
  Version: 0.3
  Author URI: http://staxx.nl
*/

register_activation_hook(__FILE__,'wpTestimonials_install'); 
function wpTestimonials_install () {
  global $wpdb;
  $table_name = $wpdb->prefix . "testimonials";
  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE " . $table_name . " (
      id int(10) NOT NULL AUTO_INCREMENT,
      name varchar(255) NOT NULL,
      quote text NOT NULL,
      PRIMARY KEY (id),
      KEY id (id)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}

load_plugin_textdomain('wp-client-testimonials', "/wp-content/plugins/wp-client-testimonials/languages/");

add_action('admin_menu', 'wpTestimonials_admin_actions');
function wpTestimonials_admin_actions() {
    add_options_page("wpTestimonials", "wpTestimonials", 1, "wpTestimonials", "wpTestimonials_admin");
}

function wpTestimonials_admin() {
	include('adminpanel.php');
}

function wpTestimonials_output() {
  global $wpdb;
  $user_count = $wpdb->get_results("SELECT * FROM wp_testimonials ORDER BY RAND() LIMIT 1");
  foreach ($user_count as $output) {
    $htmlOutput = "<div>";
    $htmlOutput .= "<em>" . $output->quote . "</em><br />";
    $htmlOutput .= "<strong> - " . $output->name . "</strong>";
    $htmlOutput .= "</div>";
  	return $htmlOutput;
  }
}

?>
