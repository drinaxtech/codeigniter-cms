<div class="w-100 p-3 table-responsive">
    <table id="subscribers" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    var table = $('#subscribers').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        ajax: {
            url: '<?= base_url("api/authapi/get_subscribers"); ?>',
            dataSrc: ''
        },
        columns: [{
                title: 'ID',
                data: 'id'
            },
            {
                title: 'Email',
                data: 'email',
            },
            {
                title: 'Unsubscribe',
                data: null,
                "render": function(data) {
                    if(data.unsubscribe == 0){
                        return 'No';
                    } else {
                        return 'Yes';
                    }
                }
            }
        ]
    });
    $('.dataTables_length').addClass('bs-select');



});
</script>