<?php get_header(); ?>

    <!------------ left box -------------->
    <?php get_template_part('leftbar'); ?>

    <!------------ right box -------------->
    <?php get_template_part('rightbar'); ?>

    <!------------ content box -------------->
	<div id="main">
      <div class="result_box">
          <span><?php if(is_category()): ?>カテゴリ：<?php elseif(is_tag()): ?>タグ：<?php elseif(is_date()): ?>過去の投稿：<?php endif; ?></span>
          <h1><?php if(is_category()): single_cat_title(); elseif(is_tag()): single_tag_title(); elseif(is_date()): $year = get_query_var('year');$monthnum = get_query_var('monthnum');$title = $year."年";if(!empty($monthnum)) $title .= $monthnum."月";echo $title; endif; ?></h1>
      </div>
      <?php
      if(have_posts()) :
		while(have_posts()) :
		  the_post();
		  get_template_part('parts/archive-content');
		endwhile;
		if(function_exists('page_navi')) :
		  page_navi('elm_class=page-nav&edge_type=span');
		endif;
      endif;
      ?>
	</div>
  </div><!-- /#wrapper -->
  </div><!-- /#bgImage -->

<?php get_footer(); ?>
