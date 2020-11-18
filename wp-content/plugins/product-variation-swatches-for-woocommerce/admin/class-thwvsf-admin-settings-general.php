<?php
/**
 * The admin advanced settings page functionality of the plugin.
 *
 * @link       https://themehigh.com
 * @since      1.0.0
 *
 * @package     product-variation-swatches-for-woocommerce
 * @subpackage  product-variation-swatches-for-woocommerce/admin
 */
if(!defined('WPINC')){	die; }

if(!class_exists('THWVSF_Admin_Settings_General')):

class THWVSF_Admin_Settings_General extends THWVSF_Admin_Settings{
	protected static $_instance = null;
	
	private $settings_fields = NULL;
	private $cell_props_L = array();
	private $cell_props_R = array();
	private $cell_props_CB = array();
	private $cell_props_TA = array();
	
	public function __construct() {
		parent::__construct('general_settings');
		$this->init_constants();
	}
	
	public static function instance() {
		if(is_null(self::$_instance)){
			self::$_instance = new self();
		}
		return self::$_instance;
	} 
	
	public function init_constants(){
		$this->cell_props_L = array( 
			'label_cell_props' => 'class="titledesc" scope="row" style="width: 20%;"', 
			'input_cell_props' => 'class="forminp"', 
			'input_width' => '250px', 
			'label_cell_th' => true 
		);
		$this->cell_props_CP = array(
			'label_cell_props' => 'class="titledesc" scope="row" style="width: 20%;"', 
			'input_cell_props' => 'class="forminp"', 
			'input_width' => '213px',
			'label_cell_th' => true 
		);
		$this->cell_props_R = array( 'label_cell_width' => '13%', 'input_cell_width' => '34%', 'input_width' => '250px' );
		$this->cell_props_CB = array( 'cell_props' => 'colspan="3"', 'render_input_cell' => true );
		$this->cell_props_TA = array( 
			'label_cell_props' => 'class="titledesc" scope="row" style="width: 20%; vertical-align:top"', 
			'rows' => 10, 
		);
		
		$this->settings_fields = $this->get_advanced_settings_fields();
	}
	
