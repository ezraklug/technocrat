<?php // ==== CONFIGURATION (CUSTOM) ==== //

// Refer to `functions-config-defaults.php` for default values; set custom values for your site here...

// Development mode
if ( WP_LOCAL_DEV === true ) {
  define( 'PENDRELL_AJAX_PAGE_LOADER', true );
  //define( 'PENDRELL_COLUMNS', 2 );
  define( 'PENDRELL_JQUERY_FOOTER', true );
  define( 'PENDRELL_LAZYSIZES', true );
  define( 'PENDRELL_LAZYSIZES_COUNTER', 3 );
  define( 'PENDRELL_MAGNIFIC', true );
  define( 'PENDRELL_POST_FORMATS', true );
  define( 'PENDRELL_RESPONSIVE_IMAGES', true );
  define( 'PENDRELL_SYNTAX_HIGHLIGHT', true );

  // Switch on most Ubik components for debugging
  define( 'PENDRELL_UBIK_ADMIN', true );
  define( 'PENDRELL_UBIK_ANALYTICS', true );
  define( 'PENDRELL_UBIK_EXCLUDER', false );
  define( 'PENDRELL_UBIK_FEED', true );
  define( 'PENDRELL_UBIK_LINGUAL', true );
  define( 'PENDRELL_UBIK_MARKDOWN', true );
  define( 'PENDRELL_UBIK_RELATED', true );
  define( 'PENDRELL_UBIK_SEO', true );
}
