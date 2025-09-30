<?php
/**
 * Gadget Store
 * Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	// Define a custom control class for radio buttons with images
	class Gadget_Store_Image_Radio_Control extends WP_Customize_Control {

	    // Render the content of the custom control
	    public function render_content() {
	 
	        // Check if choices are available
	        if (empty($this->choices))
	            return;
	 
	        // Generate a unique name for the radio button group
	        $name = $this->id;
	        ?>
	        <!-- Display control title -->
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <!-- Container for radio button options -->
	        <ul class="controls" id='gadget-store-custom-container'>
	            <?php
	            // Loop through choices and render radio buttons with images
	            foreach ($this->choices as $value => $label) :
	                // Determine the selected class based on current value
	                $class = ($this->value() == $value) ? 'gadget-store-selected-img gadget-store-selector-img ' : 'gadget-store-selector-img';
	                ?>
	                <!-- Display each radio button option -->
	                <li style="display: inline;">
	                    <label>
	                        <!-- Radio input -->
	                        <input <?php $this->link(); ?> style='display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	$this->link();
	                          	checked($this->value(), $value);
	                          	?> />
	                        <!-- Image for the radio button -->
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>

			<script type="text/javascript">
				(function($) {
					$(document).ready(function() {
						$('#gadget-store-custom-container img').on('click', function() {
							var $this = $(this);
							var input = $this.prev('input');
							var inputName = input.attr('name');
	
							// Remove the 'gadget-store-selected-img' class from all images
							$('#gadget-store-custom-container img').removeClass('gadget-store-selected-img');
	
							// Add the 'gadget-store-selected-img' class to the clicked image
							$this.addClass('gadget-store-selected-img');
	
							// Set the input as checked
							input.prop('checked', true).trigger('change');
	
							// Optionally: Update the WordPress Customizer to reflect the change
							wp.customize.control(inputName).setting.set(input.val());
						});
					});
				})(jQuery);
			</script>
	        <?php
	    } 
	}	
}