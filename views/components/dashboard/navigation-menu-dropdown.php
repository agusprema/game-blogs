<!-- Nav Item - Pages Collapse Menu -->

<?php

    $navbars = $navs;
    $navItems = $navbars['items'];
    $navLinks = [];
    $id = strtolower(str_replace(' ', '', $navbars['title']));

    foreach($navItems as $navLink){
        $navLinks[] = $navLink['url'];
    }
?>

<?php if(Core\Auth\Auth::check_role($navbars['role'])) : ?>

<li class="nav-item <?= is_route($navLinks, '', 'active') ?>">
    <a class="nav-link <?= is_route($navLinks, 'collapsed', '') ?>" href="#" data-toggle="collapse" data-target="#collapse<?= $id ?>"
        aria-expanded="<?= is_route($navLinks, 'true','false') ?>" aria-controls="collapse<?= $id ?>">
        <i class="<?= $navbars['icon'] ?>"></i>
        <span><?= $navbars['title'] ?></span>
    </a>
    
    <div id="collapse<?= $id ?>" class="collapse <?= is_route($navLinks, '', 'show') ?>" aria-labelledby="heading<?= $id ?>" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><?= $navbars['title'] ?> :</h6>

            <?php foreach($navItems as $value) : ?>
                <a class="collapse-item <?= is_route($value['url'], '', 'active') ?>" href="<?= url($value['url']) ?>"><?= $value['title'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</li>

<?php endif; ?>