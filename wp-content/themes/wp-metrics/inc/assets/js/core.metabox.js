;(function($){
    "use strict";
    var CMSMetaCore = {
        _initialized: false,
        init: function() {
            if ( this._initialized ) return;
            this._initialized = true;

            var _this_obj = this;

            _this_obj.fields();

            $( '.cms-field-wrapper [data-open-fields]' ).each( function() {
                _this_obj.open_fields( $( this ), $(this).data('open-fields') );
            });
        },

        open_fields: function( elem, data_open_fields ) {
            if ( 'undefined' == typeof data_open_fields ) return;

            var field_value = elem.parent().attr('data-selected'),
                field_names = data_open_fields[field_value];
            var data_open_fields_arr = $.map( data_open_fields, function( value, index ) {
                return [value];
            });
            var open_fields_selectors = data_open_fields_arr.join();

            $( open_fields_selectors ).hide();
            if ( 'undefined' == typeof field_names ) return;
            $( field_names ).fadeIn(300);
        },

        fields: function() {
            var _this_obj = this;
            /**
             * Multiple select field
             */
            $( '.cms-field-wrapper .field-select-multiple' ).on('change', function(e) {
                "use strict";
                var values = $(this).val();
                $(this).parent().find( '> input' ).val( values.join(',') );
                return;
            });

            /**
             * Switcher field
             */
            $( '.cms-field-wrapper .field-switcher input[type="checkbox"]' ).on( 'change', function( event ) {
                var wrapper = $(this).closest( '.cms-field-wrapper' );
                if ( $( this ).is(':checked') ) {
                    $( this ).parent().attr('data-selected', $( this ).val() );
                    $( this ).parent().find( 'input[type="hidden"]').val( $(this).val() );
                }
                else {
                    $( this ).parent().attr('data-selected', '0' );
                    $( this ).parent().find( 'input[type="hidden"]').val('');
                }
                _this_obj.open_fields( $( this ), $(this).data('open-fields') );
                $( 'html, body' ).animate({scrollTop: $( this ).parent().offset().top - 2 * wrapper.innerHeight() }, 500);
            });

            /**
             * Button group field
             */
            $( '.cms-field-wrapper .field-button-group input[type="radio"]' ).on( 'change', function( event ) {
                var wrapper = $(this).closest( '.cms-field-wrapper' );
                if ( $( this ).is(':checked') ) {
                    $( this ).parent().attr('data-selected', $( this ).val() );
                }
                _this_obj.open_fields( $( this ), $(this).data('open-fields') );
                $( 'html, body' ).animate({scrollTop: $( this ).parent().offset().top - 2 * wrapper.innerHeight() }, 500);
            });

            /**
             * Color picker field
             */
            if ( $.fn.wpColorPicker ) {
                $( '.cms-field-wrapper .field-color .field-color-input' ).wpColorPicker();
            }

            $( '.cms-field-wrapper .field-image-select' ).on( 'click', 'li', function() {
                $( this ).addClass( 'active' ).siblings().removeClass( 'active' );
                $( this ).parent().next( 'input' ).val( $( this ).attr( 'data-value' ) );
            });

            /**
             * Date time picker field
             */
            if ( $.fn.datetimepicker ) {
                $('.cms-field-wrapper .field-date-time' ).each(function() {
                    var data_format = $( this ).attr( 'data-format' );
                    $( this ).find( 'input' ).datetimepicker({
                        format: data_format
                    });
                });
            }

            /**
             * Number field
             */
            $( '.cms-field-wrapper .field-number' ).on( 'click', 'i', function(e) {
                var input = $(this).closest( '.cms-field-wrapper' ).find( 'input' );
                var value = parseInt( input.val() );
                
                if ( isNaN( value ) ) { value = 0; }

                if ( $(this).hasClass('plus') ) {
                    value++;
                } else {
                    value--;
                }
                input.val(value);
                return;
            });
            $( '.cms-field-wrapper .field-number-input' ).change(function(e) {
                if ( isNaN( $(this).val() ) ){
                    alert( 'Only Enter Numeric' );
                    $(this).val('');
                }
            });
            $( '.cms-field-wrapper .field-number-input' ).keyup( function(e) {
                var value = parseInt( $(this).val() );
                if ( isNaN( value ) ) { value = 0; }
                if ( e.which == 38 ) {
                    value++;
                }
                if ( e.which == 40 ) {
                    value--;
                }
                $(this).val(value);
            });

            /**
             * Addition
             */
            if ( $( '.cms-field-wrapper .field-select-2' ).length ) {
                if ( $.fn.select2 ) {
                    $( '.cms-field-wrapper .field-select-2' ).select2();
                }
            }
        }
    };

    $(document).ready(function(){
        $( '#cms_page_options' ).tabs();
        CMSMetaCore.init();
    });
})(jQuery);