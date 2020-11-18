<?php
class BeRocket_LMP_tripwire extends BeRocket_plugin_variations {
    public $plugin_name = 'BeRocket_LMP';
    public $version_number = 10;
    public function __construct() {
        parent::__construct();
        $this->defaults = array(
            'br_lmp_general_settings'   => array(
                'mobile_width'      => '767',
            ),
            'br_lmp_button_settings'    => array(
            ),
            'br_lmp_prev_settings'    => array(
            ),
            'br_lmp_lazy_load_settings' => array(
                'use_lazy_load'             => '',
                'use_lazy_load_mobile'      => '',
            ),
            'br_lmp_messages_settings'  => array(
                'loading'                   => 'Loading...',
                'loading_class'             => '',
                'end_text'                  => 'No more products',
                'end_text_class'            => '',
            ),
        );
        
        /*
         *  Main hooks
         */
        add_action ( 'wp_head', array( $this, 'include_front' ) );
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

    public function settings_page ( $data ) {
        $data['General'] = berocket_insert_to_array(
            $data['General'],
            'general_type',
            array(
                "general_use_mobile" => array(
                    "label"     => __( "Change load type for small devices", "BeRocket_LMP_domain" ),
                    "type"      => "checkbox",
                    "name"      => array("br_lmp_general_settings", "use_mobile"),
                    "value"     => "1",
                    "class"     => "lmp_hide_element",
                    "extra"     => 'data-hide=".lmp_use_mobile"',
                ),
                "general_mobile_type" => array(
                    "label"     => __( "Load Type for small devices", 'BeRocket_LMP_domain' ),
                    "name"     => array("br_lmp_general_settings", "mobile_type"),   
                    "type"     => "selectbox",
                    "options"  => array(
                        array('value' => 'none', 'text' => __('None', 'BeRocket_LMP_domain')),
                        array('value' => 'infinity_scroll', 'text' => __('Infinity Scroll', 'BeRocket_LMP_domain')),
                        array('value' => 'more_button', 'text' => __('Load More Button', 'BeRocket_LMP_domain')),
                        array('value' => 'pagination', 'text' => __('AJAX Pagination', 'BeRocket_LMP_domain')),
                    ),
                    "value"     => "",
                    "class"     => "lmp_use_mobile lmp_use_mobile1"
                ),
                "mobile_width" => array(
                    "label"     => __( "Maximum width for small devices", "BeRocket_LMP_domain" ),
                    "type"      => "number",
                    "name"      => array("br_lmp_general_settings", "mobile_width"),
                    "value"     => $this->defaults["br_lmp_general_settings"]["mobile_width"],
                ),
            )
        );
        $data['General']['load_image']['items']['image']['type'] = 'faimage';
        $data = berocket_insert_to_array(
            $data,
            'Selectors',
            array(
                'Lazy-load' => array(
                    'lazy_load_enab' => array(
                        "label"     => __( "Enable Lazy Load", "BeRocket_LMP_domain" ),
                        "type"      => "checkbox",
                        "name"      => array("br_lmp_lazy_load_settings", "use_lazy_load"),
                        "value"     => "1",
                    ),
                    'lazy_load_small' => array(
                        "label"     => __( "Enable Lazy Load on small devices", "BeRocket_LMP_domain" ),
                        "type"      => "checkbox",
                        "name"      => array("br_lmp_lazy_load_settings", "use_lazy_load_mobile"),
                        "value"     => "1",
                    ),
                ),
            )
        );
        $data = berocket_insert_to_array(
            $data,
            'Lazy-load',
            array(
                'Message' => array(
                    'loading_text' => array(
                        "label"     => __( "Loading Text", "BeRocket_LMP_domain" ),
                        "type"      => "text",
                        "name"      => array("br_lmp_messages_settings", "loading"),
                        "value"     => $this->defaults["br_lmp_messages_settings"]["loading"],
                    ),
                   'loading_loading_class' => array(
                        "label"     => __( "Custom Class for Loading Text", "BeRocket_LMP_domain" ),
                        "type"      => "text",
                        "name"      => array("br_lmp_messages_settings", "loading_class"),
                        "value"     => $this->defaults["br_lmp_messages_settings"]["loading_class"],
                    ),
                    'loading_end_text' => array(
                        "label"     => __( "Products End Message", "BeRocket_LMP_domain" ),
                        "type"      => "text",
                        "name"      => array("br_lmp_messages_settings", "end_text"),
                        "value"     => $this->defaults["br_lmp_messages_settings"]["end_text"],
                    ),
                    'loading_end_text_class' => array(
                        "label"     => __( "Custom Class for Products End Message", "BeRocket_LMP_domain" ),
                        "type"      => "text",
                        "name"      => array("br_lmp_messages_settings", "end_text_class"),
                        "value"     => $this->defaults["br_lmp_messages_settings"]["end_text_class"],
                    ),
                ),
            )
        );
        return $data;
    }
    
    public function settings_tabs ( $data ) {
        $data = berocket_insert_to_array(
            $data,
            'Selectors',
            array(
               'Lazy-load' => array(
                    'icon' => 'spinner',
                ),
            )
        );
        $data = berocket_insert_to_array(
            $data,
            'Lazy-load',
            array(
               'Message' => array(
                    'icon' => 'comment-o',
                ),
            )
        );
        return $data;
    }
    
    public function include_front() {
        $options = get_option($this->values['settings_name']);
        $lazy_load_options = $options['br_lmp_lazy_load_settings'];
        if ( $lazy_load_options['use_lazy_load'] || $lazy_load_options['use_lazy_load_mobile'] )
        {
            wp_enqueue_script( 'berocket_lmp_lazyloadXT', plugins_url( '../js/jquery.lazyloadxt.min.js', __FILE__ ), array( 'jquery' ), $this->info['version'] );
            wp_register_style( 'berocket_lmp_animate', plugins_url( '../css/animate.min.css', __FILE__ ), "", $this->info['version'] );
            wp_enqueue_style( 'berocket_lmp_animate' );
        }
    }
    
} new BeRocket_LMP_tripwire;
