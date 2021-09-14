<div class="container">
<div class="float-right">
<select id="myselect">
<option value="">Choose category</option>
<?php foreach ($categories as $category): ?>
    <option id="<?= $category['id']; ?>" value="<?= $category['name']; ?>"><?= ucfirst($category['name']); ?></option>
<?php endforeach;?>
</select>
</div>
</div>

<div class="w-100 p-3 table-responsive">
<table id="posts" class="table table-striped table-bordered" cellspacing="0" width="100%">
</table>
</div>




<script type="text/javascript">
  $(document).ready( function () {
      var table = $('#posts').DataTable({
        processing: true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        pageLength: 5,
        ajax: {
          type: 'post',
          url: '<?= base_url("api/authapi/get_posts/"); ?>',
          dataSrc: '',
        },
        columns:[
        {
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
        "render": function (data, type, row) {
          return '<div class="container text-left"><a href="<?=base_url('posts/');?>'+data.post_slug+'/'+data.post_id+'" style="margin-right:15px;" title="View" id="view" class="text-primary" data-id="'+data.post_id+'" ><i class="fas fa-eye"></i></a><a href="<?=base_url('dashboard/posts/edit/');?>'+data.post_id+'" style="margin-right:15px;" title="Edit" id="edit" class="text-primary" data-id="'+data.post_id+'" ><i class="fas fa-edit"></i></a><a title="Trash" id="trash" class="text-danger" data-id="'+data.post_id+'" ><i class="fas fa-trash"></i></a></div>';
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
        .columns( 3 )
        .search( category )
        .draw();
      });


    $(document).on('click','#trash', function() {
      var post_id = $(this).attr("data-id");
      $.confirm({
        title: '',
        content: 'Are you sure?',
        buttons: {
        yes: function () {
      $.ajax({
            type : 'post',
            url : '<?= base_url("api/authapi/post_trash"); ?>',
            data: {id:post_id},
            dataSrc: 'src',
            success : function(data){
              table.row('#id_'+post_id).remove().draw(false);
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



});
</script>