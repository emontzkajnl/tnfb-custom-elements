<?php

/*
Plugin Name: TFBF Custom Blocks
Plugin URI: https://wpcodeus.com/
Description: Adds custom elements for the Page Builder.
Author: Richard Stevens
Version: 1.0.0
Author URI: https://jnlcom.com
*/


// If this file is called directly, abort

if ( ! defined( 'ABSPATH' ) ) {
     die ('Silly human what are you doing here');
}


// Before VC Init

add_action( 'vc_before_init', 'wpc_vc_before_init_actions' );

function wpc_vc_before_init_actions() {

// Require new custom Element

include( plugin_dir_path( __FILE__ ) . 'tnfb-custom-elements-element.php');
include( plugin_dir_path( __FILE__ ) . 'tnfb-latest-news.php');
include( plugin_dir_path( __FILE__ ) . 'program_links.php');
include( plugin_dir_path( __FILE__ ) . 'tnfb-calameo-library.php');
include( plugin_dir_path( __FILE__ ) . 'tnfb-calemeo.php');

// include( plugin_dir_path( __FILE__ ) . 'tnfb_block_class.php');
// include( plugin_dir_path( __FILE__ ) . 'tnfb-hello-world.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_big_grid_5.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_1.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_5.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_11.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_12.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_14.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_21.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_text_with_title.php');
include( plugin_dir_path( __FILE__ ) . 'td_block_image_box.php');
include( plugin_dir_path( __FILE__ ) . 'news-ticker.php');

}

// Link directory stylesheet

function wpc_community_directory_scripts() {
    wp_enqueue_style( 'wpc_community_directory_stylesheet',  plugin_dir_url( __FILE__ ) . 'styles/tnfb-custom-styles.css' );
}
add_action( 'wp_enqueue_scripts', 'wpc_community_directory_scripts' );

function tnfb_custom_element_scripts() {
    wp_enqueue_script( 'tnfb-custom-elements', plugin_dir_url( __FILE__ )  . 'js/custom-elements.js', array('jquery') , null, true);
    wp_localize_script( 'tnfb-custom-elements', 'tnfb_custom_elements_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        // 'nonce' => wp_create_nonce( 'tnfb_custom_elements_obj' ),
    ) );
  }
  
  add_action( 'wp_enqueue_scripts', 'tnfb_custom_element_scripts' );

//   wp_localize_script( 'visualcomposerstarter-script', 'visualcomposerstarter', array(
//     'ajax_url' => admin_url( 'admin-ajax.php' ),
//     'nonce' => wp_create_nonce( 'visualcomposerstarter' ),
//     'woo_coupon_form' => get_theme_mod( 'woocommerce_coupon_from', false ),
// ) );