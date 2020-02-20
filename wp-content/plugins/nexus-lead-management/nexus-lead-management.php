<?php
/*
Plugin Name: Nexus lead management
Description: Lead Management comes from others wordpress websites and store lead to customer website. Thats lead customer can send to clients.
Plugin URI: http://nexuslinkservices.com/
Author URI: http://nexuslinkservices.com/
Author: Nexuslink services
License: Public Domain
Version: 1.1
*/

global $lead_table_example_db_version;
$lead_table_example_db_version = '1.1'; // version changed from 1.0 to 1.1

/**
    * register_activation_hook implementation
    *
    * will be called when user activates plugin first time
    * must create needed database tables
    */
function lead_table_example_install()
{
    global $wpdb;
    global $lead_table_example_db_version;

    $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix

    // sql to create your table
    // NOTICE that:
    // 1. each field MUST be in separate line
    // 2. There must be two spaces between PRIMARY KEY and its name
    //    Like this: PRIMARY KEY[space][space](id)
    // otherwise dbDelta will not work
    $sql = "CREATE TABLE " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email VARCHAR(100) NOT NULL,
        age int(11) NULL,
		client VARCHAR (100) Not Null,
        PRIMARY KEY  (id)
    );";

    // we do not execute sql directly
    // we are calling dbDelta which cant migrate database
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // save current database version for later use (on upgrade)
    add_option('lead_table_example_db_version', $lead_table_example_db_version);

  
    $installed_ver = get_option('lead_table_example_db_version');
    if ($installed_ver != $lead_table_example_db_version) {
        $sql = "CREATE TABLE " . $table_name . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            email VARCHAR(200) NOT NULL,
            age int(11) NULL,
			client VARCHAR (100) Not Null,
            PRIMARY KEY  (id)
        );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // notice that we are updating option, rather than adding it
        update_option('lead_table_example_db_version', $lead_table_example_db_version);
    }
}

register_activation_hook(__FILE__, 'lead_table_example_install');

/**
    * Trick to update plugin database, see docs
    */
function lead_table_example_update_db_check()
{
    global $lead_table_example_db_version;
    if (get_site_option('lead_table_example_db_version') != $lead_table_example_db_version) {
        lead_table_example_install();
    }
}

add_action('plugins_loaded', 'lead_table_example_update_db_check');

/**
    * PART 2. Defining Custom Table List
    * ============================================================================
    *
    * In this part you are going to define custom table list class,
    * that will display your database records in nice looking table
    *
    * http://codex.wordpress.org/Class_Reference/WP_List_Table
    * http://wordpress.org/extend/plugins/custom-list-table-example/
    */

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
    * Custom_Table_Example_List_Table class that will display our custom table
    * records in nice table
    */
