<?php

// Namespace declaration
namespace Sofasurfer;

// Exit if accessed directly 
defined('ABSPATH') or die;


/**
 * General hooks
 */
class Gallery {

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
        add_shortcode( 'get_gallery', [$this, 'get_gallery']);
    
    }
  
      public function get_gallery($icecast_host, $icecast_port) {
        $files = scandir( wp_upload_dir()['basedir'] . '/flyers');
        $index = 1;
        $content = "";
        foreach($files as $file):
            if( strpos($file,".") > 2 ):
                $content .= '<a class="gallery_item" href="' . wp_upload_dir()['baseurl'] . '/flyers/' . $file . '" target="_blank" data-index="'.$index.'">
                    <img  src="'. wp_upload_dir()['baseurl'] . '/flyers/' . $file . '"/></a>
                <script>images.push("' . wp_upload_dir()['baseurl'] . '/flyers/' . $file . '");</script>';
                $index++;
            endif;
        endforeach;

        return $content ;
      }
  
}

// Trigger initialization
Gallery::instance();
