<?php
if (!empty($posts)):
    foreach ($posts as $post):
        $body = strip_tags($post['body']);
        $username = $post['username'];
?>
<div id="post" class="margin-40px-bottom">
    <img src="
        <?=base_url('assets/images/posts/') . $post['post_image']; ?>" alt="
        <?=$post['title']; ?>">
        <div class="padding-30px-top padding-50px-lr xs-no-padding-lr">
            <span class="text-extra-dark-gray font-size14">
                <span class="font-weight-600">
                 By:
             </span>
                <a href="<?=base_url('posts/author/' . $username); ?>" class="border-bottom">
                    <?=$post['author']; ?>
                </a>
                <span class="font-weight-600">, at </span>
                <a href="#" class="border-bottom">
                    <?=date($post['created_at']); ?>
                </a>
            </span>
            <h5 class="margin-15px-top font-weight-600">
                <a href="<?=base_url('posts/' . $post['post_slug'] . '/' . $post['post_id']); ?>" class="text-extra-dark-gray">
                    <?=$post['title']; ?>
                </a>
            </h5>
            <p>
                <?=word_limiter($body, 40); ?>
            </p>
            <div class="d-flex justify-content-between">
                <div>
                    <a href="<?=base_url('posts/' . $post['post_slug'] . '/' . $post['post_id']); ?>" class="btn-blog">Read More
                    </a>
                </div>
                <div>
                    <ul class="social-links no-margin-bottom">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url('/posts/' . $post['post_slug'] . '/' . $post['post_id']); ?>">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://twitter.com/share?text=<?= urlencode($post['title']); ?>&url=<?=base_url('/posts/' . $post['post_slug'] . '/' . $post['post_id']); ?>">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    endforeach;
endif; ?>
