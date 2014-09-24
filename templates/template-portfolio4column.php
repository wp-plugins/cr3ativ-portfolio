<?php  
/* 
Template Name: Cr3ativPortfolio-4ColumnNoFilterable
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
        
        <?php 
          $temp = $wp_query; 
          $wp_query = null; 
          $wp_query = new WP_Query(); 
          $wp_query->query('post_type=cr3ativportfolio'.'&paged='.$paged); 
        ?>
        
        <!-- Start of cr3ativeportfolio_portfolio-wrapper -->
        <div id="cr3ativeportfolio_portfolio-wrapper">
            
            <!-- Start of cr3ativeportfolio_portfolio-list -->
            <ul id="cr3ativeportfolio_portfolio-list">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
                
                
                    <li class="cr3ativeportfolio_portfolio-item">
                        
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
                
            <?php endwhile; ?> 
            
            </ul>
      
            <div class="cr3ativeportfolioclear"></div>

                <!-- Start of pagination -->
                <div id="cr3ativ_pagination">
                    
                <!-- Start of next post -->
                <div class="cr3ativ_next_post">
                    <?php next_posts_link(__('Next Page', 'cr3atport')); ?>

                </div>
                <!-- End of next post -->
                
                <!-- Start of prev post -->
                <div class="cr3ativ_prev_post">
                    <?php previous_posts_link(__('Previous Page', 'cr3atport')); ?>

                </div>
                <!-- End of prev post -->

                </div><!-- End of pagination -->  
            
            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>
        
    </div>
    <!-- end #portfolio-wrapper--> 
    
  </div>
  <!-- End of wrapper --> 
  
  <!-- Start of clear fix -->
  <div class="cr3ativeportfolioclear"></div>
    
</div>
<!-- End of page wrap -->

<?php get_footer (); ?>
