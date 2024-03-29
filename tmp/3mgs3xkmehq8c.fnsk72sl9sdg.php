<h3><?= ($dict['assigned_issues']) ?></h3>
<div class="table-responsive">
    <table class="table table-condensed table-hover issue-tree">
        <thead>
            <tr>
                <th><?= ($dict['cols']['id']) ?></th>
                <th><?= ($dict['cols']['title']) ?></th>
                <th><?= ($dict['cols']['type']) ?></th>
                <th><?= ($dict['cols']['assignee']) ?></th>
                <th><?= ($dict['cols']['author']) ?></th>
                <th><?= ($dict['cols']['priority']) ?></th>
                <th><?= ($dict['cols']['due_date']) ?></th>
                <th><?= ($dict['cols']['sprint']) ?></th>
                <th><?= ($dict['cols']['hours_spent']) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($issues?:[]) as $issue): ?>
                <?php $renderTree($issue) ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
