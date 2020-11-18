<?php
class BeRocket_LMP_premium extends BeRocket_plugin_variations {
    public $plugin_name = 'BeRocket_LMP';
    public $version_number = 20;
    public function __construct() {
        parent::__construct();
        $this->defaults = array(
            'br_lmp_button_settings' => array(
                'use_image'     => '',
                'image'         => '',
                'image_hover'   => '',
                'image_loading' => '',
                'width'         => ''
            ),
            'br_lmp_prev_settings' => array(
                'use_image'     => '',
                'image'         => '',
                'image_hover'   => '',
                'image_loading' => '',
                'width'         => ''
            ),
            'br_lmp_lazy_load_settings' => array(
                'animation'                 => '',
            ),
        );
        add_filter('berocket_lmp_button_text', array($this, 'lmp_button_text'), $this->version_number, 3);
        add_filter('berocket_lmp_button_style', array($this, 'lmp_button_style'), $this->version_number, 3);
        add_filter('berocket_lmp_button_hover', array($this, 'lmp_button_hover'), $this->version_number, 3);
        add_filter('brfr_BeRocket_LMP_btn_loading_element', array($this, 'section_btn_loading_element'), $this->version_number, 3);
        add_action ( 'admin_init', array( $this, 'admin_init' ), $this->version_number );
        add_filter('berocket_the_lmp_script', array($this, 'the_lmp_script'), $this->version_number);
        add_action ( 'wp_head', array( $this, 'load_script_on_frontend' ), $this->version_number );
        add_action ( 'admin_init', array( $this, 'load_script_on_backend' ), $this->version_number );
    }

    public function default_values($defaults, $object) {
        $defaults = parent::default_values($defaults, $object);
        foreach($this->defaults as $option_name => $option) {
            if( empty($defaults[$option_name]) || ! is_array($defaults[$option_name]) ) {
                $defaults[$option_name] = $option;
            } else {
                $defaults[$option_name] = array_merge($option, $defaults[$option_name]);
            }
        }
        return $defaults;
    }

    public function admin_init() {
        $script = '
        (function ($){
            function berocket_use_image_changed($element) {
                var $parent = jQuery($element).parents(".framework-form-table").first();
                if( $parent.find(".br_btn_use_image").prop("checked") ) {
                    $parent.find(".br_trbtn_for_use_image").show();
                    $parent.find(".br_trbtn_for_use_image").find("input").prop("disabled", false);
                    $parent.find(".br_trbtn_for_use_not_image").hide();
                    $parent.find(".br_trbtn_for_use_not_image").find("input").prop("disabled", true);
                } else {
                    $parent.find(".br_trbtn_for_use_image").hide();
                    $parent.find(".br_trbtn_for_use_image").find("input").prop("disabled", true);
                    $parent.find(".br_trbtn_for_use_not_image").show();
                    $parent.find(".br_trbtn_for_use_not_image").find("input").prop("disabled", false);
                }
            }
            jQuery(document).ready(function() {
                jQuery(".br_btn_use_image").each(function() {
                    berocket_use_image_changed($(this));
                });
                $(document).on( "change", ".btn_border_color", function(){
                    var $parent = jQuery(this).parents(".framework-form-table").first();
                    if( $parent.find(".br_btn_use_image").prop("checked") ) {
                        var $button = $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" );
                        $button.css("border-color", "");
                    }
                });
                
                $(document).on( "change", ".framework-form-table .lmp_button_settings", function () {
                    var $parent = jQuery(this).parents(".framework-form-table").first();
                    if( $parent.find(".br_btn_use_image").prop("checked") ) {
                        var $field = $(this).data("field");
                        var $style = $(this).data("style");
                        var $type = $(this).data("type");
                        var $button = $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" );
                        if($style != "custom_css") {
                            if($style == "text") {
                                $button.html(berocket_load_more_paid_get_images($parent));
                            } else if($style != "width"
                            && $style != "margin-top"
                            && $style != "margin-right"
                            && $style != "margin-left"
                            && $style != "margin-bottom") {
                                $button.css($style, "");
                            }
                        }
                    }
                });
                $(document).on( "change", ".bg_btn_color, .txt_btn_color", function() {
                    var $parent = jQuery(this).parents(".framework-form-table").first();
                    if( $parent.find(".br_btn_use_image").prop("checked") ) {
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("background-color", "");
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("color", "");
                    }
                });
                $(document).on( "mouseenter", ".lmp_load_more_button .lmp_button", function () {
                    var $parent = jQuery(this).parents(".framework-form-table").first();
                    if( $parent.find(".br_btn_use_image").prop("checked") ) {
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("background-color", "");
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("color", "");
                    }
                });
                $(document).on( "mouseleave", ".lmp_load_more_button .lmp_button", function () {
                    var $parent = jQuery(this).parents(".framework-form-table").first();
                    if( $parent.find(".br_btn_use_image").prop("checked") ) {
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("background-color", "");
                        $(this).parents(".framework-form-table").first().find( ".lmp_load_more_button .lmp_button" ).css("color", "");
                    }
                });
            });
            function berocket_load_more_paid_get_images($parent) {
                use_of_image = {
                    image_loading:{
                        class:"br_lmp_loading_image",
                        image:""
                    },
                    image_hover:{
                        class:"br_lmp_hover_image",
                        image:""
                    },
                    image:{
                        class:"br_lmp_button_image",
                        image:""
                    }
                };
                $parent.find(".br_btn_for_use_image").each(function() {
                    if( typeof(use_of_image[jQuery(this).data("name")]) != "undefined" ) {
                        use_of_image[jQuery(this).data("name")].image = jQuery(this).val();
                    }
                });
                var $class = "";
                $.each(use_of_image, function(image_type, image_data) {
                    if( ! image_data.image ) {
                        $class = $class+" "+image_data.class;
                    } else {
                        use_of_image[image_type].class = use_of_image[image_type].class+$class;
                        $class = "";
                    }
                });
                var html = "";
                var alt_text = $parent.find(".lmp_button_settings[data-style=text]").val();
                $.each(use_of_image, function(image_type, image_data) {
                    if( image_data.image ) {
                        html += "<img class=\'"+image_data.class+"\' src=\'"+image_data.image+"\' alt=\'"+alt_text+"\'>";
                    }
                });
                return html;
            }
            jQuery(document).on("change", ".br_btn_use_image, .br_btn_for_use_image", function() {
                var $parent = jQuery(this).parents(".framework-form-table").first();
                berocket_use_image_changed($parent.find(".br_btn_use_image"));
                $parent.find("input").each(function() {
                    if( ! $(this).is(".br_btn_use_image, .br_btn_for_use_image") ) {
                        $(this).trigger("change");
                    }
                });
            });
        })(jQuery);';
        wp_add_inline_script('berocket_lmp_admin', $script);
    }

