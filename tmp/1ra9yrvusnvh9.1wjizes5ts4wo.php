<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php $fullwidth=true; ?>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container-fluid">
    <p>
        <a href="<?= ($BASE) ?>/search?q=<?= ($this->esc($GET['q'])) ?>&amp;closed=<?= (empty($GET['closed'])) ?>"><?= (empty($GET['closed']) ? 'Include closed issues' : 'Exclude closed issues') ?></a>
    </p>
    <?php echo $this->render('blocks/issue-list.html',NULL,get_defined_vars(),0); ?>
    <div class="clearfix">
        <p class="pull-right hidden-xs">
            <span class="text-muted">Showing <?= (($issues['limit'] * $issues['pos']) + 1) ?>&ndash;<?= ($issues['limit'] * ($issues['pos'] + 1) > $issues['total'] ? $issues['total'] : $issues['limit'] * ($issues['pos'] + 1)) ?> of <?= ($issues['total']) ?></span>
        </p>
    </div>
    <?php if ($issues['count']): ?>
        <div class="text-center">
            <ul class="pagination pagination-sm" style="margin: 15px 0;">
                <li <?php if($issues['pos'] == 0) echo 'class="disabled"' ?>>
                    <a href="<?= ($BASE) ?>/search?q=<?= ($this->esc($GET['q'])) ?>&amp;page=<?= ($issues['pos'] ? $issues['pos'] - 1 : 0) ?>&amp;closed=<?= (intval(@$GET['closed'])) ?>">&laquo;</a>
                </li>
                <?php foreach (($pages?:[]) as $page): ?>
                    <li <?php if($page == $issues['pos']) echo 'class="active"' ?>>
                        <a href="<?= ($BASE) ?>/search?q=<?= ($this->esc($GET['q'])) ?>&amp;page=<?= ($page) ?>&amp;closed=<?= (intval(@$GET['closed'])) ?>"><?= ($page + 1) ?></a>
                    </li>
                <?php endforeach; ?>
                <li <?php if($issues['pos'] == $issues['count'] - 1) echo 'class="disabled"' ?>>
                    <a href="<?= ($BASE) ?>/search?q=<?= ($this->esc($GET['q'])) ?>&amp;page=<?= (($issues['pos'] < $issues['count'] - 1) ? $issues['pos'] + 1 : $issues['count'] - 1) ?>&amp;closed=<?= (intval(@$GET['closed'])) ?>">&raquo;</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
