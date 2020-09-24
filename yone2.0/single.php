<?php get_header(); ?>

    <!------------ left box -------------->
    <?php get_template_part('leftbar'); ?>
    
    <!------------ right box -------------->
    <?php get_template_part('rightbar'); ?>
    
    <!------------ content box -------------->
	<div id="main">
	  <?php
      /* query_posts('post_type=post'); /*
      /* print_r($wp_query); */
      if(have_posts()) :
		while(have_posts()) :
		  the_post();
		  get_template_part('parts/content');
		endwhile;
      endif;
      ?>
    </div>
  </div><!-- /#wrapper -->
  </div><!-- /#bgImage -->

<?php get_footer(); ?>
