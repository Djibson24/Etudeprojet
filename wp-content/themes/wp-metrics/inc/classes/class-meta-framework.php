<?php defined( 'ABSPATH' ) or exit();
/**
 * MetaFramework - Options framework for metabox, taxonomies.
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */
class WPMetrics_Meta_Framework
{
    /**
     * Constructor
     */
    function __construct()
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
    }

    /**
     * Enqueue and register scripts/styles for options.
     */
    function register_scripts()
    {
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_media();
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );

        wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0', 'screen' );

        wp_register_style( 'jquery-datetimepicker', get_template_directory_uri() . '/inc/assets/css/jquery.datetimepicker.css' );
        wp_register_style( 'jquery-minicolors', get_template_directory_uri() . '/inc/assets/css/jquery.minicolors.css' );

        wp_register_style( 'jquery.nouislider', get_template_directory_uri() . '/inc/assets/css/jquery.nouislider.css' );
        wp_register_style( 'jquery.nouislider.pips', get_template_directory_uri() . '/inc/assets/css/jquery.nouislider.pips.css' );
        wp_register_style( 'select2', get_template_directory_uri() . '/inc/assets/css/select2.css' );

        wp_register_style( 'cms-core-options', get_template_directory_uri() . '/inc/assets/css/core.metabox.css' );

        wp_register_script( 'jquery-datetimepicker', get_template_directory_uri() . '/inc/assets/js/jquery.datetimepicker.js' );
        wp_register_script( 'jquery.nouislider', get_template_directory_uri() . '/inc/assets/js/jquery.nouislider.all.js' );
        wp_register_script( 'icons-class', get_template_directory_uri() . '/inc/assets/js/icons.class.js' );
        wp_register_script( 'select2', get_template_directory_uri() . '/inc/assets/js/select2.min.js' );

        wp_register_script( 'cms-media-selector', get_template_directory_uri() . '/inc/assets/js/media.selector.js' );
        wp_register_script( 'cms-file-selector', get_template_directory_uri() . '/inc/assets/js/file.selector.js' );
        wp_register_script( 'cms-core-options', get_template_directory_uri() . '/inc/assets/js/core.metabox.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ) );
    }


    /**
     * Prints out data attribute contains field ids which will open if current field changed to certain value.
     * @param  array $args
     */
    private function get_open_fields( $args ) {
        $open_fields = array();
        if ( ! empty( $args['open_fields'] ) ) {
            foreach ( $args['open_fields'] as $key => $fields ) {
                $field_names = '"' . implode( ',', $args['open_fields'][$key] ) . '"';
                $open_field[] = '"' . $key . '":' . $field_names;
            }
        }

        return ( ! empty( $open_field ) ? ' data-open-fields="' . esc_attr( '{' . implode( ',', $open_field ) . '}' ) . '"' : '' );
    }

    /**
     * Enqueue metabox css
     * @return void
     */
    protected function enqueue_scripts() {
        wp_enqueue_script( 'cms-core-options' );
        wp_enqueue_style( 'cms-core-options' );
    }

    /**
     * Render field based on field type
     * @param  array $args
     * @return void
     */
    protected function render_field( $args, $post_id = 0 )
    {
        $args = wp_parse_args( $args, array(
            'id' => '',
            'title' => '',
            'desc' => '',
            'type' => '',
            'class' => '',
            'multiple' => false,
            'settings' => array(),
            'options' => array(),
            'value' => '',
            'open_fields' => array(),
            'allowed_html' => array(),
            'format' => 'm/d/Y'
        ) );

        $title_allowed_html = array(
            'strong' => array(),
            'em' => array(),
            'b' => array(),
            'i' => array(),
            'u' => array(),
            'span' => array()
        );

        if ( empty( $args['id'] ) || empty( $args['type'] ) ) return;

        $field_wrapper_css_id = 'cms_metabox_field_' . $args['id'];
        $field_wrapper_css_class = 'cms-field-wrapper';

        if ( ! empty( $args['class'] ) ) {
            $field_wrapper_css_class .= ' ' . $args['class'];
        }
        $field_wrapper_css_class .= ' field-' . $args['type'] . '-wrapper';

        $args['id'] = '_cms_' . $args['id'];

        $value = get_post_meta( $post_id, $args['id'], true );
        if ( $value ) {
            $args['value'] = $value;
        }

        ob_start();

        echo '<div id="' . esc_attr( $field_wrapper_css_id ) . '" class="' . esc_attr( $field_wrapper_css_class ) . '">';
        echo    '<div class="cms-field-title">';

        if ( ! empty( $args['title'] ) ) {
            echo    '<p class="cms-field-title-text">' . wp_kses( $args['title'], $title_allowed_html ) . '</p>';
        }
        echo    '</div>'; // <-- .cms-field-title
        echo    '<div class="cms-field-content">';

        switch ( $args['type'] ) {
            case 'textfield':
                $this->textfield( $args );
                break;
            case 'textarea':
                $this->textarea( $args );
                break;
            case 'select':
                $this->select( $args );
                break;
            case 'select2':
                $this->select2( $args );
                break;
            case 'checkbox':
                $this->checkbox( $args );
                break;
            case 'switcher':
                $this->switcher( $args );
                break;
            case 'button_group':
                $this->button_group( $args );
                break;
            case 'image':
                $this->image( $args );
                break;
            case 'color':
                $this->color( $args );
                break;
            case 'file':
                $this->file( $args );
                break;
            case 'image_select':
                $this->image_select( $args );
                break;
            case 'slider':
                $this->slider( $args );
                break;
            case 'date_time':
                $this->date_time( $args );
                break;
            case 'number':
                $this->number( $args );
                break;
            case 'editor':
                $this->editor( $args );
                break;
            default:
                break;
        }
        echo    '</div>'; // <-- .cms-field-content
        if ( ! empty( $args['desc'] ) ) {
            echo '<p class="field-desc howto">' . wp_kses( $args['desc'], $title_allowed_html ) . '</p>';
        }
        echo '</div>';
        echo ob_get_clean();
    }


    /**
     * text field html output
     * @param  array $args
     */
    private function textfield( $args )
    {
        echo '<input type="text"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' class="cms-field field-text"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '/>';
    }


    /**
     * textarea field html output
     * @param  array $args
     */
    private function textarea( $args )
    {
        $textarea_attr = '';
        $args['settings'] = wp_parse_args( $args['settings'], array(
            'cols' => '',
            'rows' => '4'
        ) );
        if ( '' != isset( $args['settings']['rows'] ) ) {
            $textarea_attr .= ' rows="' . esc_attr( $args['settings']['rows'] ) . '"';
        }
        if ( '' != isset( $args['settings']['cols'] ) ) {
            $textarea_attr .= ' cols="' . esc_attr( $args['settings']['cols'] ) . '"';
        }
        echo '<textarea' . $textarea_attr .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' class="cms-field field-textarea"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '>' . wp_kses( $args['value'], $args['allowed_html'] ) . '</textarea>';
    }


    /**
     * select field html output.
     * @param  array $args
     */
    private function select( $args )
    {
        if ( true === $args['multiple'] ) {
            $this->multiple_select( $args );
        }            
        $selected = ( ! empty( $args['value'] ) ? $args['value'] : '' );
        echo '<select id="' . esc_attr( $args['id'] ) . '"' .
                ' class="cms-field field-select"' .
                ' name="' . esc_attr( $args['id'] ) .
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '">';
        foreach ( $args['options'] as $key => $option ) {
            echo '<option value="' . esc_attr( $key ) . '" ' . selected( $selected, $key, false ) .'>';
            echo esc_html( $option );
            echo '</option>';
        }
        echo '</select>';
    }


    /**
     * select field html output.
     * @param  array $args
     */
    private function select2( $args )
    {
        wp_enqueue_style( 'select2' );
        wp_enqueue_script( 'select2' );

        if ( true === $args['multiple'] ) {
            return $this->multiple_select( $args );
        }            
        $selected = ( ! empty( $args['value'] ) ? $args['value'] : '' );
        echo '<select id="' . esc_attr( $args['id'] ) . '"' .
                ' class="cms-field field-select field-select-2"' .
                ' name="' . esc_attr( $args['id'] ) .
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '">';
        foreach ( $args['options'] as $key => $option ) {
            echo '<option value="' . esc_attr( $key ) . '" ' . selected( $selected, $key, false ) .'>';
            echo esc_html( $option );
            echo '</option>';
        }
        echo '</select>';
    }


    /**
     * multiple select field html output.
     * @param  array $args
     */
    private function multiple_select( $args ) {
        $selected = empty( $args['value'] ) ? array() : explode( ',', $args['value'] );

        $css_classes = 'cms-field field-select-multiple';
        if ( $args['type'] == 'select2' ) {
            $css_classes .= ' field-select-2';
        }
        echo '<select multiple="multiple" class="' . esc_attr( $css_classes ) . '"' . 
            ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
            '>';
        foreach ( $args['options'] as $key => $option ) {
            echo '<option value="' . esc_attr( $key ) . '"' . 
                ( in_array( $key, $selected ) ? ' selected="selected"' : '' ) . '>';
            echo esc_html( $option );
            echo '</option>';
        }
        echo '</select>';
        echo '<input type="hidden"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                '/>';
    }

    /**
     * checkbox styled as a switcher html output
     * @param  array $args
     */
    private function switcher( $args )
    {
        $data_checked = '';
        if ( '' == $args['value'] || '0' == $args['value'] ) {
            $data_checked = ' data-selected="0"';
        }

        if ( '1' == $args['value'] ) {
            $data_checked = ' data-selected="1"';
        }
        $open_fields = $this->get_open_fields( $args );
        echo '<div class="cms-field field-switcher"' . $data_checked . '>';
        echo '<input type="checkbox"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' value="1" ' . checked( $args['value'], '1', false ) . $open_fields . '/>';
        echo '<label for="' . esc_attr( $args['id'] ) . '">';
        echo '<span></span>';
        echo '</label>';
        echo '<input type="hidden"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"/>';
        echo '</div>';
    }

    /**
     * Button group html output
     * @param  array $args
     */
    private function button_group( $args ) {
        if ( empty( $args['options'] ) || count( $args['options'] ) < 2 ) return '';
        $data_checked = '';
        if ( ! empty( $args['value'] ) ) {
            $data_checked = ' data-selected="' . esc_attr( $args['value'] ) . '"';
        }
        $open_fields = $this->get_open_fields( $args );
        echo '<div class="cms-field field-button-group"' . $data_checked . '>';
        foreach ( $args['options'] as $key => $option ) {
            echo '<input type="radio"' .
                ' id="' . esc_attr( $args['id'] . $key ) . '"' .
                ' name="' . esc_attr( $args['id'] ) . '" '. 
                checked( $args['value'], $key, false ) . $open_fields .
                ' value="' . esc_attr( $key ) . '"/>';
            echo '<label for="' . esc_attr( $args['id'] . $key ) . '">' . $option . '</label>';
        }
        echo '</div>';
    }

    /**
     * Image select field html output
     * @param  array $args
     */
    private function image( $args )
    {
        wp_enqueue_script( 'cms-media-selector' );

        $selected = empty( $args['value'] ) ? array() : explode( ',', $args['value'] );
        $class = 'cms-field field-image';
        $data_attr = '';
        $output = '';

        if ( true === $args['multiple'] ) {
            $class .= ' field-multiple-images';
            $data_attr = 'data-type="multiple"';
        }
        else {
            $data_attr = 'data-type="single"';
        }

        echo '<div class="' . $class . '" id="' . esc_attr( $args['id'] ) . '">';

        foreach ( $selected as $key => $value )
        {
            $attachment_image = wp_get_attachment_image_src( $value, 'thumbnail' );
            if ( ! empty( $attachment_image ) ) {
                $output .= '<li data-id="' . esc_attr( $value ) . '"'. 
                    ' style="background-image:url(' . esc_url( $attachment_image[0] ) . ');background-size:cover;">';
                $output .= '<a class="image-edit" href="javascript:void(0)">' .
                        '<i class="dashicons dashicons-edit"></i>' .
                    '</a>';
                $output .= '<a class="image-delete" href="javascript:void(0)">' .
                        '<i class="dashicons dashicons-trash"></i>' .
                    '</a>';
                $output .= '</li>';
            }
            else {
                unset( $selected[$key] );
            }
            if ( false === $args['multiple'] ) break;
        }

        if ( empty( $selected ) || true === $args['multiple'] || empty( $output ) ) {
            $output .= '<li data-id="">';
            $output .= '<a class="image-add" href="javascript:void(0)">' .
                    '<i class="dashicons dashicons-plus-alt"></i>' .
                '</a>';
            $output .= '</li>';
        }

        printf( '<ul class="images"%1$s>%2$s</ul>', $data_attr, $output );
        echo '<input type="hidden" name="' . esc_attr( $args['id'] ) . '"' .
                ' id="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( implode( ',', $selected ) ) . '"/>';
        echo '</div>';
    }

    /**
     * Colorpicker field
     * @param  array $args
     */
    private function color( $args )
    {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        echo '<div class="cms-field field-color">';
        echo '<input type="text"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' class="field-color-input"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                '/>';
        echo '</div>';
    }
    
    /**
     * File field
     * @param  array $args
     */
    private function file( $args )
    {
        wp_enqueue_script( 'cms-file-selector' );
        echo '<div class="cms-field field-file">';
        echo '<input type="text"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' class="field-file-input"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '/>';
        echo '<input type="button" class="field-file-add button button-primary" value="' . esc_html__( 'Browse', 'wp-metrics' ) . '"/>';
        echo '<input type="button" class="field-file-clear button button-secondary" value="' . esc_html__( 'Clear', 'wp-metrics' ) . '"/>';
        echo '</div>';
    }
    private function image_select( $args )
    {
        echo '<div class="cms-field field-image-select">';
        echo '<ul>';
        foreach ( $args['options'] as $key => $image ) {
            echo '<li data-value="' . esc_attr( $key ) . '"' . ( $args['value'] == $key ? ' class="active"' : '' ) . '>' .
                    '<img alt="" src="' . esc_url( $image ) . '">' .
                '</li>';
        }
        echo '</ul>';
        echo '<input type="hidden"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                '/>';
        echo '</div>';
    }

    /**
     * Date time picker field
     * @param  array $args
     */
    private function date_time( $args )
    {
        wp_enqueue_style( 'jquery-datetimepicker' );
        wp_enqueue_script( 'jquery-datetimepicker' );
        if ( empty( $args['placeholder'] ) && ! empty( $args['format'] ) ) {
            $args['placeholder'] = $args['format'];
        }
        $data_format_attr = ' data-format="' . esc_attr( $args['format'] ) . '"';

        echo '<div class="cms-field field-date-time"' . $data_format_attr . '>';
        echo '<div class="cms-field-with-icon cms-field-icon-right">';
        echo '<input type="text"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '/>';
        echo '<i class="icon dashicons dashicons-calendar"></i>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * Number field
     * @param  array $args
     */
    private function number( $args )
    {
        echo '<div class="cms-field field-number">';
        echo '<i class="field-number-tools minus"></i>';
        echo '<input type="text"' .
                ' id="' . esc_attr( $args['id'] ) . '"' .
                ' name="' . esc_attr( $args['id'] ) . '"' .
                ' value="' . esc_attr( $args['value'] ) . '"' . 
                ( ! empty( $args['placeholder'] ) ? ' placeholder="' . esc_attr( $args['placeholder'] ) . '"' : '' ) .
                '/>';
        echo '<i class="field-number-tools plus"></i>';
        echo '</div>';
    }

    /**
     * WYSIWYG Editor field
     * @param  array $args
     */
    private function editor( $args )
    {
        $content = isset( $args['value'] ) ? $args['value'] : '';
        $args['settings'] = wp_parse_args( $args['settings'], array(
            'quicktags' => true,
            'media_buttons' => false,
            'textarea_rows' => '6'
        ) );
        echo '<div class="cms-field cms-field-editor">';
        wp_editor( wpautop( urldecode( $content ) ), $args['id'], $args['settings'] );
        echo '</div>';
    }
}
