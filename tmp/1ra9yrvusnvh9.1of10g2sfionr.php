<?php $nav=\Helper\Plugin::instance()->getAllNavs($PATH); ?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nb-collapse">
                <span class="sr-only"><?= ($dict['toggle_navigation']) ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= ($BASE) ?>/" accesskey="h">
                <?php if (empty($site['logo'])): ?>
                    <?= ($this->esc($site['name'])) ?>
                    <?php else: ?>
                        <img src="<?= ($site['logo']) ?>" alt="<?= ($this->esc($site['name'])) ?>">
                    
                <?php endif; ?>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="nb-collapse">

            <ul class="nav navbar-nav">
                <li class="dropdown <?= ($menuitem == 'new' ? 'active':'') ?>">
                    <a href="<?= ($BASE) ?>/issues/new" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" accesskey="n">
                        <?= ($dict['new']) ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach (($issue_types?:[]) as $type): ?>
                            <li><a href="<?= ($BASE) ?>/issues/new/<?= ($type['id']) ?>"><?= (isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name'])) ?></a></li>
                        <?php endforeach; ?>
                        <?php if (!empty($issue)): ?>
                            <li role="presentation" class="divider"></li>
                            <?php if ($issue['type_id'] == $issue_type['project']): ?>
                                
                                    <li role="presentation" class="dropdown-header"><?= ($dict['related']) ?></li>
                                    <li><a href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['task']) ?>/<?= ($issue['id']) ?>"><?= ($dict['Task']) ?></a></li>
                                    <li><a href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['project']) ?>/<?= ($issue['id']) ?>"><?= ($dict['subproject']) ?></a></li>
                                
                                <?php else: ?>
                                    <li role="presentation" class="dropdown-header"><?= ($dict['current_issue']) ?></li>
                                    <li><a href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['task']) ?>/<?= ($issue['id']) ?>"><?= ($dict['child_task']) ?></a></li>
                                    <?php if ($issue['parent_id']): ?>
                                        <li><a href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['task']) ?>/<?= ($issue['parent_id']) ?>"><?= ($dict['related_task']) ?></a></li>
                                    <?php endif; ?>
                                
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($user['role'] == 'admin' || $nav['new']): ?>
                            <li role="presentation" class="divider"></li>
                        <?php endif; ?>
                        <?php if ($user['role'] == 'admin'): ?>
                            <li><a href="<?= ($BASE) ?>/admin/sprints/new"><?= ($dict['sprint']) ?></a></li>
                        <?php endif; ?>
                        <?php if ($nav['new']): ?>
                            <?php foreach (($nav['new']?:[]) as $navitem): ?>
                                <li class="<?= ($navitem['active'] ? 'active' : '') ?>"><a href="<?= ($BASE) ?>/<?= ($navitem['href']) ?>"><?= ($navitem['title']) ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="dropdown <?= ($menuitem == 'browse' ? 'active':'') ?>">
                    <a href="<?= ($BASE) ?>/issues" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" accesskey="b">
                        <?= ($dict['browse']) ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= ($BASE) ?>/issues/?status=open"><?= ($dict['open']) ?></a></li>
                        <li><a href="<?= ($BASE) ?>/issues/?status=closed"><?= ($dict['closed']) ?></a></li>
                        <li role="presentation" class="divider"></li>
                        <li><a href="<?= ($BASE) ?>/issues/?status=open&amp;author_id=<?= ($user['id']) ?>"><?= ($dict['created_by_me']) ?></a></li>
                        <li><a href="<?= ($BASE) ?>/issues/?status=open&amp;owner_id=<?= ($user['id']) ?>"><?= ($dict['assigned_to_me']) ?></a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation" class="dropdown-header"><?= ($dict['by_type']) ?></li>
                        <?php foreach (($issue_types?:[]) as $type): ?>
                            <li><a href="<?= ($BASE) ?>/issues?type_id=<?= ($type['id']) ?>&amp;status=open"><?= (isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name'])) ?></a></li>
                        <?php endforeach; ?>
                        <li role="presentation" class="divider"></li>
                        <li><a href="<?= ($BASE) ?>/tag"><?= ($dict['issue_tags']) ?></a></li>
                        <?php foreach (($nav['browse']?:[]) as $navitem): ?>
                            <li class="<?= ($navitem['active'] ? 'active' : '') ?>"><a href="<?= ($BASE) ?>/<?= ($navitem['href']) ?>"><?= ($navitem['title']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="<?= ($menuitem == 'backlog' ? 'active':'') ?>">
                    <a href="<?= ($BASE) ?>/backlog" accesskey="s"><?= ($dict['sprints']) ?></a>
                </li>
                <?php foreach (($nav['root']?:[]) as $navitem): ?>
                    <li class="<?= ($navitem['active'] ? 'active' : '') ?>"><a href="<?= ($BASE) ?>/<?= ($navitem['href']) ?>"><?= ($navitem['title']) ?></a></li>
                <?php endforeach; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if ($user['role']=='admin'): ?>
                    <li class="<?= ($menuitem == 'admin' ? 'active':'') ?>">
                        <a href="<?= ($BASE) ?>/admin" accesskey="a">
                            <span class="hidden-sm"><?= ($dict['administration']) ?></span>
                            <span class="fa fa-cog visible-sm"></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="dropdown <?= ($menuitem == 'user' ? 'active':'') ?>">
                    <a href="<?= ($BASE) ?>/user/<?= ($user['username']) ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" accesskey="u">
                        <span class="hidden-sm"><?= ($this->esc($user['name'])) ?> <b class="caret"></b></span>
                        <span class="fa fa-user visible-sm"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= ($BASE) ?>/"><?= ($dict['dashboard']) ?></a></li>
                        <li><a href="<?= ($BASE) ?>/user/<?= ($user['username']) ?>"><?= ($dict['my_issues']) ?></a></li>
                        <li><a href="<?= ($BASE) ?>/user"><?= ($dict['my_account']) ?></a></li>
                        <?php if ($nav['user']): ?>
                            <li role="presentation" class="divider"></li>
                            <?php foreach (($nav['user']?:[]) as $navitem): ?>
                                <li class="<?= ($navitem['active'] ? 'active' : '') ?>"><a href="<?= ($BASE) ?>/<?= ($navitem['href']) ?>"><?= ($navitem['title']) ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li role="presentation" class="divider"></li>
                        <li>
                            <a style="position: relative;">
                                <form action="<?= ($BASE) ?>/logout" method="post">
                                    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                                    <button type="submit" style="appearance: none; border: none; background: transparent; padding: 0; line-height: inherit;">
                                        <?= ($dict['log_out'])."
" ?>
                                        <div style="position: absolute; inset: 0;">
                                    </button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <form class="navbar-form navbar-right" role="search" action="<?= ($BASE) ?>/search" method="get">
                <div class="form-group">
                    <input type="search" name="q" class="form-control input-sm" placeholder="<?= ($dict['issue_search']) ?>" value="<?= ($this->esc(@$GET['q'])) ?>">
                </div>
                <button type="submit" class="btn btn-default btn-sm hidden-xs">
                    <span class="sr-only"><?= ($dict['submit']) ?></span>
                    <span class="fa fa-search"></span>
                </button>
            </form>

        </div>
    </div>
</div>

<!-- Alerts -->
<?php if (!empty($error)): ?>
    <div class="<?= (empty($fullwidth) ? 'container' : 'container-fluid') ?>">
        <p class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= ($error)."
" ?>
        </p>
    </div>
<?php endif; ?>
<?php if (!empty($success)): ?>
    <div class="<?= (empty($fullwidth) ? 'container' : 'container-fluid') ?>">
        <p class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= ($success)."
" ?>
        </p>
    </div>
<?php endif; ?>
<?php if (!empty($site['demo']) && empty($COOKIE['demo_dismiss'])): ?>
    <div class="<?= (empty($fullwidth) ? 'container' : 'container-fluid') ?>">
        <p class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="document.cookie='demo_dismiss=1';">&times;</button>
            <?= ($dict['demo_notice'])."
" ?>
        </p>
    </div>
<?php endif; ?>
