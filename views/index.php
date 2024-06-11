<div class="col-lg-8">

	<?php for($i = 0; $i < 5; $i++) : ?>
		<?= view('components/home/post') ?>
	<?php endfor; ?>

	<nav>
		<ul class="pagination justify-content-center">
			<li class="page-item active" aria-current="page">
				<span class="page-link">1</span>
			</li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
		</ul>
	</nav>

</div>