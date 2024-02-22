<li id="f-<?= ($file['id']) ?>" data-id="<?= ($file['id']) ?>"
    data-name="<?= ($this->esc($file['filename'])) ?>"
    data-user="<?= ($this->esc($file['user_name'])) ?>"
    data-date="<?= (date('M j, Y \a\t g:ia', $this->utc2local(strtotime($file['created_date'])))) ?>"
    data-mime="<?= ($this->esc($file['content_type'])) ?>"
    data-size="<?= ($this->formatFilesize($file['filesize'])) ?>">
    <a class="file-attachment" href="<?= ($BASE) ?>/files/<?= ($file['id']) ?>/<?= ($this->esc($file['filename'])) ?>" target="_blank">
        <?php if (in_array($file['content_type'], \Helper\File::$mimeMap['image'])): ?>
            
                <img src="<?= ($BASE) ?>/files/thumb/96-<?= ($file['id']) ?>.png" srcset="<?= ($BASE) ?>/files/thumb/192-<?= ($file['id']) ?>.png 2x, <?= ($BASE) ?>/files/thumb/288-<?= ($file['id']) ?>.png 3x" alt>
            
            <?php else: ?>
                <img src="<?= ($BASE) ?>/img/mime/96/<?= (\Helper\File::mimeIcon($file['content_type'])) ?>.svg" alt>
            
        <?php endif; ?>
        <?= ($this->esc($file['filename']))."
" ?>
    </a>
    <button type="button" class="btn btn-xs btn-danger delete" title="<?= ($dict['delete']) ?>">&times;</button>
</li>
