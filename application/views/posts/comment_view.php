<?php
$user_id = $this->session->userdata('user_id');
foreach ($comments as $comment):
?>

<div data-id="<?=$comment['comment_id'];?>">

<div class="comment-info">
  <h6 style="color: #6f6f6f;"><i class="fas fa-user-circle fa-fw"></i> <?=ucfirst($comment['name']) . " " . ucfirst($comment['surname']);?></h6>
  <p>
    <?=$comment['body'];?>
  <br>
  <?php if ($user_id == $comment['user_id']): ?>
    <a style="margin-top: 30px;" type="button" onClick="deleteComment(<?=$comment['comment_id'];?>);">
      <i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete
    </a>
  <?php endif;?>
  </p>
</div>
</div>
<?php endforeach;?>

<script type="text/javascript" src="<?=base_url('assets/js/jquery-confirm/3.3.2/jquery-confirm.min.js');?>"></script>
<script type="text/javascript">
      function deleteComment(id){
        $.confirm({
          title: '',
          content: 'Are you sure?',
          buttons: {
            yes: function () {
                $.ajax({
                  type : 'post',
                  url : '<?= base_url("api/authapi/delete_comment/"); ?>',
                   data: {id:id},
                   dataSrc: '',
                   success : function(data){
                   $('div[data-id='+id+']').fadeOut( "slow", function() {
                   $('div[data-id='+id+']').remove();
                 })
                 },
                 error: function(data){
                  toastr.error(
                    'Something went wrong!','Error',
                    {
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
      }
</script>
