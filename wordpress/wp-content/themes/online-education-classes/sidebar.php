<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Online Education Classes
 */


?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #secondary -->

<?php if ( ! is_active_sidebar( 'primary-sidebar' ) ) { ?>

	<aside id="secondary" class="widget-area" role="complementary">
		<!-- Search -->
		<aside id="search-3" class="widget widget_search">
			<h2 class="widget-title"><?php esc_html_e('Search Here', 'online-education-classes'); ?></h2>
			<?php get_search_form(); ?>
		</aside>
		<!-- Categories -->
		<aside id="categories" class="widget widget_categories" role="complementary" aria-label="<?php esc_attr_e( 'secondsidebar', 'online-education-classes' ); ?>">
		    <h2 class="widget-title"><?php esc_html_e('Categories', 'online-education-classes'); ?></h2>
		    <ul>
		        <?php
		        $args = array(
		            'title_li' => '',
		        );
		        wp_list_categories($args);
		        ?>
		    </ul>
		</aside>
		<!-- Archive -->
		<aside id="archive" class="widget widget_archive" role="complementary" aria-label="<?php esc_attr_e( 'secondsidebar', 'online-education-classes' ); ?>">
		    <h2 class="widget-title"><?php esc_html_e('Archive List', 'online-education-classes'); ?></h2>
		    <ul>
		        <?php wp_get_archives('type=monthly'); ?>
		    </ul>
		</aside>
		<!-- Tag Sidebar -->
		<aside id="tag-sidebar" class="widget widget_tag_cloud" role="complementary" aria-label="<?php esc_attr_e( 'thirdsidebar', 'online-education-classes' ); ?>">
		    <h2 class="widget-title"><?php esc_html_e('Popular Tags', 'online-education-classes'); ?></h2>
		    <div class="tagcloud">
		        <?php
		        $online_education_classes_tags = get_tags(array(
		            'orderby' => 'count',
		            'order'   => 'DESC',
		            'number'  => 20, // You can change the number of tags displayed
		        ));

		        if ($online_education_classes_tags) {
		            foreach ($online_education_classes_tags as $online_education_classes_tag) {
		                $online_education_classes_tag_link = get_tag_link($online_education_classes_tag->term_id);
		                $online_education_classes_tag_name = $online_education_classes_tag->name;
		                $online_education_classes_tag_count = $online_education_classes_tag->count;
		                echo '<a href="' . esc_url($online_education_classes_tag_link) . '" class="tag-link" title="' . esc_attr($online_education_classes_tag_name) . ' (' . $online_education_classes_tag_count . ' posts)">' . esc_html($online_education_classes_tag_name) . '</a> ';
		            }
		        } else {
		            echo '<p>' . esc_html__('No tags found.', 'online-education-classes') . '</p>';
		        }
		        ?>
		    </div>
		</aside>	
	</aside>

<?php } ?>
