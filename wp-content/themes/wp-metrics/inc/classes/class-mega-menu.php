<?php defined( 'ABSPATH' ) or exit();
/**
 * Mega menu system for the theme
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

class WPMetrics_Mega_Menu
{
    protected $fields = array(
        'submenu_cols',
        'submenu_cols_w',
        'submenu_drop',
        'submenu_bg_image',
        'submenu_bg_image_attachment',
        'submenu_bg_image_size',
        'submenu_bg_image_position',
        'submenu_bg_image_repeat',
        'submenu_bg_color',
        'icon',
        'group_submenu',
        'widget_area',
        'hide_title'
    );
    function __construct()
    {
        // Adds css and js to the menu page
        add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts') );

        // Adds value of new field to $item object that will be passed to back end menu editing
        add_filter( 'wp_setup_nav_menu_item', array( &$this, 'setup_nav_menu_item' ) );

        // Mofidy arguments for back end menu editing
        add_filter( 'wp_edit_nav_menu_walker', array( &$this, 'edit_nav_menu_walker' ), 10, 2 );

        // Mofidy arguments for front end rendering
        add_filter( 'wp_nav_menu_args', array( &$this, 'nav_menu_args' ), 100 );

        // Save things
        add_action( 'wp_update_nav_menu_item', array( &$this, 'update_nav_menu_item' ), 10, 3 );
    }

    /**
     * Back end menu editting scripts
     */
    function admin_scripts()
    {
        if ( 'nav-menus.php' == $GLOBALS['pagenow'] )
        {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'metrics-mega-menu', get_template_directory_uri() . '/inc/assets/js/mega-menu.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), false, true );
            wp_enqueue_style( 'metrics-mega-menu', get_template_directory_uri() . '/inc/assets/css/mega-menu.css' );
            wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.1', 'screen' );
            wp_enqueue_media();
            add_thickbox();
        }
    }

    /*
     * Adds value of new field to $item object that will be passed to back end menu editing
     */
    function setup_nav_menu_item( $menu_item )
    {
        foreach ( $this->fields as $i => $field )
        {
            $menu_item->$field = get_post_meta( $menu_item->ID, '_menu_item_' . $field, true );
        }
        return $menu_item;
    }

    /**
     * Mofidy arguments for back end menu editing.
     */
    function nav_menu_args( $args )
    {
        $args['walker'] = new WPMetrics_Walker_Nav_Menu();
        return $args;
    }

    /**
     * Save things
     */
    function update_nav_menu_item( $menu_id, $menu_item_db_id, $args )
    {
        foreach ( $this->fields as $i => $field )
        {
            if ( isset( $_REQUEST['menu-item-' . $field][$menu_item_db_id] ) )
            {
                $mega_value = $_REQUEST['menu-item-' . $field][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_menu_item_' . $field, $mega_value );
            }
            else
            {
                update_post_meta( $menu_item_db_id, '_menu_item_' . $field, '' );
            }
        }
    }

    /**
     * Mofidy arguments for back end menu editing
     */
    function edit_nav_menu_walker( $walker, $menu_id )
    {
        return 'WPMetrics_Walker_Nav_Menu_Edit';
    }
} // WPMetrics_Mega_Menu
new WPMetrics_Mega_Menu();



/**
 * Create HTML list of nav menu input items.
 */
