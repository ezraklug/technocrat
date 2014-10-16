<?php
/**
 * Template Name: Contact form
 *
 * Description: Use this page template for your contact form.
 *
 * @package WordPress
 * @subpackage Pendrell
 * @since Pendrell 0.4
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
          <header class="entry-header">
            <?php pendrell_entry_title(); ?>
          </header>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
          <div id="contact-form-wrapper">
            <h3><a name="contact-form"></a><?php _e( 'Contact form', 'pendrell' ); ?></h3>
            <form id="contact-form" class="comment-form" method="post" action="" enctype="application/x-www-form-urlencoded">
              <p class="comment-notes"><?php _e( 'Required fields are marked <span class="required">*</span>', 'pendrell' ); ?></p>

              <label for="from"><?php _e( 'Name', 'pendrell' ); ?> <span class="required">*</span></label>
              <input id="from" name="from" type="text" placeholder="<?php esc_attr_e( 'Your name', 'pendrell' ); ?>" value="" />

              <label for="email"><?php _e( 'Email', 'pendrell' ); ?> <span class="required">*</span></label>
              <input id="email" name="email" type="text" placeholder="<?php esc_attr_e( 'your@email.com', 'pendrell' ); ?>" value="" />

              <label for="subject"><?php _e( 'Subject', 'pendrell' ); ?></label>
              <input id="subject" name="subject" type="text" placeholder="<?php _e( 'What is this about?', 'pendrell' ); ?>" value="" />

              <label for="text"><?php _e( 'Message', 'pendrell' ); ?></label>
              <textarea id="message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Your message&#x0085;', 'pendrell' ); ?>"></textarea>

              <input type="checkbox" id="cc" name="cc" value="1" />
              <label for="cc" style="display: inline;"><?php _e( 'Send a copy to yourself', 'pendrell' ); ?></label>

              <div style="display: none;">
                <label for="text"><?php _e( 'Spam protection; don\'t fill this', 'pendrell' ); ?></label>
                <input name="hades" type="text" />
              </div>

              <?php wp_nonce_field( 'form_submit', 'contact_form_nonce' ) ?>

              <div class="form-submit">
                <input id="submit" name="submit" type="submit" value="<?php esc_attr_e( 'Send message', 'pendrell' ); ?>" />
              </div>
            </form>
          </div>
        </article>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>