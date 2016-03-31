<?php
	add_filter( 'manage_edit-campaign_columns',  'add_new_columns' );
add_filter( 'manage_edit-post_sortable_columns', 'register_sortable_columns' );
add_filter( 'request', 'campaign_column_orderby' );
add_action( 'manage_posts_custom_column' , 'custom_columns' );
/**
* Add new columns to the post table
*
* @param Array $columns - Current columns on the list post
*/
function add_new_columns($columns){

    $column_meta = array( 'campaign' => 'Campaign ID' );
    $columns = array_slice( $columns, 0, 6, true ) + $column_meta + array_slice( $columns, 6, NULL, true );
    return $columns;

}

// Register the columns as sortable
function register_sortable_columns( $columns ) {
    $columns['campaign'] = 'campaign';
    return $columns;
}

//Add filter to the request to make the campaign sorting process numeric, not string
function campaign_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'campaign' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'campaign',
            'orderby' => 'meta_value_num'
        ) );
    }

    return $vars;
}

/**
* Display data in new columns
*
* @param  $column Current column
*
* @return Data for the column
*/
function custom_columns($column) {

    global $post;

    switch ( $column ) {
        case 'campaign':
            $campaign = $post->ID;
            echo (int)$campaign;
        break;
    }
}



?>
