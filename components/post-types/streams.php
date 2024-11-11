<?php

// Namespace declaration
namespace Neofluxe\PostType;

use Neofluxe\PostTypes;

// Exit if accessed directly 
defined('ABSPATH') or die;

class Streams {

    private static $instance;

    public static function instance() {
        return self::$instance ?: (self::$instance = new self());
    }

    private function __construct() {
        add_action('init', [$this, 'register']);
    }

    public function register() {
        PostTypes::instance()->register_post_type('stream', 'dashicons-format-audio', [
            'name' => 'Streams',
            'singular_name' => 'Stream',
            'menu_name' => 'Streams',
            'all_items' => 'All Streams',
            'add_new' => 'Add Streams',
            'add_new_item' => 'New Streams',
            'edit_item' => 'Edit Streams',
            'new_item' => 'New Stream',
            'view_item' => 'Show Stream',
            'search_items' => 'Search Streams',
            'not_found' => 'Stream has not been found.',
            'not_found_in_trash' => 'Stream not found in the trash'
        ], [
            'en' => 'stream'
        ], false, true,['title', 'thumbnail', 'revisions', 'page-attributes']);

        if(!function_exists("register_field_group"))
            return;
    }
}

Streams::instance();