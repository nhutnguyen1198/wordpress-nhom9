<?php
/**
 * Typography Customizer Control
 */
class Online_Education_Classes_Font_Select_Control extends WP_Customize_Control {
    /**
     * Enqueue styles.
     *
     * @access public
     * @return void
     */
    public function enqueue() {
        wp_enqueue_style( 'online-education-classes-typo-control-css', get_parent_theme_file_uri( 'inc/customizer/custom-controls/typography/typo-css.css', array(), '1.0', 'all' ));
    }


    public $type = 'font_select';
    public function render_content() {
        if ( empty( $this->choices ) )
            return;

        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?>>
                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $this->value(), $value ); ?>>
                        <?php echo esc_html( $label ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="button" class="reset-font-button button button-primary" data-default="<?php echo esc_attr( $this->setting->default ); ?>">
            <?php esc_html_e( 'Reset', 'online-education-classes' ); ?>
        </button>
        <script>
        jQuery(document).ready(function($) {
            $('.reset-font-button').on('click', function() {
                var $select = $(this).siblings('label').find('select');
                var defaultVal = $(this).data('default');
                $select.val(defaultVal).trigger('change');
            });
        });
        </script>
        <?php
    }
}
