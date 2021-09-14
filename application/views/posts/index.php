         <h1 class="font-size24 sm-margin-20px-bottom"><?= $title = (base_url()==current_url() || base_url('posts')==current_url()) ? '&nbsp' : ucfirst($title);?></h1>
                <div class="row">

                    <!--  start blog left-->
                    <?php if(empty($posts)) : ?>
                        <section class="col-md-12 page-title-section-1 bg-light text-center">
                            <div class="container">
                                 <h1>Nothing Found</h1>
                                <ul>
                                    <li>
                                        <p>&nbsp</p>
                                    </li>
                                    
                                </ul>
                            </div>
                        </section>
                    <?php else: ?>
                    <div class="col-lg-8 col-md-12 sm-margin-20px-bottom">
                      <div id="post-data">
                        <?php $this->load->view('posts/post', isset($posts) ? $posts : null);?>
                      </div>
                      <div class="ajax-load text-center" style="display:none">
                        <p>
                          <img src="<?= base_url('assets/images/loader.gif'); ?>">
                          Loading More Posts
                        </p>
                      </div>
                      <div id="end" class="text-center"></div>
                    </div>

                    <!--  end blog left-->

                    <!--  start blog right-->
                    <div class="col-lg-4 col-md-12">
                        <div class="side-bar padding-30px-left md-no-padding-left">
                            <div class="widget search padding-30px-all md-padding-20px-all shadow-theme">
                                <div class="widget-title margin-35px-bottom">
                                    <h3>Search</h3>
                                </div>
                                <?= form_open(base_url('posts/search'),array('method'=>'get')); ?>
                                <div class="input-group mb-3">
                                    <input type="text" name="post" class="form-control" placeholder="Type here..." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2"><span class="ti-search"></span></button>
                                    </div>
                                </div>
                              </form>
                            </div>
                        

                            <div class="widget padding-30px-all md-padding-20px-all shadow-theme">
                                <div class="widget-title margin-35px-bottom">
                                    <h3>Categories</h3>
                                </div>
                                <ul class="tags no-margin-bottom">
                                    <?php $this->load->model('category_model');
                                    $categories = $this->category_model->get_last_categories();
                                    foreach ($categories as $category) :?>
                                        <li>
                                            <a href="<?= base_url('category/'.$category['slug']);?>">
                                                <?= ucfirst($category['name']);?>
                                            </a>
                                        </li>
                                    <?php endforeach;?>
                                    
                                </ul>
                            </div>

                            <div class="widget">
                                <div class="bg-img text-center padding-30px-all cover-background" data-overlay-dark="5" data-background="<?= base_url('assets/images/pages/facebook.jpg');?>">
                                    <div class="owl-carousel owl-theme">
                                        <div>
                                            <h5 class="text-white">Facebook</h5>
                                            <?php
                                            $social_networks = $this->post_model->get_social_networks();
                                            foreach ($social_networks as $social_network) :
                                                if($social_network['name'] =='facebook'):
                                                    $link = $social_network['link'];
                                                endif;
                                            endforeach;?>
                                            <div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/sq_AL/sdk.js#xfbml=1&version=v7.0&appId=2016116968491196&autoLogAppEvents=1" nonce="HMTfXOyc"></script>
                                            <div class="fb-like" data-href="<?= $link;?>" data-width="200" data-layout="box_count" data-action="like" data-size="small" data-share="true"></div>

                                        <div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                   <?php endif; ?>
                    <!--  end blog right-->

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
