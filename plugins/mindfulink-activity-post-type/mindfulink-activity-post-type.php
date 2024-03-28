<?php

/**
 * Plugin Name: Mindfulink Activity Post Type
 * Description: A plugin to register the activity post type and taxonomies
 * Version: 1.0
 * Author: Mindfulink
 */

function mindfulink_enqueue_post_editor_assets()
{
    wp_enqueue_script(
        'mindfulink-activity-post-type',
        plugins_url('plugin.js', __FILE__),
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(plugin_dir_path(__FILE__) . '/plugin.js')
    );
}
add_action('enqueue_block_editor_assets', 'mindfulink_enqueue_post_editor_assets', 2);


function activity_post_type()
{
    $labels = array(
        'name' => 'Activities',
        'singular_name' => 'Activity',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Activity',
        'edit_item' => 'Edit Activity',
        'new_item' => 'New Activity',
        'all_items' => 'All Activities',
        'view_item' => 'View Activity',
        'search_items' => 'Search Activities',
        'not_found' => 'No Activities Found',
        'not_found_in_trash' => 'No Activities Found in Trash',
        'parent_item_colon' => 'Parent Activity'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'slug' => 'activities',
        'has_archive' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-buddicons-activity',
        'query_var' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'activities', 'with_front' => false),
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes',
            'revisions',
            'post-formats', // post formats
        ),
        'taxonomies' => array(
            'material',
            'type',
            'effort_level'
        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );

    register_post_type('activity', $args);
}
add_action('init', 'activity_post_type');


function activity_taxonomies()
{
    register_taxonomy(
        'material',
        ['activity'],
        [
            'labels' => [
                'name' => 'Materials',
                'singular_name' => 'Material',
                'search_items' => 'Search Materials',
                'all_items' => 'All Materials',
                'edit_item' => 'Edit Material',
                'update_item' => 'Update Material',
                'add_new_item' => 'Add New Material',
                'new_item_name' => 'New Material Name',
                'menu_name' => 'Materials'
            ],
            'hierarchical' => false,
            'rewrite' => array('slug' => 'activities?material=', 'with_front' => false),
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'effort_level',
        ['activity'],
        [
            'labels' => [
                'name' => 'Effort Level',
                'singular_name' => 'Effort Level',
                'search_items' => 'Search Effort Levels',
                'all_items' => 'All Effort Levels',
                'edit_item' => 'Edit Effort Level',
                'update_item' => 'Update Effort Level',
                'add_new_item' => 'Add New Effort Level',
                'new_item_name' => 'New Effort Level Name',
                'menu_name' => 'Effort Levels'
            ],
            'rewrite' => array('slug' => 'activities?effort-level=', 'with_front' => false),
            'hierarchical' => false,
            'has_archive' => true, // 'effort-levels
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'a-type',
        ['activity'],
        [
            'labels' => [
                'name' => 'Type',
                'singular_name' => 'Type',
                'search_items' => 'Search Types',
                'all_items' => 'All Types',
                'edit_item' => 'Edit Type',
                'update_item' => 'Update Type',
                'add_new_item' => 'Add New Type',
                'new_item_name' => 'New Type Name',
                'menu_name' => 'Types'
            ],
            'rewrite' => array('slug' => 'activities?type=', 'with_front' => false),
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
}

add_action('init', 'activity_taxonomies', 0);

function mindfulink_wp_enqueue_style2()
{
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_style('activity',  $plugin_url . "/css/activity.css");
}

add_action('wp_enqueue_scripts', 'mindfulink_wp_enqueue_style2');


// function generate_taxonomy_rewrite_rules($wp_rewrite)
// {
//     $rules = array();
//     $post_types = get_post_types(array('name' => 'activity', 'public' => true, '_builtin' => false), 'objects');
//     $taxonomies = get_taxonomies(array('name' => 'type', 'public' => true, '_builtin' => false), 'objects');

//     foreach ($post_types as $post_type) {
//         $post_type_name = $post_type->name; // 'activity'
//         $post_type_slug = $post_type->rewrite['slug']; // 'activities'

//         foreach ($taxonomies as $taxonomy) {
//             $taxonomy_slug = $taxonomy->rewrite['slug']; // 'activities'

//             if ($taxonomy->object_type[0] == $post_type_name) {
//                 $terms = get_categories(array('type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));
//                 foreach ($terms as $term) {
//                     $rules[$taxonomy_slug . '/' . $term->slug . '/?'] = 'index.php?' . '/' . $post_type_slug  . '?type' . '=' . $term->slug;
//                 }
//             }
//         }
//     }
//     $wp_rewrite->rules = $rules + $wp_rewrite->rules; // Add custom rules to existing rewrite rules
//     // $activities_structure = '/activities/%type%/';
//     //     $wp_rewrite->add_rewrite_tag("%type%", '([^/]+)', "type=");
//     //     $wp_rewrite->add_permastruct('activities', $activities_structure, false);
// }


// add_filter('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');
