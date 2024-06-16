<?php 

    $categorys = \Repository\Category::getAllCategoryLimit(2);

?>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<img src="<?= asset('img/logo.png') ?>" alt="Katen" />
	</div>

	<!-- menu -->
	<nav>
		<ul class="vertical-menu">
			<li class="<?= is_route('/', '', 'active') ?>">
				<a href="<?= url('/') ?>">Home</a>
			</li>
			
			<?php foreach($categorys as $category) : ?>
				<li class="<?= is_route('/category/'.$category->slug, '', 'active') ?>">
					<a href="<?= url('/category/'.$category->slug) ?>"><?= $category->title ?></a>
				</li>
			<?php endforeach; ?>
			<li class="<?= is_route('/category', '', 'active') ?>">
				<a href="<?= url('/category') ?>">Category</a>
			</li>

			<li class="<?= is_route('/tag', '', 'active') ?>">
				<a href="<?= url('/tag') ?>">Tag</a>
			</li>

			<?php if(check_auth()) : ?>
				<li class="no-arrow">
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
				<li>
					<a href="<?= url('/login') ?>">Login</a>
				</li>
				<li>
					<a href="<?= url('/register') ?>">Register</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>

	<!-- social icons -->
	<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
		<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
	</ul>
</div>