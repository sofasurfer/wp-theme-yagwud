<?php

// Namespace declaration
namespace Sofasurfer;

// Exit if accessed directly 
defined('ABSPATH') or die;


/**
 * General hooks
 */
class Events {

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
        add_shortcode( 'get_events', [$this, 'get_events']);
    
    }

    public function get_events(){

        global $wp_query;
        $today = date("Ymd");
        $events_query = array(
            'post_type' => 'event',
            'order'     => 'DESC',
            'orderby'   => 'startdate',
            'posts_per_page'   => -1,
        );
        // Check for filters
        if( empty($_REQUEST['all']) ){
            $events_query['meta_query'] = array(
                'relation'      => 'AND',
                array(
                    'key'       => 'startdate',
                    'value'     => $today,
                    'compare'   => '>=',
                ),
            );
        }
        
        $events = get_posts( $events_query );

        ob_start();
        echo '<div id="scroll-text">';
        // Check if tours exist
        foreach( $events as $event) {
            set_query_var( 'y_event', $event );
            get_template_part('templates/event');
        }
        echo '</div>';
        $events = ob_get_clean();
        return $events;
    }
  
}

// Trigger initialization
Events::instance();