	public function get_advanced_settings_fields(){
		$behaviors = array(
			'hide' => __('Hide', 'product-variation-swatches-for-woocommerce'),
			'blur' => __('Blur','product-variation-swatches-for-woocommerce'),
			'blur_with_cross' => __('Blur With Cross','product-variation-swatches-for-woocommerce'),
		);

		$out_of_stock_behaviour = array(
			'default' => __('Default', 'product-variation-swatches-for-woocommerce'),
			'blur' => __('Blur','product-variation-swatches-for-woocommerce'),
			'blur_with_cross' => __('Blur With Cross','product-variation-swatches-for-woocommerce'),
		);

		$icon_shapes = array(
			'round' => __('Round', 'product-variation-swatches-for-woocommerce'),
			'square' => __('Square', 'product-variation-swatches-for-woocommerce'),
		);

		$selction_style = array(
			'border'=> __('Border Style', 'product-variation-swatches-for-woocommerce'),
			'enlarge' => __('Enlarge Style', 'product-variation-swatches-for-woocommerce'),
		);

		return array(
			// Common Attribute Settings
			'attribute_other_settings' => array('title'=>__('Attributes Settings', 'product-variation-swatches-for-woocommerce'), 'type'=>'separator', 'colspan'=>'3'),
		
			'icon_height' => array('type'=>'text', 'name'=>'icon_height', 'label'=>__('Icon Height', 'product-variation-swatches-for-woocommerce'),'value' => '45px'),
			'icon_width' => array('type'=>'text', 'name'=>'icon_width','label'=>__('Icon Width', 'product-variation-swatches-for-woocommerce'),'value'=>'45px'),
			'icon_shape' => array('type'=>'select', 'name'=>'icon_shape','options' =>$icon_shapes,'label'=>__('Icon shape', 'product-variation-swatches-for-woocommerce'),'value'=>'square'),
			'auto_convert' => array('type'=>'checkbox', 'name'=>'auto_convert', 'label'=>__('Convert all Dropdown Swatches to Label Swatches (If label is not provided, the term name will be treated as Label)', 'product-variation-swatches-for-woocommerce'),'hint_text'=>'', 'value'=>'yes', 'checked'=>0),

			// Label attribute Settings
			'label_settings' => array('title'=>__('Label Attribute Settings', 'product-variation-swatches-for-woocommerce'), 'type'=>'separator', 'colspan'=>'3'),
			'icon_label_height' => array('type'=>'text', 'name'=>'icon_label_height', 'label'=>__('Icon Height', 'product-variation-swatches-for-woocommerce'),'value' => '45px'),
			'icon_label_width' => array('type'=>'text', 'name'=>'icon_label_width','label'=>__('Icon Width', 'product-variation-swatches-for-woocommerce'),'value'=>'45px'),
			'label_size' => array('type'=>'text', 'name'=>'label_size', 'label'=>__('Font Size', 'product-variation-swatches-for-woocommerce'),'value' => '16px'),
			'label_background_color' => array('name'=>'label_background_color', 'label'=>__('Background color', 'product-variation-swatches-for-woocommerce'), 'type'=>'colorpicker', 'required'=>0, 'value' => '#fff'),
			'label_text_color' => array('name'=>'label_text_color', 'label'=>__('Text color', 'product-variation-swatches-for-woocommerce'), 'type'=>'colorpicker', 'required'=>0, 'value' => '#000'),

			// Tooltip Settings
			'tool_tip_settings' => array('title'=>__('Tooltip Settings', 'product-variation-swatches-for-woocommerce'), 'type'=>'separator', 'colspan'=>'3'),
			'tooltip_enable' =>array('name'=>'tooltip_enable', 'label'=>__('Enable tooltip (Attribute term name will be displayed as Tooltip)', 'product-variation-swatches-for-woocommerce'), 'type'=>'checkbox','hint_text'=>'', 'value'=>'yes', 'checked'=>0),
			'tooltip_text_background_color' => array('name'=>'tooltip_text_background_color', 'label'=>__('Term name background color', 'product-variation-swatches-for-woocommerce'),'type'=>'colorpicker','value' => '#000000'),
			'tooltip_text_color' => array('name'=>'tooltip_text_color', 'label'=>__('Term name text color', 'product-variation-swatches-for-woocommerce'),'type'=>'colorpicker','value' => '#ffffff'),

			// Active variation Style
			'attribute_active_settings' => array('title'=>__('Active Variation style', 'product-variation-swatches-for-woocommerce'), 'type'=>'separator', 'colspan'=>'3'),
			'icon_border_color_selected' => array('name'=>'icon_border_color_selected', 'label'=>__('Border Color On Selected', 'product-variation-swatches-for-woocommerce'),'type'=>'colorpicker','value' => '#8b98a6'),
			'icon_border_color_hover' => array('name'=>'icon_border_color_hover', 'label'=>__('Border Color On Hover', 'product-variation-swatches-for-woocommerce'),'type'=>'colorpicker','value' => '#b7bfc6'),
			// 'attr_selection_style' => array('name'=>'attr_selection_style', 'label'=>__('Attribute Selection Style', 'product-variation-swatches-for-woocommerce'), 'type'=>'select', 'onchange'=>'thwvsShowScale(this)', 'hint_text'=>'', 'options' => $selction_style),
			
			// Other settings
			'other_settings' => array('title'=>__('Other Settings', 'product-variation-swatches-for-woocommerce'), 'type'=>'separator', 'colspan'=>'3'),
			'behavior_for_unavailable_variation' => array('name' => 'behavior_for_unavailable_variation','type' => 'select','options' =>$behaviors,'label' => __('Behavior for unavailable variation', 'product-variation-swatches-for-woocommerce'),'value' => 'blur_with_cross' ),

			'behavior_of_out_of_stock' => array('name' => 'behavior_of_out_of_stock','type' => 'select','options' =>$out_of_stock_behaviour,'label' => __('Behavior for Out of stock variation', 'product-variation-swatches-for-woocommerce'),'value' => 'default' ),
			'ajax_variation_threshold' => array('type'=>'text', 'name'=>'ajax_variation_threshold', 'label'=>__('Ajax variation threshold', 'product-variation-swatches-for-woocommerce'),'value'=>'30','min'=>1,'hint_text'=>__('By default, if the no. of product variations is less than 30, product availability check is through JavaScript. If greater than 30, ajax method is used. This field can control the threshold value 30.', 'product-variation-swatches-for-woocommerce')),
			'clear_select' =>array('name'=>'clear_select', 'label'=>__('Clear on Reselect', 'product-variation-swatches-for-woocommerce'), 'type'=>'checkbox','hint_text'=>'', 'value'=>'yes', 'checked'=>1),
			'disable_style_sheet' =>array('name'=>'disable_style_sheet', 'label'=>__('Disable Swatches plugin stylesheet(For applying the theme default stylesheet)', 'product-variation-swatches-for-woocommerce'), 'type'=>'checkbox','hint_text'=>'', 'value'=>'yes', 'checked'=>0),
		);
	}
	
	public function render_page(){
		$this->render_tabs();
		$this->render_content();
	}
		
	public function save_advanced_settings($settings){
		$result = update_option(THWVSF_Utils::OPTION_KEY_ADVANCED_SETTINGS, $settings);
		return $result;
	}
	
