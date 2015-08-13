<?php
/**
 * Plugin Name: Cr3ativ Portfolio Plugin
 * Plugin URI: http://cr3ativ.com/cr3ativportfolio/portfolio
 * Description: Custom written plugin to add portfolio items (and categorize them) to your WordPress site.
 * Author: Jonathan Atkinson
 * Author URI: http://cr3ativ.com/
 * Version: 1.2.0
 */

/* Place custom code below this line. */

/* Variables */
$ja_cr3ativ_portfolio_main_file = dirname(__FILE__).'/cr3ativ-portfolio.php';
$ja_cr3ativ_portfolio_directory = plugin_dir_url($ja_cr3ativ_portfolio_main_file);
$ja_creativ_portfolio_path = dirname(__FILE__);

/* Add css and scripts file */
function creativ_portfolio_add_scripts() {
	global $ja_cr3ativ_portfolio_directory, $ja_creativ_portfolio_path;
		wp_enqueue_style('creativ_portfolio', $ja_cr3ativ_portfolio_directory.'css/cr3ativportfolio.css');
		wp_enqueue_script('jquery');
		wp_register_script('creativ_filter_js', $ja_cr3ativ_portfolio_directory.'js/filterable.js', 'jquery');
		wp_enqueue_script('creativ_filter_js');
}
		
add_action('wp_enqueue_scripts', 'creativ_portfolio_add_scripts');


add_action('admin_head', 'cr3ativportfolio_custom_css');

function cr3ativportfolio_custom_css() {
  echo '<style>

.portfoliointro.column-portfoliointro {
    display: inline-block;
    margin: 5px 0 25px;
    height: 110px;
    overflow: scroll;
    width: 90%;
}
  </style>';
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       WP Default Functionality       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////            Theme Options Metabox            /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'includes/meta_box.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_plugin_textdomain('cr3atport', false, basename( dirname( __FILE__ ) ) . '/languages' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Portfolio post type     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function cr3_portfoliosettings_admin_menu_setup(){
add_submenu_page(
 'edit.php?post_type=cr3ativportfolio',
 __('Cr3ativ Portfolio Options', 'cr3atport'),
 __('Portfolio Options', 'cr3atport'),
 'manage_options',
 'cr3_portfoliosettings',
 'cr3_portfoliosettings_admin_page_screen'
 );
}
add_action('admin_menu', 'cr3_portfoliosettings_admin_menu_setup'); //menu setup

/* display page content */
function cr3_portfoliosettings_admin_page_screen() {
 global $submenu;
// access page settings 
 $page_data = array();
 foreach($submenu['options-general.php'] as $i => $menu_item) {
 if($submenu['options-general.php'][$i][2] == 'cr3_portfoliosettings')
 $page_data = $submenu['options-general.php'][$i];
 }

// output 
?>
<div class="wrap">
<style>
#cr3_portfoliosettings_options .form-table th, #cr3_careerssettings_options .form-wrap label {
display: none;
}
#cr3_portfoliosettings_options label {
    cursor: pointer;
    display: block;
    float: left;
    width: 25%;
}
</style>


<?php screen_icon();?>
<h2><?php _e('Cr3ativ Portfolio Settings', 'cr3atport');?></h2>
<form id="cr3_portfoliosettings_options" action="options.php" method="post">
<?php
settings_fields('cr3_portfoliosettings_options');
do_settings_sections('cr3_portfoliosettings'); 
submit_button('Save options', 'primary', 'cr3_portfoliosettings_options_submit');
?>
 </form>
</div>
<?php
}

add_action('admin_init', 'cr3_portfoliosettings_flush' );

function cr3_portfoliosettings_flush(){

		if ( isset( $_POST['cr3_portfoliosettings_options'] ) ) {


			flush_rewrite_rules();
		
		}

} 
function cr3_portfoliosettings_settings_init(){

register_setting(
 'cr3_portfoliosettings_options',
 'cr3_portfoliosettings_options',
 'cr3_portfoliosettings_options_validate'
 );

add_settings_section(
 'cr3_portfoliosettings_portslugbox',
 '', 
 'cr3_portfoliosettings_portslugbox_desc',
 'cr3_portfoliosettings'
 );

add_settings_field(
 'cr3_portfoliosettings_portslugbox_template',
 '', 
 'cr3_portfoliosettings_portslugbox_field',
 'cr3_portfoliosettings',
 'cr3_portfoliosettings_portslugbox'
 );
    
add_settings_field(
 'cr3_portfoliosettings_portslugbox_template2',
 '', 
 'cr3_portfoliosettings_portslugbox_field2',
 'cr3_portfoliosettings',
 'cr3_portfoliosettings_portslugbox2'
 );
    
}

