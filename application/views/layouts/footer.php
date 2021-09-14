   
</div>
    </div>
      </section>

        <footer class="bg-light">
            <div class="padding-90px-top md-padding-70px-top sm-padding-50px-top">
                <div class="container">
                    <div class="row">
                        <a href="<?= base_url();?>" class="col-lg-3 col-sm-6 sm-margin-40px-bottom">
                            <img src="<?= base_url('assets/images/logos/logo-lg.png');?>" class="width-70" alt="" />
                        </a>

                        <div class="col-lg-2 col-sm-6 sm-margin-40px-bottom">
                            <h3 class="footer-title-style1">Pages</h3>
                            <ul class="list-style-1 no-margin-bottom">
                                <li><a href="<?= base_url('categories/');?>">Categories</a></li>
                                <li><a href="<?= base_url('about-us/');?>">About Us</a></li>
                                <li><a href="<?= base_url('contact/');?>">Contact</a></li>
                            </ul>
                        </div>
                        <?php if(!$this->session->userdata('logged_in')):?>
                        <div class="col-lg-3 col-sm-6 mobile-margin-40px-bottom">
                            <div class="padding-50px-left sm-no-padding-left">
                                <h3 class="footer-title-style1">User</h3>
                                <ul class="list-style-1 no-margin-bottom">
                                    <li><a href="<?= base_url('login/');?>">Log In</a></li>
                                    <li><a href="<?= base_url('register/');?>">Register</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="col-lg-3 col-sm-6 mobile-margin-40px-bottom">
                            <div class="padding-50px-left sm-no-padding-left">
                                <h3 class="footer-title-style1">User</h3>
                                <ul class="list-style-1 no-margin-bottom">
                                    <?php
                                    $user_id = $this->session->userdata('user_id'); 
                                    $role = $this->user_model->get_users($user_id)->role;
                                    if($role === 'user') : ?>
                                        <li><a href="<?= base_url('user/profile') ;?>">Profile</a></li>
                                        <?php else: ?>
                                            <li><a href="<?= base_url('dashboard') ;?>">Dashboard</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= base_url('user/logout') ;?>">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="padding-30px-left sm-no-padding-left">
                                <h3 class="footer-title-style1">Subscribe</h3>
                                <form action="<?= base_url("user/subscribe/"); ?>" method="post" class="rounded-pill newsletter-form">
                                    <div class="input-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                                        <div class="input-group-append">
                                            <input type="button" onClick="Subscribe()" class="btn btn-primary btn-costum" value="Subscribe">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="padding-30px-bottom margin-60px-top row">
                        <div class="col-12">
                            <div class="float-left xs-width-100 text-center xs-margin-5px-bottom">
                                <ul class="social-links no-margin">
                                    <?php
                                    $social_networks = $this->post_model->get_social_networks();
                                    foreach ($social_networks as $social_network) :
                                    ?>
                                    <li>
                                        <a href="<?=$social_network['link']?>"><i class="<?=$social_network['fa_icon'];?>"></i></a>
                                    </li>
                                <?php endforeach;?>
                                </ul>
                            </div>
                            <div class="float-right xs-width-100 text-center">
                                <p class="text-medium-gray margin-5px-top xs-no-margin-top">&copy; <?= date("Y"); ?> CI Blog is Powered by Dorian Rina</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer section -->

    <!-- end main-wrapper section -->

    <!-- start scroll to top -->
    <a href="javascript:void(0)" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
    <!-- end scroll to top -->

    <!-- all js include start -->

    <!-- JavaScript -->
    <script src="<?= base_url('assets/js/core.min.js');?>"></script>
    
    <!-- Search -->
    <script src="<?= base_url('assets/js/search.js');?>"></script>
    
    <!-- custom scripts -->
    <script src="<?= base_url('assets/js/main.js');?>"></script>

<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
var get = '<?=isset($_GET['post'])?$_GET['post']:'';?>';
    function Subscribe(){
        var url = '<?=current_url();?>';
        var email = $('#email').val();
        if(email=='' || !validateEmail(email)){
            $('#email').addClass('required');
            return;
        }
        email = encodeURIComponent($('#email').val());
        $('#email').removeClass('required');
        $.ajax({
          type: 'get',
          url: '<?= base_url("user/subscribe/"); ?>',
          data: {email:email},
          success: function(data){
              if(get == ''){
                  window.location.href = url;
              } else {
                  window.location.href = url+'?post='+get;
              }

          },
          error: function(data){
            control.log('Something went wrong');
          }
        });


    }

     function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    function focusOut(){
        $(':focus').blur()
    }

$(function() {
    jQuery.validator.addMethod("noSpace", function(value, element) { //Code used for blank space Validation 
        return value.indexOf(" ") < 0;
    }, "Username not allowed space!");
    $("#register").validate({
        errorElement: 'div',
        errorClass: "text-danger font-weight-normal",
        validClass: "text-success",
        rules: {
            name: "required",
            surname: "required",
            username: {
                noSpace: true,
                required: true,
                minlength: 4
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            password_again: {
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {
            name: "Name is required",
            surname: "Surname is required",
            username: {
                required: "Username is required",
                minlength: "Your username must be at least 5 characters long"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            password_again: {
                equalTo: "Please enter the same password again"
            },
            email: {
                required: "Email is required",
                minlength: "Please enter a valid email address"
            }

        },
        submitHandler: function(form) {
          var recaptcha = document.forms["register"]["g-recaptcha-response"].value;
            if (recaptcha == "") {
                $('.g-recaptcha').append('<div class="text-danger font-weight-normal">Please fill reCAPTCHA</div>');
                return false;
            } else {
               form.submit(); 
            }
        }
    });
});

$(function() {
    $("#login").validate({
        errorElement: 'div',
        errorClass: "text-danger font-weight-normal",
        rules: {
            username: {
                required: true,
            },
            email: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Username is required"
            },
            password: {
                required: "Password is required"
            }

        },
        submitHandler: function(form) {
            var recaptcha = document.forms["login"]["g-recaptcha-response"].value;
            if (recaptcha == "") {
                $('.g-recaptcha').append('<div class="text-danger font-weight-normal">Please fill reCAPTCHA</div>');
                return false;
            } else {
               form.submit(); 
            }
          
        }
    });
});
</script>
  

    <!-- all js include end -->

</body>
</html>
