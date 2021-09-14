                <div class="row justify-content-center">

                    <div class="col-lg-10 col-md-11">
                        <!-- start content  -->
                        <div class="d-flex">
                            <img src="<?= base_url('assets/images/posts/').$post['post_image']; ?>" class="img-fluid margin-30px-bottom" alt="<?= $post['title']; ?>" />
                        </div>
                        <span class="text-extra-dark-gray font-size14"><span class="font-weight-600">By:</span> <a href="<?=base_url('posts/author/' . $username); ?>" class="border-bottom"><?= $author; ?></a> <span class="font-weight-600">, at </span> <a href="#" class="border-bottom"> <?= $post['created_at']; ?></a></span>
                        <h5 class="margin-15px-top font-weight-600 font-size32 sm-font-size28 xs-font-size24 line-height-40 xs-line-height-30"><?= $post['title']; ?></h5>

                        <p class="font-size16"><?= $post['body'];?></p>

                            <?php if( !empty($role) ) :
                                if( $this->session->userdata('user_id') == $post['user_id'] || $role === 'admin' ):?>
                                  <!-- Modal-->
                                  <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog modal-md">
                                      <!-- Modal content-->
                                      <div class="modal-content modal-md">
                                        <div class="modal-body">
                                          Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                          <button id="close" onClick="deletePost()" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
                                          <button id="close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="p-2"><a class="btn btn-secondary" href="<?= base_url('dashboard/posts/edit/').$post['id']; ?>">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="p-2">
                                            <?= form_open('/posts/delete/'.$post['id'],array('id' => 'delete_post')); ?>
                                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#myModal">
                                                  Delete
                                                </a>

                                            </form>
                                        </div>
                                    </div>

                            <?php endif;
                              endif; ?>

                        <div class="row align-items-center">
                            &nbsp
                        </div>


                        <div class="border-top padding-20px-top margin-20px-bottom">
                            <div class="d-flex align-items-center justify-content-center">
                                <label class="font-weight-bold mr-3 mb-0">Share this article:</label>
                                <ul class="social-links mb-0">
                                    <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="container">
                            <div class="margin-30px-bottom">
                                <h3 class="font-size28 xs-font-size22"><?=empty($recents) ? '' : 'Recent Posts';?></h3>
                            </div>
                        </div>

                        <div class="row portfolio">
                        <?php if( !empty($recents) ) :
                            $recents = array_slice($recents, 0,3);
                            foreach( $recents as $recent ) :
                                $body = strip_tags($recent['body']);
                                ?>
                        <div class="col-md-6 col-lg-4">
                        <div class="grid">
                            <div class="grid-img">
                                <img src="<?= base_url('assets/images/posts/').$recent['post_image']; ?>" alt="...">
                            </div>

                            <div class="grid-details">

                                <span class="category"><a href="<?= base_url('category/').$category_slug;?>"><?= ucfirst($recent['name']); ?></a></span>

                                <h5><a href="<?= base_url('/posts/'.$recent['post_slug'].'/'.$recent['post_id']); ?>"><?= character_limiter($recent['title'],30); ?></a></h5>
                                <p><?= character_limiter($body,60); ?></p>
                                <div class="d-flex">
                                    <a href="<?= base_url('/posts/'.$recent['post_slug'].'/'.$recent['post_id']); ?>" class="btn-blog">Read More</a>
                                </div>

                                <div class="meta">
                                    <span class="date"><?= $recent['created_at']; ?></span>
                                    <span class="author">By <?= $recent['author']; ?></span>
                                </div>

                            </div>

                        </div>
                    </div>
                    <?php endforeach;
                    endif; ?>
                    </div>

                        <!-- end content -->

                        <div class="blogs margin-40px-top">
                            <!--  start comment-->
                            <div class="comments-area">
                                <div class="margin-50px-bottom sm-margin-30px-bottom">
                                    <h3 class="font-size28 sm-font-size26 xs-font-size24 <?=($comments_count == 0) ? 'invisible': 'visible';?>">
                                      Comments
                                    </h3>
                                </div>
                                <div class="comment-box">
                                    <div id="comments"></div>
                                    <div style="margin-left: 82px;">
                                        <button id="loadmore" class="btn btn-info btn-md" type="button">
                                            Load More
                                        </button>
                                    </div>
                                    
                                </div>



                            </div>
                            <!-- end comment-->

                            <!--  start form-->
                            <div class="comment-form">
                                <div>
                                    <h3 class="font-size28 xs-font-size22">Post a Comment</h3>
                                </div>
                                <div class="col-md-12 form-group" style="height: 40px;" id="message">
                                  
                                </div>
                                <form action="#!" id="comment-form" method="post">
                                    <div class="controls">
                                        <div class="row">
                                                <?php if(!$this->session->userdata('logged_in')): ?>
                                                <div class="alert alert-warning col-md-12 form-group">
                                                    You should <a class="text-dark" href="<?=base_url('login');?>"> login</a> first!
                                                </div>
                                                <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <textarea id="body" name="body" placeholder="Message" rows="4"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <button id="comment" type="button" class="btn btn-primary">
                                                  <span>Write a Comment</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--  end form-->
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- end blog section -->
<script type="text/javascript">
  function deletePost(){
        $('#delete_post').submit();
      }
  $(document).ready(function() {
    var logged_user_id = "<?= $this->session->userdata('user_id'); ?>";
    var logged_in = (logged_user_id == '') ? false : true;
    $("#comment").prop("disabled",true);
    $('textarea#body').keyup(function(){
      $("#comment").prop("disabled",(logged_in) ? (this.value == "") : true);
    });
    var post_id = "<?= $post['id']; ?>";
    var role = "<?= $role; ?>";
    var page = 1;
    var per_page = 4;
    var total = <?= $comments_count; ?>;
    var limit  = Math.ceil(total/per_page);
    showcomments(page);

    if(total <= per_page) {
      $('#loadmore').remove();
      $('#nomore').replaceWith('<p id="none">No Comments</p><br>');
    }


    $("#loadmore").click(function() {
      if(page <= limit) {
        page++;
        showcomments(page);
      }
    });


     function showcomments(page){
      if(page == limit){
        $("#loadmore").remove();
      }
      if(!$.isNumeric(page)){
        page=1;
      }

      $.ajax(
      {

        url: '<?= base_url('api/api/get_comments/'); ?>'+post_id+'/'+page,
        type: "get",
        beforeSend: function()
        {
          $('.ajax-load').show();
        },
        success: function(response)
        {
          $('.ajax-load').hide();
          $('#comments').append(response);

        },

          error:function(response)
          {
            $('#end').append('No posts!');
          }

      });
    }



    
    $('#comment').click(function () {
      $("#success").remove();
      $("#error").remove();
        var comment = $('textarea#body').val();

        $.ajax({
          type : 'post',
          url : "<?= base_url('api/authapi/create_comment/'); ?>"+post_id,
          data: {comment:comment},
          dataSrc: '',
          success : function(response){
            $('.invisible').removeClass('invisible');
            $("#success").remove();
            $("textarea#body").val('');
            $('#message').append( '<div id="success" style="background-color: #d4edda;height: 35px; padding-top: 2px;border-color: #c3e6cb;border-radius: .25rem;" class="col-md-12 text-success">Your comment added successfully!</div>' );
            $('#success').fadeOut( 3000, function() {
                $('#success').remove();
              });
            $("#comments").prepend(response);
          },
          error: function(response){
            $("#error").remove();
            $('#message').append( '' );
          }
        });

    });


  });
</script>