	private function reset_settings(){
		delete_option(THWVSF_Utils::OPTION_KEY_ADVANCED_SETTINGS);
		echo '<div class="updated"><p>'. __('Settings successfully reset','') .'</p></div>';	
	}
	
	private function save_settings(){
		$settings = $this->prepare_field_from_posted_data($_POST, $this->settings_fields);
		$result = $this->save_advanced_settings($settings);

		if ($result == true) {
			echo '<div class="updated"><p>'. __('Your changes were saved.','') .'</p></div>';
		} else {
			echo '<div class="error"><p>'. __('Your changes were not saved due to an error (or you made none!).','') .'</p></div>';
		}
	}
	
	private function render_content(){
		if(isset($_POST['reset_settings']))
			$this->reset_settings();	
			
		if(isset($_POST['save_settings']))
			$this->save_settings();
			
		$settings = THWVSF_Utils::get_advanced_swatches_settings();
		if($this->settings_fields){
			foreach( $this->settings_fields as $name => &$field ) {
				if($field['type'] != 'separator'){
					if(is_array($settings) && isset($settings[$name])){
						if($field['type'] === 'checkbox'){
							if($field['value'] === $settings[$name]){
								$field['checked'] = 1;
							}else{
								$field['checked'] = 0;
							}
						}else{
							$field['value'] = $settings[$name];
						}
					}
				}
			}
		}

		?>          
        <div style="padding-left: 30px;">               
		    <form id="advanced_settings_form" method="post" action="">
		    	<div id="thwvsadmin_wrapper" class="thwvsadmin-wrapper">
			    	<div class="th-col-3 thwvsadmin-tabs-wrapper">
			    		<ul id="thwvsadmin-tabs" class="thwvsadmin-tabs">
			    			<li class="thwvsadmin-tab">
								<a href="javascript:void(0)" id="tab-0" data-tab_name="" data-tab="0" class="">
									<span class="thwvsadmin-tab-label">
										<!-- <span class="dashicons dashicons-align-full-width"></span> -->
										<span class="dashicons dashicons-welcome-view-site"></span>
										<?php _e('Common Attribute Settings', 'product-variation-swatches-for-woocommerce'); ?>
									</span>
								</a>
							</li>

							<li class="thwvsadmin-tab">
								<a href="javascript:void(0)" id="tab-1" data-tab_name="" data-tab="1" class="">
									<span class="thwvsadmin-tab-label">
										<span class="dashicons dashicons-editor-textcolor"></span>
										<?php _e('Label Specific Settings', 'product-variation-swatches-for-woocommerce') ?>
										</span>
								</a>
							</li>

							<li class="thwvsadmin-tab">
								<a href="javascript:void(0)" id="tab-2" data-tab_name="" data-tab="2" class="">
									<span class="thwvsadmin-tab-label">
										<span class="dashicons dashicons-info"></span>
										<?php _e('Tooltip Settings', 'product-variation-swatches-for-woocommerce'); ?>
									</span>
								</a>
							</li>

							<li class="thwvsadmin-tab">
								<a href="javascript:void(0)" id="tab-3" data-tab_name="" data-tab="3" class="">
									<span class="thwvsadmin-tab-label">
										<span class="dashicons dashicons-plus-alt"></span>
										<?php _e('Active and Hover style', 'product-variation-swatches-for-woocommerce') ?>
									</span>
								</a>
							</li>

							<li class="thwvsadmin-tab">
								<a href="javascript:void(0)" id="tab-4" data-tab_name="" data-tab="4" class="">
									<span class="thwvsadmin-tab-label">
										<span class="dashicons dashicons-no-alt"></span>
										<?php _e('Other Settings', 'product-variation-swatches-for-woocommerce') ?>
									</span>
								</a>
							</li>
			    		</ul>

			    		<div class="clear" style="clear: both"></div>
		                <p class="submit">
							<input type="submit" name="save_settings" class="button-primary" value="Save changes">
		                    <input type="submit" name="reset_settings" class="button" value="Reset to default" 
							onclick="return confirm('Are you sure you want to reset to default settings? all your changes will be deleted.');">
		            	</p>
			    	</div>

			    	<div class="th-col-9 thwvsadmin-tab-panel-wrapper">
			    		<div id="thwvsadmin-tab-panels" class="thwvsadmin-tab-panels"> 
			    			<div class="thwvsadmin-tab-panel" id="thwvsadmin-tab-panel-0">
			    				<h3 class="thwvsadmin-tab-content"><?php _e('Common Attribute Settings', 'product-variation-swatches-for-woocommerce') ?></h3>
			    				<div class="thwvsadmin-tab-content" id="thwmsc-tab-content-0">
			    					<?php $this->common_attribute_settings($settings); ?>
			    				</div>
			    			</div>

			    			<div class="thwvsadmin-tab-panel" id="thwvsadmin-tab-panel-1">
			    				<h3 class="thwvsadmin-tab-content"><?php _e('Label Specific Settings', 'product-variation-swatches-for-woocommerce') ?></h3>
			    				<div class="thwvsadmin-tab-content" id="thwmsc-tab-content-1">
			    					<?php $this->label_attribute_settings(); ?>
			    				</div>
			    			</div>

			    			<div class="thwvsadmin-tab-panel" id="thwvsadmin-tab-panel-2">
			    				<h3 class="thwvsadmin-tab-content"><?php _e('Tooltip Settings', 'product-variation-swatches-for-woocommerce') ?></h3>
			    				<div class="thwvsadmin-tab-content" id="thwmsc-tab-content-2">
			    					<?php $this->tooltip_settings(); ?>
			    				</div>
			    			</div>

			    			<div class="thwvsadmin-tab-panel" id="thwvsadmin-tab-panel-3">
			    				<h3 class="thwvsadmin-tab-content"><?php _e('Active and Hover style', 'product-variation-swatches-for-woocommerce') ?></h3>
			    				<div class="thwvsadmin-tab-content" id="thwmsc-tab-content-3">
			    					<?php $this->active_varation_settings(); ?>
			    				</div>
			    			</div>

			    			<div class="thwvsadmin-tab-panel" id="thwvsadmin-tab-panel-4">
			    				<h3 class="thwvsadmin-tab-content"><?php _e('Other Settings', 'product-variation-swatches-for-woocommerce') ?></h3>
			    				<div class="thwvsadmin-tab-content" id="thwmsc-tab-content-8">
			    					<?php $this->other_settings(); ?>
			    				</div>
			    			</div>
			    		</div>
		    		</div>
		    	</div>
            </form>
    	</div>
    	<?php
	}

