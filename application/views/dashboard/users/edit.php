<?php
$attributes = array('class' => 'text-center border border-light p-5', 'id' => 'myform');
echo form_open('',$attributes);
?>
  <input type="hidden" name="id" id="id" value="<?= $user->user_id; ?>">
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" name="name" id="name" class="form-control" value="<?= $user->name; ?>" placeholder="First name">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" name="surname" id="surname" class="form-control" value="<?= $user->surname; ?>" placeholder="Last name">
        </div>
    </div>


    <!-- E-mail -->
    <div class="form-row mb-4">
    	<input type="text" name="username" id="username" class="form-control" value="<?= $user->username; ?>" placeholder="Username">
    </div>


    <!-- E-mail -->
    <div class="form-row mb-4">
    	<input type="text" name="email" id="email" class="form-control" value="<?= $user->email; ?>" placeholder="E-mail">
    </div>

    <?php if(!empty($roles)) : ?>
    <div class="form-row mb-4">
    	<select name="role_id" id="role_id" class="browser-default custom-select form-control">
    		<option value="" disabled>Choose role</option>
    		<?php foreach($roles as $role): ?>
    			<option <?php if($user->role_id == $role['id']){echo("selected");}?> value="<?= $role['id']; ?>"><?= $role['role']; ?></option>
    		<?php endforeach; ?>
    	</select>
    </div>
    <?php endif; ?>

    <!-- Password -->
    <div class="form-row mb-4">
    	<input type="password" name="password" id="password" class="form-control" placeholder="Password">
    </div>

    <!-- Password -->
    <div class="form-row mb-4">
    	<input type="password" name="password_again" id="password_again" class="form-control" placeholder="Password">
    </div>

    


    <!-- Sign up button -->
    <button class="btn btn-primary my-4 btn-block text-white" type="submit"><strong>Update user</strong></button>


</form>
<!-- Default form register -->
<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#myform").validate({
    errorElement: 'div',
    errorClass: "text-danger font-weight-normal",
    validClass: "text-success",
    rules: {
      name: "required",surname: "required",
      username: {
        required: true,
        minlength: 4
      },
      email: {
        required: true,
        email: true
      },
      password: {
        minlength: 5
      },
      password_again: {
        minlength : 5,
        equalTo : "#password"
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
      var id = $('#id').val();
      var role_id = $('#role_id').val();
      var name = $('#name').val();
      var surname = $('#surname').val();
      var email = $('#email').val();
      var username = $('#username').val();
      var password = $('#password').val();
      $.ajax({
          type: 'post',
          url: '<?= base_url(); ?>user/update/'+id,
          data: {id:id,name:name,surname:surname,username:username,email:email,password:password,role_id:role_id},
          dataSrc: '',
          success: function(data){
            toastr.success(
              'User Info updated successfully!','Success',
              {
                timeOut: 1000,
                fadeOut: 500,
                onHidden: function () {
                  $('#close').click();
                }
              }
              );
          },
          error: function(data){
            alert(JSON.stringify(data));
          }
        });
    }
  });




});
</script>