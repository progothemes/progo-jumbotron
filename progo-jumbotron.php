<?php
/*
Plugin Name: ProGo Jumbotron
Plugin URI: https://github.com/progothemes/progo-jumbotron
Description: Inserts a "Jumbotron" full width content area in the ProGo Base masthead header area of the home page.
Version: 0.1.1
Author: ProGo
Author URI: http://www.progo.com
License: GPLv2 or later
*/

/**
 * Register our Jumbotron post type
 */
function progo_jumbotron_post_types() {
  // if the "ProGo Theme Options" admin menu page exists, add under there
  $in_menu = true;
  if ( function_exists( 'progobaseframework_add_admin' ) ) {
    $in_menu = 'progobase-theme-options';
    
    /*
     * per https://codex.wordpress.org/Function_Reference/register_post_type#Parameters
     * need to remove & re-add the menu hook with priority 9 (or less)
     * to fix menu order
     */
    remove_action('admin_menu', 'progobaseframework_add_admin');
    add_action('admin_menu', 'progobaseframework_add_admin', 9);
  }
  // register our Jumbotron CPT
  register_post_type( 'progo_jumbotron',
    array(
      'labels' => array(
        'name' => __( 'Jumbotron Blocks' ),
        'singular_name' => __( 'Jumbotron' )
      ),
      'description' => 'ProGo Jumbotron section blocks',
      'public' => true,
      'has_archive' => false,
      'exclude_from_search' => true,
      'show_in_menu' => $in_menu,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
    )
  );
  
  // inject our Jumbotron in the "pgb_block_header" area hook
  add_action( 'pgb_block_header', 'progo_jumbotron_display' );
  
  // remove the default ProGo Base header logo & tagline block
  remove_action( 'pgb_block_header', 'pgb_load_block_header' );
}
add_action( 'init', 'progo_jumbotron_post_types' );

/**
 * Return the $post of the Jumbotron to load
 * if you are on the front_page
 * Otherwise returns false
 */
function progo_jumbotron_load() {
  if ( is_front_page() ) {
    // Find the 1 Jumbotron?!
    $args1 = array(
      'post_type' => 'progo_jumbotron',
      // for now...
      'posts_per_page' => 1,
    );
    $jumbos = get_posts( $args1 );
    // and something...
    if ( count( $jumbos ) ) {
      return $jumbos[0];
    }
  } // else
  return false;
}

/**
 * add_action( 'pgb_block_header', 'progo_jumbotron_display' );
 *
 * Find the 1 Jumbotron and display it
 */
function progo_jumbotron_display() {
  // get the jumbotron to show..
  $the_post = progo_jumbotron_load();
  // that function determines whether or not to show, so if yes, then
  if ( $the_post !== false ) { 
    $the_bg = false;
    // see if we also show a background image
    if ( has_post_thumbnail( $the_post->ID ) ) {
      $the_bg = wp_get_attachment_url( get_post_thumbnail_id($the_post->ID) );
    }
    // and output the appropriate HTML
    ?>
    <div id="problogger-jumbotron">
      <div class="jumbotron" <?php if ( $the_bg !== false ) { echo 'style="background: url(' . $the_bg . ') no-repeat 50% 50%; background-size: cover;"'; } ?>>
        <div class="container">
          <?php echo apply_filters('the_content', $the_post->post_content); ?>
        </div>
      </div>
    </div>
    <?php 
  }  
}

/**
 * Inject our Jumbotron Blocks admin bar menu item
 * either under the "appearance" section
 * or under "ProGo Options" if it exists
 */
function progo_jumbotron_add_adminbar_menu() {
	global $wp_admin_bar;
  // only add the link for user(s) with the appropriate permissions
	if ( current_user_can( 'edit_theme_options' ) ) {
    // add our link to the Appearance menu
    $in_menu = 'appearance';
    // unless a ProGo menu is a better place to put it
    if ( function_exists('progobaseframework_add_adminbar_menu') ) {
      $in_menu = 'progobase-theme-options' : 
    }
    
		$wp_admin_bar->add_node( array(
			'parent' => $in_menu,
			'id'     => 'progo-jumbotron',
			'title'  => 'Jumbotron Blocks',
			'href'   => admin_url( 'edit.php?post_type=progo_jumbotron' ),
		) );
	}
}
add_action( 'admin_bar_menu', 'progo_jumbotron_add_adminbar_menu', 1000 );
