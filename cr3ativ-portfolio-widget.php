<?php 

class cr3ativ_portfolio_widget extends WP_Widget {

	// constructor
	function cr3ativ_portfolio_widget() {
        parent::__construct(false, $name = __('Cr3ativ Portfolio Loop', 'cr3atport') );
    }

	// widget form creation
	function form($instance) { 
// Check values
 if( $instance) { 
     $title = esc_attr($instance['title']); 
     $itemstodisplay = esc_attr($instance['itemstodisplay']); 
     $numbertodisplay = esc_attr($instance['numbertodisplay']); 
     $sortby = esc_attr($instance['sortby']); 
     $cr3ativportfolio_category = esc_attr($instance['cr3ativportfolio_category']);
} else { 
     $title = ''; 
     $itemstodisplay = ''; 
     $numbertodisplay = ''; 
     $sortby = '';
     $cr3ativportfolio_category = '';
} 
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cr3atport'); ?></label>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" style="float:right; width:56%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('numbertodisplay'); ?>"><?php _e('# of Columns', 'cr3atport'); ?></label>
<select id="<?php echo $this->get_field_id('numbertodisplay'); ?>" name="<?php echo $this->get_field_name('numbertodisplay'); ?>"  style="float:right; width:56%;">
    <option selected="selected" value="none"><?php _e( 'Select One', 'cr3atport' ); ?></option>
    <option <?php if ( $numbertodisplay == '1' ) { echo ' selected="selected"'; } ?> value="1">1</option>
    <option <?php if ( $numbertodisplay == '2' ) { echo ' selected="selected"'; } ?> value="2">2</option>
    <option <?php if ( $numbertodisplay == '3' ) { echo ' selected="selected"'; } ?> value="3">3</option>
    <option <?php if ( $numbertodisplay == '4' ) { echo ' selected="selected"'; } ?> value="4">4</option>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('itemstodisplay'); ?>"><?php _e('How many to show?', 'cr3atport'); ?></label>
<input id="<?php echo $this->get_field_id('itemstodisplay'); ?>" name="<?php echo $this->get_field_name('itemstodisplay'); ?>" type="text" value="<?php echo $itemstodisplay; ?>" style="float:right; width:56%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e('Sort by random? Defaults to ascending', 'cr3atport'); ?></label>
<input id="<?php echo $this->get_field_id('sortby'); ?>" name="<?php echo $this->get_field_name('sortby'); ?>" type="checkbox" value="1" <?php checked( '1', $sortby ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('cr3ativportfolio_category'); ?>"><?php _e('Portfolio category', 'cr3atport'); ?></label>
<select id="<?php echo $this->get_field_id('cr3ativportfolio_category'); ?>" name="<?php echo $this->get_field_name('cr3ativportfolio_category'); ?>"  style="float:right; width:56%;" >
    <option selected="selected" value="none"><?php _e( 'Select One', 'cr3atport' ); ?></option>
    <?php $terms = get_terms( 'cr3ativportfolio_type' ); ?> 
    <option <?php if ( $cr3ativportfolio_category == 'all' ) { echo ' selected="selected"'; } ?> value="all"><?php _e( 'All', 'cr3atport' ); ?></option>
    <?php foreach ( $terms as $term ) { ?>
    <option<?php if ( $cr3ativportfolio_category == $term->slug ) { echo ' selected="selected"'; } ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
    <?php } ?>
</select>
</p>
            
<?php }
	// widget update
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['itemstodisplay'] = $new_instance['itemstodisplay'];
      $instance['numbertodisplay'] = $new_instance['numbertodisplay'];
      $instance['sortby'] = strip_tags($new_instance['sortby']);
      $instance['cr3ativportfolio_category'] = $new_instance['cr3ativportfolio_category'];
     return $instance;
}

	// widget display
	function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $itemstodisplay = $instance['itemstodisplay'];
   $numbertodisplay = $instance['numbertodisplay'];
   $cr3ativportfolio_category = $instance['cr3ativportfolio_category'];
   $sortby = $instance['sortby'];
   echo $before_widget;
   if( $sortby == '1' ) {
   $sortby = 'rand';
   } else {
   $sortby = 'ASC';
   }   

if( $cr3ativportfolio_category != ('all') ) {      
		global $post;  
		$cr3ativ_portfolio_widget_loop = array(
		'post_type' => 'cr3ativportfolio',
        'posts_per_page' => $itemstodisplay,
		'orderby' => $sortby,
        'tax_query' => array(
            array(
                'taxonomy' => 'cr3ativportfolio_type',
                'field' => 'slug',
                'terms' => array( $cr3ativportfolio_category)
            )),
		);    
   } else {
       global $post;  
		$cr3ativ_portfolio_widget_loop = array(
		'post_type' => 'cr3ativportfolio',
        'posts_per_page' => $itemstodisplay,
		'orderby' => $sortby
		);
   }

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }	
   
   // Display the widget
?> 
<ul class="cr3ativ_portfolio_widget_wrapper">
    <?php query_posts($cr3ativ_portfolio_widget_loop); if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if( $numbertodisplay == '1' ) { ?>
<li class="cr3ativeportfolio_portfolio-itemone">
<?php ;} elseif ( $numbertodisplay == '2' ) { ?>
<li class="cr3ativeportfolio_portfolio-itemtwo">    
<?php ;} elseif ( $numbertodisplay == '3' ) { ?>    
<li class="cr3ativeportfolio_portfolio-itemthree">       
<?php ;} else { ?>    
<li class="cr3ativeportfolio_portfolio-item">   
<?php ;} ?> 
        
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>

</li>

<?php endwhile; ?>
    
<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'cr3atport' ); ?></p> 

<?php endif; ?><?php wp_reset_query(); ?>
</ul>
  
<?php     
   
   echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("cr3ativ_portfolio_widget");'));


?>