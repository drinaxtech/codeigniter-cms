<?php
$attributes = array('class' => 'text-center border border-light p-5', 'id' => 'myform');
echo form_open('',$attributes);
?>
  <input type="hidden" name="id" id="id" value="<?= $social_network->id; ?>">
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" name="name" id="name" class="form-control" value="<?= $social_network->name; ?>" placeholder="Name">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" name="fa_icon" id="fa_icon" class="form-control" value="<?= $social_network->fa_icon; ?>" placeholder="fa-icon">
        </div>
    </div>

    <!-- E-mail -->
    <div class="form-row mb-4">
    	<input type="text" name="link" id="link" class="form-control" value="<?= $social_network->link; ?>" placeholder="URL">
    </div>

    


    <!-- Sign up button -->
    <button class="btn btn-primary my-4 btn-block text-white" type="submit"><strong>Update</strong></button>


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
      name: "required",
      fa_icon: "required",
      link: "required"
    },
    messages: {
      name: "Name is required",
      fa_icon: "fa_icon is required",
      link: "Url is required"
       
    },
    submitHandler: function(form) {
      var id = $('#id').val();
      var name = $('#name').val();
      var fa_icon = $('#fa_icon').val();
      var link = $('#link').val();
      $.ajax({
          type: 'post',
          url: '<?= base_url("dashboard/social_network_update/"); ?>',
          data: {id:id,name:name,fa_icon:fa_icon,link:link},
          dataSrc: '',
          success: function(data){
            toastr.success(
              'Social Network updated successfully!','Success',
              {
                timeOut: 1000,
                fadeOut: 500,
                onHidden: function () {
                  $('#closeEdit').click();
                }
              }
              );
          },
          error: function(data){
            console.log(JSON.stringify(data));
          }
        });
    }
  });




});
</script>