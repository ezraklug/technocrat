<?php // ==== ASSETS ==== //

// These functions handle asset loading: scripts, styles, and fonts

// == SCRIPTS & STYLES == //

// Enqueue front-end scripts and styles; additional ideas to consider: https://github.com/roots/roots/blob/master/lib/scripts.php
if ( !function_exists( 'pendrell_enqueue_scripts' ) ) : function pendrell_enqueue_scripts() {

  $handle = 'pendrell-core';  // A generic script handle
  $script_name = '';          // Empty by default, may be populated by conditionals below
  $script_vars = array();     // An empty array that can be filled with variables to send to front-end scripts

  // Load minified scripts if debug mode is off
  if ( WP_DEBUG === true ) {
    $suffix = '';
  } else {
    $suffix = '.min';
  }



  // == CORE SCRIPTS == //

  // Figure out which script bundle to load based on various options set in `src/functions-config-defaults.php`
  // Note: bundles require less HTTP requests at the expense of addition caching hits when different scripts are requested

  // Ajaxinate (XN8): @TODO: phase out
  if ( PENDRELL_SCRIPTS_AJAXINATE ) {
    $script_name .= '-xn8';
  } // end XN8

  // Page load (PG8): doesn't play nice with XN8
  if ( PENDRELL_SCRIPTS_PAGELOAD && PENDRELL_SCRIPTS_AJAXINATE === false && ( is_archive() || is_home() || is_search() ) ) {
    $script_name .= '-pg8';

    global $wp_query;

    // What page are we on? And what is the pages limit?
    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

    // Non-destructively merge array and namespace custom variables
    $script_vars = array_merge( $script_vars, array(
      'PG8' => array(
        'startPage' => $paged,
        'maxPages'  => $max,
        'nextLink'  => next_posts($max, false)
    ) ) );
  } // end PG8

  // Picturefill (PF): responsive images; not setup for XN8
  if ( PENDRELL_MODULE_RESPONSIVE && PENDRELL_SCRIPTS_AJAXINATE === false ) {
    if ( is_404() || ( is_attachment() && !wp_attachment_is_image() ) ) { // Could also add certain post formats guaranteed not to have images
      // Nothing
    } else {
      $script_name .= '-pf';
    }
  } // end PF

  // Prism: code highlighting
  if ( PENDRELL_SCRIPTS_PRISM && !is_404() && !is_attachment() && !is_search()  )
    $script_name .= '-prism';

  // Default script name
  if ( empty( $script_name ) )
    $script_name = '-core';

  // Load theme-specific JavaScript bundles with versioning based on last modified time; http://www.ericmmartin.com/5-tips-for-using-jquery-with-wordpress/
  // These bundles are created with Gulp; see `/gulpfile.js`
  // The handle is the same for each bundle since we're only loading one script; if you load others be sure to provide a new handle
  wp_enqueue_script( $handle, get_stylesheet_directory_uri() . '/js/p' . $script_name . $suffix . '.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/p' . $script_name . $suffix . '.js' ), true );



  // == ADDITIONAL SCRIPTS == //

  // Contact form (CF1) variable setup
  if ( is_page_template( 'page-templates/contact-form.php' ) ) {
    wp_enqueue_script( 'pendrell-contact-form', get_stylesheet_directory_uri() . '/js/contact-form' . $suffix . '.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/contact-form' . $suffix . '.js' ), true );

    // Non-destructively merge array and namespace custom variables
    $script_vars = array_merge( $script_vars, array(
      'CF1' => array(
        'from'          => __( 'Please enter your name.', 'pendrell' ),
        'email'         => __( 'Enter your email.', 'pendrell' ),
        'invalidEmail'  => __( 'Enter a valid email address.', 'pendrell' ),
        'message'       => __( 'Please enter a message.', 'pendrell' ),
        'messageLength' => __( 'This message is too short.', 'pendrell' ),
        'formSent'      => __( 'Your request has been received.', 'pendrell' ),
        'formError'     => __( 'There was an error submitting your request: ', 'pendrell' )
    ) ) );
  }

  // Adds JavaScript to pages with the comment form to support sites with threaded comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );



  // == SCRIPT VARIABLES == //

  // This section sends variables to the front-end

  // Currently we don't need any front-end variables without $script_vars being populated
  if ( !empty( $script_vars ) ) {

    // Pass variables to JavaScript at runtime; see: http://codex.wordpress.org/Function_Reference/wp_localize_script
    wp_localize_script( $handle, 'pendrellVars', array_merge( array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' )
      ), $script_vars )
    );
  }



  // == STYLES == //

  // Register and enqueue our main stylesheet with versioning based on last modified time
  wp_register_style( 'pendrell-style', get_stylesheet_uri(), $dependencies = array(), filemtime( get_template_directory() . '/style.css' ) );
  wp_enqueue_style( 'pendrell-style' );



  // == FONTS == //

  // Google Web Fonts loader
  $font_url = pendrell_get_font_url();
  if ( !empty( $font_url ) ) {
    wp_enqueue_style( 'pendrell-fonts', esc_url_raw( $font_url ), array(), null );
  }

} endif;
if ( !is_admin() )
  add_action( 'wp_enqueue_scripts', 'pendrell_enqueue_scripts' );



// == GOOGLE FONTS == //

// Hack: simplify and customize Google font loading; reference Twenty Twelve for more advanced options
if ( !function_exists( 'pendrell_get_font_url' ) ) : function pendrell_get_font_url( $fonts = '' ) {
  $font_url = '';

  // Allows us to pass a Google web font declaration as needed
  if ( empty( $fonts ) )
    $fonts = PENDRELL_GOOGLE_FONTS ? PENDRELL_GOOGLE_FONTS : 'Open+Sans:400italic,700italic,400,700'; // Default back to Open Sans

  // Encode commas and pipe characters; explanation: http://www.designfordigital.com/2014/04/07/google-fonts-bad-value-css-validate/
  $fonts = str_replace( ',', '%2C', $fonts );
  $fonts = str_replace( '|', '%7C', $fonts );

  $protocol = is_ssl() ? 'https' : 'http';

  $font_url = "$protocol://fonts.googleapis.com/css?family=" . $fonts;

  return $font_url;
} endif;