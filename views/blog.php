<div class="col-lg-8">
    <?php if(!empty($post)) : ?>
    <div class="post post-single">
        <!-- post header -->
        <div class="post-header">
            <h1 class="title mt-0 mb-3"><?= $post->title ?></h1>
            <ul class="meta list-inline mb-0">
                <li class="list-inline-item">
                    <img src="<?= asset('/'.user($post->user_id)->profile) ?>" width="30px" class="author" alt="author"/>
                    <?= user($post->user_id)->name ?>
                </li>
                <li class="list-inline-item"><a href="<?= url('/category/'. getCategory($post->post_id)->slug) ?>"><?= getCategory($post->post_id)->title ?></a></li>
                <li class="list-inline-item"><?= date("F jS, Y", strtotime($post->updated_at)) ?></li>
            </ul>
        </div>
        <!-- featured image -->
        <div class="featured-image">
            <img src="<?= asset('/'. $post->thumbnail) ?>" alt="post-title">
        </div>
        <!-- post content -->
        <div class="post-content clearfix">
            <?= $content ?>
        </div>
        <!-- post bottom section -->
        <div class="post-bottom">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 col-12 text-center text-md-start">
                    <!-- tags -->
                     <?php 
                        $tag = \Repository\tag::getTagPostByPostId($post->post_id);
                        $tags = \Repository\tag::getTagByPostTagId(parseObject($tag, 'tag_id'));
                     ?>

                    <?php foreach($tags as $tag) : ?>
                        <a href="<?= url('/tag/'. $tag->slug) ?>" class="tag">#<?= $tag->title ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6 col-12">
                    <!-- social icons -->
                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
            <div id="disqus_thread"></div>
        </div>

    </div>
    <?php else: ?>
    <?= components('404') ?>
    <?php endif; ?>

</div>

<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://animex-official.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>