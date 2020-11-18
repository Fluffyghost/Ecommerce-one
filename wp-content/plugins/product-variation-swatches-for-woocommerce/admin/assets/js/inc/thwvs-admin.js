var thwvsf_settings = (function($, window, document) {
    'use strict';
    var mediaUploader;
  
    var MSG_INVALID_NAME = 'NAME/ID must begin with a lowercase letter ([a-z]) and may be followed by any number of lowercase letters, digits ([0-9]) and underscores ("_")';
      
    /*------------------------------------
    *---- ON-LOAD FUNCTIONS - SATRT ----- 
    *------------------------------------*/

    $(function() {
        var settings_div = $('#edittag'),
          add_tag_div = $('#addtag'),
          advanced_settings_div = $('#advanced_settings_form'),
          custom_attr_div = $('.thwvsf-custom-table');
        thwvsf_base.setupColorPicker(advanced_settings_div);
        thwvsf_base.setupColorPicker(settings_div);
        thwvsf_base.setupColorPicker(add_tag_div);
        thwvsf_base.setupColorPicker(custom_attr_div);

        var tabs_wrapper = $('#thwvsadmin_wrapper');
        initialise_tab_switch(tabs_wrapper);
    });

    function initialise_tab_switch(tabs_wrapper){
        var tabs = tabs_wrapper.find('#thwvsadmin-tabs');
        var tab_panels = tabs_wrapper.find('#thwvsadmin-tab-panels');

        tabs.find('li.thwvsadmin-tab a').on('click', function(){
            var tab_number = $(this).data('tab');
            switch_settings_tab(tab_number, $(this), tabs, tab_panels);
        });

        var first_tab_li = tabs.find('li.thwvsadmin-tab:first-child');
        first_tab_li.find('a').trigger('click');
    }

    function switch_settings_tab(tab_number, tab, tabs, tab_panels){
        if(!tab){
            tab = tabs.find('#tab-'+tab);
        }
        
        tabs.find('li a').removeClass('active');
        var active_tab_panel = tab_panels.find('#thwvsadmin-tab-panel-'+tab_number);
        
        if(!tab.hasClass("active")){
            tab.addClass("active");
        }
        
        tab_panels.find('div.thwvsadmin-tab-panel').not('#thwvsadmin-tab-panel-'+tab_number).hide();
        active_tab_panel.show();
    }

    function upload_icon_image(elm,e){
        
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
            text: 'Choose Image'
        },  multiple: false });

        // When a file is selected, grab the URL and set it as the text field's value
        var $image_div =  $(elm).parents('.thwvsf-upload-image'),
            $index_media_image = $image_div.find('.i_index_media_img'),
            $index_media = $image_div.find('.i_index_media'),
            $remove_button = $image_div.find('.thwvsf_remove_image_button');
        
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();      
            $index_media_image.attr('src', attachment.url);
            $index_media.val(attachment.id);
            $('.thwvsf_remove_uploaded').show();
            $remove_button.show();

        });

        mediaUploader.open();
    }

    var placeholder = thwvsf_var.placeholder_image;

    function remove_icon_image(elm,e){
        var $image_div =  $(elm).parents('.thwvsf-upload-image'),
            $index_media_image = $image_div.find('.i_index_media_img'),
            $index_media = $image_div.find('.i_index_media'),
            $remove_button = $image_div.find('.thwvsf_remove_image_button');

        $index_media_image.attr( 'src',placeholder);
        $index_media.val( '' );
        $remove_button.hide();
        return false;
    }

    function change_term_type(elm,e){
        var type = $(elm).val(),
            form = $(elm).closest('.thwvsf_custom_attribute');

        var custom_attr_div = $('.thwvsf-custom-table');
        thwvsf_base.setupColorPicker(custom_attr_div);

        if(type == 'select'){
            form.find($(".thwvsf-custom-table")).hide();
        }else{
            form.find($(".thwvsf-custom-table")).hide();
            form.find($(".thwvsf-custom-table-"+ type)).show();
            form.find($(".th-tooltip-row")).show();
        }

        if(type == 'select'){
            form.find($(".th-tooltip-row")).hide();
        }else{
            form.find($(".th-tooltip-row")).show();
        }
    }

    function open_term_body(elm,e){
        var term_name = $(elm).data('term_name');
        var parent = $(elm).closest('table');

        if(!$(elm).hasClass('open')){
            parent.find('.thwvsf-local-body').hide();
            parent.find('.thwvsf-local-body-'+ term_name).show('slow');

            parent.find('.thwvsf-local-head').removeClass('open');
            $(elm).addClass('open');
        }else{
            $(elm).removeClass('open');
            parent.find('.thwvsf-local-body-'+ term_name).hide();
        }
    }

    $( document ).ajaxComplete( function( event, request, options ) {
        if ( request && 4 === request.readyState && 200 === request.status
        && options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

            var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
            if ( ! res || res.errors ) {
                return;
            }
            // Clear Thumbnail fields on submit
            $('.i_index_media_img' ).attr( 'src', placeholder);
            $('#product_cat_thumbnail_id' ).val( '' );
            $('.thwvsf_remove_image_button' ).hide();
            $('.thwvsf_settings_fields_form').find('.thpladmin-colorpickpreview').css('background-color','');
            return;
        }

        if ( request && 4 === request.readyState && 200 === request.status
        && options.data && 0 <= options.data.indexOf( 'action=woocommerce_save_attributes' ) ) {
            var this_page = window.location.toString();
            this_page = this_page.replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
            var custom_attr_div = $('.thwvs-custom-table');

            $('#product_custom_variations').load(this_page+' #custom_variations_inner',function(){
                $('#product_custom_variations').trigger( 'reload' );
                thwvsf_base.setupColorPicker($('.th-custom-attr-color-td'));
            });
        }

    });

    return{

        upload_icon_image   : upload_icon_image, 
        remove_icon_image   : remove_icon_image,
        change_term_type    : change_term_type,
        open_term_body      : open_term_body,
    };

}(window.jQuery, window, document));  

function thwvsf_upload_icon_image(elm,e){
    thwvsf_settings.upload_icon_image(elm,e);
}
function thwvsf_remove_icon_image(elm,e){
    thwvsf_settings.remove_icon_image(elm,e);
}
function thwvsf_change_term_type(elm,e){
    thwvsf_settings.change_term_type(elm,e);
}
function thwvsf_open_body(elm,e){
    thwvsf_settings.open_term_body(elm,e);
}