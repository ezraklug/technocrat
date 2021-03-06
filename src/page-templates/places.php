<?php
/**
 * Template Name: Places
 *
 * Description: Use this in place of a base template for the places taxonomy.
 *
 * @package WordPress
 * @subpackage Pendrell
 * @since Pendrell 0.18
 */

get_header(); ?>
  <div id="wrap-content" class="wrap-content">
    <div id="content" class="site-content">
      <header class="main-header">
        <?php pendrell_main_title(); ?>
        <div class="main-desc">
          <?php the_content(); ?>
        </div>
      </header>
      <main>
        <?php // The following is a total hack; @TODO: code this properly
        $data = pendrell_places_page_template();
        if ( !empty( $data ) ) {

          // A hack to set thumbs for various places
          global $pendrell_places_thumbs;
          if ( !is_array( $pendrell_places_thumbs ) )
            $pendrell_places_thumbs = array();

          // Initialize thumbs
          $places = array();

          // Loop through all the top-most places
          foreach ( $data as $place ) {

            // Clear metadata
            $metadata = '';
            $place->thumb = '';

            // This is the really hacky part of things: manually assign thumbnails to specific places
            if ( array_key_exists( $place->term_id, $pendrell_places_thumbs ) )
              $place->thumb = $pendrell_places_thumbs[$place->term_id];

            // Additional metadata to pass to the image creation function; requires additional CSS styling for correct display
            if ( !empty( $place->count ) )
              $metadata = pendrell_image_overlay_wrapper( sprintf( _n( '1 post', '%s posts', $place->count, 'pendrell' ), $place->count ) . ' ' . pendrell_icon( 'places', __( 'Places', 'pendrell' ) ) );

            // Output a gallery of places
            $places[] = ubik_imagery(
              $html     = '',
              $id       = pendrell_thumbnail_id( $place->thumb ),
              $caption  = $place->name,
              $title    = '',
              $align    = '',
              $url      = $place->link,
              $size     = 'third-square',
              $alt      = '',
              $rel      = '',
              $class    = array( 'gallery-item', 'overlay', 'no-fade' ),
              $contents = $metadata,
              $context  = array( 'group', 'responsive' )
            );
          }

          // Output places thumbnails and metadata
          if ( !empty( $places ) )
            echo '<div class="gallery gallery-flex">' . join( $places ) . '</div>';

        } else {
          get_template_part( 'content', 'none' );
        } ?>
      </main>
    </div>
  </div>
<?php get_footer();