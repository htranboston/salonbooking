<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

//Remove Profile Menu from Dashboard
function remove_profile_menu() {

remove_submenu_page('users.php', 'profile.php');
remove_menu_page('profile.php');
}

add_action('admin_menu', 'remove_profile_menu');

//Logout redirect
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( 'https://salonbooking.htswipe.com/' );
         exit();
}

//Redirect from profile.php
add_action( 'load-profile.php', function() {
	//admin won't be affected
    if( current_user_can( 'manage_options' ) ) return '';
	
    //redirect non managed users to home page
    if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/profile.php' )) {
        wp_redirect ( 'https://salonbooking.htswipe.com/' ); 
            exit();
    }	
} );