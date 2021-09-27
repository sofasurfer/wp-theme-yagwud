<?php

// Namespace declaration
namespace Neofluxe;

// Exit if accessed directly 
defined('ABSPATH') or die;


/**
 * General hooks
 */
class General {

    /**
     * The singleton instance of this class.
     * @var General
     */
    private static $instance;

    /**
     * Gets the singleton instance of this class.
     * This instance is lazily instantiated if it does not already exist.
     * The given instance can be used to unregister from filter and action hooks.
     * 
     * @return General The singleton instance of this class.
     */
    public static function instance() {
        return self::$instance ?: (self::$instance = new self());
    }


    /**
     * Creates a new instance of this singleton.
     */
    private function __construct() {


        // add_action('wp_enqueue_scripts', [$this, 'custom_scripts']);
        add_action('init', [$this, 'c_init']);
        add_action('init', [$this, 'c_register_maim_menu'] );
        add_action('admin_head', [$this, 'my_custom_admin_css']);


        add_action('admin_init',[$this, 'yagwud_add_role_events'],999);
        add_action('login_enqueue_scripts', [$this, 'my_login_logo'] );

        add_action('login_head', [$this, 'add_site_favicon']);
        add_action('admin_head', [$this, 'add_site_favicon']);
        
        add_action( 'pre_get_posts', [$this, 'event_default_order'], 9 );
        add_action( 'restrict_manage_posts', [$this, 'tsm_filter_post_type_by_taxonomy']);

        add_action('wp_ajax_events_list', [$this, 'events_list']);
        add_action('wp_ajax_nopriv_events_list', [$this, 'events_list'] );
        

        add_shortcode( 'render_animation_elements', [$this, 'render_animation_elements'] );
        add_shortcode( 'render_imagetag', [$this, 'c_shortcode_render_image'] );
        add_shortcode( 'wp_version', [$this, 'c_shortcode_version'] );
        add_shortcode( 'c_option', [$this, 'c_shortcode_option'] );


        add_shortcode( 'y_flyers', [$this, 'shortcode_flyers'] );

        add_filter('c_get_pagetitle', [$this, 'c_get_pagetitle']);
        add_filter('c_get_ogobj', [$this, 'c_get_ogobj']);
        add_filter('login_redirect',[$this, 'glue_login_redirect'],999);
        add_filter('upload_mimes', [$this, 'cc_mime_types'] );
        add_filter('acf/format_value/type=textarea', [$this, 'c_format_value'], 10, 3);
        add_filter('acf/fields/google_map/api', [$this, 'my_acf_google_map_api'] );
        add_filter('use_block_editor_for_post', '__return_false', 10);
        add_filter('use_block_editor_for_post_type', '__return_false', 10);

        add_filter('acf/fields/wysiwyg/toolbars' , [$this, 'c_toolbars']  );
        add_filter('tiny_mce_before_init', [$this, 'c_tiny_mce_before_init'] );

        add_filter('nav_menu_css_class' , [$this, 'c_special_nav_class'] , 10 , 2);
        add_filter('nav_menu_link_attributes', [$this, 'add_class_to_menu'], 10, 4 );

        add_filter( 'parse_query', [$this, 'tsm_convert_id_to_term_in_query']);

        add_filter( 'manage_event_posts_columns', [$this, 'new_modify_event_table'] );
        add_filter( 'manage_event_posts_custom_column', [$this, 'new_modify_event_table_row'], 10, 2 );

        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        load_theme_textdomain('neofluxe', get_stylesheet_directory() . '/languages');


        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page();   
        }
    }



    public function c_init(){

        setcookie("hideloader", 'true');

        add_post_type_support( 'page', 'excerpt' );

        //remove_post_type_support( 'page', 'editor' );
        //remove_post_type_support( 'post', 'editor' );
        remove_post_type_support( 'project', 'editor' );
        
        // Remove comments page in menu
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });        
    }

    public function cc_mime_types($mimes = [] ){
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }


    public function add_site_favicon() {
        echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/assets/images/icon/favicon-32x32.png" />';
    }


    public function glue_login_redirect($redirect_to,$request='',$user=null){
        //using $_REQUEST because when the login form is submitted the value is in the POST
        if(isset($_REQUEST['redirect_to'])){
            $redirect_to = $_REQUEST['redirect_to'];
        }
        return $redirect_to;
    }

    public function c_register_maim_menu() {
      register_nav_menu('header-menu', __( 'Header Menu' ));
      register_nav_menu('footer-menu', __( 'Footer Menu' ));

    }


    public function my_acf_google_map_api() {
        $api['key'] = get_field('googlemap_api_key','option');
        return $api;
    }

    public function c_shortcode_version(){
        $my_theme = wp_get_theme( 'neofluxe' );
        if ( $my_theme->exists() ){
            return $my_theme->get( 'Version' );
        }
        return 1.0;
    }


    public function yagwud_add_role_events(){

        add_role('yagwud_event_maner_3',
            'Yagwud Events',
            array(
                'read' => true,
                'edit_posts' => false,
                'delete_posts' => false,
                'publish_posts' => false,
                'upload_files' => true,
                'manage_categories' => true,
                'assign_terms' => true
            )
        );


        // Add the roles you'd like to administer the custom post types
        $roles = array('yagwud_event_maner_3','editor','administrator');
        
        // Loop through each role and assign capabilities
        foreach($roles as $the_role) { 

            $role = get_role($the_role);

            $role->add_cap( 'manage_event' );
            $role->add_cap( 'manage_events' );
            $role->add_cap( 'read_event');
            $role->add_cap( 'read_events');
            $role->add_cap( 'read_private_event' );
            $role->add_cap( 'read_private_events' );
            $role->add_cap( 'edit_event' );
            $role->add_cap( 'edit_events' );
            $role->add_cap( 'edit_others_events' );
            $role->add_cap( 'edit_published_events' );
            $role->add_cap( 'publish_events' );
            $role->add_cap( 'delete_others_events' );
            $role->add_cap( 'delete_private_events' );
            $role->add_cap( 'delete_published_events' );
            $role->add_cap( 'manage_categories' );
            $role->add_cap( 'manage_event_categories' );
            $role->add_cap( 'assign_categories' );
            $role->add_cap( 'assign_events_categories' );
            $role->add_cap( 'manage_events_terms' );
            $role->add_cap( 'edit_events_terms' );
            $role->add_cap( 'delete_events_terms' );
            $role->add_cap( 'assign_events_terms' );
            $role->add_cap( 'assign_terms' );
        
        }
    }

    /*
        Run do_shortcode on all textarea values
    */
    public function c_format_value( $value, $post_id, $field ) {
        $value = do_shortcode($value);
        return $value;
    }


    public function c_get_pagetitle(){

        $pagetitle = get_the_title() . ' | ';

        return  $pagetitle . get_bloginfo();
    }

    public function c_get_ogobj(){

        $obj = [];
        $obj['locale'] = 'EN';
        $obj['title'] = $this->c_get_pagetitle();
        $obj['description'] = get_field('rev_header_metadescription');

        $image_id = false;
        if( get_post_thumbnail_id() ){
            $image_id = get_post_thumbnail_id();
        }else if( get_field('rev_header_image_desktop') ){
            $image_id = get_field('rev_header_image_desktop');
        }
        if( $image_id  ){

            $obj['image'] = wp_get_attachment_image_src( $image_id, 'medium' );
        }
        return $obj;
    }


    /*
        Renders an image tag by it's ID
    */
    public function c_shortcode_render_image($args){

        // get alttext
        if( !empty($args['alt'])){
            $alt = $args['alt'];
        }else{
            $alt = wp_get_attachment_caption( $args['id'] );
        }

        // error_log(print_r(get_intermediate_image_sizes(),true));

        // get different image sizes
        if( $args['mobile'] && !empty($args['mobile']) ){
            $src_small = wp_get_attachment_image_src( $args['mobile'], 'thumbnail' );
            $srcset  = $src_small[0] . ' 400w,';
            $scr_medium = wp_get_attachment_image_src( $args['mobile'], 'medium' );
            $srcset  .= $scr_medium[0] . ' 1250w,';
        }else{
            $src_small = wp_get_attachment_image_src( $args['id'], 'thumbnail' );
            $srcset  = $src_small[0] . ' 400w,';
            $scr_medium = wp_get_attachment_image_src( $args['id'], 'medium' );
            $srcset  .= $scr_medium[0] . ' 1250w,';
        }
        
        $scr_large =  wp_get_attachment_image_src( $args['id'], 'large' );
        $srcset .= $scr_large[0] . ' 1840w,';

        $scr_full =  wp_get_attachment_image_src( $args['id'], 'full' ); 
        $srcset .= $scr_full[0] . ' 2400w';

        $sizes = '100vw';
        // $sizes =    '(min-width: 1600px) 1200px,  // ViewPort mindestens 1600 px, nimm Bild mit 1200px Breite'.
        //             '(min-width: 1400px) 1100px,  // ViewPort mindestens 1400 px, nimm Bild mit 1100px Breite'.
        //             '(min-width: 1000px) 900px,    // ViewPort mindestens 1000 px, nimm Bild mit 900px Breite'.
        //             '100vw"';

        $image .= '<noscript><img src="'.$scr_full[0].'" alt="'.$alt.'" /></noscript>';
        $image .= '<img class="lazy" sizes="'.$sizes.'" data-srcset="'.$srcset.'" data-src="'.$scr_large[0].'" alt="'.$alt.'" />';

        if( $args['legend'] ){            
            $attachment = get_post( $args['id'] );
            if($attachment){
                $image .= '<figcaption class="c-legend">' . $attachment->post_excerpt. '</figcaption>';
            }
        }


        return $image;
    }


    public function render_animation_elements($args){

        // apply_filters('the_content', get_post_field('post_content', get_queried_object_id() ) ); 
        $dom = new \DOMDocument();
        $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $args['text'] );
        $items = $dom->getElementsByTagName('p');
        
        // error_log(print_r($args,true) . ' / ' . $args['text'] );

        $content = "";
        if( false && $items && count($items) > 0 ){
            for($i = 0; $i < $items->length; $i ++) {
                $content .= '<div class="animation-element fade-up">';
                $content .= '<div class="animation">' . $items->item($i)->nodeValue . PHP_EOL . '</div>';
                $content .= '</div>';
            }
        }else{
            $content .= '<div class="animation-element fade-up">';
            $content .= '<div class="animation">' . $args['text'] . '</div>';
            $content .= '</div>';
        }
        return $content;
    }

    /*
        Adds custom CSS to admin
    */
    public function my_custom_admin_css() {
        echo '<style>
        .acf-fc-layout-handle{
            color: white!important;
            background-color: #0073aa;
        }
        p.c-lead{
            font-size: 2rem;
        }
        </style>';
    }

    public function my_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/yagwud-logo-w.png);
                height:100px;
                width:333px;
                background-size: 333px 100px;
                background-repeat: no-repeat;
            }

            body.login{
                background-color: #000;
            }
            .login{
                color:  #fff;
            }
            .message,
            #login_error{
                color:  #000;
            }
            #loginform,
            .login form{
                border: none;
                box-shadow: none;
                background-color: #000;
                border:  solid 1px #fff;
            }

            #nav,
            #backtoblog{
                display:  none;
            }
            .login .privacy-policy-page-link{
                margin: 0em 0 2em!important;
            }
            .login .privacy-policy-page-link a{
                color: #fff;
            }

            .login.wp-core-ui .button-primary,
            .login.wp-core-ui .button-primary:hover{
                color: #000;
                background: #fff;
                border-color: #fff;
            }
            .login.wp-core-ui .dashicons-visibility::before{
                color:  #fff;
            }
            .login form .input{
                border-radius: 0;
                border-color: #fff;
            }
        </style>
    <?php }

    public function new_modify_event_table( $column ) {


        $column['act'] = 'Act';
        $column['club_name'] = 'Club';
        $column['club_city'] = 'City';
        $column['show_date'] = 'Date';

        unset($column['date']);

        return $column;
    }

    public function new_modify_event_table_row( $column_name, $event ) {
        switch ($column_name) {
            case 'act' :
                $categories = get_the_terms($event,'event_category');
                echo $categories[0]->name;
                break;
            case 'club_name' :
                echo get_field( 'club', $event );
                break;
            case 'club_city' :
                echo get_field( 'location', $event )['city'];
                break;
            case 'show_date' :
                echo get_field( 'startdate', $event );
                break;
        }
    }


    public function event_default_order($query){
        if ($query->get('post_type') == 'event') {
            if ($query->get('orderby') == '') {
                $query->set('orderby', 'meta_value');
                $query->set('meta_key', 'startdate');
            }
            if ($query->get('order') == '') {
                $query->set('order', 'DESC');
            }
        }
        return $query;
    }


    public function tsm_filter_post_type_by_taxonomy() {
        global $typenow;
        $post_type = 'event'; // change to your post type
        $taxonomy  = 'event_category'; // change to your taxonomy
        if ($typenow == $post_type) {
            $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => true,
            ));
        };
    }


    public function tsm_convert_id_to_term_in_query($query){
        global $pagenow;
        $post_type = 'event'; // change to your post type
        $taxonomy  = 'event_category'; // change to your taxonomy
        $q_vars    = &$query->query_vars;
        if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    /*
        wysiwyg settings
    */
    public function c_toolbars( $toolbars )
    {

        $toolbars['SofaSurfer default'] = array();
        $toolbars['SofaSurfer default'][1] = array(
            'formatselect',
            'styleselect',
            'bold',
            'italic',
            'link',
            'unlink',
            'removeformat',
            'charmap',
        );
        return $toolbars;
    }
    public function c_tiny_mce_before_init( $settings ){

        $settings['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;';
        $style_formats = array(
            array(
                    'title' => 'Lead',
                    'selector' => 'p',
                    'classes' => 'c-lead',
                    'wrapper' => false,
            ),
        );

        $settings['style_formats'] = json_encode( $style_formats );        
        return $settings;

    }

    public function shortcode_flyers($args){

        ob_start();
        $files = scandir( wp_upload_dir()['basedir'] . '/flyers');
        $index = 1;
        foreach($files as $file):
            if( strpos($file,".") > 2 ):
            ?>
            <a href="<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>" target="_blank" data-index="<?=$index;?>">
                <img  src="<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>"/></a>
            <script>images.push('<?= wp_upload_dir()['baseurl']; ?>/flyers/<?= $file;?>');</script>
            <?php
            $index++;
            endif;
        endforeach;

        $output = ob_get_contents();
        ob_end_clean();

        return $output;

    }


    /*
        Events LIST
    */
    function events_list(){

        global $wp_query;
        $today = date("Ymd");
        $events_query = array(
            'post_type' => 'event',
            'order'     => 'ASC',
            'orderby'   => 'startdate',
            'posts_per_page'   => -1,          
        );

        // Check for filters
        if( empty($_GET['all']) ){
            $events_query['meta_query'] = array(
                'relation'      => 'AND',
                array(
                    'key'       => 'startdate',
                    'value'     => $today,
                    'compare'   => '>=',
                ),
            );
        }

        if( !empty($_GET['bid']) ){
            $events_query['tax_query'] = array(
                array(
                    'taxonomy' => 'event_category',
                    'field'    => 'slug',
                    'terms' => $_GET['bid']
                )
            );
        }

        $events = get_posts( $events_query );

        $result = [];
        foreach( $events as $event ){
            $result[shows][] =  array(
                'title' => get_the_title( $event ),
                'club_name' => get_field( 'club', $event ),
                'club_city' => get_field( 'location', $event ),
                'show_date' => get_field( 'startdate', $event ),
                'event_link' => get_field( 'event_link', $event ),
                'ticket_link' => get_field( 'ticket_link', $event ),
            );
        }

        echo json_encode($result);
        wp_die(); 
    }

}

// Trigger initialization
General::instance();