<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Base;
use WP_Widget;
class Widget extends WP_Widget{

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
		);
		
		return $fields;

	}

	public function form($instance){

		$form_fields = $this->fields();

		foreach($form_fields as $key=>$field){
			$type = (isset($field['type'])) ? $field['type'] : '';
			$name = (isset($field['name'])) ? $field['name'] : '';
			$title = (isset($field['title'])) ? $field['title'] : '';
			$default = (isset($field['default'])) ? $field['default'] : '';
			$description = (isset($field['description'])) ? $field['description'] : '';
			$value = (isset($instance[$name])) ? $instance[$name] : $default;
			
			switch ($type) {
				case 'text':
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html( $title ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $name ); ?>" name="<?php echo $this->get_field_name( $name ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" /><br/>
					<?php if($description): ?>
						<span><?php echo wp_kses_post( $description ); ?></span>
					<?php endif; ?>
				</p>
				<?php
				break;
				case 'select':
				$choices = (isset($field['choices'])) ? $field['choices'] : array();
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html( $title ); ?></label>
					<select class="widefat" id="<?php echo $this->get_field_id( $name ); ?>" name="<?php echo $this->get_field_name( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" >
						<option value=""><?php esc_html_e( 'Select', 'newsnote' ); ?></option>
						<?php
						foreach($choices as $option_val => $option_label ){
							?><option <?php selected( $value, $option_val ); ?> value="<?php echo esc_attr($option_val); ?>"><?php echo esc_html($option_label); ?></option><?php
						} ?>
					</select>
				</p>
				<?php
				break;
				case 'multiple':
				$choices = (isset($field['choices'])) ? $field['choices'] : array();
				?>
				<label><?php echo esc_html( $title ); ?></label>
				<ul>
					<?php foreach($choices as $option_val => $option_label){ 
						$is_checked = in_array($option_val, (array)$value);
						?> 
						<li>
							<label>
								<input <?php checked($is_checked); ?> class="widefat" id="<?php echo $this->get_field_id( $name.$option_val ); ?>" name="<?php echo $this->get_field_name( $name ); ?>[]" type="checkbox" value="<?php echo esc_attr( $option_val ); ?>" />
								<?php echo esc_html( $option_label ); ?>
							</label>
						</li>
					<?php } ?>
				</ul>
				<?php
				break;
				case 'checkbox':
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $name ); ?>"><input <?php checked($value); ?> id="<?php echo $this->get_field_id( $name ); ?>" name="<?php echo $this->get_field_name( $name ); ?>" type="checkbox" value="1" /><?php echo esc_html( $title ); ?></label>
				</p>
				<?php
				break;
				default:
				?>
				<p>
					<label for="<?php echo $this->get_field_id( $name ); ?>"><?php echo esc_html( $title ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $name ); ?>" name="<?php echo $this->get_field_name( $name ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
				</p>
				<?php
				break;
			}
		}

	}

	public function widget($args, $instance){
		//Override function from child class
	}

	public function update($new_instance, $old_instance){

		$instance = $old_instance;
		$form_fields = $this->fields();
		foreach($form_fields as $key=>$field){
			$type = (isset($field['type'])) ? $field['type'] : '';
			$name = (isset($field['name'])) ? $field['name'] : '';
			$default = (isset($field['default'])) ? $field['default'] : '';
			$value = (isset($new_instance[$name])) ? $new_instance[$name] : $default;
			switch ($type) {
				case 'text':
				$instance[$name] = sanitize_text_field( $value );
				break;
				case 'multiple':
				$instance[$name] = array();
				$multiple_val = (array)$value;
				foreach($multiple_val as $option_val){
					$instance[$name][] = absint($option_val);
				}
				break;
				case 'checkbox':
				$instance[$name] = absint($value);
				break;
				default:
				$instance[$name] = sanitize_text_field( $value );
				break;
			}
		}
		return $instance;
	}

}