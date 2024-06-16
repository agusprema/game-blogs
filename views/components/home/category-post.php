<div class="col-sm-6">
    <!-- post -->
    <div class="post post-grid rounded bordered">
        <div class="thumb top-rounded">
            <a href="<?= url('/category/'. getCategory($post['post_id'])->slug) ?>" class="category-badge position-absolute"><?= getCategory($post['post_id'])->title ?></a>
            <a href="<?= url('/blog/'. $post['slug']) ?>">
                <div class="inner">
                    <img src="<?= url('/'. $post['thumbnail']) ?>" alt="post-title">
                </div>
            </a>
        </div>
        <div class="details">
            <ul class="meta list-inline mb-0">
                <li class="list-inline-item"><img src="<?= asset(user($post['user_id'])->profile) ?>" style="width:30px;height:30px;" class="author rounded-circle" alt="author"/><?= user($post['user_id'])->name ?></li>
                <li class="list-inline-item"><?= date("F jS, Y", strtotime($post['updated_at'])) ?></li>
            </ul>
            <h5 class="post-title mb-3 mt-3"><a href="<?= url('/blog/'. $post['slug']) ?>"><?= $post['title'] ?></a></h5>
            <p class="excerpt summary mb-0"><?= fully_decode_html_entities($post['summary']) ?></p>
        </div>
        <div class="post-bottom clearfix d-flex align-items-center">
            <div class="social-share me-auto">
                <button class="toggle-button icon-tag"></button>
                <ul class="icons list-unstyled list-inline mb-0">
                    <?php 
                        $tag = \Repository\tag::getTagPostByPostId($post['post_id']);
                        $tags = \Repository\tag::getTagByPostTagId(parseObject($tag, 'tag_id'));
                     ?>

                    <?php foreach($tags as $tag) : ?>
                        <li class="list-inline-item"><a href="<?= url('/tag/'. $tag->slug) ?>" class="tag">#<?= $tag->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="more-button float-end">
                <a href="<?= url('/blog/'. $post['slug']) ?>"><span class="icon-options"></span></a>
            </div>
        </div>
    </div>
</div>