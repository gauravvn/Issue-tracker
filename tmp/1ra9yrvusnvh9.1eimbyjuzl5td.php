<div class="dashboard-widget" data-widget="issue_tree">
    <h3 class="dashboard-widget-handle"><?= ($dict['issue_tree']) ?></h3>
    <div class="table-scrollbox">
        <table class="table table-condensed table-hover issue-tree">
            <thead>
                <tr>
                    <th><?= ($dict['cols']['id']) ?></th>
                    <th><?= ($dict['cols']['title']) ?></th>
                    <th><?= ($dict['cols']['type']) ?></th>
                    <th><?= ($dict['cols']['assignee']) ?></th>
                    <th><?= ($dict['cols']['author']) ?></th>
                    <th><?= ($dict['cols']['priority']) ?></th>
                    <th><?= ($dict['cols']['due']) ?></th>
                    <th><?= ($dict['cols']['sprint']) ?></th>
                    <th><?= ($dict['cols']['hours_spent']) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($issue_tree?:[]) as $issue): ?>
                    <?php $renderTree($issue) ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
