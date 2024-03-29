--- ---
<?= ($site['name'])."
" ?>
Issue #<?= ($issue['id']) ?> <?= ($issue['name']) ?> updated

<?= ($update['user_name']) ?>:

<?php foreach($changes as $change) {
		$human_readable = \Helper\Update::instance()->humanReadableValues($change['field'], $change['old_value'], $change['new_value']);
		if($change['old_value'] && $change['new_value']) {
			echo $human_readable['field'], ' changed from ', $human_readable['old'], ' to ', $human_readable['new'], "\n";
		} elseif($change['old_value']) {
			echo $human_readable['field'], ' removed', "\n";
		} else {
			echo $human_readable['field'], ' set to ', $human_readable['new'], "\n";
		}
	} ?>

View issue: <?= ($site['url']) ?>issues/<?= ($issue['id'])."
" ?>

<?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local(strtotime($update['created_date']))))."
" ?>
