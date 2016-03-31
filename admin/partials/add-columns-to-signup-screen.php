<?php
// http://ieg.wnet.org/blog/a-guide-to-custom-wordpress-admin-columns/

add_filter( 'manage_signup_posts_columns' , 'wnetpp_set_admin_column_list');
function wnetpp_set_admin_column_list($columns) {
	  //unset($columns['date']);
	  // Delete the element from the array and the column disappears.
	  unset($columns['title']);
	  // Delete title so I can add it back in my preferred order.
	  $columns['title'] = 'Inquirer Name';
	  // Adding back the built-in 'title' column, but giving it a new label.
	  $columns['referralPage'] = 'Referal Page';
	  $columns['mobile'] = 'Mobile';
	  $columns['email'] = 'Email';
	  $columns['tellUs'] = 'Remarks';
	  // $columns['modified'] = 'Last Modified';
	  return $columns;
}

add_action( 'manage_signup_posts_custom_column' , 'wnetpp_populate_custom_columns', 10, 2 );
function wnetpp_populate_custom_columns( $column, $post_id ) {
  // 'Referal Page' is just a post meta field
  if ($column == 'referralPage') {
    echo get_post_meta( $post_id , 'as_signup_form_referral_page' , true );
  }

  if ($column == 'mobile') {
    echo get_post_meta( $post_id , 'as_signup_form_mobile_no' , true );
  }

  if ($column == 'email') {
    echo get_post_meta( $post_id , 'as_signup_form_email' , true );
  }

  if ($column == 'tellUs') {
    echo get_the_content();
  }
}

add_filter( 'manage_edit-signup_sortable_columns' , 'wnetpp_admin_sortable_columns' );
function wnetpp_admin_sortable_columns($columns) {
  $columns['referralPage'] = 'referralPage';
  $columns['mobile'] = 'mobile';
  $columns['email'] = 'email';
  return $columns;
}

add_filter( 'pre_get_posts', 'wnetpp_admin_sort_columns_by');
function wnetpp_admin_sort_columns_by( $query ) {
  if( ! is_admin() ) {
    // we don't want to affect public-facing pages
    return;
  }
  $orderby = $query->get( 'orderby');
  
  if( 'referralPage' == $orderby ) {
    $query->set('meta_key', 'as_signup_form_referral_page');
    $query->set('orderby','meta_value');
  }

  if( 'mobile' == $orderby ) {
    $query->set('meta_key', 'as_signup_form_mobile_no');
    $query->set('orderby','meta_value');
  }
  
  if( 'email' == $orderby ) {
    $query->set('meta_key', 'as_signup_form_email');
    $query->set('orderby','meta_value');
  }

}












// http://wordpress.stackexchange.com/questions/45436/add-filter-menu-to-admin-list-of-posts-of-custom-type-to-filter-posts-by-custo
add_action( 'restrict_manage_posts', 'wpse45436_admin_posts_filter_restrict_manage_posts' );
/**
 * First create the dropdown
 */
function wpse45436_admin_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('signup' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
        $values = array(
            'Home' => 'Home',
            'Campaign – Free Demat' => 'Campaign – Free Demat', 
            'Campaign – Mutual Funds' => 'Campaign – Mutual Funds',
            'Products' => 'Products',
            'Equity' => 'Equity',
            'Derivatives' => 'Derivatives',
            'Currency' => 'Currency',
            'Commodities' => 'Commodities',
            'Advisory' => 'Advisory',
            'Depository Services' => 'Depository Services',
            'IPO' => 'IPO',
            'Mutual Funds' => 'Mutual Funds',
            'Insurance' => 'Insurance',
            'Corporate FDRs' => 'Corporate FDRs',
            'Postal Savings Scheme' => 'Postal Savings Scheme',
            'NPS' => 'NPS',
            'e-Insurance Account' => 'e-Insurance Account',
            'Bonds' => 'Bonds',
            'PAN Services' => 'PAN Services',

            'Happy Service' => 'Happy Service',
            'Partners' => 'Partners',
            'Research' => 'Research',
            'Mobile Trading' => 'Mobile Trading',
            'Online Mutual Funds' => 'Online Mutual Funds',
            'Online Trading' => 'Online Trading',
        );



        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filter By ', 'wose45436'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}


add_filter( 'parse_query', 'wpse45436_posts_filter' );
/**
 * if submitted filter by post meta
 * 
 * make sure to change META_KEY to the actual meta key
 * and signup to the name of your custom post type
 * @return Void
 */
function wpse45436_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'signup' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'as_signup_form_referral_page';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}


















// https://brudtkuhl.com/wordpress-filter-posts-custom-field-value-admin/
// add_filter( 'parse_query', 'ba_admin_posts_filter' );
// add_action( 'restrict_manage_posts', 'ba_admin_posts_filter_restrict_manage_posts' );
function ba_admin_posts_filter( $query )
{
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
        $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
    if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '')
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}
function ba_admin_posts_filter_restrict_manage_posts()
{
    global $wpdb;
    $sql = 'SELECT DISTINCT meta_key FROM '.$wpdb->postmeta.' ORDER BY 1';
    $fields = $wpdb->get_results($sql, ARRAY_N);
?>
<select name="ADMIN_FILTER_FIELD_NAME">
<option value=""><?php _e('Filter By Custom Fields', 'baapf'); ?></option>
<?php
    $current = isset($_GET['ADMIN_FILTER_FIELD_NAME'])? $_GET['ADMIN_FILTER_FIELD_NAME']:'';
    $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
    foreach ($fields as $field) {
        if (substr($field[0],0,1) != "_"){
        printf
            (
                '<option value="%s"%s>%s</option>',
                $field[0],
                $field[0] == $current? ' selected="selected"':'',
                $field[0]
            );
        }
    }
?>
</select> <?php _e('Value:', 'baapf'); ?><input type="TEXT" name="ADMIN_FILTER_FIELD_VALUE" value="<?php echo $current_v; ?>" />
<?php
}








add_action( 'restrict_manage_posts', 'bs_event_table_filtering' );
function bs_event_table_filtering() {
  global $wpdb;
  if ( $screen->post_type == 'signup' ) {

    $dates = $wpdb->get_results( "SELECT EXTRACT(YEAR FROM meta_value) as year,  EXTRACT( MONTH FROM meta_value ) as month FROM $wpdb->postmeta WHERE meta_key = '_bs_meta_event_date' AND post_id IN ( SELECT ID FROM $wpdb->posts WHERE post_type = 'event' AND post_status != 'trash' ) GROUP BY year, month " ) ;

    echo '';
      echo '' . __( 'Show all event dates', 'textdomain' ) . '';
    foreach( $dates as $date ) {
      $month = ( strlen( $date->month ) == 1 ) ? 0 . $date->month : $date->month;
      $value = $date->year . '-' . $month . '-' . '01 00:00:00';
      $name = date( 'F Y', strtotime( $value ) );

      $selected = ( !empty( $_GET['event_date'] ) AND $_GET['event_date'] == $value ) ? 'selected="select"' : '';
      echo '' . $name . '';
    }
    echo '';

    $ticket_statuses = get_ticket_statuses();
    echo '';
      echo '' . __( 'Show all ticket statuses', 'textdomain' ) . '';
    foreach( $ticket_statuses as $value => $name ) {
      $selected = ( !empty( $_GET['ticket_status'] ) AND $_GET['ticket_status'] == $value ) ? 'selected="selected"' : '';
      echo '' . $name . '';
    }
    echo '';

  }
}