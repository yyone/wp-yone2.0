<div id="left" class="clearfix">
	<div class="leftBox">
		<div class="menuBar box">
			<div class="widget_title"><span>メニュー</span></div>
			<div class="nav_control">
				<div>
					<span class="bar bar1"></span>
					<span class="bar bar2"></span>
					<span class="bar bar3"></span>
					<span class="menu">MENU</span>
					<span class="close">CLOSE</span>
				</div>
			</div>
			<nav class="global_nav_wrapper">
				<div class="searchBox">
					<?php get_search_form(); ?>
				</div>
				<ul class="global_nav widget_content">
				<?php
					$cate = get_leftbar_category();
					$sub_cate = get_leftbar_category();
					for($i=0;$i<count($cate);$i++) :
						if(substr($cate[$i][0],-2) == '00') :
							if($cate[$i][1] == 'home') :
				?>
					<li class="menu_icon"><a href="<?php echo home_url('/'); ?>">
						<?php else: ?>
					<li class="menu_icon" id="menu_<?php echo $cate[$i][1]; ?>"><a href="/category/<?php echo $cate[$i][1]; ?>">
						<?php endif; ?>
					<div class="menu_<?php echo $cate[$i][1]; ?>"></div><span class="name"><?php if(is_front_page()): ?><h2><?php endif; ?><?php echo $cate[$i][2]; ?><?php if(is_front_page()): ?></h2><?php endif; ?></span></a>
					<?php
						$flg = 0;
						$hit_array = array();
						for($j=0;$j<count($sub_cate);$j++) :
							if(substr($cate[$i][0],0,2) == substr($sub_cate[$j][0],0,2)
							&& substr($sub_cate[$j][0],-2) != '00') :
								$flg = 1;
								$hit_array[$sub_cate[$j][1]] = $sub_cate[$j][2];
							endif;
						endfor;
					?>

					<?php if($flg) : ?><ul><?php endif; ?>
					<?php if($flg) :
						foreach($hit_array as $key => $value) : ?>
					<li><a href="/category/<?php echo $key; ?>"><span class="sub_title"><?php echo $value; ?></span></a></li>
					<?php
						endforeach;
						endif; ?>
					<?php if($flg) : ?></ul><?php endif; ?>
					</li>
					<?php endif; ?>
				<?php endfor; ?>
				</ul>
			</nav>
		</div>
		<?php dynamic_sidebar('leftbar-widget-area'); ?>
	</div>
</div>
