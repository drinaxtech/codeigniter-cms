<div class="w-100 p-3 table-responsive">
    <table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header text-center">
                <h2>Edit User</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var special_permissions = '<?= $this->user_model->get_users($this->user_id)->special_permissions;?>';
    console.log(special_permissions);
    var table = $('#users').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        ajax: {
            url: '<?= base_url("api/authapi/get_users"); ?>',
            dataSrc: ''
        },
        columns: [{
                title: 'ID',
                data: 'user_id'
            },
            {
                title: 'Name',
                data: 'name',
            },
            {
                title: 'Surname',
                data: 'surname',
            },
            {
                title: 'Username',
                data: 'username',
            },
            {
                title: 'Email',
                data: 'email',
            },
            {
                title: 'Role',
                data: 'role',
            },
            {
                title: 'Edit',
                data: null,
                "render": function(data) {
                    return '<a href="#" data-toggle="modal" data-id="' + data.user_id +
                        '" data-target="#myModal"><i class="fas fa-edit"></i></a>';
                }
            }
        ]
    });
    $('.dataTables_length').addClass('bs-select');
    if(special_permissions == 0){
        table.column(6).visible(false);
    }

    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var user_id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: '<?= base_url("user/edit/"); ?>' + user_id,
                dataSrc: '',
                success: function(data) {
                    $('.modal-body').html(data);
                }
            });
        });
        $('#close').on('click',function(){
            table.ajax.reload();
        });


    });

});
</script>