<?php get_header(); ?>

    <!------------ left box -------------->
    <?php get_template_part('leftbar'); ?>

    <!------------ right box -------------->
    <?php get_template_part('rightbar'); ?>

    <!------------ content box -------------->
	<div id="main">
	  <?php
      if(have_posts()) :
		while(have_posts()) :
		  the_post();
		  get_template_part('parts/page-content');
		endwhile;
      endif;
      ?>
	</div><!-- /main -->
  </div><!-- /#wrapper -->
  </div><!-- /#bgImage -->

<?php get_footer(); ?>
