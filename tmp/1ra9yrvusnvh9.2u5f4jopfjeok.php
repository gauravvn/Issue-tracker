<div class="dashboard-widget" data-widget="bugs">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_bugs']) ?>&ensp;<small><?= (count($bugs)) ?></small>&ensp;
        <a class="btn btn-xs btn-default has-tooltip" href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['bug']) ?>" title="<?= ($dict['add_bug']) ?>"><span class="fa fa-plus"></span></a>
    </h3>
    <?php $issues=$bugs; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
