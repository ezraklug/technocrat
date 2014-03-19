<?php // === NAVIGATION === //

// Hack: switch navigation links from "newer" and "older" to "next" and "previous"; solves UI problems with custom post ordering
function pendrell_content_nav( $html_id ) {
  global $wp_query;

  $html_id = esc_attr( $html_id );

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
      <h3 class="assistive-text"><?php _e( 'Post navigation', 'pendrell' ); ?></h3>
      <div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'pendrell' ) ); ?></div>
          <div class="nav-next"><?php next_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'pendrell' ) ); ?>
    </nav><!-- #<?php echo $html_id; ?> .navigation -->
  <?php endif;
}
