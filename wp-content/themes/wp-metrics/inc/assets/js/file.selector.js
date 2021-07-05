/**
 * Main jQuery media file for the plugin.
 *
 * @since 1.0.0
 *
 * @package CS Media Plugin
 * @author  Fox
 */
;(function($){
    "use strict";
    $(document).ready(function(){
        // Item
        var item;
        // Prepare the variable that holds our custom media manager.
        var cms_media_frame;

        var options = {
            className: 'media-frame cms-media-frame',
            frame: 'select',
            multiple: false,
            title: 'Select File',
            library: {
                type: 'image'
            },
            button: {
                text:  'SELECT'
            }
        }
        // new frame;
        cms_media_frame = wp.media.frames.cms_media_frame = wp.media(options);

        $( '.cms-field.field-file' ).on( 'click', 'input.field-file-add', function(e){
            item = $(this);
            cms_media_frame.open();
            return;
        });

        $( '.cms-field.field-file' ).on( 'click', 'input.field-file-clear', function(e){
            item = $(this);
            $(this).parent().find('input.field-file-input').val('');
            return;
        });

        cms_media_frame.on('select', function(){
            // Grab our attachment selection and construct a JSON representation of the model.
            var media_attachment = cms_media_frame.state().get('selection').first().toJSON();
            var input = item.parent().find('input.field-file-input');
                
            // Send the attachment URL to our custom input field via jQuery.
            if (media_attachment.id != undefined) {
                input.val( media_attachment.url );
            } else {
                input.val('');
            }
        });
    });
})(jQuery);
