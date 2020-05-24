<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

<li id="li-<?php $comments->theId(); ?>" class="comment comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' parent';
}
$comments->alt(' odd', ' even');
echo $commentClass;
?>">
<div id="div-comment-15991" class="comment-body">
	<div class="comment-author vcard">
		<?php $comments->gravatar('120', ''); ?>		
		<cite class="fn"><?php $comments->author(); ?></cite><span class="says">says: </span>		
	</div>
    <div class="comment-meta commentmetadata">
		<a href="<?php $comments->permalink(); ?>"><?php $comments->date('Y-m-d H:i'); ?></a>
	</div>
	<p><?php $comments->content(); ?></p>

	<div class="reply"><?php $comments->reply('reply'); ?></div>
        <?php if ($comments->children) { ?>
    <ul class="children">
        <?php $comments->threadedComments($options); ?>
    </ul>
</div>
<?php } ?>
</li>
<?php } ?>
    <!-- Comments -->
    <section class="comments">
        <div class="container" data-no-instant>
		    <h3 id="comments" class="comments-title"><?php $this->commentsNum('No comment', '1 comment', '%d comments'); ?> reply: “<?php $this->title(); ?>”</h3>
		
            <?php $this->comments()->to($comments); ?>
            <?php if ($comments->have()): ?>
            <h3><?php $this->commentsNum(_t('No comment now'), _t('Only one comment'), _t('%d comments')); ?></h3>
            <div class="commentlist"><?php $comments->listComments(); ?></div>
            <div class="navigation"><?php $comments->pageNav('&laquo; Previous page', 'Next page &raquo;'); ?></div>
            <?php endif; ?>
			
			<div id="respond" class="comment-respond">
			    <?php if($this->allow('comment')): ?>
		        <h3 id="reply-title" class="comment-reply-title">Comment<small><?php $comments->cancelReply(); ?></small></h3>
                <form method="post" action="<?php $this->commentUrl() ?>" id="commentform" role="form">
				    <!-- 如果当前用户已经登录 -->
                    <?php if($this->user->hasLogin()): ?>
                    <p><?php _e('Login identity: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                    <!-- 若当前用户未登录 -->
                    <?php else: ?>
					<p class="comment-notes"><span id="email-notes">E-Mail will not display to public.</span> Items with <span class="required">*</span> is affirmative.</p>
					<p class="comment-form-author">
                        <label for="author" class="required"><?php _e('Name *'); ?></label>
                        <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                    </p>
                    <p class="comment-form-email">
                        <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('E-Mail *'); ?></label>
                        <input id="email" name="mail" type="text" value="<?php $this->remember('mail'); ?>" size="30" maxlength="100" aria-describedby="email-notes" required="required">
                    </p>
                    <p class="comment-form-url">
                        <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('Website'); ?></label>
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </p>
					<?php endif; ?>
					<p class="comment-form-comment">
                        <label for="textarea" class="required"><?php _e('Comment'); ?></label>
                        <textarea rows="8" cols="45" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit" class="submit" value="Submit" /> <input type='hidden' name='comment_post_ID' value='4905' id='comment_post_ID' />
                        <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                    </p>
                </form>
				<?php else: ?>
                <h3><?php _e('Comment has been closed.'); ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </section>
