<?php

// Namespace declaration
namespace Neofluxe\PostType;

use Neofluxe\PostTypes;

// Exit if accessed directly 
defined('ABSPATH') or die;

class Events {

    private static $instance;

    public static function instance() {
        return self::$instance ?: (self::$instance = new self());
    }

    private function __construct() {
        add_action('init', [$this, 'register']);
    }

    public function register() {
        PostTypes::instance()->register_post_type('event', 'dashicons-star-filled', [
            'name' => 'Events',
            'singular_name' => 'Event',
            'menu_name' => 'Events',
            'all_items' => 'All Events',
            'add_new' => 'Add Events',
            'add_new_item' => 'New Events',
            'edit_item' => 'Edit Events',
            'new_item' => 'New Events',
            'view_item' => 'Show Events',
            'search_items' => 'Search Events',
            'not_found' => 'Events has not been found.',
            'not_found_in_trash' => 'Events not found in the trash'
        ], [
            'en' => 'event'
        ], false, true,['title', 'excerpt', 'thumbnail', 'revisions']);

        if(!function_exists("register_field_group"))
            return;
    }
}

Events::instance();