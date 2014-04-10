<?php // ==== CONTENT ==== //

// Generate content title
function pendrell_title() {
  ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to ', 'pendrell' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a><?php
}



// Entry meta wrapper
function pendrell_entry_meta() {
  global $post;

  do_action( 'pendrell_entry_meta_before' );

  ?><div class="entry-meta-buttons">
    <?php edit_post_link( __( 'Edit', 'pendrell' ), ' <span class="edit-link button">', '</span>' );
    if ( comments_open() && !is_singular() && !post_password_required( $post->ID ) ) {
      ?> <span class="leave-reply button"><?php comments_popup_link( __( 'Respond', 'pendrell' ), __( '1 Response', 'pendrell' ), __( '% Responses', 'pendrell' ) ); ?></span><?php
    } ?>
  </div>
  <div class="entry-meta-main">
    <?php pendrell_entry_meta_generator(); ?>
  </div><?php

  do_action( 'pendrell_entry_meta_after' );
}



// Entry meta; bare bones version, mostly untested... refer to Ubik for the real deal
function pendrell_entry_meta_generator() {

  // Is Ubik active?
  if ( function_exists( 'ubik_content_entry_meta' ) ) {

    // Ubik entry meta magic
    ubik_content_entry_meta();

  // If Ubik isn't active let's just fallback to Twenty Twelve's entry meta implementation with small updates to conform to hAtom microformat standard
  } else {

    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', 'pendrell' ) );

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list( '', __( ', ', 'pendrell' ) );

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date post-date published updated" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );

    $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'pendrell' ), get_the_author() ) ),
      get_the_author()
    );

    // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    if ( $tag_list ) {
      $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'pendrell' );
    } elseif ( $categories_list ) {
      $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'pendrell' );
    } else {
      $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'pendrell' );
    }

    printf(
      $utility_text,
      $categories_list,
      $tag_list,
      $date,
      $author
    );
  }
}