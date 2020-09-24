<?php
	$comment_count = get_comment_count($post->ID);
	if($comment_count['approved'] > 0	) :
?>
<div class="comment_title"><?php echo '「<em>' . get_the_title() . '</em>」に' . get_comments_number() . '件のコメント'; ?></div>
<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
</ol>
<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
<nav class="comment_nav">
	<ul>
		<li class="nav_previous"><?php previous_comments_link('<<  古いコメント'); ?></li>
		<li class="nav_next"><?php next_comments_link('新しいコメント  >>'); ?></li>
	</ul>
</nav>
<?php 
	endif;
else :
?>
<div class="comment_title">今のところ「<?php echo get_the_title(); ?>」にコメントは無し</div>
<?php
endif;

$fields = array(
	'author' =>
		'<p class="comment_form_author"><label class="comment_label" for="author">'.('Name').'</label>'.
		'<input class="comment_input author" name="author" type="text" placeholder="名前" value="'.
		esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' required /></p>',

	'email' =>
		'<p class="comment_form_email"><label class="comment_label" for="email">'.('Mail Address' ).'</label> '.
		'<input class="comment_input email" name="email" type="email" placeholder="メールアドレス" value="'.
		esc_attr(  $commenter['comment_author_email'] ).'" size="30"'.$aria_req.' required /></p>',

	'url' => 
		'<p class="comment_form_url"><label class="comment_label" for="url">'. ( 'Web Site' ).'</label>'.
		'<input class="comment_input url" name="url" type="url" placeholder="WebサイトURL" value="'.
		esc_attr( $commenter['comment_author_url'] ).'" size="30" /></p>',
);

$args = array(
	'fields' => apply_filters('comment_form_default_fields', $fields),
	'comment_field' =>
		'<p class="comment_form_comment">'.
		'<textarea class="comment_input" name="comment" cols="45" rows="8" aria-required="true" type="textarea" required></textarea></p>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'title_reply' => ( 'コメントを残す' ),
	'title_reply_to' => ( '%s にコメントを残す' ),
	'label_submit' => ( 'コメントを投稿する' ),
);

comment_form($args, $post->ID);
?>
