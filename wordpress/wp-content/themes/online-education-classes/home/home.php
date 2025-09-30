<?php
/**
 * Template Name: Home
 */

get_header();
?>

<main id="primary">
        
    <?php
        /**
         * Hook - online_education_classes_action_home_banner.
         *
         * @hooked online_education_classes_home_banner_section - 10
         */
        do_action( 'online_education_classes_action_home_banner' );

        /**
         * Hook - online_education_classes_action_learning_experiences.
         *
         * @hooked online_education_classes_learning_experiences_section - 10
         */
        do_action( 'online_education_classes_action_learning_experiences' );

        /**
         * Hook - online_education_classes_action_home_extra.
         *
         * @hooked online_education_classes_home_extra_section - 10
         */
        do_action( 'online_education_classes_action_home_extra' );
    ?>
    
</main>

<?php
get_footer();