<div class="col-sm-6 mx-auto">
    <div class="card card-signin my-5">
      <div class="card-body">
        
        <?php 
        $attributes = array('class' => 'form-signin', 'id' => 'myform');
        echo form_open('',$attributes);
        ?>

            <h5 style="margin-bottom: 30px;margin-top: 10px;" class="card-title text-center">Contact Us</h5>


          <div class="form-label-group">
            <label for="street">Street</label>
            <input type="text" id="street" name="street" class="form-control" placeholder="Street" value="<?= $address[0]; ?>" autofocus>
            <label>&nbsp</label>
          </div>

          <div class="form-label-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="City" value="<?= $address[1]; ?>" autofocus>
            <label for="street">&nbsp</label>
          </div>

          <div class="form-label-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" class="form-control" placeholder="Country" value="<?= $address[2]; ?>" autofocus>
            <label for="street">&nbsp</label>
          </div>

          <div class="form-label-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="<?= $contact->phone_number; ?>" autofocus>
            <label for="street">&nbsp</label>
          </div>

          <div class="form-label-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?= $contact->email; ?>" autofocus>
            <label for="street">&nbsp</label>
          </div>

          <br>
          <div id="align-center">
            <button class="btn btn-lg btn-primary btn-block my-4 text-white" type="submit"><strong>Update</strong></button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript">
  $(':input[type="submit"]').prop('disabled', true);
  $(':input[type="text"]').on('change', function(){
    $(':input[type="submit"]').prop('disabled', false);
  });
  $("#myform").validate({
    errorElement: 'div',
    errorClass: "text-danger font-weight-normal",
    validClass: "text-success",
    rules: {
      street: "required",
      city: "required",
      country: "required",
      phone_number: "required",
      email: "required"
    },
    messages: {
      street: "Street is required",
      city: "City is required",
      country: "Country is required",
      phone_number: "Phone Number required",
      email: "Email is required"
       
    },
    submitHandler: function(form) {
      $(':input[type="submit"]').prop('disabled', true);
      var street = $('#street').val();
      var city = $('#city').val();
      var country = $('#country').val();
      var phone_number = $('#phone_number').val();
      var email = $('#email').val();
      var address = street+'; '+city+'; '+country;
      $.ajax({
        type: 'post',
        url: '<?= base_url('api/authapi/contact'); ?>',
        data: {address:address,phone_number:phone_number,email:email},
        dataSrc: '',
        success: function(data){
          toastr.success(
            'Contact page updated successfully!','Success',
            {
              timeOut: 1000,
              fadeOut: 500,
            }
            );
        },
        error: function(data){
          console.log(JSON.stringify(data));
        }
      });

    }
  });

</script>