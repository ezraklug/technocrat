<?php // ==== CONFIGURATION (DEFAULT) ==== //

// Master switch for WP AJAX Page Load script
defined( 'PENDRELL_AJAX_PAGE_LOADER' )    || define( 'PENDRELL_AJAX_PAGE_LOADER', false );

// Baseline for the vertical rhythm; should match whatever is set in _base_config.scss (integer; required)
defined( 'PENDRELL_BASELINE' )            || define( 'PENDRELL_BASELINE', 30 );

// Number of columns in the layout; for use with Ubik Related and some other things; should match `/src/scss/config/_settings.scss`
defined( 'PENDRELL_COLUMNS' )             || define( 'PENDRELL_COLUMNS', 1 );

// Enqueue jQuery in the footer; may conflict with some plugins and configurations, use with caution
defined( 'PENDRELL_JQUERY_FOOTER' )       || define( 'PENDRELL_JQUERY_FOOTER', false );

// JPG quality setting; WordPress 4.5+ defaults to 82
defined( 'PENDRELL_JPEG_QUALITY' )        || define( 'PENDRELL_JPEG_QUALITY', 90 );

// Lazysizes switch
defined( 'PENDRELL_LAZYSIZES' )           || define( 'PENDRELL_LAZYSIZES', false );

// Lazysizes counter: number of images to display *before* applying lazy load code; set to 0 to disable
defined( 'PENDRELL_LAZYSIZES_COUNTER' )   || define( 'PENDRELL_LAZYSIZES_COUNTER', 1 );

// Master switch for post formats
defined( 'PENDRELL_MAGNIFIC' )            || define( 'PENDRELL_MAGNIFIC', false );

// Master switch for post formats
defined( 'PENDRELL_POST_FORMATS' )        || define( 'PENDRELL_POST_FORMATS', false );

// Master switch for Picturefill script
defined( 'PENDRELL_RESPONSIVE_IMAGES' )   || define( 'PENDRELL_RESPONSIVE_IMAGES', false );

// Master switch for Prism syntax highlighting script
defined( 'PENDRELL_SYNTAX_HIGHLIGHT' )    || define( 'PENDRELL_SYNTAX_HIGHLIGHT', false );
