(function( $ ) {
	'use strict';
	
	function initialize_thwvs(){

		var enable_stock_alert = thwvsf_public_var.enable_stock_alert;
		var min_value_stock = thwvsf_public_var.min_value_stock;
		var clear_on_reselect = thwvsf_public_var.clear_on_reselect;
		var out_of_stock = thwvsf_public_var.out_of_stock;
		
		var swatches_form = function( $form ) {
			var self = this;
			self.$form                = $form;
			this.variationData        = $form.data( 'product_variations' );
			this.$attributeFields     = $form.find( '.variations select' );
			self.$singleVariation     = $form.find( '.single_variation' );
			self.$singleVariationWrap = $form.find( '.single_variation_wrap' );
			//$form.on( 'change.thwvsf_variation_form', '.variations select', {swatches_form: this },this.onChangeselect_field );
			$form.on( 'click.thwvsf_variation_form', '.thwvsf-checkbox', { swatches_form : this }, this.onselect );
			$form.on( 'check_variations.thwvsf_variation_form', { swatches_form : this }, this.onFindVariation );
			$form.on( 'click.thwvsf_variation_form', '.reset_variations', { swatches_form: this }, this.onReset );
		};

		swatches_form.prototype.onReset = function( event ) {
			var form = event.data.swatches_form;
			$('.thwvsf_fields .thwvsf-checkbox').removeClass( 'thwvsf-selected' );
			$('.thwvsf_fields > span').removeClass( 'selected' );
			$('.thwvsf_fields .thwvsf-checkbox').removeClass( 'deactive');
			$('.thwvsf_fields .thwvsf-checkbox').removeClass( 'out_of_stock');
			$('.thwvsf-rad').attr('checked',false);
			$('.thwvsf-rad-li > label').removeClass( 'thwvsf-selected' );
			var $element = $( this );
			
			var $button = $element.parents('.variations_form').siblings('.thwvsf_add_to_cart_button');	
			active_and_deactive_variation(form);
			disable_out_of_stock_variation(form);
					
		};

		swatches_form.prototype.onselect = function( event ) {
			
			var form = event.data.swatches_form;
			var $element = $( this ),
				$select = $element.closest( '.thwvsf_fields' ).find( 'select' ),
				attribute_name = $select.data( 'attribute_name' ) || $select.attr( 'name' ),
				value = $element.data( 'value' ),
				clicked = attribute_name;
			selected.push(attribute_name);

			if ( ! $select.find( 'option[value="' + value + '"]' ).length ) {
				$element.siblings( '.thwvsf-checkbox' ).removeClass( 'thwvsf-selected' );
				$select.val( '' ).change();
				alert('No combination');
				return false;
			}

			if ( $element.hasClass('thwvsf-selected') ) {
				if(clear_on_reselect != 'yes'){
					return false;
				}

				$select.val( '' );
				$element.removeClass('thwvsf-selected');
			} else {
				$element.addClass('thwvsf-selected').siblings('.thwvsf-selected').removeClass('thwvsf-selected');
				$select.val( value );
			}

			$select.change();

			if(  $("BODY.post-type-archive").length > 0){
				// shop_page_add_to_cart_funtion(form);
			}
			active_and_deactive_variation(form);
			disable_out_of_stock_variation(form);
			
		}

		swatches_form.prototype.onselectradio = function( event ) {

			var form = event.data.swatches_form;
			var $element = $( this ),
				$select = $element.closest( '.thwvsf_fields' ).find( 'select' ),
				attribute_name = $select.data( 'attribute_name' ) || $select.attr( 'name' ),
				value = $element.data( 'value' );
			clicked = attribute_name;
			selected.push(attribute_name);	
			
			$select.val( value );
			$select.change();
			
		}

		function active_and_deactive_variation(form){

			var $attributeFields = form.$attributeFields;
			var $addtocart_button = form.$form.find('.woocommerce-variation-add-to-cart');

			//var choosed_attr = $select.data( 'attribute_name' ) || $select.attr( 'name' );
						
			$attributeFields.each( function( index, el ) {

				var current_attr_select     = $( el ),
					current_attr_name       = current_attr_select.data( 'attribute_name' ) || current_attr_select.attr( 'name' );
				
				var $current_attr = form.$form.find('.'+ current_attr_name);
				//console.log($current_attr);
				$current_attr.addClass('deactive');
				var options = current_attr_select.children( 'option');

				options.each( function(i,option){
			 		var opt_val = option.value;
			 		if(opt_val != ''){
			 			var $current_opt = form.$form.find('.'+ current_attr_name +'.'+ opt_val);
			 			$current_opt.removeClass('deactive');
			 		}
			 	});
				
			});	
		}

		function disable_out_of_stock_variation(form){
			var attributeFields = form.$attributeFields;
			// $('.thwvsf_fields .thwvsf-checkbox').removeClass( 'out_of_stock');

			if(attributeFields.length == 1){
				var variations  = form.variationData;
				for ( var i = 0; i < variations.length; i++ ) {
					var variation = variations[i];
					var variation_attributes =  variation.attributes;

					var attribute_key = Object.keys(variation_attributes);
					var attr_item_name = attribute_key[0];
					var attr_item_name_class = attr_item_name.replace(/[^a-z0-9_-]/gi, "");

					var attribute_value = variation_attributes[attr_item_name];
					var attribute_value_class = attribute_value.replace(/[^a-z0-9_-]/gi, "");
	 
					var is_in_stock = variation.is_in_stock;

					var attr_option_class = '';
					if(attr_item_name_class){
						attr_option_class = '.' + attr_item_name_class + '.' + attribute_value_class
					}else{
						attr_option_class = '.' + attr_item_name + '[data-value="'+ attribute_value +'"]';
					}

					if(!is_in_stock && out_of_stock != 'default'){
						form.$form.find(attr_option_class).addClass('out_of_stock');
						form.$form.find(attr_option_class).trigger('out_of_stock', [is_in_stock, attr_item_name]);
					}else{
						form.$form.find(attr_option_class).removeClass('out_of_stock');
					}
				}
			}else{
				disable_out_of_stock_variation_multiple(form, attributeFields);
			}
		}

		function disable_out_of_stock_variation_multiple(form, attributeFields){
			var total_attributes = attributeFields.length;

			var count = 0;
			var selected_terms = [];
			var selected_term_names = [];

			// Configure selected attributes
			attributeFields.each(function(index, element){
				var current_attr_select     = $(this);
				var current_attr_name       = current_attr_select.data( 'attribute_name' ) || current_attr_select.attr( 'name' );
				var selected_attribute_val =  current_attr_select.val();

				if(selected_attribute_val != ''){
					count = ++count;
					selected_terms[current_attr_name] = selected_attribute_val;
					selected_term_names[count] = current_attr_name;  
				}
			});

			// Remove out_of_stock for no selected terms
			if(count == 0  || count < total_attributes-1){
				$('.thwvsf_fields .thwvsf-checkbox').removeClass( 'out_of_stock');
			}

			// Total variation
			var variations  = form.variationData;
			
			// Check the last item is remaining to select.
			if(count == total_attributes-1){

				// Itrate on each variations
				for ( var i = 0; i < variations.length; i++ ) {

					// Assign each variation
					var variation = variations[i];
					var variation_attributes = variation.attributes;

					var q = 0;
					$.each(variation_attributes, function(attr_item_name, attribute_value){

						// Check selected variation and avaialble varaiton are same
						if(variation_attributes[attr_item_name] == selected_terms[attr_item_name]){
							++q;

							// Check for last item is iterating
							if(q == total_attributes-1){

								// Again taking the current variation which is to be shown in the page.
								var current_variation = variation;
								var current_attributes = current_variation.attributes;

								for (var current_attr_name in current_attributes){
									if(jQuery.inArray(current_attr_name,selected_term_names) == -1){

										var current_attr_val = variation_attributes[current_attr_name];
										var attr_item_name_class = current_attr_name.replace(/[^a-z0-9_-]/gi, "");
										var attribute_value_class = current_attr_val.replace(/[^a-z0-9_-]/gi, "");

										var attr_option_class = '';
										if(attribute_value_class){
											attr_option_class = '.' + attr_item_name_class + '.' + attribute_value_class
										}else{
											attr_option_class = '.' + attr_item_name_class + '[data-value="'+ attribute_value +'"]';
										}

										var is_in_stock = variation.is_in_stock;

										if(!is_in_stock && out_of_stock != 'default'){
											form.$form.find(attr_option_class).addClass('out_of_stock');
											form.$form.find(attr_option_class).trigger('out_of_stock', [is_in_stock, attr_item_name]);
										}else{
											form.$form.find(attr_option_class).removeClass('out_of_stock');
										}
									}
								}
							}
						}
					});
				}
			}
		}
		
		$.fn.wc_set_variation_attr = function( attr, value ) {
			if ( undefined === this.attr( 'data-o_' + attr ) ) {
				this.attr( 'data-o_' + attr, ( ! this.attr( attr ) ) ? '' : this.attr( attr ) );
			}
			if ( false === value ) {
				this.removeAttr( attr );
			} else {
				this.attr( attr, value );
			}
		};

		swatches_form.prototype.onFindVariation = function( event ) {
			
			var form = event.data.swatches_form;
			
			var $attributeFields = form.$attributeFields;

			
			active_and_deactive_variation(form);
			disable_out_of_stock_variation(form);
		}

		$.fn.thwvsf_variation_form = function() {
			
			new swatches_form( this );
			
			return this;
		};

		$(function() {
			if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
				$( '.variations_form' ).each( function() {
					
					$( this ).thwvsf_variation_form();
				});
			}
		});
			
		var clicked = null,
			selected = [];
	}


 	initialize_thwvs(), "flatsome" == thwvsf_public_var.is_quick_view ? $(document).on("mfpOpen", function() {
        initialize_thwvs()
    }) : "yith" == thwvsf_public_var.is_quick_view && $(document).on("qv_loader_stop", function() {
        initialize_thwvs()
    })


})( jQuery );
