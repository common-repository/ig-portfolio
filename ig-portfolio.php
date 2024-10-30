<?php
/**
 * Plugin Name:IG Portfolio
 * Plugin URI: http://www.iograficathemes.com/downloads/ig-portfolio
 * Description: IG Portfolio is a clean and simply project showcase management system for WordPress.
 * Version: 2.4
 * Author: iografica
 * Author URI: http://www.iograficathemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
//start class
if ( ! class_exists( 'IG_Portfolio' ) ) {    
//start
    class IG_Portfolio {
        public function __construct() { 
            add_action('wp_enqueue_scripts', array( $this, 'ig_portfolio_scripts' ));
            add_action('admin_enqueue_scripts', array( $this, 'ig_portfolio_admin_enqueue' ));
            add_action('admin_head', array( $this, 'ig_portfolio_mce_button' ));
            /* Includes */
            include ('includes/ig-portfolio-post-type.php');
            include ('includes/ig-portfolio-settings.php');
            include ('includes/ig-portfolio-function.php');
            include ('extra/ig-portfolio-category-widget.php');
            include ('extra/ig-portfolio-project-widget.php');
            include ('extra/ig-portfolio-project-details-widget.php');
            include ('extra/ig-portfolio-shortcodes.php');
            include ('welcome/welcome-screen.php');
          }

//Add portfolio scripts file
public function ig_portfolio_scripts() {
    wp_enqueue_style('ig-portfolio', plugins_url( 'ig-portfolio.css', __FILE__ ) );
}
        
//Add admin css
public function ig_portfolio_admin_enqueue($hook) {
    global $ig_portfolio_welcome_page;
    if ( $hook != $ig_portfolio_welcome_page ) {
        return;
    }
    wp_enqueue_style( 'ig-portfolio-admin', plugins_url( 'welcome/css/welcome.css', __FILE__ ) );
}
        
// Add shortcodes button
public function ig_portfolio_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', array( $this, 'ig_portfolio_tinymce_plugin') );
        add_filter( 'mce_buttons', array( $this, 'ig_portfolio_register_mce_button') );
    }
}
// Declare script for new button
public function ig_portfolio_tinymce_plugin( $plugin_array ) {
    $plugin_array['ig_portfolio_mce_button'] = plugins_url('/includes/mce-button.js', __FILE__);
    return $plugin_array;
}
// Register new button in the editor
public function ig_portfolio_register_mce_button( $buttons ) {
    array_push( $buttons, 'ig_portfolio_mce_button' );
    return $buttons;
}
        
    }//end class
    $igportfolio = new IG_Portfolio();
}//end if class exists

// Load plugin textdomain.
 add_action( 'plugins_loaded', 'ig_portfolio_load_textdomain' );
function ig_portfolio_load_textdomain() {
    load_plugin_textdomain( 'ig-portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}