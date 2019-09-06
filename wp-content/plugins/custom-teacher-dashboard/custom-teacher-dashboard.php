<?php
/*
Plugin Name: Custom teacher dashboard
Plugin URL: http://www.softspring.es Description: A nice plugin to create your custom dashboard page to bmaker teachers
Version: 0.1
Author: Softspring
Author URI: http://www.softspring.es
Text Domain: rc_scd
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
    define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/

class rc_custom_teacher_dashboard {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    /**
     * Initializes the plugin
     */
    function __construct() {

        add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
        add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
        add_filter( 'admin_footer_text',  array( &$this,'wpexplorer_remove_footer_admin') );
        add_action('admin_enqueue_scripts',  array( &$this,'ds_admin_theme_style') );
        add_action('login_enqueue_scripts',  array( &$this,'ds_admin_theme_style') );
        add_action( 'wp_before_admin_bar_render', array( &$this,'admin_bar_remove_logo') );

    } // end constructor

    function rc_scd_redirect_dashboard() {
        if( is_user_logged_in() ) {
            $user = wp_get_current_user();
            $user_roles = ( array )$user->roles;
           if(in_array("teacher", $user_roles)){
               if( is_admin() ) {
                    $screen = get_current_screen();
                    if( $screen->base == 'dashboard' ) {
                        wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );
                    }
                }
           }
        }

    }

    function admin_bar_remove_logo() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu( 'wp-logo' );
    }
    function ds_admin_theme_style() {
        if (!current_user_can( 'manage_options' )) {
            echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none;} .welcome-panel-column { box-sizing: border-box;padding-right: 20px;} .wp-core-ui .welcome-panel-column .button-link{padding: 5px 0px ;}</style>';
        }
    }

    function rc_scd_register_menu() {
        add_dashboard_page( 'Custom Dashboard', '', 'read', 'custom-dashboard', array( &$this,'rc_scd_create_dashboard') );
    }

    function rc_scd_create_dashboard() {
        include_once( 'custom_dashboard.php'  );
    }

    function wpexplorer_remove_footer_admin () {
        echo '';
    }
}

// instantiate plugin's class
$GLOBALS['custom_teacher_dashboard'] = new rc_custom_teacher_dashboard();