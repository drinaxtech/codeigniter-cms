<div class="container">
<div class="float-right">

</div>
</div>

<div class="w-100 p-3 table-responsive">
<table id="comments" class="table table-striped table-bordered" cellspacing="0" width="100%">
</table>
</div>




<script type="text/javascript">
  $(document).ready( function () {
      $('#comments').DataTable({
        destroy: true,
        processing: true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        pageLength: 5,
        ajax: {
          type: 'post',
          url: '<?= base_url('api/authapi/get_all_comments/'); ?>',
          dataSrc: ''
        },
        columns:[
        {
          title: 'ID',
          data: 'comment_id' 
        },
        {
          title: 'Username',
          data: null,
          "render": function (data) {
            return '<a class="text-dark" href="<?= base_url('user/'); ?>'+data.username+'">'+data.username+'</a>';
          }
        },
        {
          title: 'Post ID',
          data: null,
          "render": function (data) {
            return '<a class="text-dark" href="<?= base_url('posts/'); ?>'+data.post_slug+"/"+data.post_id+'">'+data.post_id+'</a>';
          }

        },
        {
        title: 'Hide or Show',
        data: null,
        "render": function (data, type, row) {
          if(data.hide == 0){
            return '<input type="submit" id="action'+data.comment_id+'" class="btn btn-secondary btn-md" data-default="Hide" data-alt="Show" value="Hide" data-id="'+data.comment_id+'" >';
          } else {
            return '<input type="submit" id="action'+data.comment_id+'" class="btn btn-primary btn-md" data-default="Show" data-alt="Hide" value="Show" data-id="'+data.comment_id+'" >';
          }
        }
      }
      ]
    });


    $(document).on('click','.btn', function() {
      var comment_id = $(this).attr("data-id");
      var url = "<?= base_url('dashboard/comments'); ?>";
      
      $.ajax({
            type : 'post',
            url : '<?= base_url("api/authapi/comment_action"); ?>',
            data: {id:comment_id},
            dataSrc: 'src',
            success : function(data){
              var $submit = $("#action"+comment_id);
              var  def = $submit.data('default'),
                   alt = $submit.data('alt');
                   
              $("#action"+comment_id).toggleClass('btn-primary action'+comment_id, 'add').toggleClass('btn-secondary', 'remove');
              ($submit.val() == def) ? $submit.val(alt) : $submit.val(def); 
            },
            error: function(data){
            alert(JSON.stringify(data));
          }
        });
     });



});
</script>