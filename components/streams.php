<?php

// Namespace declaration
namespace Sofasurfer;

// Exit if accessed directly 
defined('ABSPATH') or die;


/**
 * General hooks
 */
class Streams {

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
        add_shortcode( 'get_streams', [$this, 'get_streams']);
    
    }
  
      public function get_streams($atts) {
        $args = array(
            'post_type'        => 'stream',
            'post_status'      => 'publish',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'posts_per_page'   => - 1,
            'suppress_filters' => false,
            'category'         => $atts['cat'], 
        );
        $streams = get_posts( $args );
        ob_start();
        foreach($streams as $streaminfo){
            set_query_var( 'get_stream_info', $streaminfo );
            get_template_part('templates/stream');
        }
        $output = ob_get_clean();
        return $output;
      }
  
}

// Trigger initialization
Streams::instance();
