<?php

// Namespace declaration
namespace Sofasurfer;

// Exit if accessed directly 
defined('ABSPATH') or die;


/**
 * General hooks
 */
class Radio {

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
        add_shortcode( 'get_radio', [$this, 'get_radio']);


        add_action('wp_ajax_get_radio', [$this, 'ajax_get_radio']);
        add_action('wp_ajax_nopriv_get_radio', [$this, 'ajax_get_radio'] );            
    
    }

    public function ajax_get_radio(){
        wp_send_json_success($this->get_radio());        
    }

    public function get_radio(){
        $streaminfo = $this->get_stream_info('stream.yagwud.com','8000');
        ob_start();
        set_query_var( 'get_stream_info', $streaminfo );
        get_template_part('templates/radio');
        $output = ob_get_clean();
        return $output;
    }

    public function get_stream_info($icecast_host, $icecast_port) {
        $status_url = "http://{$icecast_host}:{$icecast_port}/status-json.xsl";
        $status_dat = @file_get_contents($status_url);

        if ($status_dat === FALSE) {
            return FALSE;
        }

        $status_arr = json_decode($status_dat, true);
        if ($status_arr === NULL || !isset($status_arr["icestats"]) || !isset($status_arr["icestats"]["source"]) ) {
            return FALSE;
        }

        $date = new \DateTime($status_arr["icestats"]["source"]['stream_start'], new \DateTimeZone('UTC'));
        $date->setTimezone(new \DateTimeZone('Europe/Zurich'));

        $status_arr["icestats"]["source"]['stream_start'] = $date->format('D d.m.Y H:i');

        return $status_arr["icestats"]["source"];
    }
  
}

// Trigger initialization
Radio::instance();