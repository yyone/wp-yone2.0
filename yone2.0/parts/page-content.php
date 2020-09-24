      <article <?php post_class(); ?>>
        <div class="box">
          <h2 class="title">
            <span class="text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
          </h2>

          <div class="context">
			<?php the_content(); ?>
          </div><!-- /context -->
        </div><!-- /box -->
      </article>
