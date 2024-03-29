<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= ($this->esc($site['description'])) ?>">
<meta name="generator" content="alanaktion/phproject">
<meta name="csrf-token" content="<?= ($this->esc($csrf_token)) ?>">
<title><?= ($this->esc(empty($title) ? $site['name'] : $title . ' - ' . $site['name'])) ?></title>
<link rel="stylesheet" href="<?= ($BASE) ?>/<?= (empty($user['theme']) ? $site['theme'] : $user['theme']) ?>">
<link rel="stylesheet" href="<?= ($BASE) ?>/css/style.css">
<link rel="stylesheet" href="<?= ($BASE) ?>/css/datepicker3.min.css">
<link rel="stylesheet" href="<?= ($BASE) ?>/css/font-awesome.min.css">
<link rel="search" type="application/opensearchdescription+xml" href="<?= ($BASE) ?>/opensearch.xml" title="<?= ($this->esc($site['name'])) ?>">
