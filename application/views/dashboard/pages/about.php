<?php
$attributes = array('class' => 'border border-light p-5', 'id' => 'myform');
echo form_open('',$attributes);
?>
  <input type="hidden" name="id" id="id" value="<?= $about->id; ?>">
    <div class="form-group row">
                        <label for="textarea" class="col-12 col-form-label"></label>
                        <div class="col-12">
                            <textarea id="content" class="form-control ckeditor" name="body"
                                placeholder="Add Body"><?= $about->text; ?></textarea>
                        </div>
                    </div>
    <!-- Sign up button -->
    <button class="btn btn-primary my-4 text-white" type="submit"><strong>Update</strong></button>


</form>
<!-- Default form register -->
<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#myform").validate({
        ignore: [],
        debug: false,
        rules: {
            body: {
                required: function() {
                    CKEDITOR.instances.content.updateElement();
                },
                minlength: 10
            }
        },
        messages: {
            body: {
                required: "Content is required!",
                minlength: "Content must be at least 10 characters long"
            }
        },
        submitHandler: function(form) {
          var id = $('#id').val();
          var text = $('textarea#content').val();
          $.ajax({
            type: 'post',
            url: '<?= base_url('api/authapi/about'); ?>',
            data: {id:id,text:text},
            dataSrc: '',
            success: function(data){
              toastr.success(
                'About page updated successfully!','Success',
                {
                  timeOut: 1000,
                  fadeOut: 500
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