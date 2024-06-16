<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url('/dashboard') ?>">
        <img src="<?= asset('img/logo.png') ?>" width="100px" alt="logo">
        <div class="sidebar-brand-text "><?= config('app_name') ?></div>
    </a>

    <?php if(Core\Auth\Auth::check_role('admin')) : ?>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= is_route('/dashboard', '', 'active') ?>">
        <a class="nav-link" href="<?= url('/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <?= components('dashboard/navigation-menu-dropdown', [
        'navs' => [
            'title' => 'Content',
            'icon' => 'fab fa-blogger-b',
            'role' => 'user',
            'items' => [
                [
                    'title' => 'Content',
                    'url' => '/dashboard/content'
                ],[
                    'title' => 'create',
                    'url' => '/dashboard/content/create'
                ]
            ]
        ]
    ]) ?>

    <?= components('dashboard/navigation-menu-dropdown', [
        'navs' => [
            'title' => 'Category',
            'icon' => 'fas fa-list',
            'role' => 'user',
            'items' => [
                [
                    'title' => 'Category',
                    'url' => '/dashboard/category'
                ],[
                    'title' => 'create',
                    'url' => '/dashboard/category/create'
                ]
            ]
        ]
    ]) ?>

    <?= components('dashboard/navigation-menu-dropdown', [
        'navs' => [
            'title' => 'Tag',
            'icon' => 'fas fa-tags',
            'role' => 'user',
            'items' => [
                [
                    'title' => 'Tag',
                    'url' => '/dashboard/tag'
                ],[
                    'title' => 'create',
                    'url' => '/dashboard/tag/create'
                ]
            ]
        ]
    ]) ?>

    <?= components('dashboard/navigation-menu-dropdown', [
        'navs' => [
            'title' => 'User Management',
            'icon' => 'fas fa-users',
            'role' => 'admin',
            'items' => [
                [
                    'title' => 'user',
                    'url' => '/dashboard/user'
                ],[
                    'title' => 'create',
                    'url' => '/dashboard/user/create'
                ]
            ]
        ]
    ]) ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->