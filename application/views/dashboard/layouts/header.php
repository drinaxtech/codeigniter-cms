<?php
$user_id = $this->session->userdata('user_id');
$role = $this->user_model->get_users($this->user_id)->role;
$permissions = $this->user_model->get_users($this->user_id)->special_permissions;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - <?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/4.3.1/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/toastr/toastr3.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard/pace.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fontawesome-5.9.0/css/all.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/dataTables/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/jquery-confirm/3.3.2/jquery-confirm.min.css'); ?>">
    <style type="text/css">
      .form-label-group input:not(:placeholder-shown){
        font-size:22px;
      }
      .error {
        color: red;
      }
    </style>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap/4.3.1/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-confirm/3.3.2/jquery-confirm.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/ckeditor/4.6.2/ckeditor.js'); ?>"></script>
  </head>

  <body id="body" class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url(); ?>">
        CI Blog
      </a>
      <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>

      <ul class="nav navbar-nav ml-auto">
        <?php if( $role === 'admin' && $permissions == 1 ) : ?>
        <li class="nav-item dropdown show">
          <a id="notification" class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i style="font-size: 20px;" class="fas fa-bell"></i>
            <?php if(!empty($post_notifications)): ?>
              <span class="badge badge-pill badge-danger">
                <?= count($post_notifications); ?> 
              </span>
            <?php endif; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Notification</strong>
            </div>
            <?php if(!empty($post_notifications)) :
              $notifications = array_slice($post_notifications, 0,5);
             foreach($notifications as $notification) : ?>

            <a class="dropdown-item" href="<?=base_url('posts/' . $notification['slug'] . '/' . $notification['post_id']); ?>">
              <?= ucfirst($notification['username']);?> has create new post!</a>
            <?php endforeach; ?>
            <a class="dropdown-item text-center" href="<?php base_url('dashboard/posts'); ?>">
              View All Posts</a>
            </div>
            <?php else: ?>
              <a class="dropdown-item" href="#">
              There no have notification</a>
            <?php endif; ?>
        </li>
      <?php endif; ?>
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-list"></i>
          </a>
        </li>
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-location-pin"></i>
          </a>
        </li>
        <li class="nav-item dropdown show">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i style="font-size: 20px;" class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="<?= base_url('dashboard/user/profile'); ?>">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="<?= base_url('user/logout'); ?>">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
      

    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-newspaper"></i> Posts</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a href="<?= base_url('/dashboard/posts'); ?>" class="nav-link">
                    <i class="nav-icon far fa-newspaper"></i> All Posts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('/dashboard/posts/create'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-plus-square"></i> New Post
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/posts/trash'); ?>" class="nav-link" href="typography.html">
                    <i class="nav-icon far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </li>

            <?php if( $role === 'admin' ) : ?>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-users"></i> Users</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a href="<?= base_url('/dashboard/users'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i> All Users</a>
                  </a>
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-comments"></i> Comments</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/comments/'); ?>" class="nav-link">
                    <i class="nav-icon far fa-comments"></i> All Comments</a>
                  </a>
              </ul>
            </li>

            <?php if( $permissions == 1 ) : ?>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-list-alt"></i> Categories</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/categories/'); ?>" class="nav-link">
                    <i class="nav-icon far fa-list-alt"></i> All Categories</a>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-clone"></i> Pages</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/about/'); ?>" class="nav-link">
                    <i class="nav-icon far fa-list-alt"></i> About Us</a>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/contact/'); ?>" class="nav-link">
                    <i class="nav-icon far fa-list-alt"></i> Contact Us</a>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dashboard/subscribers/'); ?>">
                <i class="nav-icon fas fa-user-friends"></i> Subscribers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dashboard/social_networks/'); ?>">
                <i class="nav-icon fas fa-globe"></i> Social Networks
              </a>
            </li>

          <?php endif;
                endif; ?>
          
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= base_url('dashboard');?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><?= $title; ?></li>
          <!-- Breadcrumb Menu-->
        </ol>
            <!-- /.row-->
            <div class="card">
              <div class="card-body justify-content-center">
                <div class="row">
                  <div class="container" id="container">
                    <script type="text/javascript">
                        $("#notification").on( "click", function() {
                          $(".badge-danger").css("visibility", "hidden");
                          $.ajax({
                            type : 'post',
                            url : '<?= base_url("dashboard/post_notification"); ?>',
                            dataSrc: 'src',
                            error: function(data){
                              alert(JSON.stringify(data));
                            }
                          });
                        });

                    </script>
                    