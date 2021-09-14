<?php
if ($this->session->userdata('logged_in')):
    $user_id = $this->session->userdata('user_id');
    $role    = $this->user_model->get_users($user_id)->role;
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?=$this->config->config["pageTitle"];?>" />
    <meta name="description" content="<?=$title;?>" />

    <!-- title  -->
    <title><?=$this->config->config["pageTitle"];?> - <?=ucfirst($title);?></title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/images/logos/favicon-32x32.png');?>" sizes="32x32" />

    <!-- plugins -->
    <link rel="stylesheet" href="<?=base_url('assets/css/plugins.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/jquery-confirm/3.3.2/jquery-confirm.min.css'); ?>">

    <!-- search css -->
    <link rel="stylesheet" href="<?=base_url('assets/css/search.css');?>" />

    <!-- core style css -->
    <link href="<?=base_url('assets/css/styles.css');?>" rel="stylesheet" />

    <script type="text/javascript" src="<?= base_url('assets/js/jquery/jquery.js'); ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

    <!-- start page loading -->
    <div id="preloader">
        <div class="row loader">
            <div class="loader-icon"></div>
        </div>
    </div>
    <!-- end page loading -->

    <!-- start main-wrapper section -->
    <div class="main-wrapper">

        <!-- start header section -->
        <header>
            <div class="navbar-default">
                <!-- start top search -->
                <div class="top-search bg-theme">
                    <div class="container">
                        <?php echo form_open(base_url('posts/search'), array('method' => 'get')); ?>
                            <div class="input-group">
                                <span class="input-group-addon cursor-pointer">
                                    <button class="search-form_submit fas fa-search font-size18 text-white" type="submit"></button>
                                </span>
                                <input type="text" name="post" class="search-form_input form-control" name="s" autocomplete="off" placeholder="Type & hit enter...">
                                <span class="input-group-addon close-search"><i class="fas fa-times font-size18 margin-10px-top"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end top search -->

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="menu_area">
                                <nav class="navbar navbar-expand-lg navbar-light no-padding">

                                    <div class="navbar-header navbar-header-custom">
                                        <!-- start logo -->
                                        <a href="<?=base_url();?>" class="navbar-brand width-200px sm-width-180px xs-width-150px"><img id="logo" src="<?=base_url('assets/images/logos/logo-md.png');?>" alt="logo"></a>
                                        <!-- end logo -->
                                    </div>

                                    <div class="navbar-toggler"></div>

                                    <!-- start menu area -->
                                    <ul class="navbar-nav ml-auto" id="nav" style="display: none;">
                                        <li><a href="<?=base_url();?>">Home</a></li>
                                        <li><a href="<?=base_url('categories');?>">Categories</a></li>
                                        <li><a href="<?=base_url('page/about');?>">About Us</a></li>
                                        <li><a href="<?=base_url('page/contact');?>">Contact</a></li>
                                        <?php if ($this->session->userdata('logged_in')): ?>
                                        <li>
                                          <a href="javascript:void(0)">
                                            <i class="fas fa-user-circle fa-fw"></i>
                                            <?=$this->session->userdata('username');?>
                                          </a>
                                            <ul>
                                                <?php if ($role === 'user'): ?>
                                                <li><a href="<?=base_url('user/profile');?>">Profile</a></li>
                                                <?php else: ?>
                                                <li><a href="<?=base_url('dashboard');?>">Dashboard</a></li>
                                                <?php endif;?>
                                                <li><a href="<?=base_url('user/logout');?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        <li><a href="<?=base_url('login');?>">Login</a></li>
                                      <?php endif;?>
                                    </ul>
                                    <!-- end menu area -->

                                    <!-- start attribute navigation -->
                                    <div class="attr-nav sm-no-margin sm-margin-65px-right xs-margin-55px-right">
                                        <ul class="search">
                                            <li class="search"><a href="javascript:void(0)"><i class="fas fa-search text-theme-color font-size18 margin-5px-top sm-no-margin-top"></i></a></li>
                                        </ul>

                                    </div>
                                    <!-- end attribute navigation -->

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">

        <?php if ($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('post_created')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
      <?php endif;?>


      <?php if ($this->session->flashdata('user_loggedout')): ?>
        <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('user_updated')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_updated') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('login_request')): ?>
        <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('login_request') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('register_request')): ?>
        <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('register_request') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('register')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('register') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('subscribe')): ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('subscribe') . '</p>'; ?>
      <?php endif;?>

      <?php if ($this->session->flashdata('post_deleted')): ?>
        <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
      <?php endif;?>