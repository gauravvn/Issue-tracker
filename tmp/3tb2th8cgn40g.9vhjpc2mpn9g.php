<div class="dashboard-widget" data-widget="open_comments">
    <h3 class="dashboard-widget-handle"><?= ($dict['open_comments']) ?></h3>
    <div class="comments">
        <?php $issue = new \Model\Issue() ?>
        <?php foreach (($open_comments?:[]) as $comment): ?>
            <?php $issue->load($comment['issue_id']) ?>
            <?php echo $this->render('blocks/issue-comment.html',NULL,get_defined_vars(),0); ?>
        <?php endforeach; ?>
    </div>
</div>
