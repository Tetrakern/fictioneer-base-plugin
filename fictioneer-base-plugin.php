<?php
/**
 * Plugin Name: Fictioneer Base Plugin
 * Description: Example plugin for developers.
 * Version: 1.0.1
 * Requires at least: 6.1.0
 * Requires PHP: 7.4.0
 * Author: Tetrakern
 * Author URI: https://github.com/Tetrakern
 * Text Domain: FCNBP
 */

// No direct access!
defined( 'ABSPATH' ) OR exit;

// Version
define( 'FCNBP_VERSION', '1.0.1' );

// Text domain
define( 'FCNBP_TD', 'fcnbp' );

// =======================================================================================
// SETUP
// =======================================================================================

/**
 * Makes plugin meta fields protected
 *
 * This prevents the meta fields used by the plugin to be changed via the
 * editor interface. Alternatively, you could start them with an underscore
 * (e.g. _fcnbp_some_meta) to make use of the WP default protection.
 *
 * @since 1.0.0
 *
 * @param bool   $protected  Whether the meta key is considered protected.
 * @param string $meta_key   The meta key to check.
 *
 * @return bool  True if the meta key is protected, false otherwise.
 */

function fcnbp_make_plugin_meta_protected( $protected, $meta_key ) {
  if ( strpos( $meta_key, 'fcnbp_' ) === 0 ) {
    return true;
  }

  return $protected;
}
add_filter( 'is_protected_meta', 'fcnbp_make_plugin_meta_protected', 10, 2 );

/**
 * Checks for the Fictioneer (parent) theme, deactivates plugin if not found
 *
 * Any plugin made for the Fictioneer theme should only run with the theme
 * active to avoid errors.
 *
 * @since 1.0.0
 * @since 1.0.1 - Ensure deactivate_plugins() is defined.
 */

function fcnbp_check_theme() {
  // Setup
  $current_theme = wp_get_theme();

  // Child or parent theme?
  if ( $current_theme->parent() ) {
    $theme_name = $current_theme->parent()->get( 'Name' );
  } else {
    $theme_name = $current_theme->get( 'Name' );
  }

  // Theme name must be Fictioneer!
  if ( $theme_name !== 'Fictioneer' ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // Deactivate plugin
    deactivate_plugins( plugin_basename( __FILE__ ) );

    // Display an admin notice
    add_action( 'admin_notices', 'fcnbp_admin_notice_wrong_theme' );
  }
}
add_action( 'after_setup_theme', 'fcnbp_check_theme' );

/**
 * Show admin notice if plugin has been deactivated due to wrong theme
 *
 * @since 1.0.0
 */

function fcnbp_admin_notice_wrong_theme() {
  // Start HTML ---> ?>
  <div class="notice notice-error is-dismissible">
    <p><?php
      _e( 'The Fictioneer Base Plugin requires the Fictioneer theme or a child theme to be active. The plugin has been deactivated.', FCNBP_TD );
    ?></p>
  </div>
  <?php // <--- End HTML
}

/**
 * Adds plugin card to theme settings plugin tab
 *
 * @since 1.0.0
 */

function fcnbp_settings_card() {
  // Start HTML ---> ?>
  <div class="fictioneer-card fictioneer-card--plugin">
    <div class="fictioneer-card__wrapper">
      <h3 class="fictioneer-card__header"><?php _e( 'Fictioneer Base Plugin', FCNBP_TD ); ?></h3>
      <div class="fictioneer-card__content">

        <div class="fictioneer-card__row">
          <p><?php
            _e( '<strong>This is an example plugin.</strong> It is not meant for production, just as boilerplate to work off. Please replace any function prefixes, constants, names, and the text domain with your own.', FCNBP_TD );
          ?></p>
        </div>

        <div class="fictioneer-card__row fictioneer-card__row--meta">
          <?php printf( __( 'Version %s', FCNBP_TD ), FCNBP_VERSION ); ?>
          |
          <?php printf( __( 'By <a href="%s">Tetrakern</a>', FCNBP_TD ), 'https://github.com/Tetrakern' ); ?>
        </div>

      </div>
    </div>
  </div>
  <?php // <--- End HTML
}
add_action( 'fictioneer_admin_settings_plugins', 'fcnbp_settings_card' );

// =======================================================================================
// SCRIPTS AND STYLES
// =======================================================================================

/**
 * Enqueues styles and scripts on the frontend
 *
 * @since 1.0.0
 */

function fcnbp_enqueue_frontend_scripts() {
  // Styles
  // wp_enqueue_style(
  //   'fictioneer-base-plugin-styles',
  //   plugin_dir_url( __FILE__ ) . '/css/fictioneer-base-plugin.css',
  //   ['fictioneer-application'],
  //   FCNBP_VERSION
  // );

  // Scripts
  // wp_enqueue_script(
  //   'fictioneer-base-plugin-scripts',
  //   plugin_dir_url( __FILE__ ) . 'js/fictioneer-base-plugin.js',
  //   ['fictioneer-application-scripts'],
  //   FCNBP_VERSION,
  //   true
  // );
}
add_action( 'wp_enqueue_scripts', 'fcnbp_enqueue_frontend_scripts' );

/**
 * Enqueues styles and scripts in the admin
 *
 * @since 1.0.0
 *
 * @param string $hook_suffix  The current admin page.
 */

function fcnbp_enqueue_admin_scripts( $hook_suffix ) {
  // Only on the theme's plugin settings tab
  if ( $hook_suffix !== 'fictioneer_page_fictioneer_plugins' ) {
    return;
  }

  // Styles
  // wp_enqueue_style(
  //   'fictioneer-base-plugin-admin-styles',
  //   plugin_dir_url( __FILE__ ) . '/css/fictioneer-base-plugin-admin.css',
  //   ['fictioneer-admin-panel'],
  //   FCNBP_VERSION
  // );

  // Scripts
  // wp_enqueue_script(
  //   'fictioneer-base-plugin-admin-scripts',
  //   plugin_dir_url( __FILE__ ) . '/js/fictioneer-base-plugin-admin.js',
  //   ['fictioneer-utility-scripts'],
  //   FCNBP_VERSION,
  //   true
  // );
}
add_action( 'admin_enqueue_scripts', 'fcnbp_enqueue_admin_scripts' );

?>