    public function lmp_button_text($text, $option_name, $options_btn) {
        if( ! empty($options_btn['use_image']) ) {
            $use_of_image = array(
                'image_loading' => array(
                    'class' => 'br_lmp_loading_image',
                ),
                'image_hover' => array(
                    'class' => 'br_lmp_hover_image',
                ),
                'image' => array(
                    'class' => 'br_lmp_button_image',
                ),
            );
            $class = '';
            foreach($use_of_image as $image_type => $image_data) {
                if( empty($options_btn[$image_type]) ) {
                    $class .= ' '.$image_data['class'];
                    unset($use_of_image[$image_type]);
                } else {
                    $use_of_image[$image_type]['class'] .= $class;
                    $class = '';
                    $use_of_image[$image_type]['image'] = $options_btn[$image_type];
                }
            }
            if( count($use_of_image) ) {
                $alt_text = $text;
                $text = '';
                foreach($use_of_image as $image_type => $image_data) {
                    $text .= '<img class="'.$image_data['class'].'" src="'.$image_data['image'].'" alt="'.$alt_text.'">';
                }
            }
        }
        return $text;
    }
    public function lmp_button_style($style, $option_name, $options_btn) {
        if( ! empty($options_btn['use_image']) ) {
            $style = 'padding: 0;';
        }
        foreach( array('width', 'margin-top', 'margin-left', 'margin-right', 'margin-bottom') as $style_type ) {
            if( ! empty($options_btn[$style_type]) ) {
                $style .= $style_type.':'.(int)$options_btn[$style_type].'px;';
            }
        }
        return $style;
    }
    public function lmp_button_hover($style, $option_name, $options_btn) {
        if( ! empty($options_btn['use_image']) ) {
            $style = '';
        }
        return $style;
    }

    public function settings_page ( $data ) {
        $data['Button-Settings']['bg_btn_color']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'bg_btn_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['bg_btn_color_hover']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'bg_btn_color_hover', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['btn_border_color']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'btn_border_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['txt_btn_color']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'txt_btn_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['txt_btn_color_hover']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'txt_btn_color_hover', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['btn_font_size']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'btn_font_size', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['paddings']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'paddings', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['border']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'border', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Button-Settings']['border-radius']['tr_class'] = br_get_value_from_array($data, array('Button-Settings', 'border-radius', 'tr_class'), '').' br_trbtn_for_use_not_image';

