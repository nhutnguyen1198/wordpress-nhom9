<?php
/**
 * Online Education Classes Theme Customizer Helper Functions
 *
 * @package Online Education Classes
 */

/**
* Render callback for site title
* 
* @return void
*/
function online_education_classes_site_title_callback() {
    bloginfo( 'name' );
}

/**
* Render callback for site description
* 
* @return void
*/
function online_education_classes_site_description_callback() {
    bloginfo( 'description' );
}

/**
 * Check if the single post no sidebar is enabled or not
 */
function online_education_classes_single_post_no_sidebar_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_blog_single_sidebar_layout' )->value() == "no" ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the single post no sidebar is enabled & full width disabled
 */
function online_education_classes_single_post_no_sidebar_enable_full_width_disable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_blog_single_sidebar_layout' )->value() == "no" && $control->manager->get_setting( 'online_education_classes_enable_single_post_full_width' )->value() == false  ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the menu sidebar is enabled or not
 */
function online_education_classes_menu_sidebar_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_enable_menu_left_sidebar' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the category archive settigns is enabled or not
 */
function online_education_classes_cat_archive_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_enable_cat_archive_settings' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the normal header is selected
 */
function online_education_classes_select_header_styles_callback( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_select_header_styles' )->value() == "style1" ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the page title disabled or not
 */
function online_education_classes_page_title_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_enable_page_title' )->value() == true) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the color radio enabled or not in page title section
 */
function online_education_classes_page_title_color_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_page_bg_radio' )->value() == 'color' && $control->manager->get_setting( 'online_education_classes_enable_page_title' )->value() == true) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the image radio enabled or not in page title section
 */
function online_education_classes_page_title_image_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_page_bg_radio' )->value() == 'image' && $control->manager->get_setting( 'online_education_classes_enable_page_title' )->value() == true) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the footer copyrights links enabled or not
 */
function online_education_classes_footer_copyrights_links_enable( $control ) {
	if ( $control->manager->get_setting( 'online_education_classes_footer_enable_footer_links' )->value() == true) {
		return true;
	} else {
		return false;
	}
}