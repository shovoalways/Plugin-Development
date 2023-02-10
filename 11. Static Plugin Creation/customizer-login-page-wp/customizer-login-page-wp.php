<?php
/**
 * Plugin Name:       Customizer Login Page
 * Plugin URI:        https://wordpress.org/plugins/customizer-login-page-wp/
 * Description:       The Customizer Login Page plugin will help you to enable a custom login page to your WordPress website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali Hossain
 * Author URI:        https://alihossain.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       clpwp
 */


 /*
 * Plugin Option Page Function
 */
  function clpwp_add_theme_page(){
    add_menu_page( 'Login Option for Admin', 'Login Option', 'manage_options', 'clpwp-plugin-option', 'clpwp_create_page', 'dashicons-unlock', 101 );
  }
  add_action( 'admin_menu', 'clpwp_add_theme_page' );


  /**
   * Plugin Callback
   */
  function clpwp_create_page(){
    echo 'Plugin Option';
  }


  // Loading CSS file
function clpwp_login_enqueue_register(){
  wp_enqueue_style( 'clpwp_login_enqueue', plugins_url( 'css/clpwp-styles.css', __FILE__ ), false, "1.0.0");

}
add_action('login_enqueue_scripts', 'clpwp_login_enqueue_register');

// Changing Login form logo
function clpwp_login_logo_change(){
  ?>
  <style>
    #login h1 a, .login h1 a{
      background-image: url(<?php print plugin_dir_url( __FILE__ ) . '/img/logo-sm.png'; ?>);
    }
  </style>

  <?php
}
add_action( 'login_enqueue_scripts', 'clpwp_login_logo_change');

// Changing Login form logo url
function clpwp_login_logo_url_change(){
  return home_url();
}
add_filter( 'login_headerurl', 'clpwp_login_logo_url_change');

 ?>