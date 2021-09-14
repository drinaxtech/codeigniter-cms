<div class="container">
    <div class="float-right">
        <select id="myselect">
            <option value="">Choose category</option>
            <?php foreach($categories as $category) : ?>
            <option value="<?= $category['id']; ?>">
                <?= ucfirst(str_replace('-', ' ',$category['name'])); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="w-100 p-3 table-responsive">
    <table id="posts" class="table table-striped table-bordered" cellspacing="0" width="100%">
    </table>
</div>




<script type="text/javascript">
$(document).ready(function() {
    var category = this.value;
    var table = $('#posts').DataTable({
        destroy: true,
        processing: true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        pageLength: 5,
        ajax: {
            type: 'post',
            data: {
                category: category
            },
            url: '<?= base_url("dashboard/get_all_trash_posts"); ?>',
            dataSrc: ''
        },
        columns: [{
                title: 'ID',
                data: 'post_id'
            },
            {
                title: 'Title',
                data: 'title'
            },
            {
                title: 'Author',
                data: 'username'
            },
            {
                title: 'Category',
                data: 'name'
            },
            {
                title: 'Actions',
                data: null,
                "render": function(data, type, row) {
                    return '<div style="font-size:18px;" class="container"><a title="Delete" style="margin-right:20px;" id="delete" class="text-danger" data-id="' +
                        data.post_id +
                        '" ><i class="fas fa-trash"></i></a> <a title="Restore" id="restore" class="text-info" data-id="' +
                        data.post_id + '" ><i class="fas fa-trash-restore"></i></a></div>';
                }
            }
        ],
        rowId: function(data) {
            return 'id_' + data.post_id;
        },
    });

    $('select').change(function() {
        var category = this.value;
        table
            .columns(3)
            .search(category)
            .draw();
    });


    $(document).on('click', '#delete', function() {
        var post_id = $(this).attr("data-id");
        $.confirm({
          title: '',
          content: 'Are you sure?',
          buttons: {
              yes: function () {
                  $.ajax({
                      type: 'post',
                      url: '<?= base_url("api/authapi/delete_posts/"); ?>',
                      data: {id: post_id},
                      dataSrc: '',
                      success: function(data) {
                          toastr.success(
                            'Posts was deleted successfully!', 'Success!', 
                            {
                                timeOut: 1000,
                                fadeOut: 500
                            }
                            );
                            table.row('#id_' + post_id).remove().draw(false);
                        },
                       error: function(data) {
                           toastr.error(
                               'Something went wrong!', 'Error', {
                                   timeOut: 1000,
                                    fadeOut: 500
                                    });
                        }
                    });
                    },
                    no: function(){
                        close();
                        }
                        }
            });
    });


    $(document).on('click', '#restore', function() {
        var post_id = $(this).attr("data-id");
        $.confirm({
          title: '',
          content: 'Are you sure?',
          buttons: {
              yes: function () {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url("api/authapi/post_restore"); ?>',
                    data: {id: post_id },
                    success: function(data) {
                        console.log(post_id);
                        table.row('#id_' + post_id).remove().draw(false);
                        },
                        error: function(data) {
                            toastr.error(
                               'Something went wrong!', 'Error', {
                                   timeOut: 1000,
                                    fadeOut: 500
                                    });
                        }
                    });
                    },
                    no: function(){
                        close();
                        }
                        }
            });
    });




});
</script>