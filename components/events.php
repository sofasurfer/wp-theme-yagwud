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

        $url = 'https://www.yagwud.com/cms/wp-admin/admin-ajax.php?action=events_list';
        $content = file_get_contents($url);
        $json = json_decode($content, true);

        ob_start();
        echo '<table>';
        // Check if tours exist
        if( !empty($json['shows'][0]) ){
            foreach($json['shows'] as $item) {
                set_query_var( 'y_event', $item );
                get_template_part('templates/event');
            }    
        }

        echo '</table>';
        $events = ob_get_clean();
        return $events;
    }
  
}

// Trigger initialization
Events::instance();