class Custom_Table_Example_List_Table extends WP_List_Table
{
    /**
        * [REQUIRED] You must declare constructor and give some basic params
        */
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'lead',
            'plural' => 'Leads',
        ));
    }

    /**
        * [REQUIRED] this is a default column renderer
        *
        * @param $item - row (key, value array)
        * @param $column_name - string (key)
        * @return HTML
        */
    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    /**
        * [OPTIONAL] this is example, how to render specific column
        *
        * method name must be like this: "column_[column_name]"
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
    function column_age($item)
    {
        return '<em>' . $item['age'] . '</em>';
    }

    /**
        * [OPTIONAL] this is example, how to render column with actions,
        * when you hover row "Edit | Delete" links showed
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
    function column_name($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &person=2
        $actions = array(
            'edit' => sprintf('<a href="?page=leads_form&id=%s">%s</a>', $item['id'], __('Edit', 'lead_table_example')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'lead_table_example')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }

    /**
        * [REQUIRED] this is how checkbox column renders
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    /**
        * [REQUIRED] This method return columns to display in table
        * you can skip columns that you do not want to show
        * like content, or description
        *
        * @return array
        */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'name' => __('Name', 'lead_table_example'),
            'email' => __('E-Mail', 'lead_table_example'),
            'age' => __('Age', 'lead_table_example'),
			'client' => __('client', 'lead_table_example')
        );
        return $columns;
    }

    /**
        * [OPTIONAL] This method return columns that may be used to sort table
        * all strings in array - is column names
        * notice that true on name column means that its default sort
        *
        * @return array
        */
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'name' => array('name', true),
            'email' => array('email', false),
            'age' => array('age', false),
			'client' => array('client', false)
        );
        return $sortable_columns;
    }

    /**
        * [OPTIONAL] Return array of bult actions if has any
        *
        * @return array
        */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete',
			'export_action' => 'Export'
        );
        return $actions;
    }

	
	public function process_bulk_action() {

        if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';

            $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
            $action = 'bulk-' . $this->_args['plural'];

            if ( ! wp_verify_nonce( $nonce, $action ) )
                wp_die( 'Nope! Security check failed!' );

        }

       $action = $this->current_action();

        switch ( $action ) {

            case 'delete':
               global $wpdb;
        $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix
             $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }

                wp_redirect( esc_url( add_query_arg() ) );

                break;

            case 'export_action':
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);
                self::export_activities( $ids );

                wp_redirect( esc_url( add_query_arg() ) );
                break;

            default:
                // do nothing or something else
                return;
                break;
        }

        return;

    }
	
	function export_activities($ids) {
    
    ob_start();
    $domain = $_SERVER['SERVER_NAME'];
    $filename = 'lead-' . $domain . '-' . time() . '.csv';
    
    $header_row = array(
        'Name',
        'Email',
		'Age'
    );
    $data_rows = array();
    
	global $wpdb;
	 $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix
	$leadData = $wpdb->get_results( "SELECT * FROM $table_name WHERE id IN($ids)", 'ARRAY_A' );

    foreach ( $leadData as $lead ) {
        $row = array(
            $lead['name'],
            $lead['email'],
			$lead['age']
        );
        $data_rows[] = $row;
    }
    $fh = @fopen( 'php://output', 'w' );
    //fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
	fprintf( $fh, chr(EF) . chr(BB) . chr(BF) );
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header( 'Content-Description: File Transfer' );
    header( 'Content-type: text/csv' );
    header( "Content-Disposition: attachment; filename={$filename}" );
    header( 'Expires: 0' );
    header( 'Pragma: public' );
    fputcsv( $fh, $header_row );
    foreach ( $data_rows as $data_row ) {
        fputcsv( $fh, $data_row );
    }
    fclose( $fh );
    
    ob_end_flush();
    
    die();
}
	
    /**
        * [OPTIONAL] This method processes bulk actions
        * it can be outside of class
        * it can not use wp_redirect coz there is output already
        * in this example we are processing delete action
        * message about successful deletion will be shown on page in next part
        */
 /*   function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
		
		if ('exportlead' === $this->current_action()) {
			
			 $idsLead = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
     if (is_array($idsLead)) $idsLead = implode(',', $idsLead);
	// Check for current user privileges 
    if( !current_user_can( 'manage_options' ) ){ return false; }
    // Check if we are in WP-Admin
    if( !is_admin() ){ return false; }
	 
    ob_start();
    $domain = $_SERVER['SERVER_NAME'];
    $filename = 'lead-' . $domain . '-' . time() . '.csv';
    
    $data_rows = array();
	
    $leadData = $wpdb->get_results( "SELECT * FROM $table_name WHERE id IN($idsLead)", 'ARRAY_A' );
	
    foreach ( $leadData as $lead ) {
        $row = array(
            $lead['name'],
            $lead['email'],
			$lead['age']
        );
        $data_rows[] = $row;
    } 
	
    $fh = @fopen( 'php://output', 'w' );
    //fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
	fprintf( $fh, chr(EF) . chr(BB) . chr(BF) );
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header( 'Content-Description: File Transfer' );
    header( 'Content-type: text/csv' );
    header( "Content-Disposition: attachment; filename={$filename}" );
    header( 'Expires: 0' );
    header( 'Pragma: public' );
    fputcsv( $fh, array('Name', 'Email', 'Age'));
    foreach ( $data_rows as $data_row ) {
        fputcsv( $fh, $data_row );
    }
    fclose( $fh );
    
    ob_end_flush();
    
    die();	
    }
		
    } */

    /**
        * [REQUIRED] This is the most important method
        *
        * It will get rows from database and prepare them to be showed in table
        */
    function prepare_items()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix

        $per_page = 20; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? ($per_page * max(0, intval($_REQUEST['paged']) - 1)) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);

        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }
}

