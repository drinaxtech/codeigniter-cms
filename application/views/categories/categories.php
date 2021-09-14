<div class="row portfolio" id="category-data">
  <?php $this->load->view('categories/category_view', $categories); ?>
</div>



<script type="text/javascript">
  var limit = <?= $limit; ?>;
  var page = 1;
  $(window).scroll(function() {
    if($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {
      page++;
      loadMoreData(page);
    }
  });

  function loadMoreData(page){
    if(limit >= page)
    {
      $.ajax(
      {

        url: "<?= base_url('api/api/get_categories/'); ?>"+ page,
        type: "get",
        beforeSend: function()
        {
          $('.ajax-load').show();
        },
        success: function(response)
        {
          $('.ajax-load').hide();
          $('#category-data').append(response);
        },

          error:function(response)
          {
            $('#end').append('No more categories!');
          }

      });
      if(limit == page) {
        $("#category-data").after('<div style="margin:10px;" class="container text-center">No more categories!</div>');
      }
    }
  }
</script>