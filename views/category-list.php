<style>
    .list-category{
        color: #FFF;
        border-radius: 25px;
        background: #FE4F70;
        background: -webkit-linear-gradient(left, #FE4F70 0%, #FFA387 100%);
        background: linear-gradient(to right, #FE4F70 0%, #FFA387 100%);
    }
</style>
<div class="col-lg-8">

    <div class="bordered container py-5">
        <h3 class="text-center">List Category</h3>
        <div class="row align-middle text-center gap-3 d-flex align-items-center justify-content-center">
            <?php foreach($categorys as $category) : ?>
                <a class="col-3 list-category p-2" href="<?= url('/category/'. $category->slug) ?>"><?= $category->title ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>