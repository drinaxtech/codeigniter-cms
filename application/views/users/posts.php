<div class="container">
<div class="float-right">
<select id="myselect">
<option value="">Choose role</option>
<?php foreach($categories as $category) : ?>
    <option value="<?php echo $category['id']; ?>"><?php echo ucfirst($category['name']); ?></option>
<?php endforeach; ?>
</select>
</div>
</div>


<div class="container">
<table id="posts" class="table table-striped table-bordered" cellspacing="0" width="100%">
</table>
</div>

<script type="text/javascript">
  $(document).ready( function () {
    $('select').change(function() {
      var category = this.value;
      $('#posts').DataTable({
        destroy: true,
        processing: true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
        pageLength: 5,
        ajax: {
          type: 'post',
          data: {category:category},
          url: '<?php echo base_url('posts/get_user_posts'); ?>',
          dataSrc: ''
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
          title: 'Category',
          data: 'name' 
        },
        ]
      });
    }).change();

   






});
</script>