<?php
if (!empty($posts)):
    foreach ($posts as $post):
        $category = $this->category_model->get_category($post['category_id']);
        $body     = strip_tags($post['body']);
        $username = $post['username'];
        ?>
                        <div class="card margin-40px-bottom border-0 bg-light rounded-0">
                            <div class="row no-gutters list-blog">

                                <div class="col-md-5">
                                    <div class="bg-img cover-background h-100 min-height-250" data-overlay-dark="0" data-background="<?=base_url('assets/images/posts/') . $post['post_image'];?>" style="background-image: url(<?=base_url('assets/images/posts/') . $post['post_image'];?>);"></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">

                                        <span class="category"><a href="#!"><?= $category['name'];?></a></span>

                                        <h5><a href="<?= base_url('posts/'.$post['post_slug'].'/'.$post['post_id']); ?>"><?=$post['title'];?></a></h5>
                                        <p><?= word_limiter($body, 20); ?></p>

                                        <div class="meta">
                                            <span class="date"><?=date($post['created_at']);?></span>
                                            <span class="author">By 
                                                <a href="<?=base_url('posts/author/' . $username); ?>">
                                                    <?=$post['author'];?> 
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                               

        <?php endforeach;
endif;?>