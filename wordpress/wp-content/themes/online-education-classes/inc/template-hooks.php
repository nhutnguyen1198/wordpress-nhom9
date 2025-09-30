<?php
/**
 * Custom template hooks for this theme.
 *
 * @package Online Education Classes
 */


/**
 * Before title meta hook
 */
if ( ! function_exists( 'online_education_classes_before_title' ) ) :
function online_education_classes_before_title() {
	do_action('online_education_classes_before_title');
}
endif;


/**
 * Before title content hook
 */
if ( ! function_exists( 'online_education_classes_before_title_content' ) ) :
	function online_education_classes_before_title_content() {
		do_action('online_education_classes_before_title_content');
	}
endif;


/**
 * After title content hook
 */
if ( ! function_exists( 'online_education_classes_after_title_content' ) ) :
	function online_education_classes_after_title_content() {
		do_action('online_education_classes_after_title_content');
	}
endif;


/**
 * After title meta hook
 */
if ( ! function_exists( 'online_education_classes_after_title' ) ) :
function online_education_classes_after_title() {
	do_action('online_education_classes_after_title');
}
endif;

/**
 * Single post content after meta hook
 */
if ( ! function_exists( 'online_education_classes_single_post_after_content' ) ) :
	function online_education_classes_single_post_after_content($postID) {
		do_action('online_education_classes_single_post_after_content',$postID);
	}
endif;