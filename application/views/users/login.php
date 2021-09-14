<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body text-center">

                <?php 
                    $attributes = array('name' => 'login', 'class' => 'form-signin', 'id' => 'login');
                    echo form_open('login',$attributes);
                ?>

                <h5 class="card-title text-center">Sign In</h5>


                <div class="form-label-group">
                  <label>&nbsp</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= $this->input->post('username'); ?>" required autofocus>
                </div>

                <div class="form-label-group">
                  <label>&nbsp</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?= $this->input->post('password'); ?>" required autofocus>
                  <label>&nbsp</label>
                </div>

                <div class="form-label-group mb-4">
                    <div class="g-recaptcha" data-sitekey="6Lc5cLEZAAAAAM3jYF_BDd5KKWGnGw-Aj5MvfLEZ"></div>
                </div>
                <label>&nbsp</label>
                

               
                <div id="align-center ">
                    <button class="btn btn-lg btn-primary btn-block text-uppercase btn-costum" type="submit">Sign In</button>
                    <small>
                        <strong>New Here? <a class="text-primary" href="<?= base_url('register'); ?>">Sign Up</a></strong>
                    </small>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var width = $('.g-recaptcha').parent().width();
  if (width) {
    let scale = width / 302;
    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
}
</script>