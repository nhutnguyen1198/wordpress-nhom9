<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function online_education_classes_posted_on() {
	$online_education_classes_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$online_education_classes_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>&nbsp;<span>Updated on</span> <time class="updated" datetime="%3$s">%4$s</time>';
	}

	$online_education_classes_time_string = sprintf( $online_education_classes_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_attr( get_the_modified_date() )
	);

	$online_education_classes_posted_on = sprintf(
		esc_html_x(/* translators: %s: Post date with permalink */ 'Posted on %s', 'post date', 'online-education-classes' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $online_education_classes_time_string . '</a>'
	);

	$online_education_classes_byline = sprintf(
		esc_html_x(/* translators: %s: Post author name with a link */ 'by %s', 'post author', 'online-education-classes' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_attr( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $online_education_classes_posted_on . '</span><span class="byline"> ' . $online_education_classes_byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'online_education_classes_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function online_education_classes_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$online_education_classes_categories_list = get_the_category_list( esc_html__( ', ', 'online-education-classes' ) );
		if ( $online_education_classes_categories_list && online_education_classes_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__(/* translators: %1$s: Category list */ 'Posted in %1$s', 'online-education-classes' ) . '</span>', $online_education_classes_categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$online_education_classes_tags_list = get_the_tag_list( '', esc_html__( ', ', 'online-education-classes' ) );
		if ( $online_education_classes_tags_list ) {
			printf( '<span class="tags-links">' . __(/* translators: %1$s: Tag list */ 'Tagged %1$s', 'online-education-classes' ) . '</span>', $online_education_classes_tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'online-education-classes' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'online-education-classes' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function online_education_classes_categorized_blog() {
	if ( false === ( $online_education_classes_all_the_cool_cats = get_transient( 'online_education_classes_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$online_education_classes_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$online_education_classes_all_the_cool_cats = count( $online_education_classes_all_the_cool_cats );

		set_transient( 'online_education_classes_categories', $online_education_classes_all_the_cool_cats );
	}

	if ( $online_education_classes_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so online_education_classes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so online_education_classes_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in online_education_classes_categorized_blog.
 */
function online_education_classes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'online_education_classes_categories' );
}
add_action( 'edit_category', 'online_education_classes_category_transient_flusher' );
add_action( 'save_post',     'online_education_classes_category_transient_flusher' );


if ( ! function_exists( 'online_education_classes_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function online_education_classes_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;