<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4><?= $title; ?></h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <?= form_open_multipart('posts/update/'.$post[0]['post_id'],array('id' => 'myform')); ?>
                    <div class="form-group row">
                        <label for="text" class="col-12 col-form-label">Enter Title here</label>
                        <div class="col-12">
                            <input type="text" id="text" name="title" placeholder="Enter Title here"
                                class="form-control here" value="<?= $post[0]['title']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="textarea" class="col-12 col-form-label">Visual Editor</label>
                        <div class="col-12" id="ckeditor">
                            <textarea id="content" class="form-control ckeditor" name="body" placeholder="Add Body"><?= $post[0]['body']; ?>
                    </textarea>
                        </div>
                    </div>
                </div>


                <div style="max-width: 18rem;" class="col-md-4">

                    <div class="card-body text-white text-left">

                        <img style="max-width: 100px;min-width: 90px;" src="<?php base_url($post[0]['post_image']); ?>">
                        <div class="custom-file">

                            <input class="custom-file-input" id="customFileLangHTML" type="file" name="userfile"
                                size="25">
                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Upload">Upload
                                Image</label>
                        </div>
                    </div>


                    <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-light ">Publish</div>
                        <div class="card-body text-white text-center">
                            <button type="submit" class="btn btn-primary btn-md">Publish</button>
                        </div>
                        <div class="card-footer bg-light">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Categories <span class="require">*</span></label>
                        <select class="js-example-basic-single" style="width: 100%;" name="category_id">
                            <option selected="true" disabled="disabled">-- Select Category --</option>

                            <?php foreach($categories as $category) : ?>

                            <option value="<?= $category['id']; ?>"
                                <?php if($post[0]['category_id'] == $category['id']) : ?> selected="selected"
                                <?php endif; ?>>
                                <?= ucfirst( $category['name'] ); ?>
                            </option>

                            <?php endforeach; ?>

                        </select>
                        <div id="category_required"></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>


<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {

    $("#publish").click(function() {
        var category = $('#category_id').val();
        if (category == null) {
            $('#category_required').empty();
            $('#category_required').append('<div style="color:red">Category is required!</div>');
        }
    });

    $("#myform").validate({
        ignore: [],
        debug: false,
        rules: {
            title: {
                required: true,
                minlength: 4,
                maxlength: 500,
            },
            body: {
                required: function() {
                    CKEDITOR.instances.content.updateElement();
                },
                minlength: 10
            }
        },
        messages: {
            title: {
                required: "Title is required!",
                minlength: "Title must be at least 5 characters long",
            },
            body: {
                required: "Content is required!",
                minlength: "Content must be at least 10 characters long"
            }
        },
        submitHandler: function(form) {
            toastr.success(
                'Your post is updated successfully!', 'Success', {
                    timeOut: 1000,
                    fadeOut: 500,
                    onHidden: function() {
                        form.submit();
                    }
                });
        }
    });
});
</script>