add_action('admin_init', 'cr3_portfoliosettings_settings_init');

/* validate input */
function cr3_portfoliosettings_options_validate($input){
 global $allowedposttags, $allowedrichhtml;
if(isset($input['portslugbox_template']))
 $input['portslugbox_template'] = wp_kses_post($input['portslugbox_template']);
 $input['portslugbox_template2'] = wp_kses_post($input['portslugbox_template2']);
return $input;
}

/* description text */
function cr3_portfoliosettings_portslugbox_desc(){
_e('Please set the slug name below for your portfolio single pages.  Default url for single pages is /cr3ativportfolio/.  If you leave this blank, the default portfolio slug name will be used.', 'cr3atport');
}

/* filed output */
function cr3_portfoliosettings_portslugbox_field() {
 $options = get_option('cr3_portfoliosettings_options');
 $portslugbox = (isset($options['portslugbox_template'])) ? $options['portslugbox_template'] : '';
 $portslugbox = strip_tags($portslugbox); //sanitise output
 $portslugbox2 = (isset($options['portslugbox_template2'])) ? $options['portslugbox_template2'] : '';
 $portslugbox2 = strip_tags($portslugbox2); //sanitise output
?>
<p>
    <label><?php _e('Portfolio Single Page Slug Name', 'cr3atport');?></label>
 <input type="text" id="portslugbox_template" name="cr3_portfoliosettings_options[portslugbox_template]" value="<?php echo $portslugbox; ?>" /></p>

<p>
    <label><?php _e('Portfolio Category Slug Name', 'cr3atport');?></label>
 <input type="text" id="portslugbox_template2" name="cr3_portfoliosettings_options[portslugbox_template2]" value="<?php echo $portslugbox2; ?>" /></p>

<?php
}


add_action('init', 'create_cr3ativportfolio');

function create_cr3ativportfolio() {
	
 $options = get_option('cr3_portfoliosettings_options');
 $portslugbox = (isset($options['portslugbox_template'])) ? $options['portslugbox_template'] : '';
 $portslugbox = strip_tags($portslugbox); //sanitise output	
	
	$labels = array(
		'name' => __('Portfolio', 'post type general name', 'cr3atport'),
		'singular_name' => __('Portfolio', 'post type singular name', 'cr3atport'),
		'add_new' => __('Add New', 'portfolio', 'cr3atport'),
		'add_new_item' => __('Add New Portfolio', 'cr3atport'),
		'edit_item' => __('Edit Portfolio', 'cr3atport'),
		'new_item' => __('New Portfolio', 'cr3atport'),
		'view_item' => __('View Portfolio', 'cr3atport'),
		'search_items' => __('Search Portfolio', 'cr3atport'),
		'not_found' =>  __('Nothing found', 'cr3atport'),
		'not_found_in_trash' => __('Nothing found in Trash', 'cr3atport'),
		'parent_item_colon' => 'Portfolio'
	);
	
    	$portfolio_args = array(
        	'labels' => $labels,
        	'public' => true,
            'menu_icon' => 'dashicons-portfolio',
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $portslugbox), 
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','comments')
        );
    	register_post_type('cr3ativportfolio',$portfolio_args);
	}

