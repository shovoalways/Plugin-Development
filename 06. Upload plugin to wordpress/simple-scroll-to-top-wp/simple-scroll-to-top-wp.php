<?php
/**
 * Plugin Name:       Simple Scroll To Top WP
 * Plugin URI:        https://wordpress.org/plugins/simple-scroll-to-top-wp/
 * Description:       Simple Scroll to top plugin will help you to enable Back to Top button to your WordPress website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali Hossain
 * Author URI:        https://alihossain.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/shovoalways
 * Text Domain:       sstt
 */


  // Including CSS
  function sstt_enqueue_style(){
    wp_enqueue_style('sstt-style', plugins_url('css/sstt-style.css', __FILE__));
  }
  add_action( "wp_enqueue_scripts", "sstt_enqueue_style" );

  // Including JavaScript
  function sstt_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('sstt-plugin-script', plugins_url('js/sstt-plugin.js', __FILE__), array(), '1.0.0', 'true');
  }
  add_action( "wp_enqueue_scripts", "sstt_enqueue_scripts" );

  // jQuery Plugin Setting Activation
  function sstt_scroll_script(){
    ?>
      <script>
        jQuery(document).ready(function () {
          jQuery.scrollUp();
        });
      </script>
    <?php
}
add_action( "wp_footer", "sstt_scroll_script" );


// Plugin Customization Sattings
add_action( "customize_register", "sstt_scroll_to_top" );
function sstt_scroll_to_top($wp_customize){
  $wp_customize-> add_section('sstt_scroll_top_section', array(
    'title' => __('Scroll To Top', 'alihossain'),
    'description' => 'Simple Scroll to top plugin will help you to enable Back to Top button to your WordPress website.',
  ));

  $wp_customize ->add_setting('sstt_default_color', array(
    'default' => '#000000',
  ));
  $wp_customize->add_control('sstt_default_color', array(
      'label'   => 'Background Color',
      'section' => 'sstt_scroll_top_section',
      'type'    => 'color',
  ));
  // Adding Rounded Corner
  $wp_customize ->add_setting('sstt_rounded_corner', array(
    'default' => '5px',
    'description' => 'If you need fully rounded or circular then use 25px here.',
  ));
  $wp_customize->add_control('sstt_rounded_corner', array(
      'label'   => 'Rounded Corner',
      'section' => 'sstt_scroll_top_section',
      'type'    => 'text',
  ));
}

// Theme CSS Customization
function sstt_theme_color_cus(){
  ?>
  <style>
    #scrollUp {
    background-color: <?php print get_theme_mod("sstt_default_color"); ?>;
    border-radius: <?php print get_theme_mod("sstt_rounded_corner"); ?>;
  }
  </style>
  <?php 
}
add_action('wp_head', 'sstt_theme_color_cus');


?>