<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Wp_Noticeboard
 * @subpackage Wp_Noticeboard/public
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main wp-noticeboard" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					endif;
				?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading %s', WP_NOTICEBOARD_TEXTDOMAIN ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', WP_NOTICEBOARD_TEXTDOMAIN ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', WP_NOTICEBOARD_TEXTDOMAIN ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</div><!-- .entry-content -->


			<footer class="entry-footer">
				<?php
				if ( in_array( get_post_type(), array( 'wp_noticeboard') ) ) {
					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

					$time_string = sprintf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						get_the_date(),
						esc_attr( get_the_modified_date( 'c' ) ),
						get_the_modified_date()
					);

					printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
						_x( 'Posted on', 'Used before publish date.', WP_NOTICEBOARD_TEXTDOMAIN ),
						esc_url( get_permalink() ),
						$time_string
					);
				}

				if ( 'wp_noticeboard' == get_post_type() ) {
					if ( is_singular() || is_multi_author() ) {
						printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
							_x( 'Author', 'Used before post author name.', WP_NOTICEBOARD_TEXTDOMAIN ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					}

					$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfifteen' ) );
					if ( $categories_list && twentyfifteen_categorized_blog() ) {
						printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
							_x( 'Categories', 'Used before category names.', WP_NOTICEBOARD_TEXTDOMAIN ),
							$categories_list
						);
					}

					$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfifteen' ) );
					if ( $tags_list ) {
						printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
							_x( 'Tags', 'Used before tag names.', WP_NOTICEBOARD_TEXTDOMAIN ),
							$tags_list
						);
					}
				}

				?>
				<?php edit_post_link( __( 'Edit', WP_NOTICEBOARD_TEXTDOMAIN), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->


		<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', WP_NOTICEBOARD_TEXTDOMAIN ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', WP_NOTICEBOARD_TEXTDOMAIN ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', WP_NOTICEBOARD_TEXTDOMAIN ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', WP_NOTICEBOARD_TEXTDOMAIN ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