/**
    * PART 3. Admin page
    * ============================================================================
    *
    * In this part you are going to add admin page for custom table
    *
    * http://codex.wordpress.org/Administration_Menus
    */

/**
    * admin_menu hook implementation, will add pages to list persons and to add new one
    */
$siteurl = site_url();
	if( $siteurl== 'http://localhost/wordpress'){ 
	
function lead_table_example_admin_menu()
{
    add_menu_page(__('Leads', 'lead_table_example'), __('Leads', 'lead_table_example'), 'manage_options', 'leads', 'lead_table_example_leads_page_handler');
    add_submenu_page('leads', __('Leads', 'lead_table_example'), __('Leads', 'lead_table_example'), 'manage_options', 'leads', 'lead_table_example_leads_page_handler');
    // add new will be described in next part
    add_submenu_page('leads', __('Add new', 'lead_table_example'), __('Add new', 'lead_table_example'), 'manage_options', 'leads_form', 'lead_table_example_leads_form_page_handler');
 
	add_submenu_page('leads', 'Generate CSV', 'Generate CSV', 'manage_options', 'lead-settings', 'lead_table_example_leads_form_page_setting' );
}

add_action('admin_menu', 'lead_table_example_admin_menu');
}


/**
    * List page handler
    *
    * This function renders our custom table
    * Notice how we display message about successfull deletion
    * Actualy this is very easy, and you can add as many features
    * as you want.
    *
    * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
    */
function lead_table_example_leads_page_handler()
{
    global $wpdb;

    $table = new Custom_Table_Example_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'lead_table_example'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Leads', 'lead_table_example')?> <a class="add-new-h2"
                                    href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=leads_form');?>"><?php _e('Add new', 'lead_table_example')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="leads-table" method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
}

function lead_table_example_leads_form_page_setting() {
?>
<div class="csv-download">
	<a href="<?php echo admin_url( 'admin.php?page=lead-settings' ) ?>&action=download_csv&_wpnonce=<?php echo wp_create_nonce( 'download_csv' )?>" class="page-title-action"><?php _e('Export to CSV','nexus-lead-management');?></a>
</div>
<?php
}

function lead_table_example_leads_form_page_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'cte'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
        'name' => '',
        'email' => '',
        'age' => null,
		'client' => '',
    );

    // here we are verifying does this request is post back and have correct nonce
    if (wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);
        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = lead_table_example_validate_lead($item);
        if ($item_valid === true) {
            if ($item['id'] == 0) {
                $result = $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'lead_table_example');
                } else {
                    $notice = __('There was an error while saving item', 'lead_table_example');
                }
            } else {
                $result = $wpdb->update($table_name, $item, array('id' => $item['id']));
                if ($result) {
                    $message = __('Item was successfully updated', 'lead_table_example');
                } else {
                    $notice = __('There was an error while updating item', 'lead_table_example');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'lead_table_example');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('leads_form_meta_box', 'Lead data', 'lead_table_example_leads_form_meta_box_handler', 'lead', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Lead', 'lead_table_example')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=leads');?>"><?php _e('back to list', 'lead_table_example')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('lead', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'lead_table_example')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

/**
    * This function renders our custom meta box
    * $item is row
    *
    * @param $item
    */
function lead_table_example_leads_form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="name"><?php _e('Name', 'lead_table_example')?></label>
        </th>
        <td>
            <input id="name" name="name" type="text" style="width: 95%" value="<?php echo esc_attr($item['name'])?>"
                    size="50" class="code" placeholder="<?php _e('Your name', 'lead_table_example')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('E-Mail', 'lead_table_example')?></label>
        </th>
        <td>
            <input id="email" name="email" type="email" style="width: 95%" value="<?php echo esc_attr($item['email'])?>"
                    size="50" class="code" placeholder="<?php _e('Your E-Mail', 'lead_table_example')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="age"><?php _e('Age', 'lead_table_example')?></label>
        </th>
        <td>
            <input id="age" name="age" type="number" style="width: 95%" value="<?php echo esc_attr($item['age'])?>"
                    size="50" class="code" placeholder="<?php _e('Your age', 'lead_table_example')?>" required>
        </td>
    </tr>
	
	<tr class="form-field">
        <th valign="top" scope="row">
            <label for="age"><?php _e('Select Client', 'lead_table_example')?></label>
        </th>
	<td>
	<select name="your-client" id="your-client">
	<option value="Client1">Client1</option>
	<option value="Client2">Client2</option>
	<option value="Client3">Client3</option>
	</select>
	</td>
    </tr>
	
    </tbody>
</table>
<?php
}

