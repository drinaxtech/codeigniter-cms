<div id="content-wrapper">
    <div class="container-fluid">


        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-pen-square"></i>
                        </div>
                        <div class="mr-5">
                            <a class="text-white"
                                href="<?= base_url('dashboard/posts/'); ?>"><?= $posts_count; ?> Posts!</a>
                        </div>
                    </div>
                    <a class="card-footer clearfix small z-1" href="<?= base_url('dashboard/posts/'); ?>">
                        <span class="float-left text-dark">View All</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="mr-5">
                            <a class="text-white"
                                href="<?= base_url('dashboard/users/'); ?>"><?= $users_count; ?> Users!</a>
                        </div>
                    </div>
                    <a class="card-footer clearfix small z-1" href="<?= base_url('dashboard/users/'); ?>">
                        <span class="float-left text-dark">View All</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="mr-5">
                            <a class="text-white"
                                href="<?= base_url('dashboard/categories/'); ?>"><?= $categories_count; ?>
                                Categories!</a>
                        </div>
                    </div>
                    <a class="card-footer clearfix small z-1" href="<?= base_url('dashboard/categories/'); ?>">
                        <span class="float-left text-dark">View All</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="mr-5">
                            <a class="text-white"
                                href="<?= base_url('dashboard/comments/'); ?>"><?= $comments_count; ?>
                                Comments!</a>
                        </div>
                    </div>
                    <a class="card-footer clearfix small z-1" href="<?= base_url('dashboard/comments/'); ?>">
                        <span class="float-left text-dark">View All</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>