<?php
/**
* The admin-specific functionality of the plugin.
*
* @link       https://themehigh.com
* @since      1.0.0
*
* @package    product-variation-swatches-for-woocommerce
* @subpackage product-variation-swatches-for-woocommerce/admin
*/
if(!defined('WPINC')){  die; }

if(!class_exists('THWVSF_Admin')):

    class THWVSF_Admin {
     private $plugin_name;
     private $version;
     private $taxonomy;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.

     */
    public function __construct( $plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action( 'admin_init', array($this,'define_admin_hooks'));
    }

    public function enqueue_styles_and_scripts($hook) {
        $debug_mode = apply_filters('thwvsf_debug_mode', false);
        $suffix = ''; //$debug_mode ? '' : '.min';
        
        $this->enqueue_styles($suffix,$hook);
        $this->enqueue_scripts($suffix);
    }

    private function enqueue_styles($suffix,$hook) {
        wp_enqueue_style('woocommerce_admin_styles', THWVSF_WOO_ASSETS_URL.'css/admin.css');
        wp_enqueue_style('thwvsf-admin-style', THWVSF_ASSETS_URL_ADMIN . 'css/thwvsf-admin.css', $this->version);
    }

    private function enqueue_scripts($suffix) {
        $deps = array('jquery', 'jquery-ui-dialog', 'jquery-tiptip','wc-enhanced-select', 'select2', 'wp-color-picker',);
        wp_enqueue_media();
        wp_enqueue_script( 'thwvsf-admin-script', THWVSF_ASSETS_URL_ADMIN . 'js/thwvsf-admin.js', $deps, $this->version, false ); 

        // $placeholder_image = esc_js( wc_placeholder_img_src());
        $placeholder_image = THWVSF_ASSETS_URL_ADMIN . '/images/placeholder.svg';
        $thwvsf_var = array(
            'admin_url' => admin_url(),
            'admin_path'=> plugins_url( '/', __FILE__ ),
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
           'placeholder_image' => $placeholder_image,
        );
        
        wp_localize_script('thwvsf-admin-script','thwvsf_var',$thwvsf_var);
    }

    public function admin_menu() {
        $page_title = __('WooCommerce Product Variation Swatches', 'product-variation-swatches-for-woocommerce');
        $menu_title = __('Swatches Options','product-variation-swatches-for-woocommerce');

        $this->screen_id = add_submenu_page('edit.php?post_type=product', $page_title, $menu_title, 'manage_woocommerce', 'th_product_variation_swatches_for_woocommerce', array($this, 'output_settings'));
    }
    
    public function add_screen_id($ids){
        // $ids[] = 'woocommerce_page_th_woocommerce_product_variation_swatches';
        $ids[] = 'woocommerce_page_th_product_variation_swatches_for_woocommerce';
        // $ids[] = strtolower( __('WooCommerce', 'woocommerce') ) .'_page_th_woocommerce_product_variation_swatches';
        $ids[] = strtolower( __('WooCommerce', 'woocommerce') ) .'_page_th_product_variation_swatches_for_woocommerce';

        return $ids;
    }

    public function plugin_action_links($links) {
        $settings_link = '<a href="'.admin_url('admin.php?page=th_product_variation_swatches_for_woocommerce').'">'. __('Settings','product-variation-swatches-for-woocommerce') .'</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    public function plugin_row_meta( $links, $file ) {
        if(THWVSF_BASE_NAME == $file) {
            $doc_link = esc_url('https://www.themehigh.com/help-guides/');
            $support_link = esc_url('https://www.themehigh.com/help-guides/');
                
            $row_meta = array(
                'docs' => '<a href="'.$doc_link.'" target="_blank" aria-label="'.__('View plugin documentation','product-variation-swatches-for-woocommerce').'">'.__('Docs','product-variation-swatches-for-woocommerce').'</a>',
                'support' => '<a href="'.$support_link.'" target="_blank" aria-label="'. __('Visit premium customer support','product-variation-swatches-for-woocommerce' ) .'">'. __('Premium support','product-variation-swatches-for-woocommerce') .'</a>',
            );

            return array_merge( $links, $row_meta );
        }
        return (array) $links;
    }

    public function output_settings(){    
        $advanced_settings = THWVSF_Admin_Settings_General::instance();    
        $advanced_settings->render_page();          
    }
    
    public function define_admin_hooks(){
         $this->cell_props_L = array( 
            'label_cell_props' => 'width="23%"', 
            'input_cell_props' => 'width="20%"', 
            'input_width' => '200px',  
        );
 
        add_filter( 'product_attributes_type_selector', array( $this,'add_attribute_types' ) );

        $attribute_taxonomies = wc_get_attribute_taxonomies();
        $this->attr_taxonomies = $attribute_taxonomies;

        foreach ($attribute_taxonomies as $tax) {
            $this->product_attr_type = $tax->attribute_type;

            add_action( 'pa_' . $tax->attribute_name . '_add_form_fields', array( $this, 'add_attribute_fields' ) );
            add_action( 'pa_' . $tax->attribute_name . '_edit_form_fields', array( $this, 'edit_attribute_fields' ), 10, 2 );
            add_filter( 'manage_edit-pa_'.$tax->attribute_name.'_columns', array( $this, 'add_attribute_column' ));
            add_filter( 'manage_pa_' . $tax->attribute_name . '_custom_column', array( $this, 'add_attribute_column_content' ), 10, 3 );
        }

        add_action( 'created_term', array( $this, 'save_term_meta' ), 10, 3 );
        add_action( 'edit_term', array( $this, 'save_term_meta' ), 10, 3 );

        add_action( 'woocommerce_product_options_attributes',array($this,'thwvsf_popup_fields'));
        add_action( 'woocommerce_product_option_terms',array($this,'thwvsf_product_option_terms'), 20, 2 );

        add_filter('woocommerce_product_data_tabs',array($this,'new_tabs_for_custom_attributes') );
        add_action('woocommerce_product_data_panels',array($this,'output_custom_variations'));
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_custom_fields' ), 10, 2);
    }

    public function add_attribute_types( $types ) {
        $more_types = array(
          'color' => __( 'Color', 'product-variation-swatches-for-woocommerce' ),
          'image' => __( 'Image', 'product-variation-swatches-for-woocommerce' ),
          'label' => __( 'Label', 'product-variation-swatches-for-woocommerce' ),  
        );

        $types = array_merge( $types, $more_types );
        return $types;
    }

    public function add_attribute_fields($taxonomy){
        $attribute_type = $this->get_attribute_type($taxonomy);
        $this->product_attribute_fields($taxonomy,$attribute_type, 'new', 'add');                       
    }

    public function edit_attribute_fields($term, $taxonomy){
        $attribute_type = $this->get_attribute_type($taxonomy);
        $term_fields = array();
        $term_type_field = get_term_meta($term->term_id,'product_'.$taxonomy, true);

        $term_fields = array(
            'term_type_field' => $term_type_field ? $term_type_field : '',
        );

        $this->product_attribute_fields($taxonomy,$attribute_type, $term_fields,'edit');
    }

    public function get_attribute_type($taxonomy){
        foreach ($this->attr_taxonomies as $tax) {
            if('pa_'.$tax->attribute_name == $taxonomy){
                return($tax->attribute_type);
                break;
            }
        }
    }

    public function product_attribute_fields($taxonomy,$type,$value,$form){
        switch ( $type ) {
            case 'color':
                $this->add_color_field($value,$taxonomy);
                break;
            case 'image':
                $this->add_image_field($value,$taxonomy);
                break;
            case 'label' :
                $this->add_label_field($value,$taxonomy);
                break;
            default:
                break;
        }
    }

    private function add_color_field($value,$taxonomy){
        $term_type_field = is_array($value) && $value['term_type_field'] ? $value['term_type_field']:'';
        $label = __( 'Color', 'product-variation-swatches-for-woocommerce' );

        if($value == 'new'){ 
            ?>  
            <div class="thwvsf-types gbl-attr-color gbl-attr-terms gbl-attr-terms-new">
                <label><?php echo $label; ?></label>
                <div class="thwvsf_settings_fields_form">
                    <span class="thpladmin-colorpickpreview color_preview"></span>
                    <input type="text" name= "<?php echo'product_'.$taxonomy ; ?>" class="thpladmin-colorpick"/>
                </div> 
            </div>
            <?php

        } else {
            ?>
            <tr class="form-field gbl-attr-terms gbl-attr-terms-edit" > 
                <th><?php echo $label; ?></th>
                <td>
                    <div class="thwvsf_settings_fields_form">
                        <span class="thpladmin-colorpickpreview color_preview" style="background:<?php echo $term_type_field ?>;"></span>
                        <input type="text"  name= "<?php echo'product_'.$taxonomy ; ?>" class="thpladmin-colorpick" value="<?php echo $term_type_field ?>"/>
                    </div>         
                </td>
            </tr> 
            <?Php
        }
    }

    private function add_image_field($value, $taxonomy){
        $image = is_array($value) && $value['term_type_field'] ? wp_get_attachment_image_src( $value['term_type_field'] ) : ''; 
        $image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
        $label = __( 'Image', 'product-variation-swatches-for-woocommerce' );

        if($value == 'new'){ 
            ?>
            <div class="thwvsf-types gbl-attr-img gbl-attr-terms gbl-attr-terms-new">
                <div class='thwvsf-upload-image'>
                    <label><?php echo $label; ?></label>
                    <div class="tawcvs-term-image-thumbnail">
                        <img class="i_index_media_img" src="<?php echo ( esc_url( $image )); ?>" width="50px" height="50px" />  <?php  ?>
                    </div>
                    <div style="line-height:60px;">
                        <input type="hidden" class="i_index_media" name="product_<?php echo $taxonomy ?>" value="">
           
                        <button type="button" class="thwvsf-upload-image-button button " onclick="thwvsf_upload_icon_image(this,event)"> <?php esc_html_e( 'Upload image', 'thwcvs' ); ?></button>

                         <button type="button" style="display:none" id="remove_field_image" class="thwvsf_remove_image_button button " onclick="thwvsf_remove_icon_image(this,event)"><?php esc_html_e( 'Remove image', '' ); ?></button>
                    </div>
                </div>
            </div>
            <?php 

        }else{
            ?>
            <tr class="form-field gbl-attr-img gbl-attr-terms gbl-attr-terms-edit">
                <th><?php echo $label; ?></th>
                <td>
                    <div class = 'thwvsf-upload-image'>
                        <div class="tawcvs-term-image-thumbnail">
                            <img  class="i_index_media_img" src="<?php echo ( esc_url( $image )); ?>" width="50px" height="50px" />  <?php  ?>
                        </div>
                        <div style="line-height:60px;">
                            <input type="hidden" class="i_index_media"  name= "product_<?php echo $taxonomy ?>" value="">
               
                            <button type="button" class="thwvsf-upload-image-button  button" onclick="thwvsf_upload_icon_image(this,event)"> <?php esc_html_e( 'Upload image', 'thwcvs' ); ?></button>

                            <button type="button" style="<?php echo (is_array($value) && $value['term_type_field']  ? '' :'display:none'); ?> "  class="thwvsf_remove_image_button button " onclick="thwvsf_remove_icon_image(this,event)"><?php esc_html_e( 'Remove image', '' ); ?></button>
                        </div>
                    </div>
                </td>
            </tr> 
            <?Php
        }   
    }

    public function add_label_field($value,$taxonomy){  
        $label = __( 'Label', 'product-variation-swatches-for-woocommerce' );

        if($value == 'new'){
            ?>
            <div class="thwvsf-types gbl-attr-label gbl-attr-terms gbl-attr-terms-new">
                <label><?php echo $label; ?></label> 
                <input type="text" id="i_label" name="product_<?php echo $taxonomy ?>" value="" />
            </div>
            <?php
        }else{
            ?>
            <tr class="form-field gbl-attr-label gbl-attr-terms gbl-attr-terms-edit" > 
                <th><?php echo $label; ?></th>
                <td>
                    <input type="text" id="i_label" name="product_<?php echo $taxonomy ?>" value="<?php echo($value['term_type_field']) ?>" />
                </td>
            </tr> 
            <?Php
        } 
    }

    public function save_term_meta($term_id, $tt_id, $taxonomy){
        if( isset($_POST['product_'.$taxonomy] )  && !empty($_POST['product_'.$taxonomy] ) ){
            update_term_meta( $term_id,'product_'.$taxonomy, sanitize_text_field($_POST['product_'.$taxonomy]) );
        }   
    }

    public function add_attribute_column($columns){
        $new_columns = array();

        if ( isset( $columns['cb'] ) ) {
            $new_columns['cb'] = $columns['cb'];
            unset( $columns['cb'] );
        }

        $new_columns['thumb'] = __( '', 'woocommerce' );

        $columns = array_merge( $new_columns, $columns );
       
        return $columns;
    }

    public function add_attribute_column_content($columns, $column, $term_id){
        $taxonomy = $_REQUEST['taxonomy'];
        $attr_type = $this->get_attribute_type($_REQUEST['taxonomy']);

        $value = get_term_meta( $term_id,'product_'.$taxonomy,true);

        switch ( $attr_type) {
            case 'color':
                printf( '<span class="th-term-color-preview" style="background-color:%s;"></span>', esc_attr( $value ) );
                break;

            case 'image':
                $image = $value ? wp_get_attachment_image_src( $value ) : '';
                $image = $image ? $image[0] : THWVSF_URL . 'admin/assets/images/placeholder.png';
                printf( '<img class="swatch-preview swatch-image" src="%s" width="44px" height="44px">', esc_url( $image ) );
                break;

            case 'label':
                printf( '<div class="swatch-preview swatch-label">%s</div>', esc_html( $value ) );
                break;
        }
    }

    public function get_attribute_by_taxonomy($taxonomy){
        global $wpdb;
        $attr = substr( $taxonomy, 3 );
        $attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = '$attr'" );
    }

    public function thwvsf_product_option_terms($attribute_taxonomy, $i ) {
        if ( 'select' !== $attribute_taxonomy->attribute_type ) {
            global $post, $thepostid, $product_object;
            $taxonomy = wc_attribute_taxonomy_name( $attribute_taxonomy->attribute_name );
            
            $product_id = $thepostid;
            if ( is_null( $thepostid ) && isset( $_POST[ 'post_id' ] ) ) {
                $product_id = absint( $_POST[ 'post_id' ] );
            }

            ?>
            <select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select terms', 'woocommerce' ); ?>" class="multiselect attribute_values wc-enhanced-select" name="attribute_values[<?php echo esc_attr( $i ); ?>][]">
            <?php
                $args      = array(
                    'orderby'    => 'name',
                    'hide_empty' => 0,
                );
            
                $all_terms = get_terms( $taxonomy, apply_filters( 'woocommerce_product_attribute_terms', $args ) );
                    if ( $all_terms ) :
                        $options = array();
                        foreach ($all_terms as $key ) {
                            $options[] = $key->term_id;
                        }

                        foreach ( $all_terms as $term ) :
                        
                            $options = ! empty( $options ) ? $options : array();

                            echo '<option value="' . esc_attr( $term->term_id ) . '" ' . wc_selected( has_term( absint( $term->term_id ), $taxonomy, $product_id ), true, false ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $term->name, $term ) ) . '</option>';
                        endforeach;
                    endif;
                ?>
            </select>
           
            <button class="button plus select_all_attributes"><?php esc_html_e( 'Select all', 'woocommerce' ); ?></button>
            <button class="button minus select_no_attributes"><?php esc_html_e( 'Select none', 'woocommerce' ); ?></button>
            
            <?php
             $taxonomy = wc_attribute_taxonomy_name( $attribute_taxonomy->attribute_name );
             $attr_type = $attribute_taxonomy->attribute_type;

            if ( (  $attribute_taxonomy->attribute_type == 'label' || $attribute_taxonomy->attribute_type == 'image' || $attribute_taxonomy->attribute_type == 'color')){ ?>
                <button class="button fr plus thwvsf_add_new_attribute"  data-attr_taxonomy="<?php echo $taxonomy; ?>"  data-attr_type="<?php echo $attr_type ?>"  data-dialog_title="<?php printf( esc_html__( 'Add new %s', '' ), esc_attr($attribute_taxonomy->attribute_label ) ) ?>">  <?php esc_html_e( 'Add new', '' ); ?>  </button> 

             <?php  

            }else{?>
                <button class="button fr plus add_new_attribute"><?php esc_html_e( 'Add new', 'woocommerce' ); ?></button> <?php
            }
        }
    }

    public function new_tabs_for_custom_attributes($tabs){
        $tabs['custom_attributes']     = array(
            'label'    => __( 'Custom Attributes', 'product-variation-swatches-for-woocommerce' ),
            'target'   => 'product_custom_variations',
            'class'    => array('variations_tab', 'show_if_variable' ),
            'priority' => 65,
        );
        return $tabs;
    }

    public function output_custom_variations(){
        
        global $post, $thepostid, $product_object,$wc_product_attributes;
        $saved_settings = get_post_meta($thepostid,'th_custom_attribute_settings', true);

        $type_options = array('select' => 'Select', 'color' => 'Color', 'label' => 'Label', 'image' => 'Image');
        $tooltip_options = array('none' => 'None','term_name' => 'Term name', 'image' => 'Image','description' => 'Description');
        
        ?>

        <div id="product_custom_variations" class="panel wc-metaboxes-wrapper hidden">
            <div id="custom_variations_inner">
                
                <?php 
                $attributes = $product_object->get_attributes();
                $i = -1;
                $has_custom_attribute = false;
                
                foreach ($attributes as $attribute){
                    $attribute_name = $attribute->get_name();
                    $type = '';
                    
                    $i++;
                    if ($attribute->is_taxonomy() == false){
                        $has_custom_attribute = true;
                        ?>
                    <div data-taxonomy="<?php echo esc_attr( $attribute->get_taxonomy() ); ?>" class="woocommerce_attribute wc-metabox closed" rel="<?php echo esc_attr( $attribute->get_position() ); ?>">
               
                        <h3>
                            <div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'woocommerce' ); ?>"></div>
                            <strong class="attribute_name"><?php echo wc_attribute_label($attribute_name); ?></strong>
                        </h3>
                        <div class="thwvsf_custom_attribute wc-metabox-content  <?php echo 'thwvs-'.$attribute_name; ?> hidden">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            
                                            <p class="form-row form-row-full ">
                                                <label for="custom_attribute_type">Swatch type</label>
                                                <span class="woocommerce-help-tip" data-tip=" Determines how this custom attributes are displayed">
                                                   
                                                </span>   
                                                <select   name="<?php echo sanitize_title('th_attribute_type_'. $attribute_name); ?>" class="select short th-attr-select" value = '' onchange="thwvsf_change_term_type(this,event)">
                                                    <?php 
                                                    $type = $this->get_custom_fields_settings($thepostid,$attribute_name,'type');
                                                    foreach ($type_options as $key => $value) { 
                                                        $default = (isset($type) &&  $type == $key) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $default ?> > <?php echo $value; ?> </option>
                                                    <?php
                                                    }?>
                                                </select>
                                             
                                            </p>
                                        </td>
                                        
                                    </tr> 
                                    <tr>
                                        <th></th>
                                        
                                    </tr>
                                    
                                        <tr>
                                       <td>
                                         
                                         <?php  $this->custom_attribute_settings_field($attribute,$thepostid); ?>
                                       </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                     </div>
                    <?php }
                }

                if(!$has_custom_attribute){
                    ?>
                    <div class="inline notice woocommerce-message">
                        <p><?php _e('No custom attributes added yet. You can add custom attributes from the <a onclick="thwvsTriggerAttributeTab(this)" href="#woocommerce-product-data"> Attributes </a> tab.', 'product-variation-swatches-for-woocommerce'); ?></p>
                    </div>
                   <?php
                }
                ?>

            </div>
        </div> <?php
    }

    public function custom_attribute_settings_field($attribute,$post_id){
        $attribute_name = $attribute->get_name();
        $type = $this->get_custom_fields_settings($post_id,$attribute_name,'type');
                
        $this->output_field_label($type,$attribute,$post_id);
    
        $this->output_field_image($type,$attribute,$post_id);
  
        $this->output_field_color($type,$attribute,$post_id);
    }

    public function output_field_label($type,$attribute,$post_id){
        $attribute_name = $attribute->get_name();
        $display_status = $type == 'label' ?'display: table': 'display: none' ;
        ?>
        <table class="thwvsf-custom-table thwvsf-custom-table-label" style="<?php echo $display_status ; ?>">
            <?php
            $i= 0;
            foreach ($attribute->get_options() as $term) {
                $css = $i==0 ? 'display:table-row-group' :'';
                $open = $i==0 ? 'open' :'';
                ?>
                <tr class="thwvsf-term-name">
                    <td colspan="2"><h3 class="thwvsf-local-head <?php echo $open;?>" data-type="<?php echo $type; ?>" data-term_name="<?php echo $term; ?>" onclick="thwvsf_open_body(this,event)"><?php echo $term; ?></h3></td>
                </tr>
                <tbody class="thwvsf-local-body thwvsf-local-body-<?php echo $term; ?>" style="<?php echo $css; ?>">
                    <tr> 
                        <td width="30%"><?php _e('Term name', 'product-variation-swatches-for-woocommerce') ?></td>
                        <td width="70%"><?php echo $term; ?></td>
                    </tr>
                    <tr class="form-field"> 
                        <td><?php _e('Label text', 'product-variation-swatches-for-woocommerce') ?></td>
                        <td>
                            <?php $term_field = $type == 'label' ? $this->get_custom_fields_settings($post_id,$attribute_name,$term,'term_value') : ''; 
                                $term_field = ($term_field) ? $term_field : '';
                            ?>
                            <input type="text" id="i_label" name="<?php echo sanitize_title('label_'.$attribute_name.'_term_'.$term) ; ?>" style="width:275px;" value="<?php echo htmlspecialchars($term_field); ?>">
                        </td>
                    </tr>
                </tbody>
                <?php  // $this->output_common_fields($term,$attribute_name,$post_id,'label'); 
                $i++;
            }
            ?>
        </table>
        <?php
    }

    public function output_field_image($type,$attribute,$post_id){
        $attribute_name = $attribute->get_name();
        $display_status = $type == 'image' ?'display:table': 'display: none' ;
        ?>
        <table class="thwvsf-custom-table thwvsf-custom-table-image" style="<?php echo $display_status; ?>">
        <?php
            $i = 0;
            foreach ($attribute->get_options() as $term) {
                $css = $i==0 ? 'display:table-row-group' :'';
                $open = $i==0 ? 'open' :'';
                ?>
                <tr class="thwvsf-term-name">
                    <td colspan="2"><h3 class="thwvsf-local-head <?php echo $open;?>" data-term_name="<?php echo $term; ?>" onclick="thwvsf_open_body(this,event)"><?php echo $term; ?></h3></td>
                </tr>

                <tbody class="thwvsf-local-body thwvsf-local-body-<?php echo $term; ?>" style="<?php echo $css; ?>">
                    <tr> 
                        <td width="30%">Term name</td>
                        <td width="70%"><?php echo $term; ?></td>
                    </tr>
                    <tr class="form-field"> <td><?php _e('Term image', 'product-variation-swatches-for-woocommerce') ?></td>
                        <td>
                            <?php $term_field = $this->get_custom_fields_settings($post_id,$attribute_name,$term,'term_value'); 
                                $term_field = ($term_field) ? $term_field : '';

                                $image =  $type == 'image' ?  $this->get_custom_fields_settings($post_id,$attribute_name,$term,'term_value') : ''; 
                                $image = ($image) ? wp_get_attachment_image_src($image) : ''; 
                                $remove_img = ($image)  ? 'display:inline' :'display:none';
                                // $image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
                                $image = $image ? $image[0] : THWVSF_ASSETS_URL_ADMIN . '/images/placeholder.svg';
                            ?>

                            <div class = 'thwvsf-upload-image'>
                        
                                <div class="tawcvs-term-image-thumbnail" style="float:left;margin-right:10px;">
                                    <img  class="i_index_media_img" src="<?php echo ( esc_url( $image )); ?>" width="60px" height="60px" />  <?php  ?>
                                </div>

                                <div style="line-height:30px;">
                                    <input type="hidden" class="i_index_media"  name= "<?php echo sanitize_title('image_'.$attribute_name.'_term_'.$term) ; ?>" value="<?php echo $term_field; ?>">
                       
                                    <button type="button" class="thwvsf-upload-image-button button " onclick="thwvsf_upload_icon_image(this,event)">
                                        <img class="thwvsf-upload-button" src="<?php echo THWVSF_ASSETS_URL_ADMIN .'/images/upload.svg' ?>">
                                        <?php // esc_html_e( 'Upload image', 'thwcvs' ); ?>
                                    
                                    </button>
                                    <button type="button" style="<?php echo $remove_img; ?>" id="remove_field_image" class="thwvsf_remove_image_button button " onclick="thwvsf_remove_icon_image(this,event)">
                                        <img class="thwvsf-remove-button" src="<?php echo THWVSF_ASSETS_URL_ADMIN .'/images/remove.svg'?>">
                                        <?php // esc_html_e( 'Remove', 'product-variation-swatches-for-woocommerce' ); ?>
                                    </button> 
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php // echo $this->output_common_fields($term,$attribute_name,$post_id,'image');
                $i++;
            }?>    
        </table>
        <?php
    }

    public function output_field_color($type,$attribute,$post_id){

        $attribute_name = $attribute->get_name();
        $display_status = $type == 'color' ?'display: table': 'display: none' ;
        ?>
        <table class="thwvsf-custom-table thwvsf-custom-table-color" style="<?php echo $display_status; ?>">
            <?php
            $i = 0;
            foreach ($attribute->get_options() as $term) {
                $css = $i==0 ? 'display:table-row-group' :'';
                $open = $i==0 ? 'open' :'';
                ?>
                <tr class="thwvsf-term-name">
                    <td colspan="2"><h3 class="thwvsf-local-head <?php echo $open;?>" data-term_name="<?php echo $term; ?>" onclick="thwvsf_open_body(this,event)"><?php echo $term; ?></h3></td>
                </tr>
                <tbody class="thwvsf-local-body thwvsf-local-body-<?php echo $term; ?>" style="<?php echo $css; ?>">
                    <tr>
                        <td width="30%"><?php _e('Term name', 'product-variation-swatches-for-woocommerce') ?></td>
                        <td width="70%"><?php echo $term; ?></td>
                    </tr>
                    <?php 
                    $color_type = $this->get_custom_fields_settings($post_id,$attribute_name,$term,'color_type');
                    $color_type = $color_type ? $color_type : '';
                    ?>

                    <tr>
                        <td>Term color</td>
                        <td class = "th-custom-attr-color-td"><?php
                            $term_field = $type == 'color' ? $this->get_custom_fields_settings($post_id,$attribute_name,$term,'term_value') : ''; 
                            $term_field = ($term_field) ? $term_field : '' ; ?>

                            <div class="thwvs_settings_fields_form" style="margin-bottom: 5px">
                                <span class="thpladmin-colorpickpreview color_preview" style="background-color: <?php echo $term_field; ?> ; padding: 18px 12px 18px 12px; float:left;"></span>
                                <input type="text"   name= "<?php echo sanitize_title('color_'.$attribute_name.'_term_'.$term) ; ?>" class="thpladmin-colorpick" value="<?php echo $term_field; ?>" style="width:250px; float: none"/>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php // echo $this->output_common_fields($term,$attribute_name,$post_id,'color');
                $i++;
            } ?>
        </table><?php
    }

    public function get_custom_fields_settings($post_id,$attribute=false,$term=false,$term_key=false){
        $saved_settings = get_post_meta($post_id,'th_custom_attribute_settings', true);
        if(is_array($saved_settings)){
            if($attribute){
                if(isset($saved_settings[$attribute])){
                    $attr_settings = $saved_settings[$attribute];

                    if(is_array($attr_settings) && $term){
                        if($term === 'type' || $term ==='tooltip_type' || $term ==='radio-type'){
                            $term_types =  (isset($attr_settings[$term])) ?   $attr_settings[$term] :  false;
                            return $term_types; 
                        }else{
                            $term_settings = isset($attr_settings[$term]) ? $attr_settings[$term] : '';
                            if(is_array($term_settings) && $term_key){
                                $settings_value = isset($term_settings[$term_key]) ? $term_settings[$term_key]: '';
                                return  $settings_value;
                            }else{
                                return false;
                            }
                            return $term_settings;
                        }                       
                    }
                    return $attr_settings;
                }
                return false;
            }
            return $saved_settings;
        }else{
            return false;
        }
    }
 
    public function thwvsf_popup_fields(){
        // $image = WC()->plugin_url() . '/assets/images/placeholder.png';
        $image = THWVSF_ASSETS_URL_ADMIN . '/images/placeholder.svg';
        ?>

        <div class="thwvsf-attribte-dialog thwvsf-attribte-dialog-color " style = "display:none;">
            <table>
                <!--<tr>
                    <td><span>Color type: </span></td>
                    <td> <select class='th-color-type' name="term_color_type" onchange="thwvsf_change_color_type(this)" style="width:200px;">
                            <option value="single_color">Single Color</option>
                            <option value="bicolor">Bicolor</option>
                        </select>
                    </td>
                    
                </tr>-->
                <tr>
                    <td><span><?php _e('Name:', 'product-variation-swatches-for-woocommerce');?></span></td>
                    <td><input type="text"  name= "attribute_name" class="thwvsf-class" value="" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td><span><?php _e('Color:', 'product-variation-swatches-for-woocommerce');?></span></td>
                    <td>
                        <div class="thwvsf_settings_fields_form">
                            <span class="thpladmin-colorpickpreview color_preview"></span>
                            <input type="text" name= "attribute_type" class="thpladmin-colorpick" style="width:175px;"/>
                        </div> 

                        <div class="thwvsf_settings_fields_form bicolor" style="display:none;">

                            <span class="thpladmin-colorpickpreview color_preview" ></span>
                            <input type="text" name= "bicolor_type" class="thpladmin-colorpick" style="width:175px;"/>
                        </div>
                    </td>

                    <!-- <td>
                        <div class="thwvsf_settings_fields_form"> 
                            <span class="thpladmin-colorpickpreview color_preview" style=""></span>  
                            <input type="text"  name= "attribute_type" class="thpladmin-colorpick thwvsf-class" value=""/>
                        </div>
                    </td> -->
                </tr>
            </table>
        </div>

        <div class="thwvsf-attribte-dialog thwvsf-attribte-dialog-image" style = "display:none;">
            <table>
                <tr>
                    <td> <span><?php _e('Name:', 'product-variation-swatches-for-woocommerce');?></span></td>
                    <td><input type="text" name= "attribute_name" class="thwvsf-class" value="" style="width:216px"/></td>
                </tr>
                <tr valign="top">
                    <td><span><?php _e('Image:', 'product-variation-swatches-for-woocommerce');?></span> </td>
                    <td>
                        <div class = 'thwvsf-upload-image'>
                            <div class="thwvsf-term-image-thumbnail" style="float:left; margin-right:10px;">
                                <img  class="i_index_media_img" src="<?php echo ( esc_url( $image )); ?>" width="60px" height="60px"/>  <?php  ?>
                            </div>

                            <input type="hidden" class="i_index_media thwvsf-class"  name= "attribute_type" value="">
                            <button type="button" class="thwvsf-upload-image-button button " onclick="thwvsf_upload_icon_image(this,event)">
                                <img class="thwvsf-upload-button" src="<?php echo THWVSF_ASSETS_URL_ADMIN .'/images/upload.svg' ?>">
                                <?php // esc_html_e( 'Upload image', 'thwcvs' ); ?>
                            </button>
                            <button type="button" style="display:none" id="remove_field_image" class="thwvsf_remove_image_button button " onclick="thwvsf_remove_icon_image(this,event)">
                                <img class="thwvsf-remove-button" src="<?php echo THWVSF_ASSETS_URL_ADMIN .'/images/remove.svg'?>">
                                <?php // esc_html_e( 'Remove', '' ); ?>
                            </button> 
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="thwvsf-attribte-dialog thwvsf-attribte-dialog-label" style = "display:none;">
            <table>
                <tr>
                    <td><span><?php _e('Name:', 'product-variation-swatches-for-woocommerce');?></span></td>
                    <td><input type="text" name= "attribute_name" class="thwvsf-class" value="" /></td>
                </tr>
                <tr>
                    <td><span><?php _e('Label:', 'product-variation-swatches-for-woocommerce');?></span> </td>
                    <td>
                        <input type="text" name="attribute_type" class="thwvsf-class" value="" />
                    </td>
                </tr>    
            </table>
        </div>

        <?php
    }

    public function save_custom_fields($post_id, $post){
        $product = wc_get_product( $post_id );
        $local_attr_settings = array();

        foreach ($product->get_attributes() as $attribute ) {
            if ($attribute->is_taxonomy() == false) {
                $attr_settings = array();
                $attr_name = $attribute->get_name();
                $type_key = sanitize_title('th_attribute_type_'.$attr_name);
                $attr_settings['type'] = isset($_POST[$type_key]) ? $_POST[$type_key] : '';
                $tt_key = sanitize_title('th_tooltip_type_'.$attr_name);
                $attr_settings['tooltip_type'] = isset($_POST[$tt_key]) ? $_POST[$tt_key] : '';

                if($attr_settings['type'] == 'radio'){
                   $radio_style_key = sanitize_title($attr_name.'_radio_button_style');
                    $attr_settings['radio-type'] = isset($_POST[$radio_style_key ]) ? $_POST[$radio_style_key] : '';
                }else{
                    $term_settings = array();
                    foreach ($attribute->get_options() as $term) {
                        $term_settings['name'] = $term;

                        if($attr_settings['type'] == 'color'){
                            $color_type_key = sanitize_title($attr_name.'_color_type_'.$term);
                            $term_settings['color_type'] = isset($_POST[ $color_type_key]) ? $_POST[$color_type_key] : '';
                        }

                        $term_key = sanitize_title($attr_settings['type'].'_'.$attr_name.'_term_'.$term);
                        $term_settings['term_value'] = isset($_POST[$term_key]) ? $_POST[$term_key]: '';
                        
                        $attr_settings[$term] = $term_settings;
                    }
                }

                $local_attr_settings[$attr_name] = $attr_settings;
            }
        }

        update_post_meta( $post_id,'th_custom_attribute_settings',$local_attr_settings);     
    }
    
}

endif;