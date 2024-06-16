<?php 

    $categorys = \Repository\Category::getAllCategory();

?>

<!-- widget categories -->
<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Explore Topics</h3>
        <img src="<?= asset('img/wave.svg') ?>" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <ul class="list">
            <?php foreach($categorys as $category) : ?>
                <li><a href="<?= url('/category/'. $category->slug) ?>"><?= $category->title ?></a><span>(<?= \Repository\Category::getCategoryPostById($category->category_id) ?>)</span></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
</div>