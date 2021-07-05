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
            title: 'Select Background Image',
            library: {
                type: 'image'
            },
            button: {
                text:  'SELECT'
            }
        }
        // new frame;
        cms_media_frame = wp.media.frames.cms_media_frame = wp.media(options);

        $( '.cms-field.field-image' ).on( 'click', 'ul li a.image-add', function(e){
            item = $(this);
            cms_media_frame.open();
            return;
        });

        $( '.cms-field.field-image' ).on( 'click', 'ul li a.image-edit', function(e){
            item = $(this);
            cms_media_frame.open();
            return;
        });

        $( '.cms-field.field-image' ).on( 'click', 'ul li a.image-delete', function(e){
            var li = $( this ).parent();
            var ul = li.parent();
                li.remove();
            if ( ul.attr('data-type') != 'multiple' ) {
                ul.append('<li data-id="">' +
                    '<a class="image-add" href="javascript:void(0)">' +
                        '<i class="dashicons dashicons-plus-alt"></i>' +
                    '</a></li>');
            }
            reinit_image_field( ul );
            return;
        });

        cms_media_frame.on('select', function(){
            // Grab our attachment selection and construct a JSON representation of the model.
            var media_attachment = cms_media_frame.state().get('selection').first().toJSON();
            // Send the attachment URL to our custom input field via jQuery.
            if (media_attachment.id != undefined) {
                var li = item.parent();
                var ul = li.parent('ul');

                li.attr( 'data-id', media_attachment.id );
                li.attr( 'style', 'background-image:url(' + media_attachment.url + ');background-size:cover;' );
                li.attr( 'class', 'image' );

                if ( li.find('a').hasClass( 'image-add' ) ) {
                    li.find('a.image-add').remove();
                    if ( ! li.find('a').hasClass( 'image-edit' ) ) {
                        li.append( '<a class="image-edit" href="javascript:void(0)"><i class="dashicons dashicons-edit"></i></a>' );
                    }
                    if ( ! li.find('a').hasClass( 'image-delete' ) ) {
                        li.append( '<a class="image-delete" href="javascript:void(0)"><i class="dashicons dashicons-trash"></i></a>' );
                    }
                }

                if ( ul.attr('data-type') == 'multiple' ) {
                    ul.append('<li data-id=""><a class="image-add" href="javascript:void(0)"><i class="dashicons dashicons-plus-alt"></i></a></li>');
                }
                reinit_image_field(ul);
            } else {

            }
        });
        function reinit_image_field(ul) {
            var values = [];
            var i = 0;
            ul.find('li').each(function(){
                if ( $(this).attr('data-id') != '' ) {
                    values[i] = $(this).attr('data-id');
                }
                i++;
            });
            ul.next('input').val(values.join(','));
        }
    });
})(jQuery);
