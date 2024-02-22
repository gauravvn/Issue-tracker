<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php if (empty($user)): ?>
    
        <?php echo $this->render('blocks/navbar-public.html',NULL,get_defined_vars(),0); ?>
    
    <?php else: ?>
        <?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
    
<?php endif; ?>
<div class="container">
    <div class="jumbotron">
        <h1><strong><?= ($ERROR['code']) ?></strong> Not Found</h1>
        <p><?= ($dict['error']['404_text']) ?></p>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
