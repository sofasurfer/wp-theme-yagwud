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
        PostTypes::instance()->register_post_type('event', 'dashicons-calendar', [
            'name' => 'Events',
            'singular_name' => 'Event',
            'menu_name' => 'Events',
            'all_items' => 'All Events',
            'add_new' => 'Add Event',
            'add_new_item' => 'New Event',
            'edit_item' => 'Edit Event',
            'new_item' => 'New Event',
            'view_item' => 'Show Event',
            'search_items' => 'Search Events',
            'not_found' => 'Event has not been found.',
            'not_found_in_trash' => 'Event not found in the trash'
        ], [
            'en' => 'event'
        ], false, true,['title', 'thumbnail', 'revisions', 'page-attributes']);

        if(!function_exists("register_field_group"))
            return;
    }
}

Events::instance();