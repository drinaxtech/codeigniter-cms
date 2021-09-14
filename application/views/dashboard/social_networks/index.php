<div class="w-100 p-3 table-responsive">
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal">Add Social Network</a>
    <br>
    <br>
    <br>
    <table id="social_networks" class="table table-striped table-bordered" cellspacing="0" width="100%">
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header text-center">
                <h2>Edit Social Network</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header text-center">
                <h2>Add Social Network</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button id="closeCreate" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#social_networks').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        ajax: {
            url: '<?= base_url("api/authapi/get_social_networks"); ?>',
            dataSrc: ''
        },
        columns: [{
                title: 'ID',
                data: 'id'
            },
            {
                title: 'Name',
                data: 'name',
            },
            {
                title: 'Font-Awesome Icon',
                data: 'fa_icon',
            },
            {
                title: 'Link',
                data: 'link',
            },
            {
                title: 'Edit',
                data: null,
                "render": function(data) {
                    return '<div class="container text-left"><a style="margin-right:15px" title="Edit" href="#" data-toggle="modal" data-id="' + data.id +
                        '" data-target="#editModal"><i class="fas fa-edit"></i></a><a title="Delete" id="delete" class="text-danger" data-id="'+data.id+'" ><i class="fas fa-trash"></i></a></div>';
                }
            }
        ]
    });
    $('tbody').css('text-transform', 'lowercase');
    $('.dataTables_length').addClass('bs-select');

    $(document).ready(function() {
        $(document).on('click','#delete', function() {
            var id = $(this).attr("data-id");
            $.confirm({
                title: '',
                content: 'Are you sure?',
                buttons: {
                    yes: function () {
                        $.ajax({
                            type : 'post',
                            url : '<?= base_url("api/authapi/social_network_delete/"); ?>',
                            data: {id:id},
                            dataSrc: 'src',
                            success : function(data){
                                table.ajax.reload();
                            },
                            error: function(data){
                                console.log(JSON.stringify(data));
                            }
                        });
                    },
                    no: function(){
                        close();
                    }
                }
            });
        });

        $('#editModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: '<?= base_url("dashboard/social_network_edit/"); ?>' + id,
                dataSrc: '',
                success: function(data) {
                    $('.modal-body').html(data);
                }
            });
        });

        $('#closeEdit').on('click',function(){
            table.ajax.reload();
        });

        $('#createModal').on('show.bs.modal', function(e) {
            $.ajax({
                type: 'post',
                url: '<?= base_url("dashboard/create_social_network/"); ?>',
                dataSrc: '',
                success: function(data) {
                    $('.modal-body').html(data);
                }
            });
        });
        
        $('#closeCreate').on('click',function(){
            table.ajax.reload();
        });


    });

});
</script>