        $data['Previous-Settings']['bg_btn_color']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'bg_btn_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['bg_btn_color_hover']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'bg_btn_color_hover', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['btn_border_color']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'btn_border_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['txt_btn_color']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'txt_btn_color', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['txt_btn_color_hover']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'txt_btn_color_hover', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['btn_font_size']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'btn_font_size', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['paddings']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'paddings', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['border']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'border', 'tr_class'), '').' br_trbtn_for_use_not_image';
        $data['Previous-Settings']['border-radius']['tr_class'] = br_get_value_from_array($data, array('Previous-Settings', 'border-radius', 'tr_class'), '').' br_trbtn_for_use_not_image';

        $data['Message']['loading_text']['class'] = br_get_value_from_array($data, array('Message', 'loading_text', 'class'), '').' br_lmp_loading_text';
        $data['General']['load_image']['tr_class'] = br_get_value_from_array($data, array('Message', 'loading_text', 'tr_class'), '').' br_lmp_loading_image_tr';
        $data['General']['load_image']['items']['image']['class'] = br_get_value_from_array($data, array('General', 'load_image', 'items', 'image', 'class'), '').' br_lmp_load_image_image';
        $data['General']['load_image']['items']['rotate_image']['class'] = br_get_value_from_array($data, array('General', 'load_image', 'items', 'rotate_image', 'class'), '').' br_lmp_load_image_rotate_image';

        $data['General']['load_image']['items'] = berocket_insert_to_array(
            $data['General']['load_image']['items'],
            'rotate_image',
            array(
                "inside_button" => array(
                    "label"     => __( "Loading inside button", "BeRocket_LMP_domain" ),
                    "type"      => "checkbox",
                    "name"      => array("br_lmp_general_settings", "inside_button"),
                    "value"     => "1",
                    'class'     => 'br_lmp_load_image_inside_button',
                    "label_for" => __( "Show loading image inside of the button(can be configured for each button)", "BeRocket_LMP_domain" ),
                ),
            )
        );
        $data['Button-Settings'] = berocket_insert_to_array(
            $data['Button-Settings'],
            'btn_custom_class',
            array(
                "use_image" => array(
                    "label"     => __( "Use image", "BeRocket_LMP_domain" ),
                    "type"      => "checkbox",
                    "name"      => array("br_lmp_button_settings", "use_image"),
                    "value"     => "1",
                    'class'     => 'br_btn_use_image',
                    "label_for" => __( "Use image instead of the button", "BeRocket_LMP_domain" ),
                ),
                "image" => array(
                    "label"     => __( "Image on button", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_button_settings", "image"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => "data-name='image'",
                    "value"     => $this->defaults["br_lmp_button_settings"]["image"],
                ),
                "image_hover" => array(
                    "label"     => __( "Image on hover", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_button_settings", "image_hover"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => "data-name='image_hover'",
                    "value"     => $this->defaults["br_lmp_button_settings"]["image_hover"],
                ),
                "image_loading" => array(
                    "label"     => __( "Image on loading", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_button_settings", "image_loading"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => "data-name='image_loading'",
                    "value"     => $this->defaults["br_lmp_button_settings"]["image_loading"],
                ),
                "width" => array(
                    "label"     => __( "Width", "BeRocket_LMP_domain" ),
                    "type"      => "number",
                    "name"      => array("br_lmp_button_settings", "width"),
                    "value"     => $this->defaults["br_lmp_button_settings"]["width"],
                    "label_for" => "px",
                    "class"     => "lmp_button_settings",
                    "extra"     => 'data-style="width" data-type="px" data-default="' .  $this->defaults['br_lmp_button_settings']['width'] . '"'
                ),
            )
        );
        $data['Button-Settings']['btn_loading_element'] = array(
            "section"   => "btn_loading_element",
            "name"      => array("br_lmp_button_settings", "loading_position"),
            "value"     => "",
        );
        $data['Previous-Settings'] = berocket_insert_to_array(
            $data['Previous-Settings'],
            'btn_prev_custom_class',
            array(
                "use_image" => array(
                    "label"     => __( "Use image", "BeRocket_LMP_domain" ),
                    "type"      => "checkbox",
                    "name"      => array("br_lmp_prev_settings", "use_image"),
                    "value"     => "1",
                    'class'     => 'br_btn_use_image',
                    "label_for" => __( "Use image instead of the button", "BeRocket_LMP_domain" ),
                ),
                "image" => array(
                    "label"     => __( "Image on button", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_prev_settings", "image"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => "data-name='image'",
                    "value"     => $this->defaults["br_lmp_prev_settings"]["image"],
                ),
                "image_hover" => array(
                    "label"     => __( "Image on hover", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_prev_settings", "image_hover"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => "data-name='image_hover'",
                    "value"     => $this->defaults["br_lmp_prev_settings"]["image_hover"],
                ),
                "image_loading" => array(
                    "label"     => __( "Image on loading", "BeRocket_LMP_domain" ),
                    "type"      => "image",
                    "name"      => array("br_lmp_prev_settings", "image_loading"),
                    'class'     => 'br_btn_for_use_image',
                    'tr_class'  => 'br_trbtn_for_use_image',
                    'extra'     => " data-name='image_loading'",
                    "value"     => $this->defaults["br_lmp_prev_settings"]["image_loading"],
                ),
                "width" => array(
                    "label"     => __( "Width", "BeRocket_LMP_domain" ),
                    "type"      => "number",
                    "name"      => array("br_lmp_prev_settings", "width"),
                    "value"     => $this->defaults["br_lmp_prev_settings"]["width"],
                    "label_for" => "px",
                    "class"     => "lmp_button_settings",
                    "extra"     => 'data-style="width" data-type="px" data-default="' .  $this->defaults['br_lmp_prev_settings']['width'] . '"'
                ),
            )
        );
        $data['Previous-Settings']['btn_loading_element'] = array(
            "section"   => "btn_loading_element",
            "name"      => array("br_lmp_prev_settings", "loading_position"),
            "value"     => "",
        );
        $data['Lazy-load'] = berocket_insert_to_array(
            $data['Lazy-load'],
            'lazy_load_small',
            array(
                'lazy_load_animation' => array(
                    "label"     => __( "Load Animation", 'BeRocket_LMP_domain' ),
                    "name"     => array("br_lmp_lazy_load_settings", "animation"),   
                    "type"     => "selectbox",
                    "options"  => array(
                        array('value' => '', 'text' => __( 'NONE', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounce', 'text' => __( 'Bounce', 'BeRocket_LMP_domain' )),
                        array('value' => 'flash', 'text' => __( 'Flash', 'BeRocket_LMP_domain' )),
                        array('value' => 'pulse', 'text' => __( 'Pulse', 'BeRocket_LMP_domain' )),
                        array('value' => 'rubberBand', 'text' => __( 'Rubber Band', 'BeRocket_LMP_domain' )),
                        array('value' => 'shake', 'text' => __( 'Shake', 'BeRocket_LMP_domain' )),
                        array('value' => 'swing', 'text' => __( 'Swing', 'BeRocket_LMP_domain' )),
                        array('value' => 'tada', 'text' => __( 'Tada', 'BeRocket_LMP_domain' )),
                        array('value' => 'wobble', 'text' => __( 'Wobble', 'BeRocket_LMP_domain' )),
                        array('value' => 'jello', 'text' => __( 'Jello', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounceIn', 'text' => __( 'Bounce In', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounceInDown', 'text' => __( 'Bounce Down', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounceInLeft', 'text' => __( 'Bounce Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounceInRight', 'text' => __( 'Bounce Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'bounceInUp', 'text' => __( 'Bounce Up', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeIn', 'text' => __( 'Fade In', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInDown', 'text' => __( 'Fade Down', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInDownBig', 'text' => __( 'Fade Down Big', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInLeft', 'text' => __( 'Fade Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInLeftBig', 'text' => __( 'Fade Left Big', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInRight', 'text' => __( 'Fade Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInUp', 'text' => __( 'Fade Up', 'BeRocket_LMP_domain' )),
                        array('value' => 'fadeInUpBig', 'text' => __( 'Fade Up Big', 'BeRocket_LMP_domain' )),
                        array('value' => 'flipInX', 'text' => __( 'Fade X', 'BeRocket_LMP_domain' )),
                        array('value' => 'flipInY', 'text' => __( 'Fade Y', 'BeRocket_LMP_domain' )),
                        array('value' => 'lightSpeedIn', 'text' => __( 'Light Speed', 'BeRocket_LMP_domain' )),
                        array('value' => 'rotateIn', 'text' => __( 'Rotate In', 'BeRocket_LMP_domain' )),
                        array('value' => 'rotateInDownLeft', 'text' => __( 'Rotate Down-Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'rotateInDownRight', 'text' => __( 'Rotate Down-Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'rotateInUpLeft', 'text' => __( 'Rotate Up-Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'rotateInUpRight', 'text' => __( 'Rotate Up-Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'rollIn', 'text' => __( 'Roll In', 'BeRocket_LMP_domain' )),
                        array('value' => 'zoomIn', 'text' => __( 'Zoom In', 'BeRocket_LMP_domain' )),
                        array('value' => 'zoomInDown', 'text' => __( 'Zoom Down', 'BeRocket_LMP_domain' )),
                        array('value' => 'zoomInLeft', 'text' => __( 'Zoom Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'zoomInRight', 'text' => __( 'Zoom Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'zoomInUp', 'text' => __( 'Zoom Up', 'BeRocket_LMP_domain' )),
                        array('value' => 'slideInDown', 'text' => __( 'Slide Down', 'BeRocket_LMP_domain' )),
                        array('value' => 'slideInLeft', 'text' => __( 'Slide Left', 'BeRocket_LMP_domain' )),
                        array('value' => 'slideInRight', 'text' => __( 'Slide Right', 'BeRocket_LMP_domain' )),
                        array('value' => 'slideInUp', 'text' => __( 'Slide Up', 'BeRocket_LMP_domain' )),
                    ),
                    "value"    => '',
                ),
            )
        );
        return $data;
    }
    function the_lmp_script($the_lmp_script) {
        $options = $this->get_option();
        if( ! empty($options['br_lmp_general_settings']['inside_button']) ) {
            $the_lmp_script['load_image'] = '';
            $image = '';
            $general_options = $options['br_lmp_general_settings'];
            $image_class = '';
            if( ! empty($general_options['rotate_image']) ) {
                $image_class = 'lmp_rotate';
            }
            if ( ! empty($general_options['loading_image']) ) {
                if ( substr( $general_options['loading_image'], 0, 3) == 'fa-' ) {
                    $image .= '<i class="fa '.$general_options['loading_image'].' '.$image_class.'"></i>';
                } else {
                    $image .= '<img class="berocket_widget_icon '.$image_class.'" src="'.$general_options['loading_image'].'" alt="">';
                }
            } else {
                $image .= '<i class="fa fa-spinner '.$image_class.'"></i>';
            }
            foreach(array('br_lmp_button_settings', 'br_lmp_prev_settings') as $option_name) {
                $button = '<span class="br_loading_inside_lmp' . (empty($options[$option_name]['use_image']) ? '' : ' br_loading_inside_image_lmp') . '" 
                style="
                width: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'width')) . 'px;
                height: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'height')) . 'px;
                top: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'top')) . 'px;';
                if( ! empty($options[$option_name]['use_image']) ) {
                    $button .= 'left: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'left')) . 'px;';
                }
                $button .= 'float: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'position')) . ';
                font-size: ' . br_get_value_from_array($options, array($option_name, 'loading_position', 'width')) . 'px;
                ">' . $image . '
                </span>';
                if( empty($options[$option_name]['use_image']) ) {
                    $button = $button . br_get_value_from_array($options, array('br_lmp_messages_settings', 'loading'));
                }
                $the_lmp_script[$option_name.'_load_image'] = $button;
                $the_lmp_script[$option_name.'_use_image'] = ! empty($options[$option_name]['use_image']);
            }
        }
        return $the_lmp_script;
    }
    public function load_script_on_frontend() {
        $script = '
            jQuery("body").append(\'<div class="berocket_load_more_preload">\'+the_lmp_js_data.br_lmp_button_settings_load_image+\'</div>\');
            jQuery(document).on("berocket_lmp_start_next", function() {
                if( the_lmp_js_data.br_lmp_button_settings_use_image ) {
                    jQuery(".br_lmp_button_settings .lmp_button").append(the_lmp_js_data.br_lmp_button_settings_load_image);
                } else {
                    jQuery(".br_lmp_button_settings .lmp_button").html(the_lmp_js_data.br_lmp_button_settings_load_image);
                }
            });
            jQuery(document).on("berocket_lmp_start_prev", function() {
                if( the_lmp_js_data.br_lmp_prev_settings_use_image ) {
                    jQuery(".br_lmp_prev_settings .lmp_button").append(the_lmp_js_data.br_lmp_prev_settings_load_image);
                } else {
                    jQuery(".br_lmp_prev_settings .lmp_button").html(the_lmp_js_data.br_lmp_prev_settings_load_image);
                }
            });
            jQuery(document).on("berocket_lmp_end", function() {
                jQuery( ".br_lmp_button_settings" ).replaceWith( jQuery( the_lmp_js_data.load_more ) );
                jQuery( ".br_lmp_prev_settings" ).replaceWith( jQuery( the_lmp_js_data.load_prev ) );
                lmp_update_state();
            });
        ';
        wp_add_inline_script('berocket_lmp_js', $script);
    }
    public function load_script_on_backend() {
        ob_start();
?>
(function ($){
    $(document).on('change', '.br_lmp_load_image_inside_button', function() {
        if( $(this).prop('checked') ) {
            $('.br_loading_position_position').each(function() {
                $(this).parents('tr').first().show();
                $(this).parents('tr').first().find('input').prop('disabled', false);
            })
        } else {
            $('.br_loading_position_position').each(function() {
                $(this).parents('tr').first().hide();
                $(this).parents('tr').first().find('input').prop('disabled', true);
            })
        }
    });

    function update_loading_position_size() {
        $('.br_loading_position_wrap').each(function() {
            $(this).parents('.nav-block').css('display', 'block');
            var $button = $(this).parents('.framework-form-table').find('.lmp_load_more_button .lmp_button');
            var button_width = $button.outerWidth();
            var button_height = $button.outerHeight();
            $(this).css('width', button_width).css('height', button_height);
            var $loading_element = $(this).find('.br_loading_position')
            if( ($loading_element.outerWidth() + $loading_element.position().left) > button_width ) {
                var left_pos = $loading_element.position().left + (button_width - ($loading_element.outerWidth() + $loading_element.position().left));
                if( left_pos < 0 ) {
                    left_pos = 0;
                    $loading_element.css({width: button_width, height:button_width, fontSize:button_width});
                }
                $loading_element.css('left', left_pos);
            }
            if( ($loading_element.outerHeight() + $loading_element.position().top) > button_height ) {
                var top_pos = $loading_element.position().top + (button_height - ($loading_element.outerHeight() + $loading_element.position().top));
                if( top_pos < 0 ) {
                    top_pos = 0;
                    $loading_element.css({width: button_height, height:button_height, fontSize:button_height});
                }
                $loading_element.css('top', top_pos);
            }
            $(this).parents('.nav-block').css('display', '');
            $loading_element.css('font-size', $loading_element.outerWidth());
        });
    }
    function from_block_to_input_loading_position() {
        $('.br_loading_position_wrap').each(function() {
            $form_table = $(this).parents('.framework-form-table');
            if( ! $form_table.find('.br_btn_use_image').length || ! $form_table.find('.br_btn_use_image').prop('checked') ) return;
            $(this).parents('.nav-block').css('display', 'block');
            var $loading_element = $(this).find('.br_loading_position')
            var width = $loading_element.outerWidth();
            var height = $loading_element.outerHeight();
            var left = $loading_element.position().left;
            var top = $loading_element.position().top;
            $(this).parents('.framework-form-table').find('.br_loading_position_width input').val(width);
            $(this).parents('.framework-form-table').find('.br_loading_position_height input').val(height);
            $(this).parents('.framework-form-table').find('.br_loading_position_left input').val(left);
            $(this).parents('.framework-form-table').find('.br_loading_position_top input').val(top);
            $(this).parents('.nav-block').css('display', '');
        });
    }
    function input_init_loading_position_size() {
        $('.br_loading_position_wrap').each(function() {
            $form_table = $(this).parents('.framework-form-table');
            if( ! $form_table.find('.br_btn_use_image').length || ! $form_table.find('.br_btn_use_image').prop('checked') ) return;
            $(this).find('.br_loading_position').css({
                width:parseInt($form_table.find('.br_loading_position_width input').val()),
                height:parseInt($form_table.find('.br_loading_position_height input').val()),
                left:parseInt($form_table.find('.br_loading_position_left input').val()),
                top:parseInt($form_table.find('.br_loading_position_top input').val()),
                fontSize: parseInt($form_table.find('.br_loading_position_height input').val())
            });
        });
    }
    jQuery(document).on('change', '.br_loading_position_width input', function() {
        $form_table = $(this).parents('.framework-form-table');
        if( $(this).val() < 20 ) {
            $(this).val(20);
        }
        $form_table.find('.br_loading_position_height input').val($(this).val());
        $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).trigger('lmp_button_changed');
        if( ! $form_table.find('.br_btn_use_image').length || ! $form_table.find('.br_btn_use_image').prop('checked') ) return;
        input_init_loading_position_size();
        update_loading_position_size();
        from_block_to_input_loading_position();
    });
    jQuery(document).on('change', '.br_loading_position_height input', function() {
        $form_table = $(this).parents('.framework-form-table');
        if( $(this).val() < 20 ) {
            $(this).val(20);
        }
        $form_table.find('.br_loading_position_width input').val($(this).val());
        $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).trigger('lmp_button_changed');
        if( ! $form_table.find('.br_btn_use_image').length || ! $form_table.find('.br_btn_use_image').prop('checked') ) return;
        input_init_loading_position_size();
        update_loading_position_size();
        from_block_to_input_loading_position();
    });
    jQuery(document).on('change', '.br_loading_position_top input, .br_loading_position_left input', function() {
        $form_table = $(this).parents('.framework-form-table');
        $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).trigger('lmp_button_changed');
        if( ! $form_table.find('.br_btn_use_image').length || ! $form_table.find('.br_btn_use_image').prop('checked') ) return;
        if( $(this).val() < 0 ) {
            $(this).val(0);
        }
        input_init_loading_position_size();
        update_loading_position_size();
        from_block_to_input_loading_position();
    });
    $(document).on('change', '.br_loading_position_position select', function() {
        $(this).parents('.framework-form-table').first().find( '.lmp_load_more_button .lmp_button' ).trigger('lmp_button_changed');
    });
    $(document).on('change', '.br_lmp_load_image_rotate_image, .br_lmp_load_image_image', function() {
        $( '.lmp_load_more_button .lmp_button' ).trigger('lmp_button_changed');
    });
    $(document).on('change', '.br_lmp_loading_text', function() {
        $('.lmp_load_more_button.br_trbtn_for_use_not_image .lmp_button').trigger('lmp_button_changed');
    });
    $(document).on('lmp_button_changed', '.lmp_load_more_button.br_trbtn_for_use_not_image .lmp_button', function() {
        $form_table = $(this).parents('.framework-form-table');
        $text = $('.br_lmp_loading_text').val();
        $(this).html('<span class="br_loading_inside_lmp">'+$('.br_lmp_loading_image_tr .berocket_selected_fa').html()+'</span>'+$text);
        var width = parseInt($form_table.find('.br_loading_position_width input').val());
        var height = parseInt($form_table.find('.br_loading_position_height input').val());
        var top = parseInt($form_table.find('.br_loading_position_top input').val());
        var position = $form_table.find('.br_loading_position_position select').val();
        $(this).find('.br_loading_inside_lmp').css({width:width, height:height, top:top, float:position, fontSize:width});
        if( $('.br_lmp_load_image_rotate_image').prop('checked') ) {
            $(this).find('.br_loading_inside_lmp').find('.fa, img').addClass('lmp_rotate');
        }
    });
    $(document).on('lmp_button_changed', '.lmp_load_more_button.br_trbtn_for_use_image .lmp_button', function() {
        $text = $('.br_lmp_loading_text').val();
        $this = $(this).parents('.lmp_load_more_button').find('.br_loading_position');
        $this.find('.br_loading_inside_lmp').remove();
        $this.append('<span class="br_loading_inside_lmp">'+$('.br_lmp_loading_image_tr .berocket_selected_fa').html()+'</span>');
        var width = parseInt($form_table.find('.br_loading_position_width input').val());
        if( $('.br_lmp_load_image_rotate_image').prop('checked') ) {
            $this.find('.br_loading_inside_lmp').find('.fa, img').addClass('lmp_rotate');
        }
    });
    $(document).ready( function () {
        $('.br_lmp_load_image_inside_button').trigger('change');
        $('.lmp_load_more_button .lmp_button img').on( 'load', update_loading_position_size);
        update_loading_position_size();
        input_init_loading_position_size();
        $('.br_loading_position_wrap').each(function() {
            $form_table = $(this).parents('.framework-form-table');
            $(this).find('.br_loading_position')
                .resizable({
                    containment: 'parent',
                    grid: 1,
                    aspectRatio: 1 / 1,
                    minHeight: 25,
                    minWidth: 25,
                    stop: function( event, ui ) {
                        var width = ui.size.width;
                        var height = ui.size.height;
                        $(this).parents('.framework-form-table').find('.br_loading_position_width input').val(width);
                        $(this).parents('.framework-form-table').find('.br_loading_position_height input').val(height);
                        $('.lmp_button').trigger('lmp_button_changed');
                    }
                })
                .draggable({
                    containment: 'parent',
                    scroll: false,
                    grid: [1, 1],
                    stop: function( event, ui ) {
                        var left = ui.position.left;
                        var top = ui.position.top;
                        $(this).parents('.framework-form-table').find('.br_loading_position_left input').val(left);
                        $(this).parents('.framework-form-table').find('.br_loading_position_top input').val(top);
                        $(this).parents('.framework-form-table').find('.lmp_button').trigger('lmp_button_changed');
                    },
                    drag: function( event, ui ) {
                        var parent_size = {width:$(this).parents('.br_loading_position_wrap').outerWidth(), height:$(this).parents('.br_loading_position_wrap').outerHeight()};
                        var this_size = {width:$(this).outerWidth(), height:$(this).outerHeight()};
                        if( ui.position.left > 5 && ui.position.left < (parent_size.width - this_size.width - 5) ) {
                            var xPosition = parent_size.width / 2 - (ui.position.left + this_size.width / 2);
                            if( xPosition > -5 && xPosition < 5 ) {
                                ui.position.left = parseInt(ui.position.left + xPosition);
                            }
                        }
                        if( ui.position.top > 5 && ui.position.top < (parent_size.height - this_size.height - 5) ) {
                            var yPosition = parent_size.height / 2 - (ui.position.top + this_size.height / 2);
                            if( yPosition > -5 && yPosition < 5 ) {
                                ui.position.top = parseInt(ui.position.top + yPosition);
                            }
                        }
                    }
                });
        });
        $('.lmp_load_more_button .lmp_button').trigger('lmp_button_changed');
        $('.lmp_button').on('lmp_button_changed', function() {
            update_loading_position_size();
            setTimeout(update_loading_position_size, 500);
        });
    });
})(jQuery);
<?php
        $script = ob_get_clean();
        wp_add_inline_script('berocket_lmp_admin', $script);
    }
    public function get_option($options = false) {
        if( $options === false ) {
            $BeRocket_LMP = BeRocket_LMP::getInstance();
            $options = $BeRocket_LMP->get_option();
        }
        return $options;
    }
    public function section_btn_loading_element ( $html, $item, $options ) {
        $BeRocket_LMP = BeRocket_LMP::getInstance();
        $value = br_get_value_from_array($options, $item['name']);
        $name = $this->values['settings_name'] . '[' . implode('][', $item['name']) . ']';
        $html = '<tr>
            <td>
                <p class="br_loading_position_width">
                    <span>Width: </span><input type="number" min="20" name="'.$name.'[width]" value="'.br_get_value_from_array($value, 'width', '25').'">px
                </p>
                <p class="br_loading_position_height">
                    <span>Height: </span><input type="number" min="20" name="'.$name.'[height]" value="'.br_get_value_from_array($value, 'height', '25').'">px
                </p>
                <p class="br_loading_position_left br_trbtn_for_use_image">
                    <span>Left: </span><input type="number" min="0" name="'.$name.'[left]" value="'.br_get_value_from_array($value, 'left', '25').'">px
                </p>
                <p class="br_loading_position_top">
                    <span>Top: </span><input type="number" min="0" name="'.$name.'[top]" value="'.br_get_value_from_array($value, 'top', '25').'">px
                </p>
                <p class="br_loading_position_position br_trbtn_for_use_not_image">
                    <span>Position: </span>
                    <select name="'.$name.'[position]">
                        <option value="none"'.(br_get_value_from_array($value, 'position', 'none') == 'none' ? ' selected' : '').'>Top</option>
                        <option value="left"'.(br_get_value_from_array($value, 'position', 'none') == 'left' ? ' selected' : '').'>Left</option>
                        <option value="right"'.(br_get_value_from_array($value, 'position', 'none') == 'right' ? ' selected' : '').'>Right</option>
                    </select></p>
            </td>
            <td>
                <div class="br_loading_position_wrap lmp_load_more_button br_trbtn_for_use_image">
                    '.$BeRocket_LMP->get_load_more_button($item['name'][0]).'
                    <div class="br_loading_position">
                    </div>
                </div>
                <div class="lmp_load_more_button br_trbtn_for_use_not_image">
                '.$BeRocket_LMP->get_load_more_button($item['name'][0]).'
                </div>
            </td>
        </tr>';
        return $html;
    }
} new BeRocket_LMP_premium;
