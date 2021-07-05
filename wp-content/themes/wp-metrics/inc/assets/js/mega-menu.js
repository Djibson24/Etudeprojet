;(function($) {
    "use strict";

    $( document ).ready( function() {
        if ( $('.set_custom_images').length > 0 ) {
            if ( typeof wp !== 'undefined' && wp.media && wp.media.editor ) {
                $( '.wrap' ).on( 'click', '.set_custom_images', function( event ) {
                    event.preventDefault();
                    var input_text = $('#' + ( this.id ).substring(7) );
                    wp.media.editor.send.attachment = function( props, attachment ) {
                        input_text.val( attachment.url );
                    };
                    wp.media.editor.open( input_text );
                    return false;
                });
            }
        }
        $( '.form-field-colorpicker' ).wpColorPicker();
        $( '.menu_icon_wrap' ).each( function() {
            var $_this = $( this );
            var $item_id = $_this.attr( 'data-item_id' );
            $( 'li', $_this ).click( function() {
                var icon = $( this ).attr( 'data-icon' );
                $( this ).attr( 'class', 'selected' ).siblings().removeAttr( 'class' );
                $( '#edit-menu-item-icon-' + $item_id ).val( icon );
                $( '.icon-preview-' + $item_id ).html( '<i class="icon ' + icon + '"></i>' );
            });
        })
        $( '.btn_clear' ).click( function( e ) {
            e.preventDefault();
            $( this ).parent().find( 'input[class*="edit-menu-item-submenu_bg_image-"]' ).val('');
            $( this ).parent().find( 'input[class*="edit-menu-item-icon-"]' ).val('');
            $( this ).parent().find( '.icon-preview' ).html('&nbsp;&nbsp;');
        })
    });  
})(jQuery);
