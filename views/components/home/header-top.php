<div class="container-xl">
    <!-- header top -->
    <div class="header-top">
        <div class="row align-items-center">

            <div class="col-md-4 col-xs-12">
                <!-- site logo -->
                <a class="navbar-brand" href="<?= url('/') ?>"><img src="<?= asset('/img/logo.png') ?>" width="100px" alt="logo" /></a> 
            </div>

            <div class="col-md-8 d-none d-md-block">
                <!-- social icons -->
                <ul class="social-icons list-unstyled list-inline mb-0 float-end">
                    <?php if(check_auth()) : ?>
                    <li class="no-arrow list-inline-item">
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->name ?></span>
                            <img style="width: 2rem; height: 2rem;" class="img-profile rounded-circle" src="<?= asset(user()->profile) ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= url('/user/profile') ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="<?= url('/dashboard/content') ?>">
                                <i class="fab fa-blogger-b fa-sm fa-fw mr-2 text-gray-400"></i>
                                Create Content
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= url('/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <?php else: ?>
                        <li class="list-inline-item">
                            <a href="<?= url('/login') ?>">Login</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?= url('/register') ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>
</div>