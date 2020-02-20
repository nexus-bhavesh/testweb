<?php
/*
Plugin Name: Wordpress Simple Location Plugin
Plugin URI:  https://github.com/simonrcodrington/Introduction-to-WordPress-Plugins---Location-Plugin
Description: Creates an interfaces to manage store / business locations on your website. Useful for showing location based information quickly. Includes both a widget and shortcode for ease of use.
Version:     1.0.0
Author:      Simon Codrington
Author URI:  http://www.simoncodrington.com.au
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class wp_simple_location{
	
	//properties
	private $wp_location_trading_hour_days = array();
	
	//magic function (triggered on initialization)
	public function __construct(){
		add_action('init', array($this, 'set_location_trading_hour_days'));  //sets the default trading hour days (used by the content type)
		add_action('init', array($this, 'register_location_content_type')); //register location content type
        add_action('init', array($this, 'register_texonomy_content_type')); //register location content type 
		add_action('add_meta_boxes', array($this,'add_location_meta_boxes')); //add meta boxes
		add_action('save_post_wp_locations', array($this,'save_location')); //save location
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts_and_styles')); //Admin script and styles
		add_action('wp_enqueue_scripts', array($this, 'enqueue_public_scripts_and_styles')); //public scripts and styles
		add_filter('the_content', array($this, 'prepend_location_meta_to_content')); //Get our meta data display before content 

        register_activation_hook(__FILE__, array($this,'plugin_activate')); //plugin activation hook
		register_deactivation_hook(__FILE__, array($this,'plugin_deactivate')); //plugin activation hook
		
	}
	
	//set the default days to use for the trading hours
	public function set_location_trading_hour_days(){
	//set the default days to use for the trading hours
		$this->wp_location_trading_hour_days = apply_filters('wp_location_trading_hours_days', 
		array('monday' => 'Monday',
			  'tuesday' => 'Tuesday',
			  'wednesday' => 'Wednesday',
			  'thursday' => 'Thursday',
			  'friday' => 'Friday',
			  'saturday' => 'Saturday',
			  'sunday' => 'Sunday',
		)
		);
	}
	
	//register location custom post type
	function register_location_content_type(){
		//labels for post type
		$labels = array(
		    'name'               => 'Location',
            'singular_name'      => 'Location',
            'menu_name'          => 'Locations',
            'name_admin_bar'     => 'Location',
            'add_new'            => 'Add New', 
            'add_new_item'       => 'Add New Location',
            'new_item'           => 'New Location', 
            'edit_item'          => 'Edit Location',
            'view_item'          => 'View Location',
            'all_items'          => 'All Locations',
            'search_items'       => 'Search Locations',
            'parent_item_colon'  => 'Parent Location:', 
            'not_found'          => 'No Locations found.', 
            'not_found_in_trash' => 'No Locations found in Trash.',
			);
		//arguments for post type
		$args= array(
		    'labels'            => $labels,
            'public'            => true,
            'publicly_queryable'=> true,
            'show_ui'           => true,
            'show_in_nav'       => true,
            'query_var'         => true,
            'hierarchical'      => false,
            'supports'          => array('title','thumbnail','editor'),
            'has_archive'       => true,
            'menu_position'     => 20,
            'show_in_admin_bar' => true,
            'menu_icon'         => 'dashicons-location-alt',
            'rewrite'			=> array('slug' => 'locations', 'with_front' => 'true'),
          // This is where we add taxonomies to our CPT
            'taxonomies'          => array( 'locationarea' ) 
		);
		//register post type
		register_post_type('wp_locations', $args);
	}

     //register texonomy
function register_texonomy_content_type() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
 // set up labels
	$labels = array(
		'name'              => 'Location Areas',
		'singular_name'     => 'Location Area',
		'search_items'      => 'Search Location Areas',
		'all_items'         => 'All Location Areas',
		'edit_item'         => 'Edit Location Area',
		'update_item'       => 'Update Location Area',
		'add_new_item'      => 'Add New Location Area',
		'new_item_name'     => 'New Location Area',
		'menu_name'         => 'Location Areas'
	);
	// register taxonomy
	register_taxonomy( 'locationarea', 'wp_locations', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_admin_column' => true,
        'rewrite' => array('slug' => 'area')
	) );
} 
	
	//adding meta boxes to location post type
    function add_location_meta_boxes(){
		add_meta_box('wp_location_meta_box', 'Location Information', array($this,'location_meta_box_display'), 'wp_locations', 'normal', 'default');
	}
	
	//display function used for our custom location meta box*/
		
    public function location_meta_box_display($post){
		
		//set nonce field
		wp_nonce_field('wp_location_nonce', 'wp_location_nonce_field');
		
		//collect variables
		$wp_location_phone = get_post_meta($post->ID,'wp_location_phone',true);
		$wp_location_email = get_post_meta($post->ID,'wp_location_email',true);
		$wp_location_address = get_post_meta($post->ID,'wp_location_address',true);
		
	?>
	<p>Enter additional information about your location </p>
	<div class="field-container">
	<?php //before main form elementst hook
	do_action('wp_location_admin_form_start'); 
	?>

	<div class="field">
	<label for="wp_location_phone">Contact Phone</label>
	<small>main contact number</small>
	<input type="tel" name="wp_location_phone" id="wp_location_phone" value="<?php echo $wp_location_phone;?>"/>
	</div>
	<div class="field">
		<label for="wp_location_email">Contact Email</label>
		<small>Email contact</small>
		<input type="email" name="wp_location_email" id="wp_location_email" value="<?php echo $wp_location_email;?>"/>
	</div>
	<div class="field">
		<label for="wp_location_address">Address</label>
		<small>Physical address of your location</small>
		<textarea name="wp_location_address" id="wp_location_address"><?php echo $wp_location_address;?></textarea>
	</div>
	<?php
	
	if(!empty($this->wp_location_trading_hour_days)){
		echo '<div class="field">';
			echo '<label>Trading Hours </label>';
			echo '<small> Trading hours for the location (e.g 9am - 5pm) </small>';
		    //go through all of our registered trading hour days
		  foreach($this->wp_location_trading_hour_days as $day_key => $day_value){
		  //collect trading hour meta data
		  $wp_location_trading_hour_value = get_post_meta($post->ID, 'wp_location_trading_hours_' .$day_key, true);
		  //dispaly label and input
		  echo '<lable for="wp_location_trading_hours_' . $day_key . '">' . $day_key . '</lable> ';
		  echo '<input type="text" name="wp_location_trading_hours_'. $day_key . '" id="wp_location_trading_hours_' .$day_key.'" value="' . $wp_location_trading_hour_value . '" />';
		  }
		
		echo '</div>';
		
		
	}
	?>
	<?php 
	//after main form elementst hook
	do_action('wp_location_admin_form_end');
	?>
	</div>
<?php
}

