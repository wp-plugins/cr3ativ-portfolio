<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Start of page wrap -->
<div class="cr3ativeportfolio_page_wrap"> 
  
    <!-- Start of wrapper -->
    <div class="cr3ativeportfolio_wrapper"> 
        <h1><?php the_title (); ?></h1>

        <!-- Start of one third first -->
        <div class="cr3ativeportfolio_one_third_first">
            <?php
                $portfolio_clientname = get_post_meta($post->ID, 'cr3ativportfolio_clientname', $single = true); 
                $portfolio_url = get_post_meta($post->ID, 'cr3ativportfolio_url', $single = true); 
                $portfolio_urltext = get_post_meta($post->ID, 'cr3ativportfolio_urltext', $single = true); 
                $portfolio_skills = get_post_meta($post->ID, 'cr3ativportfolio_skills', $single = true); 
                $portfolio_leftintrotext = get_post_meta($post->ID, 'cr3ativportfolio_leftintrotext', $single = true); 
                $sd = get_post_meta($post->ID, 'cr3ativportfolio_date', $single = true); 
            ?>
            
            <?php if ($portfolio_leftintrotext != ('')){ ?>
            
            <p><?php echo stripslashes($portfolio_leftintrotext); ?></p>
            
            <?php } ?>
            
            <?php if ($sd != ('')){ ?>
            
            <!-- Start of custom tax -->
            <div class="cr3ativeportfolio_custom_tax">
                <?php _e( 'Date', 'cr3atport' ); ?>

            </div>
            <!-- End of custom tax --> 
      
            <!-- Start of custom meta -->
            <div class="cr3ativeportfolio_custom_meta"> 
                <?php $dateformat = get_option('date_format'); ?>
                <?php echo date($dateformat, $sd); ?>

            </div>
            <!-- End of custom meta -->

            <?php } ?>
            
            <?php if ($portfolio_clientname != ('')){ ?>
      
            <!-- Start of custom tax -->
            <div class="cr3ativeportfolio_custom_tax">
                <?php _e( 'Client', 'cr3atport' ); ?>

            </div>
            <!-- End of custom tax --> 

            <!-- Start of custom meta -->
            <div class="cr3ativeportfolio_custom_meta"> 
                <?php echo stripslashes($portfolio_clientname); ?> 
            
            </div>
            <!-- End of custom meta -->

            <?php } ?>
            
            <?php if ($portfolio_url != ('')){ ?>

            <!-- Start of custom tax -->
            <div class="cr3ativeportfolio_custom_tax">
                <?php _e( 'Link', 'cr3atport' ); ?>
                
            </div>
            <!-- End of custom tax --> 

            <!-- Start of custom meta -->
            <div class="cr3ativeportfolio_custom_meta"> 
                <a href="<?php echo ($portfolio_url); ?>"><?php echo stripslashes($portfolio_urltext); ?></a> 
            
            </div>
            <!-- End of custom meta -->

            <?php } ?>
            
            <?php if ($portfolio_skills != ('')){ ?>

            <!-- Start of custom tax -->
            <div class="cr3ativeportfolio_custom_tax">
            <?php _e( 'Skills', 'cr3atport' ); ?>
                
            </div>
            <!-- End of custom tax --> 

            <!-- Start of custom meta -->
            <div class="cr3ativeportfolio_custom_meta"> 
            <?php echo stripslashes($portfolio_skills); ?> 
            
            </div>
            <!-- End of custom meta -->

            <?php } ?>
            
        </div>
        <!-- End of one third first --> 

        <!-- Start of two third -->
        <div class="cr3ativeportfolio_two_third">
        <?php the_content('        '); ?>

        </div>
        <!-- End of two third --> 

        <?php endwhile; ?>
        <?php else: ?>
        <p>
        <?php _e( 'There are no posts to display. Try using the search.', 'cr3atport' ); ?>
        </p>
        <?php endif; ?>
        
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('cr3ativ_portfolio_widget_area') ) : else : ?>		
        <?php endif; ?> 

    </div>
    <!-- End of wrapper --> 

    <!-- Start of clear fix -->
    <div class="cr3ativeportfolioclear"></div>
    
</div>
<!-- End of page wrap -->

<?php get_footer (); ?>
