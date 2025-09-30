<?php
/**
 * @package Online Education Classes
 */

//Return if the first widget area has no widgets
if ( !is_active_sidebar( 'footer-1' ) ) {
	return;
} ?>

<?php //user selected widget columns

	$online_education_classes_widget_num = esc_html(get_theme_mod('online_education_classes_footer_widgets', '4'));
	
	if ($online_education_classes_widget_num == '4') :
		$online_education_classes_col1 ='col-md-3';
		$online_education_classes_col2 ='col-md-3';
		$online_education_classes_col3 ='col-md-3';
		$online_education_classes_col4 ='col-md-3';
	elseif ($online_education_classes_widget_num == '3') :
		$online_education_classes_col1 ='col-md-4';
		$online_education_classes_col2 ='col-md-4';
		$online_education_classes_col3 ='col-md-4';
		
	elseif ($online_education_classes_widget_num == '2') :
		 $online_education_classes_col1 ='col-md-6';
		 $online_education_classes_col2 ='col-md-6';
	else :
		$online_education_classes_col1 ='col-md-12';
	endif;
?>
		
<?php 
	if ( is_active_sidebar( 'footer-1' ) && ( $online_education_classes_widget_num == '4' || $online_education_classes_widget_num == '3' || $online_education_classes_widget_num == '2' || $online_education_classes_widget_num == '1')) :
		?>
			<div class="widget-column px-3 <?php echo esc_attr($online_education_classes_col1); ?>">
				<?php dynamic_sidebar( 'footer-1'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-2' ) && ( $online_education_classes_widget_num == '4' || $online_education_classes_widget_num == '3' || $online_education_classes_widget_num == '2')) :
		?>
			<div class="widget-column px-3 <?php echo esc_attr($online_education_classes_col2); ?>">
				<?php dynamic_sidebar( 'footer-2'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-3' ) && ( $online_education_classes_widget_num == '4' || $online_education_classes_widget_num == '3' )) :
		?>
			<div class="widget-column px-3 <?php echo esc_attr($online_education_classes_col3); ?>">
				<?php dynamic_sidebar( 'footer-3'); ?>
			</div>
		<?php
	endif;
	if ( is_active_sidebar( 'footer-4' ) && ( $online_education_classes_widget_num == '4' )) :
		?>
			<div class="widget-column px-3 <?php echo esc_attr($online_education_classes_col4); ?>">
				<?php dynamic_sidebar( 'footer-4'); ?>
			</div>
		<?php
	endif;
?>