/**
    * Simple function that validates data and retrieve bool on success
    * and error message(s) on error
    *
    * @param $item
    * @return bool|string
    */
function lead_table_example_validate_lead($item)
{
    $messages = array();

    if (empty($item['name'])) $messages[] = __('Name is required', 'lead_table_example');
    if (!empty($item['email']) && !is_email($item['email'])) $messages[] = __('E-Mail is in wrong format', 'lead_table_example');
    if (!ctype_digit($item['age'])) $messages[] = __('Age in wrong format', 'lead_table_example');
    //if(!empty($item['age']) && !absint(intval($item['age'])))  $messages[] = __('Age can not be less than zero');
    //if(!empty($item['age']) && !preg_match('/[0-9]+/', $item['age'])) $messages[] = __('Age must be number');
    //...

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}

function lead_table_example_languages()
{
    load_plugin_textdomain('lead_table_example', false, dirname(plugin_basename(__FILE__)));
}

add_action('init', 'lead_table_example_languages');

function form_creation(){

 if (!empty($_POST)) {
        global $wpdb;
		$wpdb_b = new wpdb( "root", "", "wordpress", "localhost" );
            $table = wp_cte;
            $data = array(
                'name'    => $_POST['your-name'],
				'email'    => $_POST['your-email'],
				'age'    => $_POST['your-age'],
				'client'    => $_POST['your-client']
            );
            $format = array(
                '%s','%s','%s','%s'
            );
            $success=$wpdb_b->insert( $table, $data, $format );
            if($success){
				
				echo '<h3>Your request successfully send! Our Staff will contact you!</h3>'; 
		 
			}
		}
		else   { ?>

<form method="post">
		<p><label> Your Name<br />
			<input type="text" name="your-name" value="" size="40" /></label></p>
		<p><label> Your Email<br />
			<input type="email" name="your-email" value="" size="40"/></label></p>
		<p><label> Your Age<br />
			<input type="text" name="your-age" value="" size="40" /></label></p>
				<p><label> Your Clients<br />
			<select name="your-client" id="your-client">
	<option value="Client1">Client1</option>
	<option value="Client2">Client2</option>
	<option value="Client3">Client3</option>
	</select></label></p>
		<p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit" /></p>
		</form>
<?php
}
}
add_shortcode('leadform', 'form_creation');
?>

<?php


// Add action hook only if action=download_csv
if ( isset($_GET['action'] ) && $_GET['action'] == 'download_csv' )  {
	// Handle CSV Export
	add_action( 'admin_init', 'csv_export');
}
function csv_export() {
    // Check for current user privileges 
    if( !current_user_can( 'manage_options' ) ){ return false; }
    // Check if we are in WP-Admin
    if( !is_admin() ){ return false; }
    // Nonce Check
    $nonce = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
    if ( ! wp_verify_nonce( $nonce, 'download_csv' ) ) {
        die( 'Security check error' );
    }
    
    ob_start();
    $domain = $_SERVER['SERVER_NAME'];
    $filename = 'lead-' . $domain . '-' . time() . '.csv';
    
    $header_row = array(
        'Name',
        'Email',
		'Age'
    );
    $data_rows = array();
    global $wpdb;
    $sql = 'SELECT * FROM ' . $wpdb->prefix . 'cte';
    $leadData = $wpdb->get_results( $sql, 'ARRAY_A' );
    foreach ( $leadData as $lead ) {
        $row = array(
            $lead['name'],
            $lead['email'],
			$lead['age']
        );
        $data_rows[] = $row;
    }
    $fh = @fopen( 'php://output', 'w' );
    //fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
	fprintf( $fh, chr(EF) . chr(BB) . chr(BF) );
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header( 'Content-Description: File Transfer' );
    header( 'Content-type: text/csv' );
    header( "Content-Disposition: attachment; filename={$filename}" );
    header( 'Expires: 0' );
    header( 'Pragma: public' );
    fputcsv( $fh, $header_row );
    foreach ( $data_rows as $data_row ) {
        fputcsv( $fh, $data_row );
    }
    fclose( $fh );
    
    ob_end_flush();
    
    die();
}
?>