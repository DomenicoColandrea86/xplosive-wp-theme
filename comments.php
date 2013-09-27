<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'xplosive'));
	if ( post_password_required() ) {
		echo '<p class="nocomments">' . _e('This post is password protected. Enter the password to view comments.', 'xplosive') . '</p>';
		return;
	}
?>

<?php if (have_comments()): ?>
	<div class="row post-comments">
		<h2><?php comments_number(__('No comments', 'xplosive'), __('1 comment', 'xplosive'), __('% comments', 'xplosive')); ?></h2>
		<div class="comments-pagination"><?php paginate_comments_links(); ?></div>
		<ol id="comment-list">
			<?php wp_list_comments(array(
				'callback' => 'ci_comment'
			)); ?>
		</ol>
		<div class="comments-pagination"><?php paginate_comments_links(); ?></div>
	</div><!-- .post-comments -->
<?php endif; ?>

<?php if(comments_open()): ?>
	<section id="respond">
		<div id="form-wrapper" class="row group">
			<?php get_template_part('comment-form'); ?>
		</div><!-- #form-wrapper -->
	</section>
<?php endif; ?>

