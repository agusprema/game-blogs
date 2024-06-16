<div class="col-lg-8">

	<?php if(!empty($posts)) : ?>
		<?php foreach($posts->items() as $post) : ?>
			<?= view('components/home/post', ['post' => $post]) ?>
		<?php endforeach ?>

		<nav>
			<ul class="pagination justify-content-center">
					<?php if($posts->currentPage() >= 2) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. 1) ?>">First</a></li>
					<?php endif; ?>

					<?php if($posts->currentPage() - 2 >= 1) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. $posts->currentPage() - 2) ?>"><?= $posts->currentPage() - 2 ?></a></li>
					<?php endif; ?>

					<?php if($posts->currentPage() - 1 >= 1) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. $posts->currentPage() - 1) ?>"><?= $posts->currentPage() - 1 ?></a></li>
					<?php endif; ?>

					<li class="page-item active" aria-current="page">
						<span class="page-link"><?= $posts->currentPage() ?></span>
					</li> 

					<?php if($posts->currentPage() + 1 <= $posts->totalPages()) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. $posts->currentPage() + 1) ?>"><?= $posts->currentPage() + 1 ?></a></li>
					<?php endif; ?>
					
					<?php if($posts->currentPage() + 2 <= $posts->totalPages()) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. $posts->currentPage() + 2) ?>"><?= $posts->currentPage() + 2 ?></a></li>
					<?php endif; ?>

					<?php if($posts->currentPage() <= $posts->totalPages() / 1.5) : ?>
						<li class="page-item"><a class="page-link" href="<?= url('?page='. $posts->totalPages()) ?>">Last</a></li>
					<?php endif; ?>

				<!--
				<li class="page-item active" aria-current="page">
					<span class="page-link">1</span>
				</li> 
				-->
			</ul>
		</nav>
	<?php else: ?>
    <?= components('404') ?>
	<?php endif; ?>

</div>