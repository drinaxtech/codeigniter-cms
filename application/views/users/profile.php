<?php
$user_id = $this->session->userdata('user_id');
$role = $this->user_model->get_users($user_id)->role;
?>
<div class="container d-flex justify-content-center">
  <div style="max-width:940px;background-color: #F8F8FF;margin-bottom: 10px;" class="row container card">
          <div style="margin-top: 10px;" class="row container">
			<div class="col-md-4 text-center">
              <i class="fas fa-user-circle fa-3x"></i>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-14">
                  <h1 class="only-bottom-margin"><?php echo ucfirst($user->name)." ".ucfirst($user->surname); ?></h1>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <span class="text-muted">Name:</span> <?php echo $user->name; ?><br>
                  <span class="text-muted">Surname:</span> <?php echo $user->surname; ?><br>
                  <span class="text-muted">Username:</span> <?php echo $user->username; ?><br>
                  <span class="text-muted">Email:</span> <?php echo $user->email; ?><br>
                  <span class="text-muted">Role:</span> <?php echo $user->role; ?><br><br>
                  <small class="text-muted">Created: <?php echo $user->register_date; ?></small>
                </div>
                <div class="col-md-3">
                
                  <div class="activity-mini">
                  <?php if($role === 'creator') : ?>
                    <i class="nav-icon far fa-newspaper"></i> <a href ="<?php echo base_url('posts/author/'.$user->username); ?>">
                    <?php echo $count_posts; ?> Posts</a>
                <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <div class="row">
            <?php if($role !== 'admin') : ?>
            <div class="col-md-12">
              <a style="margin:5px" href="<?= base_url('user/edit/'.$user_id); ?>" class="btn btn-secondary btn-md float-right"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            </div>
            <?php endif; ?>
          </div>
        </div>
    </div>