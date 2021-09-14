<div class="col-md-12 col-sm-8 row">
    <div class="col-md-6 text-center">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Add New Category</div>
                </div>
                <div style="padding-top:30px" class="panel-body form-group">
                    <form id="myform" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <input id="category" type="text" class="form-control required" name="category"
                                placeholder="Category Name">
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <button type="button" id="save_category" class="btn btn-primary btn-lg btn-block">Create
                                    Category</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-md-6 table-responsive float-right">
        <table id="posts" class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
    </div>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#posts').DataTable({
        processing: true,
        responsive: true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        pageLength: 5,
        ajax: {
            type: 'post',
            url: '<?= base_url("api/authapi/get_categories/"); ?>',
            dataSrc: '',
        },
        columns: [{
                title: 'ID',
                data: 'id'
            },
            {
                title: 'Name',
                data: 'name'
            },
            {
                title: 'Posts Number',
                data: 'post_count'
            },
            {
                title: 'Actions',
                data: null,
                "render": function(data, type, row) {
                    if (data.post_count != 0) {
                        return '<a class="text-dark" data-id="' + data.id +
                            '" ><i class="fas fa-trash"></i></a>';
                    } else {
                        return '<a title="Delete" id="delete" class="text-danger" data-id="' +
                            data.id + '" ><i class="fas fa-trash"></i></a>';
                    }

                }
            }
        ],
        rowId: function(data) {
            return 'id_' + data.id;
        },
    });

    $(document).on('click', '#delete', function() {
        var id = $(this).attr("data-id");
        $.confirm({
            title: '',
            content: 'Are you sure?',
            buttons: {
                yes: function() {
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url("api/authapi/delete_category"); ?>',
                        data: {
                            id: id
                        },
                        dataSrc: 'src',
                        success: function(data) {
                            toastr.success(
                                'Category deleted successfully!',
                                'Success', {
                                    timeOut: 1000,
                                    fadeOut: 500
                                });
                            table.row('#id_' + id).remove().draw(false);
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
                no: function() {
                    close();
                }
            }
        });
    });

    $("#myform").submit(function(e) {
        e.preventDefault();
    });
    $('#myform').validate({
        rules: {
            category: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            category: {
                required: "Please enter a value!",
                minlength: "2 characters minimum"
            }
        }

    });
    $('#save_category').click(function(e) {
        var category = $('#category').val();
        var url = "<?= current_url(); ?>";
        if ($("#myform").valid()) {
            $.ajax({
                type: 'post',
                url: '<?= base_url("api/authapi/create_category"); ?>',
                data: {
                    category: category
                },
                dataSrc: '',
                success: function(data) {
                    if (data == 'false') {
                        $("#error").remove()
                        setTimeout(function() {
                            $('#message').append(
                                '<div id="error" class="alert alert-danger">This category already exists!</div>'
                                );
                        }, 20);
                    } else {
                        toastr.success(
                            'Category created successfully!', 'Success', {
                                timeOut: 1000,
                                fadeOut: 500
                            });
                        table.ajax.reload();
                        $('#category').val('');
                    }
                },
                error: function(data) {
                    $("#error").remove()
                    setTimeout(function() {
                        $('#message').append(
                            '<div id="error" class="alert alert-danger">This category already exists!</div>'
                            );
                    }, 20);
                }
            });
        }
    });



});
</script>