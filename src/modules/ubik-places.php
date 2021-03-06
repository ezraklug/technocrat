<?php // ==== UBIK PLACES ==== //

define( 'PENDRELL_PLACES_TEMPLATE_ID', false );
require_once( trailingslashit( get_stylesheet_directory() ) . 'modules/ubik-places/ubik-places.php' );



// Display breadcrumbs for the places taxonomy
function pendrell_places_breadcrumbs() {
  echo ubik_terms_breadcrumbs( '', 'places' );
}
add_action( 'pendrell_archive_header', 'pendrell_places_breadcrumbs', 15 );



// Display the Ubik Places sidebar; @TODO: turn this into a real widget
function pendrell_places_sidebar( $sidebar ) {
  if ( is_tax( 'places' ) ) {

    // Retrieve data from Ubik Places
    $widgets = ubik_places_list();

    // Only output places widget markup if we have results
    if ( !empty( $widgets ) ) {
      $sidebar = '';
      foreach ( $widgets as $key => $widget ) {
        $index = ''; // A simple hack to insert a link to the places index page
        if ( $key === ( count( $widgets ) - 1 ) && PENDRELL_PLACES_TEMPLATE_ID !== false )
          $index = '<li class="cat-item"><strong><a href="' . get_permalink( PENDRELL_PLACES_TEMPLATE_ID ) . '">' . __( 'All places', 'pendrell' ) . '</a></strong></li>';
        $sidebar .= '<aside id="ubik-places" class="widget places-' . strtolower( $widget['name'] ) . '"><h2>' . $widget['title'] . '</h2><ul class="place-list">' . $index . wp_list_categories( array_merge( $widget['args'], array( 'echo' => 0 ) ) ) . '</ul></aside>';
      }
    }
  }
  return $sidebar;
}
//add_filter( 'pendrell_sidebar', 'pendrell_places_sidebar' );



// Adds places to entry metadata right after other taxonomies; @DEPENDENCY: Ubik Terms
function pendrell_places_meta( $meta ) {
  if ( has_term( '', 'places' ) ) {

    // Initialize
    $sep = ', ';
    $after = '';

    // If there's only one term associated with the post let's add the inheritance chain; this was we get "Changhua, Taiwan" etc.
    if ( ubik_terms_count( '', 'places' ) === 1 ) {
      $after = apply_filters( 'pendrell_places_ancestors', ubik_places_ancestors() );
      if ( !empty( $after ) )
        $after = $sep . $after;
    }

    // Add to post metadata
    $meta .= sprintf( __( 'Places: %s. ', 'pendrell' ), ubik_meta_terms( 'places', $before = '', $sep, $after ) );
  }
  return $meta;
}
add_filter( 'ubik_meta_taxonomies', 'pendrell_places_meta' );



// Add schema.org data to places metadata
function pendrell_places_meta_schema( $links ) {
  $links = str_replace( 'rel="tag"', 'itemprop="contentLocation" itemscope itemtype="https://schema.org/Place"', $links );
  $links = str_replace( 'Place">', 'Place"><span itemprop="name">', $links );
  $links = str_replace( '</a>', '</span></a>', $links );
  return $links;
}
add_filter( 'term_links-places', 'pendrell_places_meta_schema' ); // Built-in
add_filter( 'pendrell_places_ancestors', 'pendrell_places_meta_schema' ); // Also handles ancestors on posts with only one place



// Return an array of top-most places complete with counts and links for the "places" page template
function pendrell_places_page_template() {

  // Initialize
  $top = array();

  // Retrieve a list of top-most taxonomy terms
  $parents = get_terms( 'places', array( 'fields' => 'ids', 'parent' => 0 ) );

  // Retrieve a list of all taxonomy terms with padded counts
  $places = get_terms( 'places', array( 'pad_counts' => true ) );

  // Loop through places with padded counts, only adding those that are also top-most terms
  foreach ( $places as $place ) {
    if ( in_array( $place->term_id, $parents ) ) {
      $place->link = get_term_link( $place );
      $top[] = $place;
    }
  }

  // Sort the results by count; @DEPENDENCY: Ubik Terms
  usort( $top, "ubik_terms_popular_sort" );

  return $top;
} // pendrell_places_page_template()



// Body class filter
function pendrell_places_body_class( $classes ) {
  if ( is_page_template( 'page-templates/places.php' ) )
    $classes[] = 'gallery-flex';
  return $classes;
}
add_filter( 'body_class', 'pendrell_places_body_class' );



// A simple function to put a single place name into the image overlay
function pendrell_places_image_overlay( $data = '', $id = '' ) {
  if ( has_term( '', 'places' ) && ubik_terms_count( '', 'places' ) === 1 ) {
    $places = wp_get_post_terms( $id, 'places' );
    if ( !empty( $places ) )
      $data = pendrell_image_overlay_wrapper( $places[0]->name . ' ' . pendrell_icon( 'places', __( 'Places', 'pendrell' ) ), 'top-right', 'place smaller' );
  }
  return $data;
}
//add_filter( 'pendrell_image_overlay_top_right', 'pendrell_places_image_overlay', 99, 2 );



// Add places to the views taxonomy
function pendrell_places_views( $taxonomies ) {
  $taxonomies[] = 'places';
  return $taxonomies;
}
add_filter( 'ubik_views_taxonomies', 'pendrell_places_views' );



// Adds place descriptions to the quick edit box
if ( PENDRELL_UBIK_QUICK_TERMS ) {
  function pendrell_places_quick_terms( $taxonomies ) {
    $taxonomies[] = 'places';
    return $taxonomies;
  }
  add_filter( 'ubik_quick_terms_taxonomies', 'pendrell_places_quick_terms' );
}



// Add places to photo metadata
// @filter: pendrell_places_photo_meta_city
// @filter: pendrell_places_photo_meta_country
function pendrell_places_photo_meta( $location = '', $d ) {

  // An array of possible places this photo may have been tagged with
  $places = array();

  // Attempt to add to the places array
  if ( ubik_photo_meta_set( 'city', $d ) )
    $places[] = apply_filters( 'pendrell_places_photo_meta_city', $d['city'], $d );
  if ( ubik_photo_meta_set( 'country', $d ) )
    $places[] = apply_filters( 'pendrell_places_photo_meta_country', $d['country'], $d );

  // Return existing location if nothing came up
  if ( empty( $places ) )
    return $location;

  // Implode and wrap in shortcodes
  $places = '[place]' . implode( '[/place], [place]', $places ) . '[/place]';

  // Return a formatted string
  return do_shortcode( $places ) . ' (' . $d['string_microdata_linked'] . ')';
}



// Modify the name of the city to handle certain edge cases
function pendrell_places_photo_meta_city( $city = '', $d ) {

  // Exit early if necessary
  if ( empty( $city ) )
    return;

  // Country may influence the following rules
  $country = '';
  if ( ubik_photo_meta_set( 'country', $d ) )
    $country = $d['country'];

  // Specific to Taiwan's geography
  if ( empty( $country ) || ( !empty( $country ) && $country === 'Taiwan' ) )
    $city = trim( str_replace( array( 'Township', 'District' ), '', $city ) );

  // Return what we have
  return $city;
}



// Activate the previous functions only if Ubik Photo Meta is defined
if ( PENDRELL_UBIK_PHOTO_META ) {
  add_filter( 'ubik_photo_meta_location_formatted', 'pendrell_places_photo_meta', 999, 2 );
  add_filter( 'pendrell_places_photo_meta_city', 'pendrell_places_photo_meta_city', '', 2 );
}
