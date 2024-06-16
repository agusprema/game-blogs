<div class="col-lg-8">

<?php if(isset($posts)) : ?>
    <div class="row gy-4">
        <?php foreach($posts->items() as $posta) : ?>
            <?= components('home/category-post', ['post' => $posta]) ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <?= components('404') ?>
<?php endif; ?>
</div>