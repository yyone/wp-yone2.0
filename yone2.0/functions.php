<?php

/*
 * createDate: 2013/07/16
 * updateDate: 
 *
 * content: adjeustment of wordpress default action
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');


/*
 * createDate: 2013/05/23
 * updateDate: 
 *
 * content: management of output script in head tag
 */
// Javascript
function add_script_header() {
	if(!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery');

		wp_register_script('utility', get_bloginfo('template_directory').'/js/utilities.min.js', false, "", true);
		wp_enqueue_script('utility');

		wp_register_script('comm', get_bloginfo('template_directory').'/js/common.min.js', false, "", true);
		wp_enqueue_script('comm');

		wp_register_script('scroll', get_bloginfo('template_directory').'/js/scroll.min.js', false, "", true);
		wp_enqueue_script('scroll');
	}
}
add_action('wp_enqueue_scripts', 'add_script_header');

// CSS
function add_my_stylesheet() {
	wp_register_style('main', get_bloginfo('template_directory') . '/css/style.css');
	wp_enqueue_style('main');
}
add_action('wp_print_styles', 'add_my_stylesheet');


/*
 * createDate: 2017/11/24
 */
register_sidebar(array(
	'name' => 'Leftbar-Widget-Area',
	'id' => 'leftbar-widget-area',
	'description' => '左カラムウィジェットエリア',
	'before_widget' => '<div class="leftWidget box">' ."\n",
	'after_widget' => '</div></div>'."\n",
	'before_title' => '<div class="widget_title"><span>',
	'after_title' => '</span></div>'."\n". '<div class="tag_cloud widget_content">'."\n",
));
/*
 * createDate: 2013/05/23
 * content: widget definition
 */
register_sidebar(array(
	'name' => 'Rightbar-Widget-Area',
	'id' => 'rightbar-widget-area',
	'description' => '右カラムウィジェットエリア',
	'before_widget' => '<div class="rightWidget box">' ."\n",
	'after_widget' => '</div></div>'."\n",
	'before_title' => '  <div class="widget_title"><span>',
	'after_title' => '</span></div>'."\n". '<div class="widget_content">'."\n",
));


/*
 * createDate: 2013/06/01
 * updateDate: 
 *
 * content:
      register using of eye catch image
*/
add_theme_support('post-thumbnails');


/*
 * createDate: 2013/05/23
 * updateDate: 
 *
 * content: register leftbar category data
 */
function get_leftbar_category() {
	$category_array = array(
		array('0100', 'home', 'HOME'),
		array('0200', 'it', 'IT'),
		array('0201', 'tool', 'ツール'),
		array('0202', 'lifehack', 'ライフハック'),
		array('0300', 'programming', 'プログラム'),
		array('0301', 'javascript-2', 'JavaScript'),
		array('0400', 'web_design', 'WEBデザイン'),
		array('0500', 'apple', 'Mac'),
		array('0600', 'marketing', 'マーケティング'),
		array('0700', 'bicycle', '自転車'),
		array('0800', 'movie', '映画／アニメ'),
		array('0900', 'book', '書評'),
		array('1000', 'photo', '写真'),
		array('1100', 'life', '生活'),
		array('1101', 'opinion', '言いたいコト'),
	);
	return $category_array;
}


/*
 * createDate: 2013/05/23
 * updateDate: 
 *
 * content: for display postpage top, when you click 'more' button
 */
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');


/*
 * createDate: 2013/05/23
 * updateDate: 
 *
 * content: delete <p> tag near <img> tag
   -> not work .. why??
 */
function filter_ptags_on_images($content) {
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*(\w+)\s*<\/p>/iU', '$1$2$3<p>$4<\/p>', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/*
 * createDate: 2013/05/29
 * updateDate: 
 *
 * content: html code of comment box
 */
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<div class="comment_context">
		<div class="author">
			<?php echo get_avatar($comment); ?>
			<?php printf(__('<span class="name">%s</span>'), get_comment_author_link()) ?>
		</div>

		<div class="comment_date">
			<?php printf(__('%1$s'), get_comment_date('Y/m/d')) ?><?php edit_comment_link(__('[Edit]'),'  ','') ?>
		</div>

		<div class="comment_text">
			<?php comment_text() ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('（承認待ちコメントです）') ?></em>
			<?php endif; ?>

			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'このコメントに返信'))) ?>
			</div>
		</div>
	</div>
	<?php
}


/*
 * createDate: 2013/05/23
 * updateDate: 
 *
 * content:
 *   「最近の投稿」HTML生成
 */
class NewRecentPostsWidget extends WP_Widget {

	/** constructor */
	function NewRecentPostsWidget() {
		parent::WP_Widget(false, $name = 'NewRecentPostsWidget');
	}
	
	/** WP_Widget::widget */
	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
		?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div id="newRecentPost">
		<ul>
		<?php $cat_array = get_leftbar_category(); ?>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li><?php
				$flg = false;
				for($i=0;$i<count($cat_array);$i++) :
					$key=$cat_array[$i][1]; $value=$cat_array[$i][2];
					if(substr($cat_array[$i][0], -2) == '00' && in_category($key)) :
				?><div class="post_<?php echo $key; ?>"></div>
				<?php
						$flg = true;
						break;
					endif;
				endfor;
				if(!$flg) :
				?><div class="post_life"></div>
				<?php endif; ?>
				<span class="post_title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></span>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?></li>
		<?php endwhile; ?>
		</ul>
		</div>
		<?php echo $after_widget; ?>
	<?php
		endif;
	}
	
	/** WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
	/** WP_Widget::form(for Management tool view) */
	function form($instance) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("NewRecentPostsWidget");'));


/*
 * createDate: 2013/05/24
 * updateDate: 
 *
 * content:
 *   「過去の投稿」HTML生成
 */
class newCollapsArchWidget extends WP_Widget {

	/** constructor */
	function newCollapsArchWidget() {
		parent::WP_Widget(
			'newcollapsarch', // id
			'New Collapsing Archives', // name
			array('description' => 'Collapsible archives listing' ) // args
		);
	}

	/** WP_Widget::widget */
	function widget($args, $instance) { //$args:widget arguments, $instance:saved value from db.
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		echo $before_widget . $before_title . $title . $after_title;
		echo "<ul id='newCollapsArchWidget' class='collapsing archives list'>\n";

		// include php files
		include('widgets/newCollapsArch.php');

		if(function_exists('newCollapsArch')) {
			newCollapsArch($instance);
		} else {
			wp_list_archives();
		}
		echo "</ul>\n";
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("NewCollapsArchWidget");'));

/* 2017/11/17追加 管理バーの非表示 */
//add_filter( 'show_admin_bar', '__return_false' );