	public function common_attribute_settings($settings){
		?>
		<table class="form-table thpladmin-form-table">
			<tbody>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_height'], $this->cell_props_L);
					
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_width'], $this->cell_props_R);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_shape'], $this->cell_props_L);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['auto_convert'], $this->cell_props_CB);
					?>							
				</tr>
			</tbody>
		</table>
		<?php 
	}

	public function label_attribute_settings(){
		?>
		<table class="form-table thpladmin-form-table">
			<tbody>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_label_height'], $this->cell_props_L);
					
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_label_width'], $this->cell_props_R);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['label_size'], $this->cell_props_L);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['label_background_color'], $this->cell_props_CP);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['label_text_color'], $this->cell_props_CP);
					?>							
				</tr>
			</tbody>
		</table>
		<?php 
	}

	public function tooltip_settings(){
		?>
		<table class="form-table thpladmin-form-table">
			<tbody>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['tooltip_enable'], $this->cell_props_CB);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['tooltip_text_background_color'], $this->cell_props_CP);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['tooltip_text_color'], $this->cell_props_CP);
					?>							
				</tr>
			</tbody>
		</table>
		<?php 
	}

	public function active_varation_settings(){
		?>
		<table class="form-table thpladmin-form-table">
			<tbody>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_border_color_hover'], $this->cell_props_CP);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['icon_border_color_selected'], $this->cell_props_CP);
					?>							
				</tr>
				<!-- <tr>
					<?php
					// $this->render_form_field_element($this->settings_fields['attr_selection_style'], $this->cell_props_R);
					?>							
				</tr> -->
			</tbody>
		</table>
		<?php 
	}

	public function other_settings(){
		?>
		<table class="form-table thpladmin-form-table">
			<tbody>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['behavior_for_unavailable_variation'], $this->cell_props_L);
					
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['behavior_of_out_of_stock'], $this->cell_props_R);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['ajax_variation_threshold'], $this->cell_props_L);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['clear_select'], $this->cell_props_CB);
					?>							
				</tr>
				<tr>
					<?php
					$this->render_form_field_element($this->settings_fields['disable_style_sheet'], $this->cell_props_CB);
					?>							
				</tr>
			</tbody>
		</table>
		<?php 
	}

	public  function prepare_field_from_posted_data($posted, $props){
		$field = array();	
		
		foreach( $props as $pname => $property ){
			$iname  = 'i_'.$pname;
			$pvalue = '';
			if($property['type'] === 'checkbox'){
				$pvalue = isset($posted[$iname]) ? $posted[$iname] : 0;

			}else if(isset($posted[$iname])){
				$pvalue = is_array($posted[$iname]) ? implode(',', $posted[$iname]) : sanitize_text_field($posted[$iname]);
			}
			
			$field[$pname] =  $pvalue;
		}
		
		return $field;
	}
}

endif;