class WPMetrics_Walker_Nav_Menu_Edit extends Walker_Nav_Menu
{

    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 )
    {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = get_the_title( $original_object->ID );
        } elseif ( 'post_type_archive' == $item->type ) {
            $original_object = get_post_type_object( $item->object );
            $original_title = $original_object->labels->archives;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( esc_html__( '%s (Invalid)', 'wp-metrics' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( esc_html__('%s (Pending)', 'wp-metrics'), $item->title );
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;
        ?>
        <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
            <div class="menu-item-bar">
                <div class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu"<?php echo ( 0 == $depth ? ' style="display: none;"': '' ); ?>><?php esc_html_e( 'sub item', 'wp-metrics' ); ?></span></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'wp-metrics' ); ?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'wp-metrics' ); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item','wp-metrics'); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>"><?php esc_html_e( 'Edit Menu Item','wp-metrics' ); ?></a>
                    </span>
                </div>
            </div>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
                <?php if ( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                            <?php esc_html_e( 'URL', 'wp-metrics' ); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-wide">
                    <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Navigation Label', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="field-title-attribute description description-wide">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Title Attribute', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php esc_html_e( 'Open link in a new tab', 'wp-metrics' ); ?>
                    </label>
                </p><?php
                /**
                 * Additional Fields
                 */ ?>
                <div id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>-popup" data-item_id="<?php echo esc_attr( $item_id ); ?>" class="menu_icon_wrap" style="display:none;">
                    <div class="menu-item-icon-picker">
                        <input type="hidden" name="" class="wpb_vc_param_value" value="<?php echo esc_attr( $item->icon ); ?>" id="trace"/>
                        <div class="icon-preview thickbox-icon-preview icon-preview-<?php echo esc_attr( $item_id ); ?>"><?php
                            if ( $item->icon ) : ?><i class="<?php echo esc_attr( $item->icon ); ?>"></i><?php endif;
                        ?></div>
                        <?php
                            $icons = WPMetrics_Icons::font_awesome();
                        ?>
                        <div id="edit-menu-item-icon-dropdown-<?php echo esc_attr( $item_id ); ?>">
                            <ul class="icon-list">
                            <?php foreach ( $icons as $index => $icon ) : ?>
                                <li<?php echo ( ( $item->icon == $icon ) ? ' class="selected"' : '' ); ?> data-icon="<?php echo esc_attr( $icon ); ?>"><i class="icon <?php echo esc_attr( $icon ); ?>"></i></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="field-icon description description-wide">
                    <label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Menu icon', 'wp-metrics' ); ?><br />
                        <input type="text" value="<?php echo esc_attr( $item->icon ); ?>" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" />
                        <input alt="#TB_inline?height=520&width=800&inlineId=edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>-popup" title="<?php esc_html_e( 'Click to browse icon', 'wp-metrics' ) ?>" class="thickbox button-primary submit-add-to-menu" type="button" value="<?php esc_html_e( 'Browse Icon', 'wp-metrics' ) ?>" />
                        <button class="button btn_clear button-secondary"><?php esc_html_e( 'Clear', 'wp-metrics' ); ?></button>
                        <span class="icon-preview icon-preview<?php echo '-' . $item_id; ?>">&nbsp;<i class=" fa fa-<?php echo esc_attr( $item->icon ); ?>"></i>&nbsp;</span>
                    </label>
                </p><?php
                if ( 0 == $depth ) : ?>
                <p class="field-submenu_cols description description-thin">
                    <label for="edit-menu-item-submenu_cols-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Sub Menu Columns', 'wp-metrics' ); ?><br />
                        <select id="edit-menu-item-submenu_cols-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_cols" name="menu-item-submenu_cols[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="1" <?php selected( "1", $item->submenu_cols ); ?>><?php esc_html_e( 'Single', 'wp-metrics' ); ?></option>
                            <option value="2" <?php selected( "2", $item->submenu_cols ); ?>><?php esc_html_e( '2 Columns', 'wp-metrics' ); ?></option>
                            <option value="3" <?php selected( "3", $item->submenu_cols ); ?>><?php esc_html_e( '3 Columns', 'wp-metrics' ); ?></option>
                            <option value="4" <?php selected( "4", $item->submenu_cols ); ?>><?php esc_html_e( '4 Columns', 'wp-metrics' ); ?></option>
                            <option value="5" <?php selected( "5", $item->submenu_cols ); ?>><?php esc_html_e( '5 Columns', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-submenu_cols_w description description-thin">
                    <label for="edit-menu-item-submenu_cols_w-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Sub Menu Column Width (px)', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-submenu_cols_w-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-submenu_cols_w" name="menu-item-submenu_cols_w[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->submenu_cols_w ); ?>" />
                    </label>
                </p>
                <div style="clear:both"></div>
                <p class="field-submenu_drop description description-thin">
                    <label for="edit-menu-item-submenu_drop-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Sub Menu Dropdown', 'wp-metrics' ); ?><br />
                        <select id="edit-menu-item-submenu_drop-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_drop" name="menu-item-submenu_drop[<?php echo esc_attr( $item_id ); ?>]">
                            <option value=""><?php esc_html_e( 'Default', 'wp-metrics' ); ?></option>
                            <option value="left" <?php selected( "left", $item->submenu_drop ); ?>><?php esc_html_e( 'Left', 'wp-metrics' ); ?></option>
                            <option value="center" <?php selected( "center", $item->submenu_drop ); ?>><?php esc_html_e( 'Center', 'wp-metrics' ); ?></option>
                            <option value="right" <?php selected( "right", $item->submenu_drop ); ?>><?php esc_html_e( 'Right', 'wp-metrics' ); ?></option>
                            <option value="full" <?php selected( "full", $item->submenu_drop ); ?>><?php esc_html_e( 'Full Width', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-submenu_bg_color field-type-color-picker description description-thin">
                    <label for="edit-menu-item-submenu_bg_color-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Sub menu background color', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-submenu_bg_color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-submenu_bg_color form-field-colorpicker" name="menu-item-submenu_bg_color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->submenu_bg_color ); ?>" />
                    </label>
                </p>
                <div style="clear:both"></div>
                <p class="field-group_submenu description description-wide">
                    <label for="edit-menu-item-group_submenu-<?php echo esc_attr( $item_id ); ?>">
                        <input type="checkbox" id="edit-menu-item-group_submenu-<?php echo esc_attr( $item_id ); ?>" value="1" name="menu-item-group_submenu[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->group_submenu, '1' ); ?> />
                        <?php esc_html_e( 'Divide Submenus in to Groups', 'wp-metrics' ); ?>
                    </label>
                </p>
                <p class="field-submenu_bg_image description description-wide">
                    <label for="edit-menu-item-submenu_bg_image-<?php echo esc_attr( $item_id ); ?>">
                        <strong><?php esc_html_e( 'Sub Menu Background Image', 'wp-metrics' ); ?></strong><br />
                        <input type="text" id="edit-menu-item-submenu_bg_image-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-submenu_bg_image-<?php echo esc_attr( $item_id ); ?>" name="menu-item-submenu_bg_image[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->submenu_bg_image ); ?>" />
                        <button id="browse-edit-menu-item-submenu_bg_image-<?php echo esc_attr( $item_id ); ?>" class="set_custom_images button button-primary submit-add-to-menu"><?php esc_html_e( 'Browse Image', 'wp-metrics' ); ?></button>
                        <button class="button btn_clear button-secondary"><?php esc_html_e( 'Clear', 'wp-metrics' ); ?></button>
                    </label>
                </p>
                <p class="field-submenu_bg_image_repeat description description-thin-one-fourth">
                    <label for="edit-menu-item-submenu_bg_image_repeat-<?php echo esc_attr( $item_id ); ?>">
                        <select id="edit-menu-item-submenu_bg_image_repeat-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_bg_image_repeat" name="menu-item-submenu_bg_image_repeat[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="repeat" <?php selected( "repeat", $item->submenu_bg_image_repeat ); ?>><?php esc_html_e( 'Repeat', 'wp-metrics' ); ?></option>
                            <option value="repeat-x" <?php selected( "repeat-x", $item->submenu_bg_image_repeat ); ?>><?php esc_html_e( 'Repeat X', 'wp-metrics' ); ?></option>
                            <option value="repeat-y" <?php selected( "repeat-y", $item->submenu_bg_image_repeat ); ?>><?php esc_html_e( 'Repeat Y', 'wp-metrics' ); ?></option>
                            <option value="no-repeat" <?php selected( "no-repeat", $item->submenu_bg_image_repeat ); ?>><?php esc_html_e( 'No Repeat', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-submenu_bg_image_position description description-thin-one-fourth">
                    <label for="edit-menu-item-submenu_bg_image_position-<?php echo esc_attr( $item_id ); ?>">
                        <select id="edit-menu-item-submenu_bg_image_position-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_bg_image_position" name="menu-item-submenu_bg_image_position[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="center" <?php selected( "center", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Center', 'wp-metrics' ); ?></option>
                            <option value="center left" <?php selected( "center left", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Center Left', 'wp-metrics' ); ?></option>
                            <option value="center right" <?php selected( "center right", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Center Right', 'wp-metrics' ); ?></option>
                            <option value="top left" <?php selected( "top left", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Top Left', 'wp-metrics' ); ?></option>
                            <option value="top center" <?php selected( "top center", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Top Center', 'wp-metrics' ); ?></option>
                            <option value="top right" <?php selected( "top right", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Top Right', 'wp-metrics' ); ?></option>
                            <option value="bottom left" <?php selected( "bottom left", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Bottom Left', 'wp-metrics' ); ?></option>
                            <option value="bottom center" <?php selected( "bottom center", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Bottom Center', 'wp-metrics' ); ?></option>
                            <option value="bottom right" <?php selected( "bottom right", $item->submenu_bg_image_position ); ?>><?php esc_html_e( 'Bottom Right', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-submenu_bg_image_attachment description description-thin-one-fourth">
                    <label for="edit-menu-item-submenu_bg_image_attachment-<?php echo esc_attr( $item_id ); ?>">
                        <select id="edit-menu-item-submenu_bg_image_attachment-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_bg_image_attachment" name="menu-item-submenu_bg_image_attachment[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="scroll" <?php selected( "scroll", $item->submenu_bg_image_attachment ); ?>><?php esc_html_e( 'Scroll', 'wp-metrics' ); ?></option>
                            <option value="fixed" <?php selected( "fixed", $item->submenu_bg_image_attachment ); ?>><?php esc_html_e( 'Fixed', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-submenu_bg_image_size description description-thin-one-fourth">
                    <label for="edit-menu-item-submenu_bg_image_size-<?php echo esc_attr( $item_id ); ?>">
                        <select id="edit-menu-item-submenu_bg_image_size-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-submenu_bg_image_size" name="menu-item-submenu_bg_image_size[<?php echo esc_attr( $item_id ); ?>]">
                            <option value=""><?php esc_html_e( 'Keep Original', 'wp-metrics' ); ?></option>
                            <option value="100% auto" <?php selected( "100% auto", $item->submenu_bg_image_size ); ?>><?php esc_html_e( 'Stretch to width', 'wp-metrics' ); ?></option>
                            <option value="auto 100%" <?php selected( "auto 100%", $item->submenu_bg_image_size ); ?>><?php esc_html_e( 'Stretch to height', 'wp-metrics' ); ?></option>
                            <option value="cover" <?php selected( "cover", $item->submenu_bg_image_size ); ?>><?php esc_html_e( 'Cover', 'wp-metrics' ); ?></option>
                            <option value="contain" <?php selected( "contain", $item->submenu_bg_image_size ); ?>><?php esc_html_e( 'Contain', 'wp-metrics' ); ?></option>
                        </select>
                    </label>
                </p>
                <div style="clear:both"></div>
                <?php
                endif; // $depth == 0 ?>
                <?php if ( 0 < $depth ) : ?>
                <p class="field-widget_area description description-wide">
                    <label for="edit-menu-item-widget_area-<?php echo esc_attr( $item_id ); ?>">
                        <strong><?php esc_html_e( 'Use widget area instead', 'wp-metrics' ); ?></strong><br />
                        <select id="edit-menu-item-widget_area-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-widget_area-<?php echo esc_attr( $item_id ); ?>" name="menu-item-widget_area[<?php echo esc_attr( $item_id ); ?>]">
                            <option value=""><?php esc_html_e( 'Select Widget Area', 'wp-metrics' ); ?></option>
                            <?php
                            $sidebars = $GLOBALS['wp_registered_sidebars'];
                            foreach ( $sidebars as $sidebar ) {
                                echo '<option value="' . esc_attr( $sidebar['id'] ) . '" ' . selected( $sidebar['id'], $item->widget_area ) . '>' . $sidebar['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                </p>
                <p class="field-hide_title description description-wide">
                    <label for="edit-menu-item-hide_title-<?php echo esc_attr( $item_id ); ?>">
                        <input type="checkbox" id="edit-menu-item-hide_title-<?php echo esc_attr( $item_id ); ?>" value="1" name="menu-item-hide_title[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->hide_title, '1' ); ?> />
                        <?php esc_html_e( 'Hide menu title', 'wp-metrics' ); ?>
                    </label>
                </p>
                <?php
                endif; // $depth > 0
                /**
                 * <-- End additional fields
                 */
                ?>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'CSS Classes (optional)', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Link Relationship (XFN)', 'wp-metrics' ); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                        <?php esc_html_e( 'Description', 'wp-metrics' ); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'wp-metrics' ); ?></span>
                    </label>
                </p>

                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span><?php esc_html_e( 'Move', 'wp-metrics' ); ?></span>
                        <a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'wp-metrics' ); ?></a>
                        <a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'wp-metrics' ); ?></a>
                        <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                        <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                        <a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'wp-metrics' ); ?></a>
                    </label>
                </p>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( esc_html__('Original: %s', 'wp-metrics'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            admin_url( 'nav-menus.php' )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php esc_html_e( 'Remove', 'wp-metrics' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e('Cancel','wp-metrics'); ?></a>
                </div>
                <div style="clear:both"></div>
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
} // WPMetrics_Walker_Nav_Menu_Edit



/**
 * Show the menu to front-end
 */
class WPMetrics_Walker_Nav_Menu extends Walker_Nav_Menu
{

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        //display this element
        if ( isset( $args[0] ) && is_array( $args[0] ) ) {
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        }
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'start_el' ), $cb_args );

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[$id] ) ) {
            $b          = $args[0];
            $b->element = $element;
            $b->count_child = count($children_elements[$id]);
            //$b->mega_child = $element->mega;
            $args[0]    = $b;
            foreach ( $children_elements[$id] as $child ) {
                if ( ! isset( $newlevel ) ) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge( array( &$output, $depth ), $args );
                    $cb_args = array_merge( array( &$output, $depth ), $args );
                    call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[$id] );
        }

        if ( isset( $newlevel ) && $newlevel ) {
            //end the child delimiter
            $cb_args = array_merge( array( &$output, $depth ), $args );
            call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
        }

        //end this element
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'end_el' ), $cb_args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $submenu_cols = isset( $args->element->submenu_cols ) ? $args->element->submenu_cols : '1';
        $submenu_cols_w = isset( $args->element->submenu_cols_w ) ? $args->element->submenu_cols_w : '';
        $submenu_drop = isset( $args->element->submenu_drop ) ? $args->element->submenu_drop : '';
        $submenu_bg_color = isset( $args->element->submenu_bg_color ) ? $args->element->submenu_bg_color : '';
        $submenu_bg_image = isset( $args->element->submenu_bg_image ) ? $args->element->submenu_bg_image : '';
        $submenu_bg_image_attachment = isset( $args->element->submenu_bg_image_attachment ) ? $args->element->submenu_bg_image_attachment : '';
        $submenu_bg_image_size = isset( $args->element->submenu_bg_image_size ) ? $args->element->submenu_bg_image_size : '';
        $submenu_bg_image_position = isset( $args->element->submenu_bg_image_position ) ? $args->element->submenu_bg_image_position : '';
        $submenu_bg_image_repeat = isset( $args->element->submenu_bg_image_repeat ) ? $args->element->submenu_bg_image_repeat : '';

        $submenu_classes = array(
            'sub-menu'
        );
        $submenu_styles = array();
        $submenu_data_attr = array();

        if ( 0 == $depth )
        {
            if ( '' != $submenu_cols ) {
                switch ( $submenu_cols ) {
                    case '2':
                        $submenu_classes[] = 'multi-cols multi-cols-2';
                        if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                            $submenu_data_attr[] = 'data-item-width="' . esc_attr( $submenu_cols_w ) . '"';
                            $submenu_data_attr[] = 'data-item-cols="' . esc_attr( $submenu_cols ) . '"';
                        }
                        break;
                    case '3':
                        $submenu_classes[] = 'multi-cols multi-cols-3';
                        if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                            $submenu_data_attr[] = 'data-item-width="' . esc_attr( $submenu_cols_w ) . '"';
                            $submenu_data_attr[] = 'data-item-cols="' . esc_attr( $submenu_cols ) . '"';
                        }
                        break;
                    case '4':
                        $submenu_classes[] = 'multi-cols multi-cols-4';
                        if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                            $submenu_data_attr[] = 'data-item-width="' . esc_attr( $submenu_cols_w ) . '"';
                            $submenu_data_attr[] = 'data-item-cols="' . esc_attr( $submenu_cols ) . '"';
                        }
                        break;
                    case '5':
                        $submenu_classes[] = 'multi-cols multi-cols-5';
                        if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                            $submenu_data_attr[] = 'data-item-width="' . esc_attr( $submenu_cols_w ) . '"';
                            $submenu_data_attr[] = 'data-item-cols="' . esc_attr( $submenu_cols ) . '"';
                        }
                        break;
                    // Default to 1
                    default:
                        if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                            $submenu_styles[] = 'width:' . $submenu_cols_w . 'px';
                        }
                        break;
                }
            }
            /*if ( is_numeric( $submenu_cols_w ) && $submenu_cols_w > 0 && $submenu_drop != 'full' ) {
                $submenu_styles[] = 'width:' . $submenu_cols_w . 'px';
            }*/
            if ( '' != $submenu_drop ) {
                $submenu_classes[] = 'drop-' . $submenu_drop;
            }
            if ( '' != $submenu_bg_color ) {
                if ( wpmetrics_validate_color( $submenu_bg_color ) ) {
                    $submenu_styles[] = 'background-color:' . $submenu_bg_color;
                }
            }
            if ( '' != esc_url( $submenu_bg_image ) ) {
                $submenu_styles[] = 'background-image:url(' . esc_url( $submenu_bg_image ) . ')';
                if ( '' != $submenu_bg_image_attachment ) {
                    $submenu_styles[] = 'background-attachment:' . $submenu_bg_image_attachment;
                }
                if ( '' != $submenu_bg_image_size ) {
                    $submenu_styles[] = 'background-size:' . $submenu_bg_image_size;
                }
                if ( '' != $submenu_bg_image_position ) {
                    $submenu_styles[] = 'background-position:' . $submenu_bg_image_position;
                }
                if ( '' != $submenu_bg_image_repeat ) {
                    $submenu_styles[] = 'background-repeat:' . $submenu_bg_image_repeat;
                }
            }
        }

        $submenu_classes = esc_attr( implode( ' ', $submenu_classes ) );
        $submenu_styles = empty( $submenu_styles ) ? '' : 'style="' . esc_attr( implode( ';', $submenu_styles ) ) . '"';
        $submenu_data_attr = empty( $submenu_data_attr ) ? '' : implode( ' ', $submenu_data_attr );

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"$submenu_classes\" $submenu_styles $submenu_data_attr>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $icon = isset( $item->icon ) ? $item->icon : '';
        $widget_area = isset( $item->widget_area ) ? $item->widget_area : '';
        $hide_title = isset( $item->hide_title ) ? $item->hide_title : '';

        if ( 0 < $depth ) {
            if ( $hide_title ) {
                $classes[] = 'menu-item-hide-title';
            }

            if ( '' != $widget_area ) {
                $classes[] = 'menu-item-widget';
            }
        }

        if ( 0 == $depth ) {
            $submenu_cols = isset( $item->submenu_cols ) ? $item->submenu_cols : '1';
            $group_submenu = isset( $item->group_submenu ) ? $item->group_submenu : '';
            $submenu_drop = isset( $item->submenu_drop ) ? $item->submenu_drop : '';
            if ( '' != $submenu_cols && 1 < $submenu_cols ) {
                $classes[] = 'menu-item-mega-' . esc_attr( $submenu_cols );
            }
            if ( 'full' == $submenu_drop ) {
                $classes[] = 'menu-item-has-sub-menu-full';
            }
            if ( '1' == $group_submenu ) {
                $classes[] = 'menu-item-group-sub-menu';
            }
        }

        /**
         * Filter the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param array  $args  An array of arguments.
         * @param object $item  Menu item data object.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        /**
         * Filter a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string $title The menu item's title.
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = $args->before;

        if ( 0 < $depth && '' != $widget_area ) {
            $item_output .= '<div class="menu-item-inner">';
            if ( $icon ) {
                $item_output .= '<i class="menu-icon ' . esc_attr( $icon ) . '"></i>';
            }
            if ( is_active_sidebar( $widget_area ) ) {
                ob_start();
                dynamic_sidebar( $widget_area );
                $widget_area_content = ob_get_clean();
                if ( $widget_area_content ) {
                    $item_output .= $widget_area_content;
                }
            }
            $item_output .= '</div>';
        }
        else {
            $item_output .= '<a'. $attributes .'>';
            if ( $icon ) {
                $item_output .= '<i class="menu-icon ' . esc_attr( $icon ) . '"></i>';
            }
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
        }
        $item_output .= $args->after;

        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
} // WPMetrics_Walker_Nav_Menu
