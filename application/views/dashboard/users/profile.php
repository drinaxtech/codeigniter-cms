<div class="container d-flex justify-content-center">
    <div style="max-width:940px;background-color: #F8F8FF;margin-bottom: 10px;" class="row container card">
        <div style="margin-top: 10px;" class="row container">
            <div class="col-md-4 text-center">
                <i class="fas fa-user-circle fa-3x"></i>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-14">
                        <h1 class="only-bottom-margin"><?= ucfirst($user->name)." ".ucfirst($user->surname); ?>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <span class="text-muted">Name:</span> <?= $user->name; ?><br>
                        <span class="text-muted">Surname:</span> <?= $user->surname; ?><br>
                        <span class="text-muted">Username:</span> <?= $user->username; ?><br>
                        <span class="text-muted">Email:</span> <?= $user->email; ?><br>
                        <span class="text-muted">Role:</span> <?= $user->role; ?><br><br>
                        <small class="text-muted">Created: <?= $user->register_date; ?></small>
                    </div>
                    <div class="col-md-3">
                        <div class="activity-mini">
                            <i class="nav-icon far fa-newspaper"></i> <a
                                href="<?= base_url('posts/author/'.$user->username); ?>">
                                <?= $count_posts; ?> Posts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url('dashboard/user/edit/'.$user_id); ?>" style="margin:5px" class="btn btn-secondary btn-md float-right"><i
                        class="glyphicon glyphicon-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
</div>