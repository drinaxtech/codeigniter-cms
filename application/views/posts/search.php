         <section class="page-title-section-1 bg-light text-center">
            <div class="container">
                <h1>Search Result for '<?=$this->input->get('post');?>'</h1>
                <ul>
                    <li>
                        <a href="<?=base_url();?>">Home</a>
                    </li>
                    <li>
                        <span class="active">Search Result</span>
                    </li>
                </ul>
            </div>
        </section>
        <h1 class="font-size24 sm-margin-20px-bottom">&nbsp</h1>
        <div class="row">
          <div class="col-md-12 sm-margin-50px-bottom">
            <div id="post-data">
              <?php if (empty($posts)): ?>
                <h5 class="text-center">Nothing Found</h5>
              <?php endif;?>
            </div>
            <div class="ajax-load text-center" style="display:none">
              <p>
                <img src="<?= base_url('assets/images/loader.gif'); ?>">
                Loading More Posts
              </p>
            </div>
            <div id="end" class="text-center"></div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end blog section -->

<script type="text/javascript">

  var limit = <?=$limit;?>;
  var string = '<?=isset($string) ? $string : false;?>';
  if(string) {
    $('#post-data p').each(function() {
      let text = $(this).text();
      let res = str_replace_all(text, string, '<mark>'+string+'</mark>');
      $(this).html(res);
    });

  }

  var page = 1;

  if(page == 1){
    loadMoreData(page);
  }
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

        url: "<?= base_url('api/api/' . $api . '/'); ?>"+ page,
        type: "get",
        beforeSend: function()
        {
          $('.ajax-load').show();
        },
        success: function(response)
        {
          $('.ajax-load').hide();
          $('#post-data').append(response);
          if(string) {
            $('#post-data p').each(function() {
              let text = $(this).text();
              let res = str_replace_all(text, string, '<mark>'+string+'</mark>');
              $(this).html(res);
            });
          }

        },

          error:function(response)
          {
            $('#end').append('No posts!');
          }

      });
      if(limit == page) {
        $('#end').append('No more posts!');

      }

    }
  }
    function str_replace_all(string, str_find, str_replace){
try{
    return string.replace( new RegExp(str_find, "g"), str_replace ) ;
} catch(ex){return string;}}
</script>
