<?php defined( 'ABSPATH' ) or exit();
/**
 * Extending default Visual Composer
 * This file contains some classes and functions for extending Visual Composer's features
 * @package WPMetrics
 */

if ( ! class_exists( 'WPMetrics_VC_Ext' ) ) :

/**
 * Extending visual composer parameters and other stuffs
 */
class WPMetrics_VC_Ext {

    function __construct() {
        //-- Icon picker additional library -->
        // Register icon library for front-end and back-end
        add_action( 'wp_enqueue_scripts', array( $this, 'iconpicker_base_register_css' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'iconpicker_base_register_css' ) );
        add_action( 'vc_backend_editor_enqueue_js_css', array( $this, 'iconpicker_editor_enqueues' ) );
        add_action( 'vc_frontend_editor_enqueue_js_css', array( $this, 'iconpicker_editor_enqueues' ) );
        add_action( 'vc_enqueue_font_icon_element', array( $this, 'iconpicker_editor_enqueues' ) );

        // Load and render icons to backend editor
        add_filter( 'vc_iconpicker-type-strokegapicons', array( $this, 'vc_iconpicker_type_strokegapicons' ) );

        //<-- Icon picker additional library
    }

    /**
     * Register icon css
     */
    function iconpicker_base_register_css() {
        wp_enqueue_style( 'strokegapicons', get_template_directory_uri() . '/assets//css/stroke-gap-icons.min.css', false, '', 'screen' );
    }

    /**
     * Enqueue icon css for backend and frontend editor
     */
    function iconpicker_editor_enqueues() {
        wp_enqueue_style( 'strokegapicons' );
    }

