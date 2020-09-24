<article>
	<div class="box">
		<div class="content article">
			<div class="title">
				<?php
					$cat_array = get_leftbar_category(); $flg;

				for($i=0;$i<count($cat_array);$i++) :
					$key=$cat_array[$i][1]; $value=$cat_array[$i][2];
					if(substr($cat_array[$i][0], -2) == '00' && in_category($key)) :
				?>
					<div class="title_<?php echo $key; ?>"></div>
				<?php
					$flg = true; break;
					endif;
				endfor;
				if(!$flg) :
				?>
					<div class="title_life"></div>
				<?php endif; ?>
				<span class="text"><a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a></span>
			</div>

			<time datetime="<?php the_time('Y/m/d'); ?>" class="time">
				posted on <?php the_time('Y/m/d'); ?>
				<?php if(is_user_logged_in() && author_can($post->ID, 'publish_posts')) : ?>
					&nbsp;<a href="<?php echo get_edit_post_link($post->ID); ?>">[Edit]</a>
				<?php endif; ?>
			</time>

			<div class="context">
				<?php the_content(); ?>
			</div>

			<div class="hr"></div>
			<div class="attached clearfix">
				<div class="share">
					<span class="title">Share This:&nbsp;</span>
					<ul class="socialButton">
						<li class="twitter">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="y_yone" data-lang="ja">ツイート</a>
						</li>
						<li class="fb">
							<iframe src="//www.facebook.com/plugins/like.php?href=<?php urlencode(the_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=20&amp;appId=216570448382466" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:20px;" allowTransparency="true"></iframe>
						</li>
						<li class="gplus">
							<div class="g-plusone" data-size="medium" data-href="<?php urlencode(the_permalink()); ?>"></div>
						</li>
						<li class="hatena">
							<a href="https://b.hatena.ne.jp/entry/yone3.net" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple-balloon" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
						</li>
					</ul>
				</div>
				<div class="category clearfix">
					<span class="title">Category:&nbsp;&nbsp;</span><?php the_category(', '); ?>
				</div>
				<div class="tag">
					<span class="title">Tags:&nbsp;&nbsp;</span><?php the_tags('', ', ', ' '); ?>
				</div>
				<div class="indicator clearfix">
					<span class="before"><?php previous_post_link('%link', "<< " . '%title', true); ?></span>
					<span class="next"><?php next_post_link('%link', '%title' . " >>", true); ?></span>
				</div>
			</div>
			<?php get_template_part('/parts/back_to_top'); ?>
		</div>
	</div>

	<div class="box">
		<div class="comments">
			<?php comments_template('/parts/comments.php', true); ?>
		</div>
		<?php get_template_part('/parts/back_to_top'); ?>
	</div>

	<!-- X:S ZenBackWidget -->
<!--
		<div class="box">
		<div class="zenback">
			<script type="text/javascript">document.write(unescape("%3Cscript")+" src='http://widget.zenback.jp/?base_uri=http%3A//yone3.net&nsid=104715941241188385%3A%3A104715950368022747&rand="+Math.ceil((new Date()*1)*Math.random())+"' type='text/javascript'"+unescape("%3E%3C/script%3E")); </script>
		</div>
		/*<?php get_template_part('/parts/back_to_top'); ?>*/
	</div>
-->
</article>
