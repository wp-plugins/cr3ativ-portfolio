<?php  
/* 
Template Name: Cr3ativPortfolio-4ColumnFilterable
*/  
?>
<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Start of page wrap -->
<div class="cr3ativeportfolio_page_wrap"> 
  
    <!-- Start of wrapper -->
    <div class="cr3ativeportfolio_wrapper"> 
        <?php the_content('        '); ?>
        <?php endwhile; ?>
        <?php else: ?>
        <p>
          <?php _e( 'There are no posts to display. Try using the search.', 'cr3atport' ); ?>
        </p>
        <?php endif; ?>
        
    <?php   $terms = get_terms("cr3ativportfolio_type");
            $count = count($terms);
			echo '<ul id="cr3ativeportfolio_portfolio-filter">';
			echo '<li class="cr3ativeportfolio_filter">Filter:</li><li><a href="#all" title="">All<span class="slash"></span></a></li>';
			if ( $count > 0 ){
                foreach ( $terms as $term ) {
                    $termname = strtolower($term->name);
                    $termname = str_replace(' ', '-', $termname);
                    echo '<li><a href="#'.$termname.'" title="" rel="'.$termname.'">'.$term->name.'<span class="slash"></span></a></li>';
                }
             }
             echo '</ul>'; ?>
        
    <?php   $loop = new WP_Query(array('post_type' => 'cr3ativportfolio', 'posts_per_page' => -1, 'showposts' => 9999999 ));
            $count =0;
    ?>
        
        <!-- Start of cr3ativeportfolio_portfolio-wrapper -->
        <div id="cr3ativeportfolio_portfolio-wrapper">
            
            <!-- Start of cr3ativeportfolio_portfolio-list -->
            <ul id="cr3ativeportfolio_portfolio-list">
                
            <?php if ( $loop ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <?php
                $terms = get_the_terms( $post->ID, 'cr3ativportfolio_type' );
                if ( $terms && ! is_wp_error( $terms ) ) : 
                    $links = array();

                    foreach ( $terms as $term ) 
                    {
                        $links[] = $term->name;
                    }
                    $links = str_replace(' ', '-', $links);	
                    $tax = join( " ", $links );		
                else :	
                    $tax = '';	
                endif;
            ?>
                
                <li class="cr3ativeportfolio_portfolio-item <?php echo strtolower($tax); ?> all">
            
                    <div class="cr3ativeportfolio_thumb">
                        
                        <div class="cr3ativeportfolio_mask">
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('slide'); ?></a>

                        </div>
                        
                    </div>
                    
                    <a class="cr3ativeportfolio_title" href="<?php the_permalink (); ?>"><?php the_title (); ?></a>
                    
                    <div class="cr3ativeportfolio_port_date">
                    <?php the_time(get_option('date_format')); ?>
                        
                    </div>
                    
                </li>
            
            <?php endwhile; else: ?>
            
            <?php endif; ?>
            
            </ul>
            
      <div class="cr3ativeportfolioclear"></div>
            
    </div>
    <!-- end #portfolio-wrapper--> 
    
  </div>
  <!-- End of wrapper --> 
  
  <!-- Start of clear fix -->
  <div class="cr3ativeportfolioclear"></div>
    
</div>
<!-- End of page wrap -->

<?php get_footer (); ?>
