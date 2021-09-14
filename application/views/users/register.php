<div class="row">
  <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div  class="card card-signin my-5">
      <div class="card-body text-center">
        
        <?php 
        $attributes = array('name' => 'register', 'class' => 'form-signin', 'id' => 'register');
        echo form_open('register',$attributes);
        ?>


            <h5 class="card-title text-center">Sign Up</h5>


          <div id="inline-block">
          <div class="form-label-group input-name">
            <label for="name">&nbsp</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?= $this->input->post('name'); ?>" autofocus>
            <?= form_error('name', '<div class="error">', '</div>'); ?>
          </div>

          <div class="form-label-group input-surname">
            <label for="surname">&nbsp</label>
            <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname" value="<?= $this->input->post('surname'); ?>" autofocus>
            <?= form_error('surname', '<div class="error">', '</div>'); ?>
          </div>
        </div>
          <div class="form-label-group">
            <label for="username">&nbsp</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= $this->input->post('username'); ?>" autofocus>
            <?= form_error('username', '<div class="error">', '</div>'); ?>
          </div>

          <div class="form-label-group">
            <label for="email">&nbsp</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Email Adress" value="<?= $this->input->post('email'); ?>" autofocus>
            <?= form_error('email', '<div class="error">', '</div>'); ?>
          </div>

          <div class="form-label-group">
            <label for="password">&nbsp</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <?= form_error('password', '<div class="error">', '</div>'); ?>
          </div>

          <div class="form-label-group">
            <label for="password_again">&nbsp</label>
            <input type="password" id="password_again" name="password_again" class="form-control" placeholder="Repeat Password">
            
            <?= form_error('password_again', '<div class="error">', '</div>'); ?>
            <label>&nbsp</label>
          </div>

          <div class="form-label-group mb-4">
            <div class="g-recaptcha" data-sitekey="6Lc5cLEZAAAAAM3jYF_BDd5KKWGnGw-Aj5MvfLEZ"></div>
          </div>

          <label>&nbsp</label>
          <div id="align-center">
            <button class="btn btn-lg btn-primary btn-block text-uppercase btn-costum" type="submit">Sign Up</button>
            <small class="signup"><strong>Already register? <a class="text-primary" href="<?= base_url('login'); ?>">Sign In</a></strong></small>
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