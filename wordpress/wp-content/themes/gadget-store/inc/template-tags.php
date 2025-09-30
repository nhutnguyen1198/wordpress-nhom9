<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gadget Store
 */

if ( ! function_exists( 'gadget_store_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gadget_store_posted_on() {
	$gadget_store_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$gadget_store_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$gadget_store_time_string = sprintf( $gadget_store_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$gadget_store_posted_on = sprintf(
		/* translators: %s: Date. */
		esc_html_x( 'Posted on %s', 'post date', 'gadget-store' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $gadget_store_time_string . '</a>'
	);

	$gadget_store_byline = sprintf(
		/* translators: %s: by. */
		esc_html_x( 'by %s', 'post author', 'gadget-store' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on">' . $gadget_store_posted_on . '</span><span class="byline"> ' . $gadget_store_byline . '</span>'; // WPCS: XSS OK.
}
endif;


if ( ! function_exists( 'gadget_store_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function gadget_store_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$gadget_store_categories_list = get_the_category_list( esc_html__( ', ', 'gadget-store' ) );
		if ( $gadget_store_categories_list && gadget_store_categorized_blog() ) {
			/* translators: %1$s: Posted. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'gadget-store' ) . '</span>', $gadget_store_categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$gadget_store_tags_list = get_the_tag_list( '', esc_html__( ', ', 'gadget-store' ) );
		if ( $gadget_store_tags_list ) {
			/* translators: %1$s: Tagged. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'gadget-store' ) . '</span>', $gadget_store_tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'gadget-store' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'gadget-store' ),
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
function gadget_store_categorized_blog() {
	if ( false === ( $gadget_store_all_the_cool_cats = get_transient( 'gadget_store_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$gadget_store_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$gadget_store_all_the_cool_cats = count( $gadget_store_all_the_cool_cats );

		set_transient( 'gadget_store_categories', $gadget_store_all_the_cool_cats );
	}

	if ( $gadget_store_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gadget_store_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gadget_store_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gadget_store_categorized_blog.
 */
function gadget_store_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gadget_store_categories' );
}
add_action( 'edit_category', 'gadget_store_category_transient_flusher' );
add_action( 'save_post',     'gadget_store_category_transient_flusher' );

/**
 * Register Google fonts.
 */
function gadget_store_google_font() {
	$font_url      = '';
	$gadget_store_font_family   = array(
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900'
	);
	
	$gadget_store_fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $gadget_store_font_family ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	$gadget_store_contents = wptt_get_webfont_url( esc_url_raw( $gadget_store_fonts_url ) );
	return $gadget_store_contents;
}

function gadget_store_scripts_styles() {
    wp_enqueue_style( 'gadget-store-fonts', gadget_store_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'gadget_store_scripts_styles' );

/**
 * Register Breadcrumb for Multiple Variation
 */
function gadget_store_breadcrumbs_style() {
	get_template_part('./template-parts/sections/section','breadcrumb');
}

/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'gadget_store_post_layout' )) :
function gadget_store_post_layout(){
	if(is_active_sidebar('gadget-store-sidebar-primary'))
		{ echo 'col-lg-8'; } 
	else 
		{ echo 'col-lg-12'; }  
} endif;