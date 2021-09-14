<form method="POST" class='text-center border border-light p-5'>
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" name="name" id="name" onChange="createSocial(this.value)" class="form-control" placeholder="Name">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" name="fa_icon" id="fa_icon" onChange="createSocial('null',this.value)" class="form-control" placeholder="fa-icon">
        </div>
    </div>

    <!-- E-mail -->
    <div class="form-row mb-4">
    	<input type="text" name="link" id="link" onChange="createSocial('null', 'null', this.value)" class="form-control" placeholder="URL">
    </div>

    


    <!-- Sign up button -->
    <button id="element" class="btn btn-primary my-4 btn-block text-white" onClick="createSocial('null', 'null', 'null', true)" type="button"><strong>Create</strong></button>


</form>
<!-- Default form register -->
<script type="text/javascript">
  var name = '';
  var fa_icon = '';
  var link = '';
  var submit = false;
function createSocial(social=name,fa=fa_icon,url=link,submit_val=submit) {
  if(social != 'null'){
    name = social;
  }
  if(fa != 'null'){
    fa_icon = fa;
  }
  if(url != 'null'){
    link = url;
  }
  submit = submit_val;
  if(submit){
    if(name == '' || fa_icon == '' || link == ''){
      submit = false;
      toastr.error(
        'All fields are required!','Error',
        {
          timeOut: 1000,
          fadeOut: 500
        });
    } else {



    $.ajax({
          type: 'post',
          url: '<?= base_url('dashboard/create_social_network'); ?>',
          data: {name:name,fa_icon:fa_icon,link:link},
          dataSrc: '',
          success: function(data){
            console.log(data);
            toastr.success(
              'Social Network created successfully!','Success',
              {
                timeOut: 1000,
                fadeOut: 500,
                onHidden: function () {
                  $('#closeCreate').click();
                }
              }
              );
          },
          error: function(data){
            console.log(JSON.stringify(data));
          }
        });
      }


  }

}

</script>