    /**
     * Stroke gap icons library
     * @param  array $icon {
     *     Extra icons if needed
     *     @var  string     Icon class
     *     @var  string     Icon name
     * }
     * @return array
     */
    function vc_iconpicker_type_strokegapicons( $icons ) {
        return array_merge(
            array(
                array( 'sgicon sgicon-WorldWide' => esc_html__( 'World Wide', 'wp-metrics' ) ),
                array( 'sgicon sgicon-WorldGlobe' => esc_html__( 'World Globe', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Underpants' => esc_html__( 'Underpants', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Tshirt' => esc_html__( 'Tshirt', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Trousers' => esc_html__( 'Trousers', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Tie' => esc_html__( 'Tie', 'wp-metrics' ) ),
                array( 'sgicon sgicon-TennisBall' => esc_html__( 'Tennis Ball', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Telesocpe' => esc_html__( 'Telesocpe', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Stop' => esc_html__( 'Stop', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Starship' => esc_html__( 'Starship', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Starship2' => esc_html__( 'Starship2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Speaker' => esc_html__( 'Speaker', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Speaker2' => esc_html__( 'Speaker2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Soccer' => esc_html__( 'Soccer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Snikers' => esc_html__( 'Snikers', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Scisors' => esc_html__( 'Scisors', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Puzzle' => esc_html__( 'Puzzle', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Printer' => esc_html__( 'Printer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pool' => esc_html__( 'Pool', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Podium' => esc_html__( 'Podium', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Play' => esc_html__( 'Play', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Planet' => esc_html__( 'Planet', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pause' => esc_html__( 'Pause', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Next' => esc_html__( 'Next', 'wp-metrics' ) ),
                array( 'sgicon sgicon-MusicNote2' => esc_html__( 'Music Note2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-MusicNote' => esc_html__( 'Music Note', 'wp-metrics' ) ),
                array( 'sgicon sgicon-MusicMixer' => esc_html__( 'Music Mixer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Microphone' => esc_html__( 'Microphone', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Medal' => esc_html__( 'Medal', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ManFigure' => esc_html__( 'Man Figure', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Magnet' => esc_html__( 'Magnet', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Like' => esc_html__( 'Like', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Hanger' => esc_html__( 'Hanger', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Handicap' => esc_html__( 'Handicap', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Forward' => esc_html__( 'Forward', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Footbal' => esc_html__( 'Footbal', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Flag' => esc_html__( 'Flag', 'wp-metrics' ) ),
                array( 'sgicon sgicon-FemaleFigure' => esc_html__( 'Female Figure', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Dislike' => esc_html__( 'Dislike', 'wp-metrics' ) ),
                array( 'sgicon sgicon-DiamondRing' => esc_html__( 'Diamond Ring', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Cup' => esc_html__( 'Cup', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Crown' => esc_html__( 'Crown', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Column' => esc_html__( 'Column', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Click' => esc_html__( 'Click', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Cassette' => esc_html__( 'Cassette', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bomb' => esc_html__( 'Bomb', 'wp-metrics' ) ),
                array( 'sgicon sgicon-BatteryLow' => esc_html__( 'Battery Low', 'wp-metrics' ) ),
                array( 'sgicon sgicon-BatteryFull' => esc_html__( 'Battery Full', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bascketball' => esc_html__( 'Bascketball', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Astronaut' => esc_html__( 'Astronaut', 'wp-metrics' ) ),
                array( 'sgicon sgicon-WineGlass' => esc_html__( 'Wine Glass', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Water' => esc_html__( 'Water', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Wallet' => esc_html__( 'Wallet', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Umbrella' => esc_html__( 'Umbrella', 'wp-metrics' ) ),
                array( 'sgicon sgicon-TV' => esc_html__( 'TV', 'wp-metrics' ) ),
                array( 'sgicon sgicon-TeaMug' => esc_html__( 'Tea Mug', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Tablet' => esc_html__( 'Tablet', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Soda' => esc_html__( 'Soda', 'wp-metrics' ) ),
                array( 'sgicon sgicon-SodaCan' => esc_html__( 'Soda Can', 'wp-metrics' ) ),
                array( 'sgicon sgicon-SimCard' => esc_html__( 'Sim Card', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Signal' => esc_html__( 'Signal', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Shaker' => esc_html__( 'Shaker', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Radio' => esc_html__( 'Radio', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pizza' => esc_html__( 'Pizza', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Phone' => esc_html__( 'Phone', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Notebook' => esc_html__( 'Notebook', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Mug' => esc_html__( 'Mug', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Mastercard' => esc_html__( 'Master card', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Ipod' => esc_html__( 'Ipod', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Info' => esc_html__( 'Info', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Icecream2' => esc_html__( 'Icecream2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Icecream1' => esc_html__( 'Icecream1', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Hourglass' => esc_html__( 'Hourglass', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Help' => esc_html__( 'Help', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Goto' => esc_html__( 'Goto', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Glasses' => esc_html__( 'Glasses', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Gameboy' => esc_html__( 'Gameboy', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ForkandKnife' => esc_html__( 'Forkand Knife', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Export' => esc_html__( 'Export', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Exit' => esc_html__( 'Exit', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Espresso' => esc_html__( 'Espresso', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Drop' => esc_html__( 'Drop', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Download' => esc_html__( 'Download', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Dollars' => esc_html__( 'Dollars', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Dollar' => esc_html__( 'Dollar', 'wp-metrics' ) ),
                array( 'sgicon sgicon-DesktopMonitor' => esc_html__( 'Desktop Monitor', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Corkscrew' => esc_html__( 'Corkscrew', 'wp-metrics' ) ),
                array( 'sgicon sgicon-CoffeeToGo' => esc_html__( 'Coffee To Go', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Chart' => esc_html__( 'Chart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ChartUp' => esc_html__( 'Chart Up', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ChartDown' => esc_html__( 'Chart Down', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Calculator' => esc_html__( 'Calculator', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bread' => esc_html__( 'Bread', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bourbon' => esc_html__( 'Bourbon', 'wp-metrics' ) ),
                array( 'sgicon sgicon-BottleofWIne' => esc_html__( 'Bottleof WIne', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bag' => esc_html__( 'Bag', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Arrow' => esc_html__( 'Arrow', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Antenna2' => esc_html__( 'Antenna2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Antenna1' => esc_html__( 'Antenna1', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Anchor' => esc_html__( 'Anchor', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Wheelbarrow' => esc_html__( 'Wheelbarrow', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Webcam' => esc_html__( 'Webcam', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Unlinked' => esc_html__( 'Unlinked', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Truck' => esc_html__( 'Truck', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Timer' => esc_html__( 'Timer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Time' => esc_html__( 'Time', 'wp-metrics' ) ),
                array( 'sgicon sgicon-StorageBox' => esc_html__( 'Storage Box', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Star' => esc_html__( 'Star', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ShoppingCart' => esc_html__( 'Shopping Cart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Shield' => esc_html__( 'Shield', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Seringe' => esc_html__( 'Seringe', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pulse' => esc_html__( 'Pulse', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Plaster' => esc_html__( 'Plaster', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Plaine' => esc_html__( 'Plaine', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pill' => esc_html__( 'Pill', 'wp-metrics' ) ),
                array( 'sgicon sgicon-PicnicBasket' => esc_html__( 'Picnic Basket', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Phone2' => esc_html__( 'Phone2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pencil' => esc_html__( 'Pencil', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pen' => esc_html__( 'Pen', 'wp-metrics' ) ),
                array( 'sgicon sgicon-PaperClip' => esc_html__( 'PaperClip', 'wp-metrics' ) ),
                array( 'sgicon sgicon-On-Off' => esc_html__( 'On-Off', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Mouse' => esc_html__( 'Mouse', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Megaphone' => esc_html__( 'Megaphone', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Linked' => esc_html__( 'Linked', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Keyboard' => esc_html__( 'Keyboard', 'wp-metrics' ) ),
                array( 'sgicon sgicon-House' => esc_html__( 'House', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Heart' => esc_html__( 'Heart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Headset' => esc_html__( 'Headset', 'wp-metrics' ) ),
                array( 'sgicon sgicon-FullShoppingCart' => esc_html__( 'Full Shopping Cart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-FullScreen' => esc_html__( 'Full Screen', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Folder' => esc_html__( 'Folder', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Floppy' => esc_html__( 'Floppy', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Files' => esc_html__( 'Files', 'wp-metrics' ) ),
                array( 'sgicon sgicon-File' => esc_html__( 'File', 'wp-metrics' ) ),
                array( 'sgicon sgicon-FileBox' => esc_html__( 'FileBox', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ExitFullScreen' => esc_html__( 'Exit Full Screen', 'wp-metrics' ) ),
                array( 'sgicon sgicon-EmptyBox' => esc_html__( 'Empty Box', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Delete' => esc_html__( 'Delete', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Controller' => esc_html__( 'Controller', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Compass' => esc_html__( 'Compass', 'wp-metrics' ) ),
                array( 'sgicon sgicon-CompassTool' => esc_html__( 'Compass Tool', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ClipboardText' => esc_html__( 'Clipboard Text', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ClipboardChart' => esc_html__( 'Clipboard Chart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ChemicalGlass' => esc_html__( 'Chemical Glass', 'wp-metrics' ) ),
                array( 'sgicon sgicon-CD' => esc_html__( 'CD', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Carioca' => esc_html__( 'Carioca', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Car' => esc_html__( 'Car', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Book' => esc_html__( 'Book', 'wp-metrics' ) ),
                array( 'sgicon sgicon-BigTruck' => esc_html__( 'Big Truck', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bicycle' => esc_html__( 'Bicycle', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Wrench' => esc_html__( 'Wrench', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Web' => esc_html__( 'Web', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Watch' => esc_html__( 'Watch', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Volume' => esc_html__( 'Volume', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Video' => esc_html__( 'Video', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Users' => esc_html__( 'Users', 'wp-metrics' ) ),
                array( 'sgicon sgicon-User' => esc_html__( 'User', 'wp-metrics' ) ),
                array( 'sgicon sgicon-UploadCLoud' => esc_html__( 'Upload CLoud', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Typing' => esc_html__( 'Typing', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Tools' => esc_html__( 'Tools', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Tag' => esc_html__( 'Tag', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Speedometter' => esc_html__( 'Speedometter', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Share' => esc_html__( 'Share', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Settings' => esc_html__( 'Settings', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Search' => esc_html__( 'Search', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Screwdriver' => esc_html__( 'Screwdriver', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Rolodex' => esc_html__( 'Rolodex', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Ringer' => esc_html__( 'Ringer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Resume' => esc_html__( 'Resume', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Restart' => esc_html__( 'Restart', 'wp-metrics' ) ),
                array( 'sgicon sgicon-PowerOff' => esc_html__( 'PowerOff', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Pointer' => esc_html__( 'Pointer', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Picture' => esc_html__( 'Picture', 'wp-metrics' ) ),
                array( 'sgicon sgicon-OpenedLock' => esc_html__( 'OpenedLock', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Notes' => esc_html__( 'Notes', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Mute' => esc_html__( 'Mute', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Movie' => esc_html__( 'Movie', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Microphone2' => esc_html__( 'Microphone2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Message' => esc_html__( 'Message', 'wp-metrics' ) ),
                array( 'sgicon sgicon-MessageRight' => esc_html__( 'MessageRight', 'wp-metrics' ) ),
                array( 'sgicon sgicon-MessageLeft' => esc_html__( 'MessageLeft', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Menu' => esc_html__( 'Menu', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Media' => esc_html__( 'Media', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Mail' => esc_html__( 'Mail', 'wp-metrics' ) ),
                array( 'sgicon sgicon-List' => esc_html__( 'List', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Layers' => esc_html__( 'Layers', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Key' => esc_html__( 'Key', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Imbox' => esc_html__( 'Imbox', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Eye' => esc_html__( 'Eye', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Edit' => esc_html__( 'Edit', 'wp-metrics' ) ),
                array( 'sgicon sgicon-DSLRCamera' => esc_html__( 'DSLRCamera', 'wp-metrics' ) ),
                array( 'sgicon sgicon-DownloadCloud' => esc_html__( 'DownloadCloud', 'wp-metrics' ) ),
                array( 'sgicon sgicon-CompactCamera' => esc_html__( 'CompactCamera', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Cloud' => esc_html__( 'Cloud', 'wp-metrics' ) ),
                array( 'sgicon sgicon-ClosedLock' => esc_html__( 'ClosedLock', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Chart2' => esc_html__( 'Chart2', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Bulb' => esc_html__( 'Bulb', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Briefcase' => esc_html__( 'Briefcase', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Blog' => esc_html__( 'Blog', 'wp-metrics' ) ),
                array( 'sgicon sgicon-Agenda' => esc_html__( 'Agenda', 'wp-metrics' ) )
            ),
            $icons
        );
    }
}

new WPMetrics_VC_Ext();

endif;


/**
 * Custom loop query builder
 */
class WPMetrics_VcLoopQueryBuilder extends VcLoopQueryBuilder {
    public function __construct( $data ) {
        parent::__construct( $data );
    }

    public function parse_paged( $paged ) {
        if ( is_numeric( $paged ) && 0 < (int)$paged ) {
            $this->args['paged'] = (int)$paged;
        }
    }

    public function parse_per_page( $per_page ) {
        $this->args['posts_per_page'] = $per_page;
    }

    public function getArgs() {
        return $this->args;
    }
}
