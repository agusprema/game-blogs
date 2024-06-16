<?php 

    $categorys = \Repository\Category::getAllCategoryLimit(2);

?>

<nav class="navbar navbar-expand-lg">
    <!-- header bottom -->
    <div class="header-bottom  w-100">
        
        <div class="container-xl">
            <div class="d-flex align-items-center">
                <div class="collapse navbar-collapse flex-grow-1">
                    <!-- menus -->
                    <ul class="navbar-nav">
                        <li class="nav-item <?= is_route('/', '', 'active') ?>">
                            <a class="nav-link" href="<?= url('/') ?>">Home</a>
                        </li>
                        
                        <?php foreach($categorys as $category) : ?>
                            <li class="nav-item <?= is_route('/category/'.$category->slug, '', 'active') ?>">
                                <a class="nav-link" href="<?= url('/category/'.$category->slug) ?>"><?= $category->title ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="nav-item <?= is_route('/category', '', 'active') ?>">
                            <a class="nav-link" href="<?= url('/category') ?>">Category</a>
                        </li>

                        <li class="nav-item <?= is_route('/tag', '', 'active') ?>">
                            <a class="nav-link" href="<?= url('/tag') ?>">Tag</a>
                        </li>
                    </ul>
                </div>

                <!-- header buttons -->
                <div class="header-buttons">
                    <button class="search icon-button">
                        <i class="icon-magnifier"></i>
                    </button>
                    <button class="burger-menu icon-button ms-2 float-end float-lg-none d-md-none">
                        <span class="burger-icon"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</nav>