$portfields = array(
	array(
		'label'	=> __('Date', 'cr3atport'),
		'desc'	=> __('Date.', 'cr3atport'),
		'id'	=> 'cr3ativportfolio_date',
		'type'	=> 'date'
	),
	array(
            'label' => __('Client', 'cr3atport'),
            'desc' => __('Enter client name.', 'cr3atport'),
            'id' => 'cr3ativportfolio_clientname',
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Link', 'cr3atport'),
            'desc' => __('Enter the url address.', 'cr3atport'),
            'id' => 'cr3ativportfolio_url' ,
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Link Text', 'cr3atport'),
            'desc' => __('Enter the text for the link listed above (if no link is entered, this text will not appear.', 'cr3atport'),
            'id' => 'cr3ativportfolio_urltext' ,
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Left Intro Text', 'cr3atport'),
            'desc' => __('Enter text here that will appear on the left above the date and other project informtion.', 'cr3atport'),
            'id' => 'cr3ativportfolio_leftintrotext',
            'type' => 'textarea',
            'std' => ""
        ),
	array(
            'label' => __('Skills', 'cr3atport'),
            'desc' => __('List skills.', 'cr3atport'),
            'id' => 'cr3ativportfolio_skills' ,
            'type' => 'textarea',
            'std' => ""
		)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */

$portfolio_box = new cr3ativportfolio_add_meta_box( 'portfolio_box', __('Portfolio Info', 'cr3atport'), $portfields, 'cr3ativportfolio', true );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Custom taxonomies     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'cr3ativportfolio_type', 0 );
function cr3ativportfolio_type()	{
 $options = get_option('cr3_portfoliosettings_options');
 $portslugbox2 = (isset($options['portslugbox_template2'])) ? $options['portslugbox_template2'] : '';
 $portslugbox2 = strip_tags($portslugbox2); //sanitise output
	register_taxonomy( 
		'cr3ativportfolio_type', 
		'cr3ativportfolio', 
			array( 
				'hierarchical' => true, 
				'label' => __('Portfolio Category', 'cr3atport'),
				'query_var' => true, 
				'rewrite' => array('slug' => $portslugbox2), 
			) 
	);
 
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////             Portfolio widget                 /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'cr3ativ-portfolio-widget.php' );



////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Register new widget     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
register_sidebar(array(
	'name' => __( 'Cr3ativ Portfolio Single Page', 'cr3atport' ),
	'id' => 'cr3ativ_portfolio_widget_area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h6>',
    'after_title' => '</h6>'
));




add_filter( 'manage_edit-cr3ativportfolio_columns', 'my_edit_cr3ativportfolio_columns' ) ;

function my_edit_cr3ativportfolio_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
        'portfoliofeaturedimg' => __( 'Portfolio Image' , 'cr3atport'),
        'portfoliodate' => __( 'Portfolio Date', 'cr3atport' ),
		'title' => __( 'Portfolio Name', 'cr3atport' ),
        'portfolioclient' => __( 'Client' , 'cr3atport'),
        'portfoliourl' => __( 'Link' , 'cr3atport'),
        'portfolioskills' => __( 'Skills' , 'cr3atport'),
        'portfoliointro' => __( 'Intro' , 'cr3atport'),
        'portfoliocategory' => __( 'Portfolio Category' , 'cr3atport')
	);

	return $columns;
}

add_action( 'manage_cr3ativportfolio_posts_custom_column', 'my_manage_cr3ativportfolio_columns', 10, 2 );

function my_manage_cr3ativportfolio_columns( $column, $post_id ) {
	global $post;
    $cr3ativportfolio_date = get_post_meta($post->ID, 'cr3ativportfolio_date', $single = true); 
    $cr3ativportfolio_clientname = get_post_meta($post->ID, 'cr3ativportfolio_clientname', $single = true); 
    $cr3ativportfolio_url = get_post_meta($post->ID, 'cr3ativportfolio_url', $single = true); 
    $cr3ativportfolio_urltext = get_post_meta($post->ID, 'cr3ativportfolio_urltext', $single = true);
    $cr3ativportfolio_leftintrotext = get_post_meta($post->ID, 'cr3ativportfolio_leftintrotext', $single = true); 
    $cr3ativportfolio_skills = get_post_meta($post->ID, 'cr3ativportfolio_skills', $single = true);
	switch( $column ) {

		case 'portfoliodate' :
        if ( !empty( $cr3ativportfolio_date ) ) {
			$dateformat = get_option('date_format');
            echo date($dateformat, $cr3ativportfolio_date);
        }
			break;        

		case 'portfolioclient' :

             printf( $cr3ativportfolio_clientname ); 
			break;  
        
		case 'portfoliourl' :

			 echo '<a href="'. $cr3ativportfolio_url .'" target="_blank">'. $cr3ativportfolio_urltext .'</a><br/>'; 
			break; 
        
		case 'portfoliointro' :

             printf( $cr3ativportfolio_leftintrotext ); 
			break;  
        
		case 'portfolioskills' :

             printf( $cr3ativportfolio_skills ); 
			break;  
        
		case 'portfoliofeaturedimg' :

			 the_post_thumbnail ('thumbnail');
			break;
        
		case 'portfoliocategory' :

			$terms = get_the_terms( $post_id, 'cr3ativportfolio_type' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'cr3ativportfolio_type' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'cr3ativportfolio_type', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}




?>