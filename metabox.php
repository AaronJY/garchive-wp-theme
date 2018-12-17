<?php

add_filter('rwmb_meta_boxes', function ($meta_boxes) {
    $prefix = 'garchive_metabox_';
    $meta_boxes[] = array(
        'id' => 'extra_post_options',
        'title' => __('Extra Post Options', 'garchive'),
        'post_types' => array('post', 'page'),
        'context' => 'normal',
        'priority' => 'high',
        'autosave' => 'false',
        'fields' => array(
            array(
                'id' => $prefix . 'creators',
                'type' => 'textarea',
                'name' => __('Creators', 'garchive'),
                'description' => __('A list of creators invovled in making the content.', 'garchive')
            ),
            array(
                'id' => $prefix . 'source',
                'type' => 'text',
                'name' => __('Source', 'garchive'),
                'description' => __('A link to the original content source.', 'garchive')
            )
        )    
    );

    return $meta_boxes;
});

?>