//triggered on activation of the plugin (called only once)
	public function plugin_activate(){
		
		//call our custom content type function
	 	$this->register_location_content_type();
		//flush permalinks
		flush_rewrite_rules(); 
	}
	
	//trigered on deactivation of the plugin (called only once)
	public function plugin_deactivate(){
		//flush permalinks
		flush_rewrite_rules();
	}
	
//append our additional meta data for the location before the main content (when viewing a single location)
 public function prepend_location_meta_to_content($content){
	 global $post, $post_type;
	 
	 //display meta only on our locations (and if its a single location)
	 if($post_type=='wp_locations' && is_singular('wp_locations')){
		 //collect variables
		 $wp_location_id = $post->ID;
		 $wp_location_phone = get_post_meta($post->ID, 'wp_location_phone', true);
		 $wp_location_email = get_post_meta($post->ID,'wp_location_email',true);
		 $wp_location_address = get_post_meta($post->ID,'wp_location_address',true);
		 
		 //dispaly
		 $html = '';
		 $html .= '<section class="meta-data">';
		 
		 //hook for outputting additional meta data (at the start of the form)
		 do_action('wp_location_meta_data_output_start',$wp_location_id);
		 
		 $html .= '<p>';
		 if(!empty($wp_location_phone)){
			 $html .= '<b>Location Phone :</b>&nbsp;' . $wp_location_phone . '</br>';
		 }
		 
		 if(!empty($wp_location_email)){
			 $html.= '<b>Location Email :</b> &nbsp;'. $wp_location_email . '</br>'; 
		 }
		 
		 if(!empty($wp_location_address)){  
			 $html.='<b>Location Address :</b>&nbsp;' . $wp_location_address . '</br>';
		 }
		 $html .= '</p>';
		 
		 if(!empty($this->wp_location_trading_hour_days)){
			 $html .= '<p>';
			 $html .= '<b>Location Trading Hours </b></br>';
			 foreach($this->wp_location_trading_hour_days as $day_key => $day_value){
			 $trading_hours = get_post_meta($post->ID, 'wp_location_trading_hours_' . $day_key , true);
			 $html .= '<b>' . $day_key . ' : '.'</b>&nbsp;' . $trading_hours . '</br>';
			 }
			  $html .= '</p>';
		 }
		 //hook for outputting additional meta data (at the end of the form)
			do_action('wp_location_meta_data_output_end',$wp_location_id);
		  $html .= '</section>';
		  $html .= $content;

           $terms = get_the_terms( $post->ID , 'locationarea' ); 
            if ($terms != ""){
            $html .=  'Category: ';
                    foreach ( $terms as $term ) {
                    $html .=  '<a href="' . get_term_link($term) . '">' . $term->name . '</a>' .'<div style="display:inline;" class="seprate">, </div>';
                    } 
                 }
		  return $html;

		 }
		 else {
			 return $content;
		 }
		 
	 }
	 
	//main function for displaying locations (used for our shortcodes and widgets)
	public function get_locations_output($arguments = ""){
			
		//default args
		$default_args = array(
			'location_id'	=> '',
			'number_of_locations'	=> -1,
			'category'      => '',
		);
		
		
		
		//update default args if we passed in new args
		if(!empty($arguments) && is_array($arguments)){
			//go through each supplied argument
			foreach($arguments as $arg_key => $arg_val){
				//if this argument exists in our default argument, update its value
				if(array_key_exists($arg_key, $default_args)){
					$default_args[$arg_key] = $arg_val;
				}
			}
		}
		 
		 //output 
		 $html = '';
		 
		 if ($default_args['category']==''){ 
		 $default_args['category'] = array('gujarat','maharastra');
		 } 
		 else {
			 $default_args['category']= $default_args['category'];
			 }
			 
		 $location_args = array(
			'post_type'		=> 'wp_locations',
			'posts_per_page'=> $default_args['number_of_locations'],
			'post_status'	=> 'publish',
			'tax_query' => array(
            array(
                'taxonomy' => 'locationarea',
                'field' => 'slug',
                'terms' => $default_args['category']
            )
        ));
		 
		//if we passed in a single location to display
		if(!empty($default_args['location_id'])){
			$location_args['include'] = $default_args['location_id'];
		}
		
		
		
		
		 $locations=get_posts($location_args);
		 //if we have loca
		 if($locations){
			//output
			$html .= '<article class="location_list cf">';
			//foreach location
			foreach($locations as $location){
				$html .= '<section class="location">';
				$wp_location_id = $location->ID;
					$wp_location_title = get_the_title($wp_location_id);
					$wp_location_thumbnail = get_the_post_thumbnail($wp_location_id,'thumbnail');
					$wp_location_content = apply_filters('the_content', $location->post_content);

				if(!empty($wp_location_content)){
					$wp_location_content = strip_shortcodes(wp_trim_words( $wp_location_content, 40, '...' ));
				}

				$wp_location_permalink = get_permalink($wp_location_id);
				$wp_location_phone = get_post_meta($wp_location_id,'wp_location_phone',true);
				$wp_location_email = get_post_meta($wp_location_id,'wp_location_email',true);
				
				//title display
				$html .= '<h2 class="title">';
				$html .= '<a href="' . $wp_location_permalink . '" title="view location">';
				$html .= $wp_location_title;
				$html .= '</a>';
				$html .= '</h2>';
				
			//image & content
			if(!empty($wp_location_thumbnail) || !empty($wp_location_content)){
						
				$html .= '<p class="image_content">';
				if(!empty($wp_location_thumbnail)){
					$html .= $wp_location_thumbnail;
				}
				if(!empty($wp_location_content)){
					$html .=  $wp_location_content;
				}
				
				$html .= '</p>';
				}

				
				//phone & email output
				if(!empty($wp_location_phone) || (!empty($wp_location_email))){
					$html .= '<p class="phone_email">';
					if(!empty($wp_location_phone)){
						$html .= '<b>Phone:</b>&nbsp;' .$wp_location_phone. '</br>';
					}
					if(!empty($wp_location_email)){
						$html .= '<b>Email:</b>&nbsp;' .$wp_location_email. '</br>';
					}
					$html .= '</p>';
				}
				
				//readmore
				$html .= '<a class="link" href="' .$wp_location_permalink. '" title="view location">View location</a>';
				$html .= '</section>';
			}
			 $html .= '</article>';
			 
		 }
		 return $html; 
	 }

	 
	 //triggered when adding or editing a location
	 public function save_location($post_id){
		 
		 //check for nonce
		 if(!isset($_POST['wp_location_nonce_field'])){
			 return $post_id;
		 }
		 //verify nonce
		 if(!wp_verify_nonce($_POST['wp_location_nonce_field'], 'wp_location_nonce')){
			 return $post_id;
		 }
		 if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
			 return $post_id;
		 }
		 
		 //get our phone, email, address
		 $wp_location_phone = isset($_POST['wp_location_phone'])? sanitize_text_field($_POST['wp_location_phone']) : '';
		 $wp_location_email = isset($_POST['wp_location_email'])? sanitize_text_field($_POST['wp_location_email']) : '';
		 $wp_location_address = isset($_POST['wp_location_address'])? sanitize_text_field($_POST['wp_location_address']) : '';
		 
		 //update phone, email, address
		  update_post_meta($post_id, 'wp_location_phone', $wp_location_phone);
		  update_post_meta($post_id, 'wp_location_email', $wp_location_email);
		  update_post_meta($post_id, '', $wp_location_address);
		 
		 //search for our trading hour data and update
		 foreach($_POST as $key => $value){
			if(preg_match("/^wp_location_trading_hours_/", $key)) {
                update_post_meta($post_id, $key , $value);
                 }
		 }
		 
		 //location save hook 
		//used so you can hook here and save additional post fields added via 'wp_location_meta_data_output_end' or 'wp_location_meta_data_output_end'
		do_action('wp_location_admin_save',$post_id);
	 }
	 
	//enqueus scripts and stles on the back end
	public function enqueue_admin_scripts_and_styles(){
		wp_enqueue_style('wp_location_admin_styles', plugin_dir_url(__FILE__) . '/css/wp_location_admin_styles.css');
	}
	 
	 //public scripts and stles on the back end
	 public function enqueue_public_scripts_and_styles(){
		wp_enqueue_style('wp_location_public_styles', plugin_dir_path(__FILE__) . '/css/wp_location_public_styles.css');
	 }
	 
}
$wp_simple_locations = new wp_simple_location;

//include shortcodes
include(plugin_dir_path(__FILE__) . 'inc/wp_location_shortcode.php');
//include Widgets
include(plugin_dir_path(__FILE__) . 'inc/wp_location_widget.php');